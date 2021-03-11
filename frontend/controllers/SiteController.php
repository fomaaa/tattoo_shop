<?php

namespace frontend\controllers;

use cheatsheet\Time;
use common\models\Article;
use common\models\KeyStorageItem;
use common\models\ProductCategoryModel;
use common\models\ProductModel;
use common\models\Subscription;
use common\models\User;
use common\sitemap\UrlsIterator;
use frontend\models\ContactForm;
use Sitemaped\Element\Urlset\Urlset;
use Sitemaped\Sitemap;
use Yii;
use yii\filters\PageCache;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
	use \common\traits\GlobalFunctions;

	public function beforeAction($action)
	{
		if (Yii::$app->controller->action->id == 'index') {
			$type = 'home';
		} elseif (Yii::$app->controller->action->id == 'contact') {
			$type = 'contact';
		}
		$this->putSEO(1, $type);
		$this->enableCsrfValidation = false;

		return parent::beforeAction($action);
	}


	public function behaviors()
	{
		return [
			[
				'class' => PageCache::class,
				'only' => ['sitemap'],
				'duration' => Time::SECONDS_IN_AN_HOUR,
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction'
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
			],
			'set-locale' => [
				'class' => 'common\actions\SetLocaleAction',
				'locales' => array_keys(Yii::$app->params['availableLocales'])
			]
		];
	}

	/**
	 * @return string
	 */
	public function actionIndex()
	{
		$subscribe = KeyStorageItem::find()->where(['key' => 'settigns.subscribe'])->one();
		$subscribe = json_decode($subscribe->value);

		$novelty = KeyStorageItem::find()->where(['key' => 'frontend.novelty'])->one();

		if ($novelty->value) {
			$novelty = ProductModel::find()->where(['is_published' => 1])->andWhere('id IN ( ' . $novelty->value . ')')->all();
		}

		$bestsellers = KeyStorageItem::find()->where(['key' => 'frontend.bestsellers'])->one();

		if ($bestsellers->value) {
			$bestsellers = ProductModel::find()->where(['is_published' => 1])->andWhere('id IN ( ' . $bestsellers->value . ')')->all();
		}

		$articles = Article::find()->orderby('published_at desc')->limit(4)->all();
		$contacts = KeyStorageItem::find()->where(['key' => 'frontend.contacts'])->one();


		$categories['main'] = ProductCategoryModel::find()
			->select(['product_category.*', 'count(product.id) as count'])
			->leftJoin('product', 'product_category.id = product.category')
			->where(['parent' => 0])
			->groupBy(['product_category.id'])
			->orderby('sort asc')
			->asArray()
			->all();

		$categories['sub'] = ProductCategoryModel::find()
			->select(['product_category.*', 'count(product.id) as count'])
			->leftJoin('product', 'product_category.id = product.category')
			->where('parent != 0')
			->groupBy(['product_category.id'])
			->orderby('sort asc')
			->asArray()
			->all();

		if (is_array($categories['main'])) {
			foreach ($categories['main'] as $key => $main) {
				if (is_array($categories['sub'])) {
					foreach ($categories['sub'] as $index => $sub) {
						if ($sub['parent'] == $main['id']) {

							$res[$main['id']][] = $sub;
						}

					}
				}

			}
		}
		$categories['sub'] = $res;

		$slider = KeyStorageItem::find()->where(['key' => 'frontend.slider'])->one();
		$advantage = KeyStorageItem::find()->where(['key' => 'frontend.advantage'])->one();

		return $this->render('index', [
			'categories' => $categories,
			'novelty' => $novelty,
			'bestsellers' => $bestsellers,
			'articles' => $articles,
			'contacts' => json_decode($contacts->value),
			'subscribe' => $subscribe,
			'slider' => json_decode($slider->value, true),
			'advantage' => json_decode($advantage->value, true)
		]);
	}

	/**
	 * @return string|Response
	 */
	public function actionContact()
	{
		$model = new ContactForm();

		$data = KeyStorageItem::find()->where(['key' => 'frontend.contacts'])->one();

		if ($model->load(Yii::$app->request->post())) {
			\Yii::$app->email->sendNotification('callback', $model);
			$amo = Yii::$app->amocrm->getClient();

			$lead = $amo->lead;
			$lead['name'] = 'Заявка с формы обратной связи с сайта.';
			$lead['responsible_user_id'] = 3885049;
			 $lead->addCustomField(129781, [
			     [$model->body],
			 ]);
			$id = $lead->apiAdd();

			$contact = $amo->contact;

			$contact['name'] = isset($model->name) ? $model->name : 'Не указано';
			$contact['linked_leads_id'] = [(int)$id];

			$contact->addCustomField(118175, [
				[$model->email, 'WORK'],
			]);
			$contact->addCustomField(129705, [
				['194017'],
			]);

			// Добавление нового контакта и получение его ID
			$id = $contact->apiAdd();

			\Yii::$app->getSession()->setFlash('alert', [
				'body' => Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
				'options' => ['class' => 'alert-success']
			]);
			return $this->refresh();
		}

		return $this->render('contact', [
			'model' => $model,
			'data' => json_decode($data->value)
		]);
	}

	/**
	 * @param string $format
	 * @param bool $gzip
	 * @return string
	 * @throws BadRequestHttpException
	 */
	public function actionSitemap($format = Sitemap::FORMAT_XML, $gzip = false)
	{
		$links = new UrlsIterator();
		$sitemap = new Sitemap(new Urlset($links));

		Yii::$app->response->format = Response::FORMAT_RAW;

		if ($gzip === true) {
			Yii::$app->response->headers->add('Content-Encoding', 'gzip');
		}

		if ($format === Sitemap::FORMAT_XML) {
			Yii::$app->response->headers->add('Content-Type', 'application/xml');
			$content = $sitemap->toXmlString($gzip);
		} else if ($format === Sitemap::FORMAT_TXT) {
			Yii::$app->response->headers->add('Content-Type', 'text/plain');
			$content = $sitemap->toTxtString($gzip);
		} else {
			throw new BadRequestHttpException('Unknown format');
		}

		$linksCount = $sitemap->getCount();
		if ($linksCount > 50000) {
			Yii::warning(\sprintf('Sitemap links count is %d'), $linksCount);
		}

		return $content;
	}

	public function actionSubscribe()
	{
		if ($_POST['email']) {
			$actual = Subscription::find()->where(['email' => $_POST['email']])->asArray()->one();

			if ($actual) {
				$message = 'Введенный Email уже подписан на рассылку';
				$sub_message = '';
			} else {
				$actual = new Subscription();
				$actual->email = $_POST['email'];
				if (!Yii::$app->user->isGuest) {
					$actual->user_id = Yii::$app->user->id;
					$user = User::findOne(Yii::$app->user->id);

					if ($user) {
						$user->subscribe = 1;
						$user->save();
					}
				}

				$actual->save(false);

				//TODO send data to MAILCHIMP

				$message = 'ПОДПИСКА ОФОРМЛЕНА!';
				$sub_message = 'Теперь вы будете получать самые свежие новости и не пропустите акутальные акции и предложения';
			}
		}

		$response = '<div class="subscribe__body">
                <div class="subscribeNotification">
                    <div class="subscribeNotification__title">' . $message . '</div>
                    <div class="subscribeNotification__text">' . $sub_message . '</div>
                </div>
            </div>';

		exit($response);
	}

	public function actionLogout()
	{
		if (!Yii::$app->user->isGuest) {
			Yii::$app->user->logout();
		}

		return $this->goHome();
	}
}

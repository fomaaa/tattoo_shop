<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
  <main class="pageWrapper">
        <div class="section section--contacts section--paddingTopDefault">
          <div class="container section__inner">
            <div class="page__title">
              <h1>контакты</h1>
            </div>
            <div class="contacts">
              <div class="contacts__left">
                <ul class="contacts__links">
                  <li>
                    <a href="tel:<?php echo preg_replace('~[^0-9]+~','',$data->phone); ?>"> <?php echo $data->phone ?> </a>
                  </li>
                  <li>
                    <a href="mailto:<?php echo $data->email ?>"> <?php echo $data->email ?> </a>
                  </li>
                </ul>
                <div class="contactsLocation">
                  <div class="contactsLocation__title"> наше местонахождение </div>
                  <div class="contactsLocation__address"> <?php echo $data->address ?> </div>
                  <div class="contactsLocation__small"> <?php echo $data->work_time ?> </div>
                </div>
                <div class="metroBox">
                  <div class="metroBox__image">
                    <img src="/img/metro_image2.png" alt="">
                  </div>
                  <div class="metroBox__body">
                    <p><?php echo $data->metro ?></p>
                  </div>
                </div>
              </div>
              <div class="contacts__right">
                <h3 class="text--center">написать нам</h3>
                <div class="auth__body">
                    <?php $form = ActiveForm::begin(['options' =>['class' => 'form form--auth']]); ?>
					<?php if (Yii::$app->session->hasFlash('alert')): ?>
						<div class="formBlock__notification">
							<div class="notificationBox notificationBox--<?php echo(Yii::$app->session->getFlash('alert')['class']); ?>">
								<span class="notificationBox__text"><?php echo(Yii::$app->session->getFlash('alert')['body']); ?></span>
							</div>
						</div>
					<?php endif; ?>
                    <div class="form__group">
                        <?php echo $form->field($model, 'name', [
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Имя</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']);
                        ?>

                        <?php echo $form->field($model, 'email',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>ЭЛ. почта</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']);
                        ?>
                        <?php echo $form->field($model, 'body', [
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Ваше сообщение</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textArea(['class' => 'textarea']);
                        ?>
                    </div>
                    <div class="form__button">
                      <?php echo Html::submitButton('отправить', ['class' => 'btn btn--primary btn--lg', 'name' => 'contact-button']) ?>
                    </div>
                  <?php ActiveForm::end(); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="locationMap" id="map"></div>
        </div>
      </main>

<script>
  var locationCoords = {
    zoom: 14,
    placemarks: [
      {
        lat: <?php echo $data->lat ?>,
        lng: <?php echo $data->lng ?>,
        caption: '<?php echo $data->marker ?>',
        text: '<?php echo $data->tooltip_text ?>',
      }]
  };
</script>

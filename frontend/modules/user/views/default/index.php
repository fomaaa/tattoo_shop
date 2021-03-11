<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings')
?>
      <main class="pageWrapper">
        <div class="section section--account section--paddingTopDefault">
          <div class="containerFluid section__inner">
            <div class="page__title">личный кабинет</div>
            <div class="page__subtitle">изменить регистрационные данные</div>
            <div class="account">
              <div class="account__left">
                <?php echo \Yii::$app->view->renderFile('@app/modules/user/views/default/account-nav.php', [
                  ]); ?>
              </div>
              <div class="account__right">
                <div class="account__form">
                  <div class="formBlock">
					  <?php if (Yii::$app->session->hasFlash('alert')): ?>
						  <div class="formBlock__notification">
							  <div class="notificationBox notificationBox--<?php echo(Yii::$app->session->getFlash('alert')['class']); ?>">
								  <span class="notificationBox__text"><?php echo(Yii::$app->session->getFlash('alert')['body']); ?></span>
							  </div>
						  </div>
					  <?php endif; ?>
                    <?php $form = ActiveForm::begin(['options' =>['class' => 'form form--account']]); ?>
                      <div class="form__row">
                        <div class="form__groupWrapper">
                          <div class="form__title">контакты</div>
                          <div class="form__group">
                            <?php echo $form->field($model->getModel('account'), 'email',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Email</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']); ?>


                            <?php echo $form->field($model->getModel('profile'), 'firstname',[
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
                                ])->textInput(['class' => 'input']); ?>


                            <?php echo $form->field($model->getModel('profile'), 'lastname',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Фамилия</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']); ?>

                            <?php echo $form->field($model->getModel('profile'), 'phone',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Телефон</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']); ?>

                          </div>
                        </div>
                        <div class="form__groupWrapper">
                          <div class="form__title">адрес</div>
                          <div class="form__group">

                            <?php echo $form->field($model->getModel('profile'), 'country',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>страна</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']); ?>

                            <?php echo $form->field($model->getModel('profile'), 'city',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>город</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']); ?>

                            <?php echo $form->field($model->getModel('profile'), 'address',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>адрес</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']); ?>


                            <?php echo $form->field($model->getModel('profile'), 'post_index',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>индекс</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false,
                                    ]
                                ])->textInput(['class' => 'input']); ?>
                          </div>
                        </div>
                      </div>
                      <div class="form__button">
                        <?php echo Html::submitButton('сохранить изменения ', ['class' => 'btn btn--primary btn--lg']) ?>
                      </div>
                    <?php ActiveForm::end(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

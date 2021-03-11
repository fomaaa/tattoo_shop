<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

      <main class="pageWrapper">
        <div class="section section--auth section--paddingTopDefault">
          <div class="container section__inner">
            <div class="page__title">личный кабинет</div>
            <div class="auth">
              <ul class="authLinks">
                <li class="authLinks__item">
                  <a href="/login" class="is-active">Вход</a>
                </li>
                <li class="authLinks__item">
                  <a href="/registration">регистрация</a>
                </li>
              </ul>
              <div class="auth__body">
                <?php $form = ActiveForm::begin(['options' =>['id' => 'login-form', 'class' => 'form form--auth']]); ?>
                  <div class="form__group">
                    <?php echo $form->field($model, 'identity',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Логин или Email</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>", 
                                    'options' => [
                                        'tag' => false, 
                                    ] 
                                ])->textInput(['class' => 'input']); ?>

                    <?php echo $form->field($model, 'password',[
                                    'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Пароль</span>
                                            <a href='/user/sign-in/request-password-reset' class='btn btn--link btn--xs'>Напомнить пароль</a>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
                                    'options' => [
                                        'tag' => false, 
                                    ] 
                                ])->passwordInput() ?>
                  </div>
                  <div class="form__button">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn--primary btn--lg', 'name' => 'login-button']) ?>
                  </div>
                <?php ActiveForm::end(); ?>
              </div>
            </div>
          </div>
        </div>
      </main>
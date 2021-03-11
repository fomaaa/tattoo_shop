<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-signup">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?php echo $form->field($model, 'username') ?>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div> -->

<main class="pageWrapper">
    <div class="section section--auth section--paddingTopDefault">
        <div class="container section__inner">
            <div class="page__title">личный кабинет</div>
            <div class="auth">
                <ul class="authLinks">
                    <li class="authLinks__item">
                        <a href="/login">Вход</a>
                    </li>
                    <li class="authLinks__item">
                        <a href="/registration" class="is-active">регистрация</a>
                    </li>
                </ul>
                <div class="auth__body">
                    <?php $form = ActiveForm::begin(['options' =>['id' => 'form-signup', 'class' => 'form form--auth']]); ?>
                        <div class="form__group">
                            <?php echo $form->field($model, 'username',[
                                    'template' => "
                                    <div class='form__field is-required'>
                                        <label class='label'>
                                            <span class='label__title'>Логин</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>", 
                                    'options' => [
                                        'tag' => false, 
                                    ] 
                                ])->textInput(['class' => 'input']) ?>  

                            <?php echo $form->field($model, 'email',[
                                    'template' => "
                                    <div class='form__field is-required'>
                                        <label class='label'>
                                            <span class='label__title'>email</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>", 
                                    'options' => [
                                        'tag' => false, 
                                    ] 
                                ])->textInput(['class' => 'input']) ?> 

                            <?php echo $form->field($model, 'password',[
                                    'template' => "
                                    <div class='form__field is-required'>
                                        <label class='label'>
                                            <span class='label__title'>Пароль</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>", 
                                    'options' => [
                                        'tag' => false, 
                                    ] 
                                ])->passwordInput(['class' => 'input']) ?>

                            <div class="form__field is-required">
                                <label class="label">
                                    <span class="label__title">Пароль еще раз</span>
                                </label>
                                <input type="password" name="SignupForm[password-confirmation]" class="input " />
                            </div>
                            <div class="form__field">
                                <label class="label">
                                    <span class="label__title">Имя</span>
                                </label>
                                <input type="text" name="SignupForm[firstname]" class="input " />
                            </div>
                            <div class="form__field">
                                <label class="label">
                                    <span class="label__title">Фамилия</span>
                                </label>
                                <input type="text" name="SignupForm[lastname]" class="input " />
                            </div>
                            <div class="form__field">
                                <label class="label">
                                    <span class="label__title">Телефон</span>
                                </label>
                                <input type="text" name="SignupForm[phone]" class="input " />
                            </div>
                        </div>
                  <div class="form__hideFields hideFields">
                    <div class="hideFields__button">
                      <a href="#" class="btn btn--transparent js-hideField-button">
                        <svg class="icon icon-plus">
                          <use xlink:href="img/sprite.svg#icon-plus"></use>
                        </svg>
                        <span>добавить адрес</span>
                      </a>
                    </div>
                    <div class="hideFields__body">
                      <div class="form__group">
                        <div class="form__field">
                          <label class="label">
                            <span class="label__title">Страна</span>
                          </label>
                          <input type="text" name="SignupForm[country]" class="input " />
                        </div>
                        <div class="form__field">
                          <label class="label">
                            <span class="label__title">Город</span>
                          </label>
                          <input type="text" name="SignupForm[city]" class="input " />
                        </div>
                        <div class="form__field">
                          <label class="label">
                            <span class="label__title">Адрес</span>
                          </label>
                          <input type="text" name="SignupForm[address]" class="input " />
                        </div>
                        <div class="form__field">
                          <label class="label">
                            <span class="label__title">Индекс</span>
                          </label>
                          <input type="text" name="SignupForm[post_index]" class="input " />
                        </div>
                      </div>
                    </div>
                  </div>
                        <div class="form__button">
                            <?php echo Html::submitButton('зарегистрироваться', ['class' => 'btn btn--primary btn--lg', 'name' => 'signup-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</main>
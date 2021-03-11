<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Сменить пароль')
?>
<main class="pageWrapper">
	<div class="section section--account section--paddingTopDefault">
		<div class="containerFluid section__inner">
			<div class="page__title">личный кабинет</div>
			<div class="page__subtitle">ИЗМЕНИТЬ ПАРОЛЬ</div>
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
							<?php $form = ActiveForm::begin(['options' => ['class' => 'form form--account']]); ?>
							<form action="/" class="form form--account">
								<div class="form__row">
									<div class="form__groupWrapper">
										<div class="form__title">Введите новый пароль</div>
										<div class="form__group">

											<?php echo $form->field($model->getModel('account'), 'password', [
												'template' => "
                                    <div class='form__field'>
                                        <label class='label'>
                                            <span class='label__title'>Новый пароль</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
												'options' => [
													'tag' => false,
												]
											])->passwordInput() ?>

											<?php echo $form->field($model->getModel('account'), 'password_confirm', [
												'template' => "
                                    <div class='form__field is-required'>
                                        <label class='label'>
                                            <span class='label__title'>ПАРОЛЬ ЕЩЕ РАЗ</span>
                                        </label>

                                    {input}\n{hint}\n{error}

                                    </div>",
												'options' => [
													'tag' => false,
												]
											])->passwordInput() ?>

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

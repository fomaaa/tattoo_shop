<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\PasswordResetRequestForm */

$this->title =  Yii::t('frontend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>


<main class="pageWrapper">
	<div class="section section--auth section--paddingTopDefault">
		<div class="container section__inner">
			<div class="page__title"><?php echo Html::encode($this->title) ?></div>
			<div class="auth">
				<div class="auth__body">
					<?php $form = ActiveForm::begin(['options' => ['id' => 'request-password-reset-form', 'class'=> 'form form--auth']]); ?>
					<div class="form__group">
						<?php echo $form->field($model, 'email',[
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
					</div>
					<div class="form__button">
						<?php echo Html::submitButton(Yii::t('frontend', 'Reset password'), ['class' => 'btn btn--primary btn--lg']) ?>
					</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</main>

<style type="text/css">
div.form span label {
	display: inline;
	font-weight: normal;
}
</style>

<?php if (Yii::app()->user->hasFlash('userIsSaved')) { ?>
<p>
	<?php echo Yii::app()->user->getFlash('userIsSaved') ?>
</p>
<?php } ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'user-update',
	// 'enableClientValidation'=>true,
	// 'clientOptions'=>array(
	// 	'validateOnSubmit'=>true,
	// ),
)); ?>

	<?php echo $form->errorSummary($user); ?>

	<div class="row">
		<?php echo $form->label($user, 'login'); ?>
		<?php echo $form->textField($user, 'login'); ?>
		<?php echo $form->error($user, 'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user, 'password'); ?>
		<?php echo $form->textField($user, 'password'); ?>
		<?php echo $form->error($user, 'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user, 'username'); ?>
		<?php echo $form->textField($user, 'username'); ?>
		<?php echo $form->error($user, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user, 'sex'); ?>
		<?php echo $form->radioButtonList($user, 'sex', array('female', 'male')); ?>
		<?php echo $form->error($user, 'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user, 'email'); ?>
		<?php echo $form->textField($user, 'email'); ?>
		<?php echo $form->error($user, 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user, 'phone'); ?>
		<?php echo $form->textField($user, 'phone'); ?>
		<?php echo $form->error($user, 'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($user, 'description'); ?>
		<?php echo $form->textArea($user, 'description', array('style' => 'width:400px;height:100px')); ?>
		<?php echo $form->error($user, 'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

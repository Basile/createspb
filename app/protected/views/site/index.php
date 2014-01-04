<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'login',
		'password' => array(
			'name' => 'password',
			'sortable' => false,
		),
		'username' => array(
			'name' => 'username',
			'sortable' => false,
		),
		'sex' => array(
			'name' => 'sex',
			'sortable' => false,
			'value' => '$data->getSexAsText()',
		),
		'email',
		'phone',
		array(
			'class' => 'CButtonColumn',
			'viewButtonUrl' => '$this->grid->controller->createUrl("user/view", array("id" => $data->id))',
			'updateButtonUrl' => '$this->grid->controller->createUrl("user/update", array("id" => $data->id))',
			'deleteButtonUrl' => '$this->grid->controller->createUrl("user/delete", array("id" => $data->id))',
		),
	),
));
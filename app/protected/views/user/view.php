<?php
$createdAt = DateTime::createFromFormat('Y-m-d H:i:s', $user->created_at);
$updatedAt = DateTime::createFromFormat('Y-m-d H:i:s', $user->updated_at);
$this->widget('zii.widgets.CDetailView', array(
	'data' => $user,
	'attributes' => array(
		'id',
		'login',
		'password',
		'username',
		array(
			'label' => 'Sex',
			'type' => 'raw',
			'value' => $user->getSexAsText(),
		),
		'email',
		'phone',
		'description',
		array(
			'label' => 'Created At',
			'type' => 'raw',
			'value' => $createdAt->format('d.m.Y H:i:s'),
		),
		array(
			'label' => 'Updated At',
			'type' => 'raw',
			'value' => $updatedAt->format('d.m.Y H:i:s'),
		),
	),
));

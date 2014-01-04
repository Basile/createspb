<?php
class UserController extends Controller {

	public function actionView($id) {
		$user = User::model()->findByPk($id);
		if (!$user) {
			throw new CHttpException(404, 'Not found');
		}

		$this->render('view', array(
			'user' => $user,
		));
	}

	public function actionCreate() {
		$user = new User;
		if (isset($_POST['User'])) {
			$user->attributes = $_POST['User'];
			if ($user->save()) {
				Yii::app()->user->setFlash('userIsSaved', 'User was created successfully');
				$this->redirect($this->createUrl('user/update', array('id' => $user->id)));
			}
		}
		$this->render('create', array(
			'user' => $user,
		));
	}	

	public function actionUpdate($id) {
		$user = User::model()->findByPk($id);
		if (!$user) {
			throw new CHttpException(404, 'Not found');
		}

		if (isset($_POST['User'])) {
			$user->attributes = $_POST['User'];
			if ($user->save()) {
				Yii::app()->user->setFlash('userIsSaved', 'User was updated successfully');
				$this->redirect($this->createUrl('user/update', array('id' => $id)));
			}
		}
		$this->render('update', array(
			'user' => $user,
		));
	}

	public function actionDelete($id) {
		$n = User::model()->deleteByPk($id);
		if (!$n) {
			throw new CHttpException(404, 'Not found');
		}
	}

	public function actionSearch($term) {
		$term = addcslashes($term, '%_');
		$users = User::model()->findAll(array(
			'select' => 'id, login',
			'condition' => 'login like :login',
			'order' => 'login',
			'limit' => 10,
			'params' => array(
				'login' => $term . '%',
			),
		));
		$response = array();
		foreach ($users as $u) {
			$response[] = array(
				'value' => $this->createUrl('user/update', array('id' => $u['id'])),
				'label' => $u['login'],
			);
		}
		echo json_encode($response);
	}
}

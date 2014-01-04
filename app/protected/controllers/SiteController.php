<?php

class SiteController extends Controller {
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$dataProvider = new CActiveDataProvider('User', array(
			'pagination' => array(
				'pageSize' => 50,
			),
		));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else {
				$this->render('error', $error);
			}
		}
	}

	public function actionStats() {
		$usersNumber = User::model()->count();

		$usersSex = $this->getUsersSexData();
		$sexData = array(
			array('Женский', isset($usersSex[0]) ? $usersSex[0] : 0),
			array('Мужской', isset($usersSex[1]) ? $usersSex[1] : 0),
		);

		$domains = $this->getEmailDomainsData();
		$domainsList = array_keys($domains);

		$this->render('stats', array(
			'usersNumber' => $usersNumber,
			'sexData' => $sexData,
			'domainsList' => $domainsList,
			'domains' => $domains,
		));
	}

	protected function getUsersSexData() {
		$userRows = Yii::app()->db->createCommand()
			->select('sex, count(id) as count')
			->from('users')
			->group('sex')
			->queryAll();
		$data = array();
		foreach ($userRows as $r) {
			$data[$r['sex']] = (int)$r['count'];
		}
		return $data;
	}

	protected function getEmailDomainsData() {
		$domainRows = Yii::app()->db->createCommand()
			->select("substring_index(email, '.', -1) as domain, count(id) as count")
			->from('users')
			->group('domain')
			->queryAll();
		$domains = array();
		foreach ($domainRows as $d) {
			$domains[$d['domain']] = (int)$d['count'];
		}
		return $domains;
	}
}

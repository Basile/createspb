<?php
class User extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'users';
	}

	public function rules() {
		return array(
			array('login, password', 'required'),
			array('login', 'unique'),
			array('email', 'email'),
			array('login, password, username, email, phone', 'length', 'max' => 255),
			array('sex', 'in', 'range' => array(0, 1)),
			array('created_at, updated_at', 'date', 'format' => 'yyyy-MM-dd hh:mm:ss'),
		);
	}

	public function getSexAsText() {
		return $this->sex ? 'male' : 'female';
	}

	protected function beforeSave() {
		if ($this->isNewRecord) {
			$this->created_at = date('Y-m-d H:i:s');
		}
		$this->updated_at = date('Y-m-d H:i:s');
		return true;
	}
}

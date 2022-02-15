<?php

require_once "../DB.php";

class UserModel {
  public $_id;
  public $email;
  public $username;
  public $password;
  
  public function __construct($email, $username, $password) {
	$this->email = $email;
	$this->username = $username;
	$this->password = $password;
  }

  public static function register($email, $username, $password) {
    $createdUser = DB::get()->users->insertOne([
		'email' => $email,
		'username' => $username,
		'password' => password_hash($password, PASSWORD_DEFAULT)
	]);

	return $createdUser->getInsertedId();
  }

  public static function load($username, $password) {
    $user = DB::get()->users->findOne(['username' => $username]);

	if ($user && password_verify($password, $user['password'])) {
	  $userEntity = new UserModel(
          $user['email'], 
		  $user['username'], 
		  $user['password']
		);

		$userEntity->_id = $user['_id']->__toString();
        $userEntity->saveSessionDetalis();
		return $userEntity;
	}

	return NULL;
  }
  
  public static function getUserSession() {
    if (isUserAuthorized()) {
        return load($_SESSION['username'], $_SESSION['password']);
    } else {
        return null;
    }
  }  

  public function saveSessionDetalis() {
	$_SESSION['userId'] = $this->_id;
	$_SESSION['username'] = $this->username;
	$_SESSION['email'] = $this->email;
  }

  public static function isUserAuthorized() {
	return isset($_SESSION['userId']);
  }

  public static function getUserID() {
	return $_SESSION['userId'];
  }

  public static function getAuthorizedUserName() {
	return $_SESSION['username'];
  }

  public static function getAuthorizedUserEmail() {
	return $_SESSION['email'];
  }

  public static function getAuthorizedUser() {
	$user = DB::get()->users->findOne(['_id' => RegisteredUser::getUserID()]);

	$userEntity = new RegisteredUser(
		$user['username'], 
		$user['password'], 
		$user['email'], 
		$user['publicPhotos'], 
		$user['privatePhotos']
	  );

	  $userEntity->_id = $user['_id']->__toString();

	  return $userEntity;
  }

  public static function checkUserExists($username) {
	return DB::get()->users->findOne(['username' => $username]) !== NULL;
  }
}
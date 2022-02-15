<?php

require_once '../views/RegisterView.php';
require_once '../views/GalleryView.php';
require_once '../views/RedirectView.php';
require_once '../views/DebugView.php';
require_once '../views/LoginFailedView.php';
require_once '../models/UserModel.php';

class RegisterController {
  public function signUpView() {
    return new RegisterView();
  }

  public function signUp() {
    if (!isset($_POST['username'])) {
      $_POST['username'] = '';
    }

    if (!isset($_POST['password'])) {
      $_POST['password'] = '';
    }

    if (!isset($_POST['repeatedPassword'])) {
      $_POST['repeatedPassword'] = '';
    }

    if (!isset($_POST['email'])) {
      $_POST['email'] = '';
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatedPassword = $_POST['repeatedPassword'];
    $email = $_POST['email'];

    if ($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return new RegisterView(
        $username, 
        $password, 
        $repeatedPassword, 
        $email,
        [REGISTER_ERROR::INVALID_EMAIL]
      );
    }

    if ($username == '') {
      return new RegisterView(
        $username, 
        $password, 
        $repeatedPassword, 
        $email,
        [REGISTER_ERROR::EMPTY_USERNAME]
      );
    }

    if (UserModel::checkUserExists($username)) {
      return new RegisterView(
        $username, 
        $password, 
        $repeatedPassword, 
        $email,
        [REGISTER_ERROR::USERNAME_ALREADY_TAKEN]
      );
    }

    if ($password == '') {
      return new RegisterView(
        $username, 
        $password, 
        $repeatedPassword, 
        $email,
        [REGISTER_ERROR::EMPTY_PASSWORD]
      );
    }

    if ($repeatedPassword != $password) {
      return new RegisterView(
        $username,
        $password, 
        $repeatedPassword,
        $email,
        [REGISTER_ERROR::PASSWORD_MISMATCH]
      );
    }

    UserModel::register($email, $username, $password);
    return new RedirectView("/gallery", 303);
  }

  public function login() {
    if (!isset($_POST['username'])) {
      $_POST['username'] = '';
    }

    if (!isset($_POST['password'])) {
      $_POST['password'] = '';
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '') {
      return new LoginFailedView(REGISTER_ERROR::EMPTY_USERNAME);
    }

    if ($password == '') {
      return new LoginFailedView(REGISTER_ERROR::EMPTY_PASSWORD);
    }

    $user = UserModel::load($username, $password);
    if ($user === NULL) {
      return new LoginFailedView(REGISTER_ERROR::INVALID_CREDENTIALS);
    }

    return new RedirectView("/gallery", 303);
  }

  public function logout() {
    session_destroy();
    return new RedirectView("/gallery", 303);
  }
}
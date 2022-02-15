<?php

class GalleryView {
  private $username;
  private $password;
  private $email;
  private $errors;

  public function __construct($username = "", $password = "", $errors = []) {
    $this->username = $username;
    $this->password = $password;
    $this->errors = $errors;
  }

  public function render() {
    $username = $this->username;
    $password = $this->password;
    $errors = $this->errors;

    include '../layouts/gallery.php';
  }
}
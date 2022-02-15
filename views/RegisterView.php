<?php

abstract class REGISTER_ERROR {
  const EMPTY_USERNAME = "Pusta nazwa użytkownika";
  const USERNAME_ALREADY_TAKEN = "Nazwa użytkownka już zajęta";

  const EMPTY_PASSWORD = "Puste hasło";
  const PASSWORD_MISMATCH = "Hasła do siebie nie pasują";

  const INVALID_EMAIL = "Błędny email";
  const INVALID_CREDENTIALS = "Nieprawidłowe dane logowania";
}

class RegisterView {
  private $userName;
  private $password;
  private $repeatPassword;
  private $email;
  private $errors;

  public function __construct(
      $userName = "", 
      $password = "", 
      $repeatPassword = "", 
      $email = "",
      $errors = []
  ) {
    $this->userName = $userName;
    $this->password = $password;
    $this->repeatPassword = $repeatPassword;
    $this->email = $email;
    $this->errors = $errors;
  }

  public function render() {
    $username = $this->userName;
    $password = $this->password;
    $repeatedPassword = $this->repeatPassword;
    $email = $this->email;
    $errors = $this->errors;

    include '../layouts/register.php';
  }
}
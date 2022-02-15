<?php

class LoginFailedView {
	private $why;

	public function __construct($why) {
		$this->why = $why;
	}

    public function render() {
		$why = $this->why;
        include '../layouts/loginFailed.php';
    }
}
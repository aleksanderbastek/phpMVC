<?php

class DebugView {
  private $data;

  public function __construct($data) {
    $this->data = $data;
  }

  public function render() {
    echo var_dump($this->data);
  }
}
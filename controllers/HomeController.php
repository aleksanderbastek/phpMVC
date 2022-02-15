<?php

require_once '../views/IndexView.php';
require_once '../views/FilmsView.php';
require_once '../views/SeriesView.php';

class HomeController {
  public function index() {
    return new IndexView();
  }
  
  public function films() {
    return new FilmsView();
  }
  
  public function series() {
    return new SeriesView();
  }
}
<?php
require_once '../views/ResourceView.php';

class ResourceController {
  public function serve() {
    return new ResourceView($_SERVER['REQUEST_URI']);
  }
}
<?php

class PhotoModel {
    protected $collection;

	public function __construct($_id, $title, $author) {
		$this->_id = $_id;
		$this->title = $title;
		$this->author = $author;
	}
}
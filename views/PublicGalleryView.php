<?php

class PublicPhotosViewModel {
  public $photos;
  public $currentPage;

  public function __construct($photos, $currentPage) {
    $this->photos = $photos;
    $this->currentPage = $currentPage;
  }
}

class PublicGalleryView {
  private $gallery; // PublicPhotosViewModel

  public function __construct($galleryViewModel) {
	  $this->gallery = $galleryViewModel;
  }

  public function render() {
    $publicPhotos = $this->gallery->photos;
	  $gallery = $this->gallery;

    $currentPublicPage = $this->gallery->currentPage;
    $currentPrivatePage = 1;

    $publicPhotoAmount = PublicPhotoModel::getAmountOfPublicImg();

    include '../layouts/gallery.php';
  }
}
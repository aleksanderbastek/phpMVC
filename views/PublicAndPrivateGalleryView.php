<?php
require_once "../models/UserModel.php";

class PublicPrivatePhotosViewModel {
  public $publicPhotos;
  public $privatePhotos;

  public $currentPublicPage;
  public $currentPrivatePage;

  public function __construct($publicPhotos, $privatePhotos, $currentPublicPage, $currentPrivatePage) {
    $this->publicPhotos = $publicPhotos;
    $this->privatePhotos = $privatePhotos;
    $this->currentPublicPage = $currentPublicPage;
    $this->currentPrivatePage = $currentPrivatePage;
  }
}

class PublicAndPrivateGalleryView {
  private $gallery;

  public function __construct($galleryViewModel) {
	  $this->gallery = $galleryViewModel;
  }

  public function render() {
    $publicPhotos = $this->gallery->publicPhotos;
    $privatePhotos = $this->gallery->privatePhotos;
    
    $currentPublicPage = $this->gallery->currentPublicPage;
    $currentPrivatePage = $this->gallery->currentPrivatePage;
    
    $publicPhotoAmount = PublicPhotoModel::getAmountOfPublicImg();
    $privatePhotoAmount = PrivatePhotoModel::getAmountOfPrivateImg(UserModel::getAuthorizedUserName());

    include '../layouts/gallery.php';
  }
}
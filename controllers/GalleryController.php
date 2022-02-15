<?php
require_once '../views/GalleryView.php';
require_once '../views/DebugView.php';
require_once '../views/RedirectView.php';
require_once '../models/UserModel.php';
require_once '../views/PublicGalleryView.php';
require_once '../views/PublicAndPrivateGalleryView.php';
require_once '../models/PublicPhotoModel.php';
require_once '../models/PrivatePhotoModel.php';

class GalleryController {
  private function showPublicAndPrivateGallery() {
    $publicPhotosPage = isset($_GET['publicPhotosPage']) && is_numeric($_GET['publicPhotosPage']) ? $_GET['publicPhotosPage'] : 1;
    $privatePhotosPage = isset($_GET['privatePhotosPage']) && is_numeric($_GET['privatePhotosPage']) ? $_GET['privatePhotosPage'] : 1;
    $username = UserModel::getAuthorizedUserName();

    $publicPhotos = PublicPhotoModel::getImages($publicPhotosPage);
    $privatePhotos = PrivatePhotoModel::getImagesOfAuthor($privatePhotosPage, $username);

    $galleryViewModel = new PublicPrivatePhotosViewModel($publicPhotos, $privatePhotos, $publicPhotosPage, $privatePhotosPage);

    return new PublicAndPrivateGalleryView($galleryViewModel);
  }
  
  private function showPublicGallery() {
    $publicPhotosPage = isset($_GET['publicPhotosPage']) && is_numeric($_GET['publicPhotosPage']) ? $_GET['publicPhotosPage'] : 1;
    $publicPhotos = PublicPhotoModel::getImages($publicPhotosPage);

    $galleryViewModel = new PublicPhotosViewModel($publicPhotos, $publicPhotosPage);

    return new PublicGalleryView($galleryViewModel);
  }

  public function show() {
    if (UserModel::isUserAuthorized()) {
      return $this->showPublicAndPrivateGallery();
    }

    return $this->showPublicGallery();
  }

  public function upload() {
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $watermark = isset($_POST['watermark']) ? $_POST['watermark'] : '';
    $privacy = isset($_POST['privacy']) ? $_POST['privacy'] : '';
    $imageUpload = isset($_FILES['image']) ? $_FILES['image'] : '';

    if ($imageUpload['error'] !== UPLOAD_ERR_OK) {
      $_SESSION['upload_error'] = "Wybierz plik";
      return new RedirectView("/gallery", 303);
    }

    if ($imageUpload['size'] > 1048576) {
      $_SESSION['upload_error'] = "Za duży plik";
      return new RedirectView("/gallery", 303);
    }

    $imageExtension = strtolower(pathinfo($imageUpload['name'], PATHINFO_EXTENSION));
    if ($imageExtension !== 'png' && $imageExtension !== 'jpg') {
      $_SESSION['upload_error'] = "Błędne rozszerzenie";
      return new RedirectView("/gallery", 303);
    }
    
    if ($title === '') {
      $_SESSION['upload_error'] = "Podaj tytuł";
      return new RedirectView("/gallery", 303);
    }

    if ($author === '') {
      $_SESSION['upload_error'] = "Podaj autora";
      return new RedirectView("/gallery", 303);
    }

    if ($watermark === '') {
      $_SESSION['upload_error'] = "Podaj zawartość znaku wodnego";
      return new RedirectView("/gallery", 303);
    }

    unset($_SESSION['upload_error']);
    
    $uniqueImageID = uniqid();
    $originalImagePath = 'images/original/' . $uniqueImageID;
    $watermarkedImagePath = 'images/watermarked/' . $uniqueImageID;
    $thumbnailImagePath = 'images/thumbnail/' . $uniqueImageID;

		move_uploaded_file($imageUpload['tmp_name'], $originalImagePath);

    if ($imageExtension === 'png') {
      $image = imagecreatefrompng($originalImagePath);
    } else {
      $image = imagecreatefromjpeg($originalImagePath);
    }

		$watermark_color_alpha = imagecolorallocatealpha($image, 255, 0, 0, 80);
		imagestring($image, 5, 0, 0, $watermark, $watermark_color_alpha);
		
    if ($imageExtension === 'png') {
      imagepng($image, $watermarkedImagePath);
    } else {
      imagejpeg($image, $watermarkedImagePath);
    }

		$image = imagescale($image, 200, 125);

		if ($imageExtension === 'png') {
      imagepng($image, $thumbnailImagePath);
    } else {
      imagejpeg($image, $thumbnailImagePath);
    }
    
		imagedestroy($image);

    if ($privacy === 'private') {
      $entry = PrivatePhotoModel::saveImageInCollection($uniqueImageID, $title, $author);
      if ($entry == null) {
        return new DebugView("error when uploading private photo");
      }
    } else {
      $entry = PublicPhotoModel::saveImageInCollection($uniqueImageID, $title, $author);
      if ($entry === NULL) {
        return new DebugView("error when uploading public photo");
      }
    }
    
    return new RedirectView("/gallery", 303);
  }
}
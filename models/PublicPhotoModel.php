<?php

class PublicPhotoModel {
	public $_id;
	public $title;
	public $author;

    public function __construct($_id, $title, $author) {
        $this->_id = $_id;
        $this->title = $title;
        $this->author = $author;
    }

    public static function getImages($page) {
        $skip = ($page - 1) * 6;
        $photosFromDb = DB::get()->publicPhotos->find([], ["limit" => 6, "skip" => $skip]);

        $photos = [];

        foreach ($photosFromDb as $photo) {
            $publicPhoto = new PublicPhotoModel(
                $photo['_id'],
                $photo['title'],
                $photo['author']
            );
            array_push($photos, $publicPhoto);
        }

        return $photos;
    }

    public static function saveImageInCollection($_id, $title, $author) {
        if (UserModel::isUserAuthorized() && UserModel::getAuthorizedUserName() != $author) {
            return null;
        }
        
        DB::get()->publicPhotos->insertOne([
            "_id" => $_id,
            "title" => $title,
            "author" => $author,
        ]);

        return new PublicPhotoModel($_id, $title, $author);
    }
    
    public static function getAmountOfPublicImg() {
        $photosFromDb = DB::get()->publicPhotos->find()->toArray();
        return ceil(count($photosFromDb) / (float)6);
    }

}
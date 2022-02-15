<?php

class PrivatePhotoModel {
	public $_id;
	public $title;
	public $author;

    public function __construct($_id, $title, $author) {
        $this->_id = $_id;
        $this->title = $title;
        $this->author = $author;
    }

    public static function getImagesOfAuthor($page, $author) {
        $photosFromDb = DB::get()->privatePhotos->find([
            "author" => $author
        ], [
            "skip" => ($page - 1) * 6,
            "limit" => 6
        ]);
        $photos = [];

        foreach ($photosFromDb as $photo) {
            $publicPhoto = new PrivatePhotoModel(
                $photo['_id'],
                $photo['title'],
                $photo['author']
            );

            array_push($photos, $publicPhoto);
        }

        return $photos;
    }
    
    public static function saveImageInCollection($_id, $title, $author) {
        $isAuthorizedAndCanUpload = UserModel::isUserAuthorized() && $author == UserModel::getAuthorizedUserName();
        
        if ($isAuthorizedAndCanUpload) {
            DB::get()->privatePhotos->insertOne([
                "_id" => $_id,
                "title" => $title,
                "author" => $author,
            ]);

            return new PrivatePhotoModel($_id, $title, $author);
        }
        
        return null;
    }

    public static function getAmountOfPrivateImg($username) {
        $photosFromDb = DB::get()->privatePhotos->find(['author' => $username])->toArray();
        return ceil(count($photosFromDb) / (float)6);
    }
}
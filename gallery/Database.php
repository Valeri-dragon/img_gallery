<?php
require_once 'config.php';
class Database extends Config{

//Insert album data into database
public function createAlbum($albums_title,	$descrip_album){
  $sql = "INSERT INTO albums(albums_title,	descrip_album) VALUES (:albums_title,	:descrip_album)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(
      'albums_title' => $albums_title,
      'descrip_album' => $descrip_album
          ));
    return true;
}

 
//Fetch all albums
public function fetchAllAlbums(){
    $sql = "SELECT * FROM albums ORDER BY id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}
//Fetch single album
public function fetchAlbum($id){
    $sql = " SELECT * FROM albums WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();
    return $row;
}
//Method update album
public function updateAlbum($id, $albums_title,  $descrip_album){
    $sql = " UPDATE  albums SET albums_title = :albums_title, descrip_album = :descrip_album WHERE id = :id";
     $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      'albums_title'=> $albums_title,
      'descrip_album'=> $descrip_album,
      'id' => $id
    ]);
 return true;
}

//Method remove album

public function removeAlbum($id){
    $sql = "DELETE FROM albums WHERE id= :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(
      [
        'id'=> $id
      ]
    );
    return true;
}
  //Insert data into image database
  public function uploadImage($alt_text,
    $title_img,
    $description_img,
    $img_path,
    $album_id
  ) {
    $sql = "INSERT INTO gallery(alt_text, title_img, description_img, img_path, id_album) VALUES (:alt_text, :title_img, :description_img, :img_path, :id_album)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array(
      'alt_text' => $alt_text,
      'title_img' => $title_img,
      'description_img' => $description_img,
      'img_path' => $img_path,
      'id_album' => $album_id
    ));
    return true;
  }


//Fetch all images method

public function fetchAllImages($id_album){
  $sql = "SELECT * FROM gallery  WHERE id_album = :id_album";

    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id_album'=> $id_album]);
    $rows = $stmt->fetchAll();
    return $rows;
}
//Method fetch single image
public function fetchImage($id){
$sql = " SELECT * FROM gallery WHERE id = :id";
$stmt = $this->conn->prepare($sql);
$stmt->execute(['id'=> $id]);
$row =$stmt->fetch();
    return $row;
}
//Method update image
public function updateImage($id, $alt_text, $title_img, $description_img, $img_path){
    $sql = " UPDATE  gallery SET alt_text = :alt_text, title_img = :title_img, description_img = :description_img, img_path = :img_path WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      'alt_text' => $alt_text,
      'title_img' => $title_img,
      'description_img' => $description_img,
      'img_path' => $img_path,
      'id'=>$id
    ]);
    
    return true;
}
//Method delete image
public function removeImage($id){
  $sql = "DELETE FROM gallery WHERE id= :id";
    $stmt = $this->conn->prepare($sql);
     $stmt->execute(
    [
      'id' => $id
    ]);
    return true;
}
}

<?php
require_once  'Util.php';
require_once 'Database.php';

$util = new Util;
$db = new Database;
//Handle fetch all albums ajax request
if(isset($_POST['fetch_all_albums'])){
  $albums =$db->fetchAllAlbums();
  $output = '';
  if($albums){
    /**
     * 
     * @var object $albums
     */
    foreach($albums as $row){
      $output .= '<div class="col-sm-6 col-md-4 col-lg-3  mb-2">
      <a href="./albums.php?' . $row['id'] . '" class="block_img open_album" id="' . $row['id'] . '" ">
      <span  class="open_album" id="' . $row['id'] . '" >
      '. $row['albums_title'] .'
      </span>
      <p class="h5 mt-2">' . $row['descrip_album'] . '</p>
      <span class="mt-2 d-flex justify-content-end">
            <span href="#" class="text-primary me-2 change_album" title="Редактировать альбом" data-bs-toggle="modal" data-bs-target="#edit_album_modal" data-id="'. $row['id']. '">
              <i class="fas fa-edit fa-lg"></i>
            </span>
            <span href="#" class="text-danger me-2 remove_album" title="Удалить альбом" data-id="' . $row['id'] . '">
              <i class="fas fa-trash-alt fa-lg"></i>
            </span>
          </span>
      </a>

      </div>';
    };
    echo $output;
  } else {
    echo '<div class="col-lg-12">
 <h1 class="text-center p-4">Альбомов не найдено</h1>

  </div>';
  }
};
//Method GET fetch album
$album_id = '';
if (isset($_GET['album_id'])) {
  $album_id = $_GET['album_id'];
  $album = $db->fetchAlbum($album_id);
  echo json_encode($album);
}
//Method POST fetch album
if(isset($_POST['sPageURL'])){
  $album_id = $_POST['sPageURL'];
  $album = $db->fetchAlbum($album_id);
  if(!isset($_POST['fetch_all_imgs'])){
    echo json_encode($album);
  }
 
}
//Hadle fetch all images ajax request
if(isset($_POST['fetch_all_imgs'])){
   $album_id =  $util->testInput($_POST['sPageURL']);
$images =$db->fetchAllImages($album_id);
$output = '';
 if($images){
  foreach($images as $row){
      $output .= '<div class="col-sm-6 col-md-4 col-lg-3  mb-2">
      <div class="block_img open_img" id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#img_preview_modal">
      <a href="#" class="open_img" id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#img_preview_modal">
      <img src="./uploads/'.$row['img_path'].'" alt="'.$row['alt_text']. '" class="img-fluid rounded-1 img-thumbnail">
      </a>
      <p class="h5 mt-2">'. $row['title_img']. '</p>
      </div>
      </div>';
  };
  echo $output;
}else{
  echo '<div class="col-lg-12">
 <h1 class="text-center p-4">Изображений не найдено</h1>

  </div>';
}
};


//Method set image in modal ajax request
if(isset($_POST['img_id'])){
$id = $_POST['img_id'];
$img = $db->fetchImage($id);
echo json_encode($img);
}
?>
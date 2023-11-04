<?php
require_once  'Util.php';
require_once 'Database.php';
require_once 'insert.php';
$util = new Util;
$db = new Database;


//Handle edit image ajax request
if (isset($_POST['edit_img'])) {
  $id = $_POST['id'];
  $img = $db->fetchImage($id);
  echo json_encode($img);
}
//Handle update image ajax request
if(isset($_POST['update_upload_img'])){
  
  $img_id =$_POST ['edit_img_id'];
   $old_img = $_POST['old_img'] ;
    $alt_text= $util->testInput($_POST['altText']);
  $title_img = $util->testInput($_POST ['titleImg']);
  $descrip_img = $util->testInput( $_POST  ['descripImg']);
  $img_name =  $_FILES['img']['name'];
  $img_size = $_FILES['img']['size'];
  $img_tmp = $_FILES['img']['tmp_name'];
  $img_ext = explode('.', $img_name);
  $img_ext = strtolower(end($img_ext));
  $allowed_ext  = ['jpg', 'jpeg', 'png'];
  $target_dir = 'uploads/';
  $img_uniqe_name = uniqid(). '.' . $img_ext;
  $img_path  = $target_dir . $img_name;
  if (isset($img_name) && $img_name != '') {
    $new_img_path = $img_name;
    compress($img_tmp, $img_path, 70);
    if($old_img != null){
      unlink($target_dir.$old_img);
    }
  }else{
    $new_img_path = $old_img;
  }
  if($db->updateImage($img_id, $alt_text, $title_img, $descrip_img, $new_img_path )){
    echo
    $util->showMessage('success', 'Изображение удачно обновлено');
  }else{
    echo $util->showMessage('danger', 'Что-то пошло не так!');
  }
}
//Handle edit album  ajax request
if (isset($_POST['edit_album'])) {
  $id = $_POST['id'];
  $album = $db->fetchAlbum($id);
  echo json_encode($album);
}
//Handle update album ajax request
if (isset($_POST['update_album'])) {
  $album_id = $_POST['edit_album_id'];
  $title_album = $util->testInput($_POST['titleAlbum']);
  $descrip_album = $util->testInput($_POST['descripAlbum']);
  if ($db->updateAlbum($album_id,  $title_album, $descrip_album)) {
    echo
    $util->showMessage('success', 'Альбом изменен');
  } else {
    echo $util->showMessage('danger', 'Что-то пошло не так!');
  }

}
?>
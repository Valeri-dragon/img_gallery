<?php
require_once  'Util.php';
require_once 'Database.php';
$util = new Util;
$db = new Database;
//Handle upload image ajax request
if (isset($_POST["upload_img"])) {
 $alt_text= $util->testInput($_POST['altText']);
  $title_img=$util->testInput($_POST['titleImg']);
  $description_img=$util->testInput($_POST['descripImg']);
  $album_id= $util->testInput($_POST['albumId']);
  $img_name = $_FILES['img']['name'];
  $img_size=
  $_FILES['img']['size'];
  $img_tmp = $_FILES['img']['tmp_name'];
  $img_ext = explode('.', $img_name);
  $img_ext = strtolower(end($img_ext));
  $allowed_ext  = ['jpg', 'jpeg', 'png'];
  $target_dir = 'uploads/';
  $img_uniqe_name =uniqid().'.'. $img_ext;
  $img_path
  = $target_dir. $img_name;
  if(!file_exists($img_path)){
if(in_array($img_ext, $allowed_ext)){
  if($img_size <= 1000000){
        // if(move_uploaded_file($img_tmp, $img_path)){
        if (compress($img_tmp, $img_path, 70)) {
$db->uploadImage($alt_text, $title_img, $description_img, $img_name, $album_id);
echo $util->showMessage('success', 'Изображение удачно загружено');
    }
  }else{
    echo $util->showMessage('danger', 'Размер изображения должен быть меньше или равен 1 МБ!');
  }

}else{
   echo $util->showMessage('danger', 'Не соответствует тип изображения. Поддерживыемые форматы jpg, jpeg или png!');
}
  }else{
    echo $util->showMessage('danger', 'Изображение уже существует в базе данных!');
  }
}
//Handle create album
if(isset($_POST['create_album'])){
  //print_r($_POST['create_album']);
  $title_album= $util->testInput($_POST['titleAlbum']);
  $description_album = $util->testInput($_POST['descripAlbum']);
  if(!isset($$title_album)){
    $db->createAlbum($title_album, $description_album);
    echo $util->showMessage('success', 'Альбом удачно создан');
  } else {
    echo $util->showMessage('danger', 'Такой альбом уже существует в базе данных!');
  }
}
//compress image function

function compress($source, $destination, $quality){
$info = getimagesize($source);
if($info['mime']== 'image/jpeg'){
  $image = imagecreatefromjpeg($source);
} else if($info['mime'] == 'image/png'){
    $image = imagecreatefrompng($source);
}
imagejpeg($image,$destination, $quality);
return $destination;
}
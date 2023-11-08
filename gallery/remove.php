<?php
require_once  'Util.php';
require_once 'Database.php';


$util = new Util;
$db = new Database;
//Handle remove image ajax request
if (isset($_POST['remove_img'])) {
 $id = $_POST['id'];
  $img_url = $_POST['img_url'];
  if($db->removeImage($id)){
    unlink($img_url);
    echo
    $util->showMessage('success', 'Изображение удалено');
  } else {
    echo $util->showMessage('danger', 'Что-то пошло не так!');
  }
 
}
//Handle remove album ajax request
if (isset($_POST['remove_album'])) {
  $id = $_POST['id'];
 $images = $db->fetchAllImages($id);
  if ($db->removeAlbum($id)) {
    if ($images) {
      foreach ($images as $row) {
        unlink("./uploads/".$row["img_path"]);
      }}
      echo
    $util->showMessage('success', 'Альбом и всё его содержимое удалено');
  } else {
    echo $util->showMessage('danger',
      'Что-то пошло не так!'
    );
  }
}



?>

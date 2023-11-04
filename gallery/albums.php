<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/fonts/fontawesome.min.css">
  <link rel="stylesheet" href="./assets/fonts/solid.css">
  <link rel=" stylesheet" href="./assets/css/style.css">
  <script src="./assets/js/bootstrap.bundle.min.js" defer></script>
  <script src="./assets/js/jquery-3.5.1.js"></script>
  <script src="./assets/js/menu.js" defer></script>
  <script src="./assets/js/albums.js" defer></script>
  <script src="./assets/js/main.js" defer></script>

  <title>Document</title>
</head>

<body>
  <input type="hidden" value="" name="albumId" class="album_id">
  <!-- image upload modal start -->
  <div class="modal fade" id="upload_img_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Загрузка нового изображения в альбом <span class="titleAlb"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body p-4">
          <div id="message-alert"></div>
          <div class="progress mb-3" style="height: 25px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100">

            </div>
          </div>
          <form action="#" method="POST" enctype="multipart/form-data" id="img_upload_form">
            <div class="mb-3">
              <input type="text" name="altText" id="alt_text" class="form-control" placeholder="Альтернативный текст изображения" required>
            </div>
            <div class="mb-3">
              <input type="text" name="titleImg" id="title_img" class="form-control" placeholder="Название изображения" required>
            </div>
            <div class="mb-3">
              <textarea name="descripImg" id="description_img" class="form-control" placeholder="Описание изображения" required></textarea>
            </div>

            <div class="mb-3">
              <input type="file" name="img" id="upload_img" class="form-control">
            </div>
            <div class="mb-3" id="preview_img">

            </div>
            <div class="mb-3 d-grid">
              <input type="submit" value="Загрузить" class="btn rounded-3" id="upload_btn">
              <input type="hidden" value="" name="albumId" class="album_id">
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
  <!-- image upload modal end -->
  <!-- Change image modal start -->
  <div class="modal fade" id="edit_img_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Изменение выбранного изображения в альбоме <span class="titleAlb"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body p-4">
          <div id="edit_message-alert"></div>
          <div class="progress mb-3" style="height: 25px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100">

            </div>
          </div>
          <form action="#" method="POST" enctype="multipart/form-data" id="img_edit_form">
            <input type="hidden" name="edit_img_id" id="edit_img_id">
            <input type="hidden" name="old_img" id="old_img">
            <div class="mb-3">
              <input type="text" name="altText" id="edit_alt_text" class="form-control" placeholder="Альтернативный текст изображения" required>
            </div>
            <div class="mb-3">
              <input type="text" name="titleImg" id="edit_title_img" class="form-control" placeholder="Название изображения" required>
            </div>
            <div class="mb-3">
              <textarea name="descripImg" id="edit_description_img" class="form-control" placeholder="Описание изображения" required></textarea>
            </div>

            <div class="mb-3 block-relative">


              <label class="btn btn-icon" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Изменить изображение">
                <i class="fas fa-pencil-alt fs-7"></i>
                <input type="file" name="img" id="edit_upload_img" class="form-control d-none">
              </label>

              <div class="mb-3" id="edit_preview_img">

              </div>
            </div>
            <div class="mb-3 d-grid">
              <input type="submit" value="Обновить изображение" class="btn rounded-3 btn-success" id="change_btn">
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
  <!-- Change image  modal end -->
  <!-- Display full image preview modal start -->
  <div class="modal fade" id="img_preview_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="img_title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>


        <div class="modal-body">
          <img class="img-fluid" id="set_img">
          <p class="text-left mt-2" id="img_descr"></p>
          <div class="mt-2 float-end">
            <a href="#" class="text-primary me-2 change_img" title="Изменить изображение" data-bs-toggle="modal" data-bs-target="#edit_img_modal">
              <i class="fas fa-edit fa-lg"></i>
            </a>
            <a href="#" class="text-danger me-2 remove_img" title="Удалить изображение">
              <i class="fas fa-trash-alt fa-lg"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Display full image preview modal end -->
  <div class="container">
    <ul class="text-uppercase mt-4">
      <li class="top-right-slide"><span class="inner-container-top">
          <a href="/" class="nav-links">Главная
          </a>
        </span></li>


      <li class="middle-right-slide">
        <span class="inner-container-middle">
          <a href="./albums.php" class="nav-links">Галерея</a>
        </span>
      </li>
      <li class="bottom-right-slide">
        <span class="inner-container-bottom">
          <a href="#" class="nav-links">Контакты</a>
        </span>
      </li>

      <li class="top-left-slide">
        <span class="inner-container-left-top">
          <a href="#" class="nav-links">Проекты</a>
        </span>
      </li>
      <li class="bottom-left-slide">
        <span class="inner-container-left-bottom">
          <a href="#" class="nav-links">О нас</a>
        </span>
      </li>
    </ul>

    <nav class="main-nav">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <div class="col-6 logo">

            <!-- logo block--><a class="logo__text" href="/" title="Our Nice Logo">Gallery</a>

          </div>
          <!--nav open button-->
          <div class="col-auto">
            <button class="main-nav__toggler toggler-open" type="button" title="Open Menu">

              <span class="toggler-open__bar"></span>
              <span class="toggler-open__bar"></span>
              <span class="toggler-open__bar"></span>

            </button>
          </div>
          <!--nav expandable area-->
          <div class="main-nav__expandable">
            <div class="main-nav__expandable-inner">
              <div class="container">
                <div class="main-nav__expandable-content">
                  <!--nav close btn-->
                  <button class="main-nav__toggler toggler-close" type="button" title="Close Menu"></button>
                  <!--nav links list-->
                  <ul class="main-nav__list">
                    <li class="main-nav__item" data-add-text="data-add-text"><a class="main-nav__link" href="/" title="Home"><span class="main-nav__link-title">Главная</span><span class="main-nav__link-descr">Вернуться на домашнюю страницу</span></a></li>
                    <li class="main-nav__item" data-add-text="data-add-text"><a class="main-nav__link" href="#" title="Features"><span class="main-nav__link-title">Особенности</span><span class="main-nav__link-descr">Узнайте больше о наших удивительных функциях!</span></a></li>
                    <li class="main-nav__item" data-add-text="data-add-text"><a class="main-nav__link" href="#" title="Pricing"><span class="main-nav__link-title">Цены</span><span class="main-nav__link-descr">Проверьте годовые и ежемесячные планы</span></a></li>
                    <li class="main-nav__item" data-add-text="data-add-text"><a class="main-nav__link" href="#" title="FAQ"><span class="main-nav__link-title">FAQ</span><span class="main-nav__link-descr">Ответы на все распространенные вопросы находятся здесь</span></a></li>
                    <li class="main-nav__item" data-add-text="data-add-text"><a class="main-nav__link" href="#" title="Contacts"><span class="main-nav__link-title">Контакты</span><span class="main-nav__link-descr">Отправьте нам сообщение! У нас есть поддержка 24/7</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="row">

      <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div class="mb-3 d-grid">
          <h4>Галерея вашего альбома: <span id="title_album"></span></h4>

          <p id="descr_album"></p>
        </div>
        <button class="btn rounded-3" data-bs-toggle="modal" data-bs-target="#upload_img_modal">
          <i class="fas fa-image me-2"></i>

          Загрузить изображение в альбом</button>
      </div>
    </div>
    <hr>
    <div id="delete_img_alert"></div>
    <div class="row g-4 mt-2" id="show_all_images">
      <h1 class="text-center text-secondary p-5">Загружаем данные, пожалуйста, подождите</h1>

    </div>

  </div>

</body>

</html>
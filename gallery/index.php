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
  <!-- <script src="./assets/js/main.js" defer></script> -->
  <script src="./assets/js/albums.js" defer></script>
  <title>Галерея</title>
</head>

<body class="bg-light">
  <!-- Album create modal start -->
  <div class="modal fade" id="create_album_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Создание нового альбома</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body p-4">
          <div id="message-album-alert"></div>
          <div class="progress mb-3" style="height: 25px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100">

            </div>
          </div>
          <form action="#" method="POST" enctype="multipart/form-data" id="create_album_form">

            <div class="mb-3">
              <input type="text" name="titleAlbum" id="title_album" class="form-control" placeholder="Название альбома" required>
            </div>
            <div class="mb-3">
              <textarea name="descripAlbum" id="description_album" class="form-control" placeholder="Описание альбома" required></textarea>
            </div>


            <div class="mb-3 d-grid">
              <input type="submit" value="Создать альбом" class="btn rounded-3" id="create_album_btn">
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
  <!-- Album create modal end -->


  <!-- Change album modal start -->
  <div class="modal fade" id="edit_album_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Изменение альбома:  <span id="titleAlb"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body p-4">
          <div id="edit_message-alert"></div>
          <div class="progress mb-3" style="height: 25px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100">

            </div>
          </div>
          <form action="#" method="POST" enctype="multipart/form-data" id="album_edit_form">
            <input type="hidden" name="edit_album_id" id="edit_album_id">
           
            
            <div class="mb-3">
              <input type="text" name="titleAlbum" id="edit_title_album" class="form-control" placeholder="Название альбома" required>
            </div>
            <div class="mb-3">
              <textarea name="descripAlbum" id="edit_description_album" class="form-control" placeholder="Описание альбома" required></textarea>
            </div>

           
            <div class="mb-3 d-grid">
              <input type="submit" value="Обновить альбом" class="btn rounded-3 btn-success" id="change_btn">
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
  <!-- Change album modal end -->
  



  <div class="container">
    <ul class="text-uppercase mt-4">
      <li class="top-right-slide"><span class="inner-container-top">
          <a href="#" class="nav-links">Главная
          </a>
        </span></li>


      <li class="middle-right-slide">
        <span class="inner-container-middle">
          <a href="#" class="nav-links">Галерея</a>
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

            <!-- logo block--><a class="logo__text" href="#" title="Our Nice Logo">Gallery</a>

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
                    <li class="main-nav__item" data-add-text="data-add-text"><a class="main-nav__link" href="#" title="Home"><span class="main-nav__link-title">Главная</span><span class="main-nav__link-descr">Вернуться на домашнюю страницу</span></a></li>
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
    <header class="header">


      <h1 class="header__title">Необычная навигация</h1>
      <div class="header__subtitle">(нажмите на значок бургера и наведите курсор на ссылки)</div>
      <div class="header__btns btns">
        <button class="header__btn  btn rounded-3" data-bs-toggle="modal" data-bs-target="#create_album_modal">
          <!-- <i class="fas fa-image me-2"></i> -->
          <i class="fa-regular fa-images me-2"></i>
          Создать альбом
      </div>



    </header>
    <div class="row">

    </div>
    <hr>
    <div id="delete_album_alert"></div>
    <div class="row g-4 mt-2" id="show_all_albums">
      <h1 class="text-center text-secondary p-5">Загружаем данные об альбомах, пожалуйста, подождите</h1>

    </div>

  </div>






</body>

</html>
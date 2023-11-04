Для развертывания проекта, необходима импортировать базу image_gallery.sql данных в бвзу,
на сервере выгрузить папку gallery и осуществить подключение к вашей базе данных в файле config.php
где:
private const DBHOST = 'localhost';
  private const DBUSER = 'root';
  private const DBPASS = '';
  private const DBNAME = 'image_gallery';

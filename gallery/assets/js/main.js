$(function () {
  let img_modal = new bootstrap.Modal(
    document.getElementById("img_preview_modal")
  );
  //function validate
  function validateImg($this, $prev_img, $mess_alert, $btn) {
    $this.change(function (e) {
      let file_ext = $(this).val().split(".").pop().toLowerCase();
      let allowed_ext = ["jpg", "jpeg", "png"];
      let file_size = this.files[0].size;
      if (allowed_ext.includes(file_ext)) {
        if (file_size <= 1000000) {
          let url = window.URL.createObjectURL(this.files[0]);
          $prev_img.html(`<img src="${url}" class="img-fluid img-thumbnail">`);
          $mess_alert.html(showMessage("success", "Изображение выбрано."));
          hideMessage($mess_alert);

          $btn.prop("disabled", false);
        } else {
          $mess_alert.html(
            showMessage(
              "danger",
              "Размер изображения должен быть меньше или равен 1 МБ!"
            )
          );
          $(this).val("");
          $prev_img.html("");
          hideMessage($mess_alert);
          $btn.prop("disabled", true);
        }
      } else {
        $mess_alert.html(
          showMessage(
            "danger",
            "Не соответствует тип изображения. Поддерживыемые форматы jpg, jpeg или png!"
          )
        );
        $(this).val("");
        $prev_img.html("");
        hideMessage($mess_alert);
        $btn.prop("disabled", true);
      }
    });
  }
  //function upload img
  function uploadImage(
    $this,
    $post,
    $btn,
    $actionUrl,
    $mess_alert,
    $prev_img,
    $upload_modal
  ) {
    $this.submit(function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      formData.append($post, 1);
      $btn.val("Пожалуйста, подождите...");
      $.ajax({
        xhr: function () {
          let xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener(
            "progress",
            function (evt) {
              if (evt.lengthComputable) {
                $(".progress").show();
                let percent = Math.round((evt.loaded / evt.total) * 100);
                $(".progress-bar").width(percent + "%");
                $(".progress-bar").text(percent + "%");
              }
            },
            false
          );
          return xhr;
        },
        url: $actionUrl,
        method: "post",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);
          $mess_alert.html(showMessage("success", response));
          $this[0].reset();
          $prev_img.html("");
          $btn.val("Загрузить");
          $(".progress").hide();
          hideMessage($mess_alert);
          setTimeout(function () {
            $upload_modal.modal("hide");
          }, 2500);
          fetchAllImages();
        },
      });
    });
  }
  //Fecth all images ajax request
  //Method set single album
  let sPageURL = decodeURIComponent(window.location.search.substring(1));

  fetchAllImages();
  function fetchAllImages() {
    $.ajax({
      url: "fetch.php",
      method: "POST",
      data: {  fetch_all_imgs: 1, sPageURL: sPageURL},
      success: function (response) {
        $("#show_all_images").html(response);
      },
    });
  }

  //Checking the image on the client side when uploading
  validateImg(
    $("#upload_img"),
    $("#preview_img"),
    $("#message-alert"),
    $("#upload_btn")
  );

  //Upload image ajax request
  uploadImage(
    $("#img_upload_form"),
    "upload_img",
    $("#upload_btn"),
    "insert.php",
    $("#message-alert"),
    $("#preview_img"),
    $("#upload_img_modal")
  );

  //Set image in the modal
  $(document).on("click", ".open_img", function (e) {
    e.preventDefault();
    let img_id = $(this).attr("id");
    $.ajax({
      url: "fetch.php",
      method: "POST",
      data: { img_id: img_id },
      dataType: "json",
      success: function (response) {
        $("#img_title").text(response.title_img);
        $("#set_img").attr("src", `./uploads/${response.img_path}`);
        $("#set_img").attr("alt", response.alt_text);
        $("#img_descr").text(response.description_img);
        $(".change_img, .remove_img").attr("data-id", response.id);
      },
    });
  });

  //Edit image ajax request

  $(".change_img").click(function (e) {
    e.preventDefault();
    let idEditImg = $(this).attr("data-id");

    img_modal.hide();
    $.ajax({
      url: "edit.php",
      method: "POST",
      data: { id: idEditImg, edit_img: 1 },
      dataType: "json",
      success: function (response) {
        $("#edit_img_id").val(response.id);
        $("#edit_alt_text").val(response.alt_text);
        $("#edit_title_img").val(response.title_img);
        $("#edit_description_img").val(response.description_img);
        $("#old_img").val(response.img_path);
        $("#edit_preview_img").html(
          `<img src="./uploads/${response.img_path}" class="img-fluid img-thumbnail">`
        );
      },
    });
  });

  //Checking the image on the client side when uploading during editing
  validateImg(
    $("#edit_upload_img"),
    $("#edit_preview_img"),
    $("#edit_message-alert"),
    $("#change_btn")
  );

  //upload a modified image ajax request
  uploadImage(
    $("#img_edit_form"),
    "update_upload_img",
    $("#change_btn"),
    "edit.php",
    $("#edit_message-alert"),
    $("#edit_preview_img"),
    $("#edit_img_modal")
  );

  //Remove image ajax request
  $(".remove_img").click(function (e) {
    e.preventDefault();
    let idImg = $(this).attr("data-id");
    let img_url = $("#set_img").attr("src");
    $.ajax({
      url: "remove.php",
      method: "POST",
      data: { id: idImg, img_url: img_url, remove_img: 1 },
      success: function (response) {
        img_modal.hide();
        fetchAllImages();
        $("#delete_img_alert").html(response);
        hideMessage($("#delete_img_alert"));
      },
    });
  });

  //Method for displaying error message
  function showMessage(type, message) {
    return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
<strong>${message}</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
</div>`;
  }

  //Method remove error message
  function hideMessage($mess_alert) {
    setTimeout(function () {
      $mess_alert.html("");
    }, 2500);
  }
});

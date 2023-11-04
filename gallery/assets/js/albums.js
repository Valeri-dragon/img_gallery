$(function () {
  
  //Create album ajax request
   function createUpdateAlbun(
     $thisForm,
     $ajaxParam,
     $btnCreate,
     $actionUrl,
     $mess_alert,
     $upload_modal
   ) {
     $thisForm.submit(function (e) {
       e.preventDefault();
       const formData = new FormData(this);
       formData.append($ajaxParam, 1);
       $btnCreate.val("Пожалуйста, подождите...");
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
           $mess_alert.html(showMessage("success", response));
           $thisForm[0].reset();
           $btnCreate.val("Создать");
           $(".progress").hide();
           hideMessage($mess_alert);
           setTimeout(function () {
             $upload_modal.modal("hide");
           }, 2500);
           fetchAllAlbums();
         },
       });
     });
   }
  createUpdateAlbun(
    $("#create_album_form"),
    "create_album",
    $("#create_album_btn"),
    "insert.php",
    $("#message-album-alert"),
    $("#create_album_modal")
  );
  //Fecth all albums ajax request
  fetchAllAlbums();
  function fetchAllAlbums() {
    $.ajax({
      url: "fetch.php",
      method: "POST",
      data: { fetch_all_albums: 1 },
      success: function (response) {
        $("#show_all_albums").html(response);
      },
    });
  }
  //redirect albums
  $(document).on("click", ".open_album", function (e) {
  
    let album_id = $(this).attr("id");
    if ($(e.target).hasClass("fa-trash-alt")) {
      e.preventDefault();
      //Remove album ajax request
               $.ajax({
          url: "remove.php",
          method: "POST",
          data: { id: album_id, remove_album: "remove_album" },
          success: function (response) {
            console.log(response);
            fetchAllAlbums();
            $("#delete_album_alert").html(response);
            hideMessage($("#delete_album_alert"));
          },
        });
      
    } if ($(e.target).hasClass("fa-edit")) {
      e.preventDefault();
      //edit album
       $.ajax({
         url: "edit.php",
         method: "POST",
         data: { id: album_id, edit_album: 1 },
         dataType: "json",
         success: function (response) {
          console.log(response)
           $("#edit_album_id").val(response.id);
           $("#titleAlb").text(`«${response.albums_title}»`);
           $("#edit_title_album").val(response.albums_title);
           $("#edit_description_album").val(response.descrip_album);
         },
       });
       createUpdateAlbun(
         $("#album_edit_form"),
         "update_album",
         $("#change_btn"),
         "edit.php",
         $("#edit_message-alert"),
         $("#edit_album_modal")
       );
    }
      $.ajax({
        type: "GET",
        url: "fetch.php",
        data: { album_id: album_id },
      });
  });
      //Method set single album
          let sPageURL = decodeURIComponent(window.location.search.substring(1));
      
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: { sPageURL: sPageURL },
        dataType: "json",
        success: function (response) {
          $("#title_album").text(`"${response.albums_title}"`);
          $("#descr_album").text(response.descrip_album);
          $(".album_id").attr("value", sPageURL);
           $(".titleAlb").text(`«${response.albums_title}»`);
        },
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
})
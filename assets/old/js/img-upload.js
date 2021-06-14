function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#iuw_'+input.id).hide();
      $('#fui_'+input.id).attr('src', e.target.result);
      $('#fuc_'+input.id).show();
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('#fui_fileInput').replaceWith($('#fui_fileInput').clone());
  $('#fuc_fileInput').hide();
  $('#iuw_fileInput').show();
}

$('#iuw_fileInput').bind('dragover', function () {
        $('#iuw_fileInput').addClass('image-dropping');
    });
    $('#iuw_fileInput').bind('dragleave', function () {
        $('#iuw_fileInput').removeClass('image-dropping');
});

async function subirImagen(on_end,dir=null){
  if ($('#fileInput')[0].files[0]!=null){
    let images = new FormData();
    let image = await toBase64($('#fileInput')[0].files[0]);
    images.append('image',image);
    images.append('action',"upload_image");
    if (dir!=null)
      images.append("dir",dir);
    console.log("Enviando imagen 0");
    $.ajax({
          data:  images, 
          url:"../bridge/post.php",
          type:  'post', 
          contentType: false,
          processData: false,
          success:  function (res) {
            on_end(res);
          },
          error: function(error) {
            console.log(error)
          }
        });
  }else{
    alert("Selecciona una imagen para subir")
  }
}


const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});
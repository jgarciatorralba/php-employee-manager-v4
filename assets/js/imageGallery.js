$(function () {

  // General event listener in the entire document to handle clicks
  $(document).click((e) => {

    // Event listener to select avatar image on click
    if ($(e.target).hasClass('img-option')) {
      $('.img-option').each(function (index, element) {
        $(element).parent().removeClass('border-primary');
        $(element).removeClass('img-selected');
      })
      $(e.target).parent().addClass('border-primary');
      $(e.target).addClass('img-selected');
      $('.avatar-image').attr('src', $(e.target).attr('src'));
    }
    // Event listener to update value of hidden input "photo" in form
    if ($(e.target).hasClass('img-option')) {
      $('#avatarInput').val($(e.target).attr('src'));
    }
    /*
      Event listener to toggle image gallery,
      including ajax "POST" request to retrieve data from API
      (avatar extra feature).
    */
    if ($(e.target).hasClass('avatar-image')) {
      if ($('#gallery-cont').hasClass('d-none')) {
        if ($('.img-cont').children().length == 0) {
          $.ajax({
            type: "POST",
            url: projectURL + 'libs/avatarsApi.php',
            data: {
              "gender": $('#inputGender').val()
            }
          }).done(function (response) {
            if (!response.includes("cURL Error")) {
              let arrayOfItems = JSON.parse(response);
              arrayOfItems.forEach(printMiniature);
            } else {
              $('.error-cont').removeClass('d-none');
              console.log(response);
            }
            $('#gallery-cont').removeClass('d-none');
          });
        } else {
          $('#gallery-cont').removeClass('d-none');
        }
      } else {
        $('#gallery-cont').addClass('d-none');
        $('.error-cont').addClass('d-none');
      }
    }

  });

});

// Helper functions

// Prints a miniature image in the image container (avatar extra feature).
function printMiniature(obj) {
  let myDiv = $('<div>').addClass('m-1 d-inline-block border');
  let myImg = $('<img>').addClass('img-fluid img-option');
  myImg.attr('src', obj.photo);
  myImg.appendTo(myDiv);
  $('.img-cont').append(myDiv);
}
let addMovieBtn = document.getElementById('addMovie');
let addMovieModal = document.getElementById('addMoviePopup');
let movieDismiss = document.getElementById('movieModalDissmis');


//Movie-Popup show
addMovieBtn.addEventListener('click', function() {
    addMovieModal.classList.toggle('active');
  })
  //Movie-Popup close
  movieDismiss.addEventListener('click', function(e) {
    e.preventDefault();
    addMovieModal.classList.toggle('active');
  })

  //Добавить фильм 
  $(document).ready(function() {
    $('#addMovieForm').submit(function(e) {
      let movieName = $('#addMovieInput').val();
      let movieDur = $('#addMovieDurationInput').val()
      let movieDesc = $('#addMovieTextarea').val()
      let movieCountry = $('#addMovieCountryInput').val()
      e.preventDefault();
  
      $.ajax({
        url: "/add_movie",
        type: 'POST',
        data: {
          title: movieName,
          duration: movieDur,
          description: movieDesc,
          country: movieCountry
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function () {
          addMovieModal.classList.toggle('active');
          location.reload();
        }
      });
    });
  })

//Удаление фильма
$(document).ready(function() {
  $('#movie_delete_btn').click(function() {
    let movieName = $('#seance_movieName').val();
    $.ajax({
      url: "/delete_movie",
      type: 'POST',
      data: {
        title: movieName,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function() {
        location.reload();
      }
    });
  });
})
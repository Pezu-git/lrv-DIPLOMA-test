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
  $('#addMivieForm').submit(function(e) {
    let movieName = $('#addMovieInput').val();
    let movieDur = $('#addMovieDurationInput').val()
    e.preventDefault();

    $.ajax({
      url: "/add_movie",
      type: 'POST',
      data: {
      title: movieName,
      duration: movieDur
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function () {
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
let scheduleMovieItems = [...document.querySelectorAll('.conf-step__seances-movie')];
let delSheduleMovie = document.getElementById('delShowtimePopup');
let popupMovieSpan = document.querySelector('.popupMovieName');
let delShowtimeDismiss = document.getElementById('delShowtimeModalDissmis');
let showtimeDismiss = document.getElementById('showtimeModalDissmis');
let showtimeAdd = [...document.querySelectorAll('.conf-step__movie')];
let addShowtimeModal = document.getElementById('addShowtimePopup');
let movieNameInput = document.querySelector('.movie_name');


//Schedule-delete-Popup
scheduleMovieItems.forEach(movie => {
    movie.addEventListener('click', () => {
      delSheduleMovie.classList.toggle('active');
      let movieName = movie.querySelector('.conf-step__seances-movie-title').textContent;
      let movieTime = movie.querySelector('.conf-step__seances-movie-start').textContent;
      let id = movie.getAttribute('data-hallSchedule-id');
      popupMovieSpan.textContent = movieName;
  
      $('#delete_hall_shedule').submit(function () {
        $.ajax({
            url: "/delete_hall_shedule",
            type: 'POST',
            data: {
              movieName: movieName,
              movieTime: movieTime,
              hall_id: id
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          success: function () {
            location.reload();
            }
          });
        })
    })
  })
  
  delShowtimeDismiss.addEventListener('click', function(e) {
    e.preventDefault();
    delSheduleMovie.classList.toggle('active');
  })

  //Schedules-add-Popup
showtimeAdd.forEach(movie => {
    movie.addEventListener('click', () => {
      console.log(movie)
      let title = movie.querySelector('.conf-step__movie-title')
      addShowtimeModal.classList.toggle('active');
      movieNameInput.value = title.textContent
      
    })
  })
  
  //Закрыть Popup сеанса
showtimeDismiss.addEventListener('click', function(e) {
    e.preventDefault();
    addShowtimeModal.classList.toggle('active');
  })

  // Добавить фильм в расписание
$(document).ready(function() {
    $('#seanceAddForm').submit(function(e) {
      let movieName = $('#seance_movieName').val();
      let hallId = $('#seance_hallName option:selected').val();
      let startTime = $('#seance_startTime').val();
      
// e.preventDefault()
  
      $.ajax({
        url: "/add_movie_schedule",
        type: 'POST',
        data: {
          hall_id: hallId,
          movie_name: movieName,
          start_time: startTime,
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          location.reload();
          if(data) {
            alert(data)
          }
          
        }
      });
    });
  })
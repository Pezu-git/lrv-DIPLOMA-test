let trashs = Array.from(document.querySelectorAll('[data-delHall-id]'));
let delModal = document.getElementById('deletePopup');
let deleteDismiss = document.getElementById('delModalDissmis');
let hallAddPopupShowBtn = document.getElementById('hallAddPopupShow');
let addModal = document.getElementById('addPopup');
let addDismiss = document.getElementById('addModalDissmis');
let ul = [...document.querySelectorAll('.hallDeleteList')];
var popupSpan = document.querySelector('.popupHallName');



  //Delete-Popup close
  deleteDismiss.addEventListener('click', function(e) {
    e.preventDefault();
    delModal.classList.toggle('active');
  })
  //Add-Popup show
  hallAddPopupShowBtn.addEventListener('click', function() {
    addModal.classList.toggle('active');
  })
  //Add-Popup close
  addDismiss.addEventListener('click', function(e) {
    e.preventDefault();
    addModal.classList.toggle('active');
  })

  //Удаление зала
for (let i = 0; i < trashs.length; i++) {
  trashs[i].addEventListener('click', function() {
    delModal.classList.toggle('active');
    let id = trashs[i].getAttribute('data-delHall-id');
    console.log(ul[i].textContent)
    popupSpan.textContent = ul[i].textContent;
    $(document).ready(function() {
      $('#hallDeleteForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: "/delete_hall",
          type: 'POST',
          data: {
          hall_id: id 
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            location.reload();
          }
        });
      });
    })
  })
}
  
  //Добавление зала
   $(document).ready(function() {
        $('#hallAddForm').submit(function(e) {
          e.preventDefault();
          $hall_name = $('#hallNameAdd').val()
          $.ajax({
            url: "/hall_add",
            type: 'POST',
            data: {
            name: $hall_name 
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              $h = `<li class="hallDeleteList">${data.hall_name}
                      <button class="conf-step__button conf-step__button-trash" type="button" id="{{ $hall_name }}" data-delHall-id=${data.hall_id}"></button>
                    </li>`
              $('.conf-step__list').append($h);
              addModal.classList.toggle('active');
              location.reload();
            }
          });
        });
      })
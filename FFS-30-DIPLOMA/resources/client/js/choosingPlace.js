//Выбор места

const chairChecked = () => {
  const chairs = Array.from(document.querySelectorAll('.buying-scheme__row  .buying-scheme__chair'));
  chairs.forEach(chair => chair.addEventListener('click', () => {
    if (chair.classList.contains('buying-scheme__chair_taken')) {
      return;
    }
    chair.classList.toggle('buying-scheme__chair_selected');
  }));
}
chairChecked();


//Обновление зала бронирования
const buttonAcceptin = document.querySelector('.acceptin-button');
  const hallName = document.querySelector('.buying__info-hall').textContent;
  const seance = document.querySelector('.buying__info-start').textContent.substring(15);
  const title = document.querySelector('.buying__info-title').textContent;

  // Вешаем событие onclick на кнопку
  buttonAcceptin.addEventListener("click", (event) => {
    let chairsSelected = Array.from(document.querySelectorAll('.buying-scheme__row .buying-scheme__chair_selected'));
    event.preventDefault();
    // Формируем список выбранных мест
    const selectedPlaces = Array();
    const divRows = Array.from(document.getElementsByClassName("buying-scheme__row"));
    for (let i = 0; i < divRows.length; i++) {
      const spanPlaces = Array.from(divRows[i].getElementsByClassName("buying-scheme__chair"));
      for (let j = 0; j < spanPlaces.length; j++) {
        if (spanPlaces[j].classList.contains("buying-scheme__chair_selected")) {
          // Определяем тип выбранного кресла
          const typePlace = (spanPlaces[j].classList.contains("buying-scheme__chair_standart")) ? "standart" : "vip"
          selectedPlaces.push({
            "row": i + 1,
            "place": j + 1,
            "type": typePlace
          })
        }
      }
    }
    chairsSelected.forEach(chair => {
      if (chair.classList.contains("buying-scheme__chair_vip")) {
        chair.classList.toggle("buying-scheme__chair_vip");
      }
      chair.classList.toggle("buying-scheme__chair_selected");
      chair.classList.toggle("buying-scheme__chair_taken");

    })
    $.ajax({
      url: "/client_hall",
      type: 'GET',
      data: {
        movie: title,
        hallName: hallName,
        seance: seance,
        takenPlaces: selectedPlaces
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        location.href = data;
      }
    });
  });
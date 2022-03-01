//Переключение типов кресел


const chairChecked = () => {
    const chairs = Array.from(document.querySelectorAll('.buying-scheme__row  .buying-scheme__chair'));
    chairs.forEach(chair => chair.addEventListener('click', () => {
      if (chair.classList.contains('buying-scheme__chair_standart')) {
        // chair.classList.toggle('buying-scheme__chair_standart');
        chair.classList.toggle('buying-scheme__chair_selected');
      } else if (chair.classList.contains('buying-scheme__chair_vip')) {
        // chair.classList.toggle('buying-scheme__chair_vip');
        chair.classList.toggle('buying-scheme__chair_selected');
      }
    }));
  }
  chairChecked();
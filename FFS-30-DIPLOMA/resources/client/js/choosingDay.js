let days = [...document.querySelectorAll('.page-nav__day')];
days.forEach(day => {
  day.addEventListener('click', function() {
    let choosenDay = document.querySelector('.page-nav__day_chosen');
    choosenDay.classList.toggle('page-nav__day_chosen');
    day.classList.toggle('page-nav__day_chosen');
  })
})
 
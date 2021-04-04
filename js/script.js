function action() {
  let modal = document.querySelector('.modal');
  modal.style.display = 'flex';
  let blur = document.getElementById('blur');
  blur.classList.toggle('active');
  blur.classList.toggle('color');
}

function fechar() {
  let modal = document.querySelector('.modal');
  modal.style.display = 'none';
  let blur = document.getElementById('blur');
  blur.classList.remove('active');
}


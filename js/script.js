function action(id) {
  
  const modal = document.querySelector(id);
  modal.style.display = 'flex';
  const blur = document.getElementById('blur');
  blur.classList.toggle('active');
}

function fechar(id) {
  const modal = document.querySelector(id);
  modal.style.display = 'none';
  const blur = document.getElementById('blur');
  blur.classList.remove('active');
}

function outSideClick(element, events, callback) {
  const html = document.documentElement;
  const outside = 'data-outside';
  if(!element.hasAttribute(outside)) {
    events.forEach(userEvent => {
      setTimeout(()=> {html.addEventListener(userEvent, handleOutsideClick);})
    })
    element.setAttribute(outside,'');
  }
  function handleOutsideClick(event) {
    if(!element.contains(event.target)) {
      element.removeAttribute(outside);
      events.forEach(userEvent => {
        html.removeEventListener(userEvent, handleOutsideClick);
      })
      callback();
    }
  }
}

const menuButton = document.querySelector('[data-menu="button"]');
const menuList = document.querySelector('[data-menu="list"]');

function openMenu() {
  menuList.classList.add('active');
  menuButton.classList.add('active');  
  outSideClick(menuList,['click','touchstart'],() => {
    menuList.classList.remove('active');
    menuButton.classList.remove('active');  
  });
}

menuButton.addEventListener('click', openMenu);



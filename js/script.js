const navLinks = document.querySelectorAll('.header__cat-link');
const logoLink = document.querySelector('.logo').parentElement; // Получаем родительский <a> для логотипа
const activeLinkKey = 'activeNavLink'; // Ключ для хранения в localStorage
let previousActiveLink = null; // Переменная для хранения предыдущей активной ссылки

// Обработчик клика на логотип
logoLink.addEventListener('click', (event) => {
  event.preventDefault(); // Отменяем стандартное поведение ссылки
  window.scrollTo(0, 0); // Прокручиваем страницу вверх

  // Дополнительно: делаем ссылку "Главная" активной
  navLinks.forEach(link => {
    link.classList.remove('active');
    link.classList.remove('from-right');
  });

  const homeLink = document.querySelector(`.header__cat-link[href="#"]`);
  if (homeLink) {
    homeLink.classList.add('active');
    previousActiveLink = homeLink;
    localStorage.setItem(activeLinkKey, homeLink.getAttribute('href'));
  }
});

navLinks.forEach(link => {
  link.addEventListener('click', (event) => {
    // Убираем класс "active" и "from-right" у всех ссылок
    navLinks.forEach(link => {
      link.classList.remove('active');
      link.classList.remove('from-right');
    });

    const currentActiveLink = event.currentTarget;
    currentActiveLink.classList.add('active');

    // Определяем направление анимации
    if (previousActiveLink) {
      const currentLinkIndex = Array.from(navLinks).indexOf(currentActiveLink);
      const previousLinkIndex = Array.from(navLinks).indexOf(previousActiveLink);

      if (currentLinkIndex < previousLinkIndex) {
        currentActiveLink.classList.add('from-right'); // Справа налево
      }
    }

    // Сохраняем href активной ссылки в localStorage
    localStorage.setItem(activeLinkKey, currentActiveLink.getAttribute('href'));

    // Сохраняем текущую ссылку как предыдущую
    previousActiveLink = currentActiveLink;
  });
});

// Добавление класса active при загрузке страницы
window.addEventListener("DOMContentLoaded", (event) => {
  // Получаем href активной ссылки из localStorage
  const savedActiveLinkHref = localStorage.getItem(activeLinkKey);

  if (savedActiveLinkHref) {
    // Ищем ссылку с сохраненным href
    const linkToActive = document.querySelector(`.header__cat-link[href="${savedActiveLinkHref}"]`);

    if (linkToActive) {
      // Убираем класс active и from-right у всех ссылок
      navLinks.forEach(link => {
        link.classList.remove('active');
        link.classList.remove('from-right');
      });

      linkToActive.classList.add('active');
      previousActiveLink = linkToActive;
    } else {
      // Если в localStorage ссылка не валидна, активируем "Главная"
      const linkHome = document.querySelector(`.header__cat-link[href="#"]`);
      if (linkHome) {
        linkHome.classList.add('active');
        previousActiveLink = linkHome;
      }
    }
  } else {
    // Если в localStorage ничего нет, активируем "Главная"
    const linkHome = document.querySelector(`.header__cat-link[href="#"]`);
    if (linkHome) {
      linkHome.classList.add('active');
      previousActiveLink = linkHome;
    }
  }
});





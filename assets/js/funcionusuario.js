
  const icon = document.querySelector('.yuli .icon i');
  const yuli = document.querySelector('.yuli');

  icon.addEventListener('click', () => {
    yuli.classList.toggle('active');
  });

  document.addEventListener('click', (event) => {
    if (!yuli.contains(event.target) && yuli.classList.contains('active')) {
      yuli.classList.remove('active');
    }
  });


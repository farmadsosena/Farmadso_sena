function saveScrollPosition() {
  var scrollableContent = document.querySelector(".scrollableContent");
  localStorage.setItem("scrollPosition", scrollableContent.scrollTop);
}

function restoreScrollPosition() {
  var scrollableContent = document.querySelector(".scrollableContent");
  var savedScrollPosition = localStorage.getItem("scrollPosition");
  if (savedScrollPosition !== null) {
    scrollableContent.scrollTop = savedScrollPosition;
  }
}

document.addEventListener("DOMContentLoaded", restoreScrollPosition);

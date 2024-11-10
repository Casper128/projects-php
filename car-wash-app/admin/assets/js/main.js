document.addEventListener('DOMContentLoaded', function() {
  // HAMBURGER MENU
  var hamburger = document.querySelector('.hamburger.open-menu');
  hamburger.addEventListener('click', function(e) {
    document.body.classList.toggle('show-menu');
    this.classList.toggle('is-active');
  });

  // STICKY MAINNAV
  var navOnScroll = function() {
    var winTop = window.pageYOffset || document.documentElement.scrollTop;
    var topBar = document.querySelector('#top-bar');
    var header = document.querySelector('#main-header');
    var h = topBar ? topBar.offsetHeight : 100;
    var defaultH = 100;
    if (h == null) h = defaultH;

    // SCROLL DIRECTION
    if (winTop > lastScrollTop && lastScrollTop > 0 && winTop > h - (10 / 100 * h)) {
      header.classList.add('nav-hide');
    } else {
      header.classList.remove('nav-hide');
    }

    // SHOW MENU AT SCROLL TO BOTTOM
    // if (winTop + window.innerHeight > document.documentElement.scrollHeight - 50) {
    //   header.classList.remove('nav-hide');
    // }

    lastScrollTop = winTop;

    // SCROLLED
    if (winTop > h) {
      header.classList.add('nav-scrolled');
    } else {
      header.classList.remove('nav-scrolled');
    }
  };

  navOnScroll();
  var lastScrollTop = 0;
  window.addEventListener('scroll', navOnScroll);
  document.body.addEventListener('touchmove', navOnScroll);
});
import $ from 'jquery';

//============================RESPONSIVE NAV MENU==============================
class MobileNav {
  constructor() {
    this.navToggle = $("#nav-toggle");
    this.navList = $(".navigation__list");
    this.clickToClose = $("html");
    this.events();
  }

  events() {
    this.navToggle.on("click", this.openMenu.bind(this)); 
    this.clickToClose.on("click", this.closeMenu.bind(this));
  }

  openMenu(event) {
    event.stopPropagation();
    this.classList.toggle('active');
    this.navList.slideToggle();
  }

  closeMenu() {
    if(this.navToggle.hasClass('active')) {
      this.navToggle.removeClass('active');
      this.navList.slideToggle();
    }
  }
}

export default MobileNav;

// jQuery(document).ready(function($) {
//     $('#nav-toggle').on('click', function(event) {
//       event.stopPropagation();
//       this.classList.toggle('active');
//       $('.navigation__list').slideToggle();
//     });
  
//     $('html').click(function() {
//       if($('#nav-toggle').hasClass('active')) {
//         $('#nav-toggle').removeClass('active');
//         $('.navigation__list').slideToggle();
//       }
//     });
// });


// class MobileNav {
//   constructor() {
//     this.menu = $(".site-header__menu");
//     this.openButton = $(".site-header__menu-trigger");
//     this.events();
//   }

//   events() {
//     this.openButton.on("click", this.openMenu.bind(this));
//   }

//   openMenu() {
//     this.openButton.toggleClass("fa-bars fa-window-close");
//     this.menu.toggleClass("site-header__menu--active");
//   }
// }
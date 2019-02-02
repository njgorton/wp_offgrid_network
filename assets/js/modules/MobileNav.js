import $ from 'jquery';

//============================RESPONSIVE NAV MENU==============================
class MobileNav {
  constructor() {
    this.navToggle = $("#nav-toggle");
    this.navList = $(".nav__list");
    this.clickToClose = $("html");
    this.events();
  }

  events() {
    this.navToggle.on("click", this.openMenu.bind(this)); 
    this.clickToClose.on("click", this.closeMenu.bind(this));
  }

  openMenu(event) {
    event.stopPropagation();
    this.navToggle.toggleClass('active');
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
//       $('.nav__list').slideToggle();
//     });
  
//     $('html').click(function() {
//       if($('#nav-toggle').hasClass('active')) {
//         $('#nav-toggle').removeClass('active');
//         $('.nav__list').slideToggle();
//       }
//     });
// });
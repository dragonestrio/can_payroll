nav = 'header';
menu = 'menu';
navbar_toggler = 'navbar_toggler';
navbar_menu = 'navbar';
popup = 'popup';

// Scroll Down to Show
window.onscroll = function scroll_a() {scroll_down()};

function scroll_down() {
    navbar = document.getElementById(nav);
    menus = document.getElementById(menu);
    scroll_value = 300;

    // if (document.body.scrollTop > scroll_value || document.documentElement.scrollTop > scroll_value) {
    //     navbar.classList.remove('slideup-animate', 'navbar-bg');
    //     navbar.classList.add('slideup-animate');
    //     navbar.classList.add('bg-dark', 'shadow');
    //     // menus.classList.remove('menu-bg', 'bg-transparent');
    //     // menus.classList.add('bg-dark');
    // } else {
    //     navbar.classList.remove('slideup-animate');
    //     setTimeout(() => {
    //         navbar.classList.add('slideup-animate', 'navbar-bg');
    //         navbar.classList.remove('bg-dark', 'shadow');
    //         // menus.classList.add('menu-bg', 'bg-transparent');
    //         // menus.classList.remove('bg-dark');
    //     }, 300);
    // }
}
//

// Scroll Down to Hide
hides_scroll = window.pageYOffset;

// window.onscroll = function scroll_b() {
//     current_scroll = window.pageYOffset;

//     if (hides_scroll > current_scroll) {
//         navbar.classList.remove('showDown-animate');
//         navbar.classList.add('hideUp-animate');
//     } else {
//         navbar.classList.remove('hideUp-animate');
//         navbar.classList.add('showDown-animate');
//     }
// }
//

// Navbar Toggler Icon
navbar_toggler = document.getElementById(navbar_toggler);
// navbar_toggler = document.querySelector('#' + navbar_toggler);

// navbar_toggler.addEventListener('click', () => {
//     // if (!navbar.classList.contains('bg-dark')) {
//     //     navbar.classList.toggle('bg-dark');
//     // }

//     if (navbar_toggler.classList.contains('navbar-toggler-icon-open')) {
//         navbar_toggler.classList.remove('navbar-toggler-icon-open');
//         navbar_toggler.classList.add('navbar-toggler-icon-close');
//     } else {
//         navbar_toggler.classList.remove('navbar-toggler-icon-close');
//         navbar_toggler.classList.add('navbar-toggler-icon-open');
//     }
// })
//

// Popup
var pop = document.getElementById(popup);
var modal = document.getElementById('myInput');

// pop.addEventListener('shown.bs.modal', function() {
//     modal.focus()
// });
//

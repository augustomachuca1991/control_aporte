// var icon = document.getElementById('icon');

// icon.onclick = function() {
//     console.log('modo oscuro');
//     document.body.classList.toggle('dark-theme');
//     if (document.body.classList.contains('dark-theme')) {
//         icon.src = "image/sun.png";
//     } else {
//         icon.src = "image/moon.png";
//     }
// }

var MenuItems = document.getElementById("MenuItems");

MenuItems.style.maxHeight = "0px";
function menutoggle() {
    // body...
    if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "200px"
    } else {
        MenuItems.style.maxHeight = "0px"
    }
}


var icon = document.getElementById('icon');
var menu = document.getElementById('menu-toggle')

icon.onclick = function() {
    document.body.classList.toggle('dark-theme');
    if (document.body.classList.contains('dark-theme')) {
        icon.src = "image/sun.png";
        menu.src = "image/menu-light.png"
    } else {
        icon.src = "image/moon.png";
        menu.src = "image/menu.png"
    }
}
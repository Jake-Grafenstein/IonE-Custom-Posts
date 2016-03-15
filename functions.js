//
//  Theme: IonE Mana Child
//  Title: functions.js
//  Authors: Jacob Grafenstein and Cliff Tan
//  Author URI: https://github.com/Jake-Grafenstein
//  Description: Various javascript functions to affect layout and styles of HTML elements
//

// Changes the hover elements on the menu depending on window size (NOT DYNAMIC)
$(document).ready(function() {
  var items = ["#menu-item-163", "#menu-item-104", "#menu-item-148", "#menu-item-155", "#menu-item-296", "#menu-item-303", "#menu-item-307", "#menu-item-309", "#menu-item-1797"];
  var myItems = ["#menu-item-104", "#menu-item-163", "#menu-item-147", "#menu-item-154", "#menu-item-156"];
  console.log("Resize has been called again.");
  var mySize = window.innerWidth;
  console.log("This is my window size: " + mySize);
  if (mySize >= 1200) {
      console.log("The window is greater than 1200");
      $.each(items, function(index, value){
        console.log("Changed " + value + " hover state.");
        $(value).hover( function(){
          $(".menu_arrow").toggleClass("hovered");
        });
      });
  } else {
      console.log("The window is less than 1200");
      $.each(myItems, function(index,value){
          console.log("Changing the hovered elements");
          $(value).hover( function(){
              console.log("Changed " + value + " hover state.");
              $(".menu_arrow").toggleClass("hovered");
          });
      });
  }
});

// Show "MENU" only on mobile
$(document).ready(function() {
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    $('head').append("<style>#nav_menu-2 div, #nav_menu-4 div, #nav_menu-3 div, #nav_menu-9 div, #nav_menu-13 div, #nav_menu-14 div, #nav_menu-10 div { display:none; }.wide_menu{display:none;}</style>");
  } else {
    $('head').append("<style>.widget_nav_menu .widget_title {display:none;}");
  }
});

// Add slide up and down functionality to mobile
$(document).ready(function(){
  var menus = ["#nav_menu-2 h3", "#nav_menu-4 h3", "#nav_menu-13 h3", "3nav_menu-11 h3", "#nav_menu-14 h3", "#nav_menu-3 h3", "#nav_menu-9 h3", "#nav_menu-10 h3"];
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      $.each(menus, function(index, value) {
        $(value).click(function(){
  		    //slide up all the link lists
  		    $(this).next().slideUp();
  		    //slide down the link list below the h3 clicked - only if its closed
  		    if(!$(this).next().is(":visible"))
  		    {
  			    $(this).next().slideDown();
  		    }
  	    });
      });
    }
});

// Removes classes from menu so it always displays
$(document).ready(function() {
  $(".mainmenu").each(function() {
    $(this).removeClass("hidden-xs hidden-sm visible-md visible-lg");
});
});

// Makes active page styled in sidebar
$(document).ready(function() {
    var path = window.location.href;
    console.log(path);

    $(".widget_nav_menu a").each(function () {
        var href = $(this).attr('href');
        if (path === href) {
            $(this).closest('li').addClass('active');
        }
    });
});

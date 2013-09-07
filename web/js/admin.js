/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function activeMenu(element) {

    active_element = $("ul.menu").find("li.active");
    if (active_element.is("li")) {
        hideMenu(active_element);

        if (active_element.get(0) !== $(element).get(0)) {
            setTimeout(function() {
                showMenu(element);
            }, 500);

        }

    } else {
        showMenu(element);
    }
}

function hideMenu(element) {
    $(element).animate({backgroundColor: '#686868', color: "#ffffff"}, 'fast', function() {
        $(element).prev().find("div").animate({backgroundColor: '#a0a0a0'}, 'fast');
        $(element).next().find("div").animate({backgroundColor: '#a0a0a0'}, 'fast');

    });
    $(element).find(".submenu").slideUp('fast');
    $(element).removeClass("active");
}

function showMenu(element) {
    if ($(element).find(".submenu").is(":hidden")) {
        $(element).prev().find("div").animate({backgroundColor: '#ffffff'}, 'fast');
        $(element).next().find("div").animate({backgroundColor: '#ffffff'}, 'fast');

        setTimeout(function() {
            $(element).animate({backgroundColor: '#ffffff', color: "#686868"}, 'medium');
            $(element).find(".submenu").slideDown('fast');
            $(element).addClass("active");
        }, 500);
    }
}


$(document).ready(function() {
    $(".menu > li .title").click(function(event) {
        activeMenu($(this).parent());
        event.stopImmediatePropagation();
    });
});


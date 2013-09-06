/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(
        function() {
            $("form.ajax").submit(function() {
                switch ($(this).attr("method")) {
                    case 'get':
                        getRequest(this);
                        break;
                    case 'post':
                        postRequest(this);
                        break;
                }
                return false;
            });

        }
);

function postRequest(element) {
    var form_data = $(element).serialize();
    url = $(element).prop("action");
    $.ajax({
        url: url,
        cache: false,
        type: 'POST',
        data: form_data,
        datatype: "json",
        complete: function(data, status) {
            var obj = $.parseJSON(data.responseText);
            window[$(element).attr('data-ajax-callback')](element, obj);
        }
    });
}
function iSaidNo(id, limit, tour) {
    limit = (limit) ? limit : 5;
    tour = (tour) ? tour : 0;



    if (tour === limit)
        return true;

    if (parseInt(limit - tour) === 1 || parseInt(limit - tour) === -1) {
        left = "0";
    } else {
        left = (tour % 2 === 0) ? "+14" : "-14";
    }

    $("#" + id).animate({
        left: left
    }, 80, function() {
        tour += 1;
        iSaidNo(id, limit, tour);
    });
}

//function getRequest(element) {
//
//    if ($(element).is('a')) {
//        link = $(element).attr("href");
//    } else if ($(element).is('form')) {
//        link = $(element).attr("action");
//        var form_data = $(element).is('form').serialize();
//    }
//
//    $.ajax({
//        url: link,
//        cache: false,
//        type: "get",
//        data: form_data,
//        datatype: "json",
//        complete: function(data, status) {
//            var obj = $.parseJSON(data.responseText);
//            if (obj.message == "success") {
//                $("#" + $(element).attr("data-ajax-cible")).html(obj.render);
//
//                if ($(element).attr("data-ajax-cible").match(/fancybox-.*/g)) {
//                    $("#" + $(element).attr("data-ajax-cible")).dialog({
//                        width: "50%",
//                        modal: true
//                    });
//                }
//            }
//        }
//    });
//    return false;
//}

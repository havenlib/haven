
function addAnItem(source){
    // this function will add an item to a collection from a data-prototype as created by symfony 2's form with option allow_add and data-prototype set to true
    // It will use the length of the child in the data-prototype div, or, the length of all the childs of all the div with the data-join-class class.
    // This is to allow use to create many forms for a single type of relationship in a table inheritance situtation
    newnode = document.createElement("div");
    next_id = $("#"+source).attr('data-join-class')?$("."+$("#"+source).attr('data-join-class')).children().length:$("#"+source).children().length;
    newnode.innerHTML =$("#"+source).attr('data-prototype').replace(/__name__/gi, next_id);
    document.getElementById(source).appendChild(newnode);
}

function showFormElement(tab){
    tab_num = tab.id.match(/\d+/g);
    
    $(".tab-element").hide();
    $(".tab-element.tab" + tab_num).show();
    $(".tab.active").removeClass("active");
    $("#tab" + tab_num).addClass("active");
}

function ajaxLogin(form, data){

    var login_infos = '_password='+form.password.value +'&_username=' + form.username.value +'&_csrf_token=' +form._token.value;
    $.ajax({
        url: form.action,
        cache: false,
        type: "post",
        data: login_infos,
        complete: function(data, status){
            var obj = $.parseJSON(data.responseText);
            if(obj.message == "NotLoggedIn"){
                $("#login_div").html(obj.render);
            }else if(obj.message=="IsLoggedIn"){
                $("#user-greeter").hide();
                $("#user-greeter").html(obj.render).fadeIn("slow");

                $(form).parentsUntil('.container').fadeOut("slow");
                $("a.signin").remove();
                $("#monespace").removeAttr('onclick');
            }
        }
    });
    return false;
}

function ajaxRegister(form, data){
    var register_infos = $(form).serialize();
    $.ajax({
        url: form.action,
        cache: false,
        type: "post",
        data: register_infos,
        datatype: "json" ,
        complete: function(data, status){
            var obj = $.parseJSON(data.responseText);
            if(obj.message == "NotRegistered"){
                $("#register_div").html(obj.render);
            }else if(obj.message=="IsRegistered"){
                $("#signin_menu").html(obj.render);
            //                $("#user-greeter").hide();
            //                $("#user-greeter").html(obj.render).fadeIn("slow");

            //                $(form).parentsUntil('.container').fadeOut("slow");
            //                $("a.signin").remove();
            //                $("#monespace").removeAttr('onclick');
            }
        }
    });
    return false;
}
function ajaxResetRequest(form, data){
    var reset_infos = $(form).serialize();
    $.ajax({
        url: form.action,
        cache: false,
        type: "post",
        data: reset_infos,
        datatype: "json" ,
        complete: function(data, status){
            var obj = $.parseJSON(data.responseText);
            if(obj.message == "emailNotFound"){
                $("#reset_div").html(obj.render);
            }else if(obj.message=="resetSent"){
                $("#reset_div").html(obj.render);
            }
        }
    });
    return false;
}

$(document).ready(
    function (){
        $(".datepicker" ).datepicker({
            showOn: "button",
            buttonImage: "/images/calendar.png",
            buttonImageOnly: true
        });
    }
    );

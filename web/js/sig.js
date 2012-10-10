function addAnItem(source){
    newnode = document.createElement("div");
    nodes_to_count_id = $("#"+source).attr('data-join-class')?"."+$("#"+source).attr('data-join-class'):"#"+source;
    newnode.innerHTML =$("#"+source).attr('data-prototype').replace(/__name__/gi,$(nodes_to_count_id).children().length);
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

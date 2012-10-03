function addAnItem(source){
    newnode = document.createElement("div");
    newnode.innerHTML =document.getElementById(source).getAttribute('data-prototype').replace(/\$\$name\$\$/gi, document.getElementById(source).childNodes.length);
    document.getElementById(source).appendChild(newnode);
}

function showLoginForm(){
    $("#total_defi").show();
    $("#defi_login").show();
    $("#defi_login div").children().filter(":input").removeAttr("disabled");
    $("#defi_register").hide();
    $("#defi_register div").children().filter(":input").attr("disabled","disabled");

}

function showRegistrationForm(){
    $("#total_defi").show();
    $("#defi_login").hide();
    $("#defi_login div").children().filter(":input").attr("disabled","disabled");
    $("#defi_register").show();
    $("#defi_register div").children().filter(":input").removeAttr("disabled");
}

function SelectionneUneAddress(target){
    $(target).closest("form").children(".adresse-form").find(":input").attr("disabled","disabled");
    $(target).closest(".adresse-form").find(":input").removeAttr("disabled");
    $(target).closest("form").children(".adresse-form").find(":disabled").closest(".adresse-form").slideUp();
    $(".labelAddresssDifferentes").slideUp();
    $(".labelAddressUnique").slideDown();
    $(".meme_adresse").hide();
    $(".diff_adresse").show();

}

function SelectionneMultiAddress(target){
    $(target).closest("form").children(".adresse-form").find(":input").removeAttr("disabled");
    $(target).closest("form").children(".adresse-form").slideDown();
    $(".labelAddressUnique").slideUp();
    $(".labelAddresssDifferentes").slideDown();
    $(".meme_adresse").show();
    $(".diff_adresse").hide();
}

function PasserLaCommande(){
    $('form#panier').submit();
}

function ConfirmerPaiement(){
    if($('#conditions_vente').is(':checked'))
        PasserLaCommande();
    else
        $("#message_conditions_vente").show();
}

function showFormElement(tab){
    tab_num = tab.id.match(/\d/g);
    
    $(".tab-element").hide();
    $(".tab-element.tab" + tab_num).show();
    $(".tab.active").removeClass("active");
    $("#tab" + tab_num).addClass("active");
}

function changeState(country_dropdown){

    state_dropdown = document.getElementById("register_contact_contact_address_"+ country_dropdown.id.match(/\d+/g) +"_address_state");

    /**
     * Range. (from: 1 ; to: 13) = Canada
     * Range. (from: 13 ; to: 63) = États-Unis
     */
    from = (country_dropdown.value == 1)? 1: 14;
    to = (country_dropdown.value == 1)? 13: 63;

    for(i = 0; i < state_dropdown.options.length; i++){
        state_dropdown.options.item(i).setAttribute("class", "hidden-option")

        if(isInRange(from,to,state_dropdown.options.item(i).value)){
            state_dropdown.value = from;
            state_dropdown.options.item(i).removeAttribute("class");
        }
    }
}
    
function isInRange(from, to, value){
    if(value >= from && value<= to){
        return true;
    }
    return false;
}

/**
 * Prépare les textarea avec ckeditor de l'admin
 * Pour activer, ajouter les class="ckeditor ckeditor-admin" aux textearea
 */
$(".ckeditor-admin").each(function(index, element){
    CKEDITOR.replace( element.id,
    {
        toolbar : [
        {
            name: 'document',
            items : [ 'Source','-','Save' ]
        },

        {
            name: 'clipboard',
            items : [ 'PasteText','-','Undo','Redo' ]
        },

        {
            name: 'editing',
            items : [ 'Find','Replace','-','SelectAll' ]
        },


        {
            name: 'basicstyles',
            items : [ 'Bold','Italic', 'Abbr',   'Subscript','Superscript','-','RemoveFormat' ]
        },

        {
            name: 'paragraph',
            items : [ 'NumberedList','BulletedList' ]
        },

        {
            name: 'format',
            items : [ 'JustifyLeft','JustifyCenter','JustifyRight'  ]
        },

        {
            name: 'insert',
            items : [  'Image','MediaEmbed','SpecialItem' ]
        },
        '/',
        {
            name: 'links',
            items : [ 'Link','Unlink','Anchor' ]
        },

        {
            name: 'insert',
            items : [  'Table','HorizontalRule', 'SpecialChar'  ]
        },


        {
            name: 'styles',
            items : [ 'Styles','Format'  ]
        } ,
        ],
        width : 756,
        uiColor: '#c6daeb'
    });
});
CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_P;
/**
 * Permet de choisir parmi les images déjà sur le server
 * quand on crée une nouvelle actualité ou un nouveau produit.
 * 
 * Fonctionnalité non implémentée pour l'instant.
 */
function chooseExistingFiles(target_url){
    $.ajax({
        type: "GET",
        url: target_url,
        success: function (data){
            alert(data);
        }
    });
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

function mySpaceLogin(data, status, jqr){
    alert('status: '+status+' data '+data+' autre '+jqr);
}

function bigProduct(id){
    alert(id);
}

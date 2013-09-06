function clickPlus(element) {
    if ($(".alert-error").is(":visible")) {
        $(".alert-error").fadeOut('fast', function() {
            toggleTools(element);
        });
    } else {
        toggleTools(element);
    }
}

function toggleTools(element) {
    login_box = $(element).closest("#login");


    if ($(element).is("img")) {
        top_height = (visible = login_box.find(".tools").is(":visible")) ? "20" : "+29";
        opacity = (visible) ? "hide" : "show";
        speed = (visible) ? 150 : 150;
    } else {
        top_height = "23";
        opacity = 'hide';
        speed = 150;
    }

    login_box.find(".tools").animate({
        top: top_height,
        opacity: opacity
    }, speed);
}


function loginCallback(element, obj) {

    if (error = obj.params.error) {
        iSaidNo("login");
        setTimeout(function() {
            $(".alert-error").find(".message").html(error);
            toggleAlert('show');
            $(element).find("input[type='password']").val("");
        }, 500);

    } else {
        window.location.href = obj.params.targetUrl;
    }
}

function toggleAlert(what) {
    if (what === 'show') {
        $(".alert-error").fadeIn('medium');
    } else {
        $(".alert-error").fadeOut('fast');
    }
}
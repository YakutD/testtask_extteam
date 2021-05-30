"use strict";

function onSubmit(token) {
    let entry_form = document.getElementById('entry_form');
    entry_form.submit();
}

function captchaExecuter(form){
    document.querySelector('[type="submit"]').setAttribute('disabled', 'disabled');
    if(form.id == 'entry_form'){
        if (!grecaptcha.getResponse()) {
            window.event.preventDefault();
            grecaptcha.execute();
        }
    }
}; 
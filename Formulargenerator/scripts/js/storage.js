/* ==================================================
    Copyright © 2014, Dimitri Vranken
   ================================================== */

if (typeof jQuery === 'undefined') {
    throw new Error('jQuery is required for storage.js');
}
if (typeof jQuery.cookies === 'undefined') {
    throw new Error('jQuery.cookies is required for storage.js');
}

$.cookies.setOptions({
    expiresAt: new Date().getDate() + 31
})

function saveUserInput(inputId) {
    var input = document.getElementById(inputId);
    if (input == null) {
        throw new Error('Invalid inputId');
    }

    input.value = $.cookies.get(inputId);
}

function loadUserInput(inputId) {

}
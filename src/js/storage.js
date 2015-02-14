if (typeof jQuery === 'undefined') {
    throw new Error('storage.js requires jQuery');
}
if (typeof jQuery.cookies === 'undefined') {
    throw new Error('storage.js requires jQuery.cookies');
}

$.cookies.setOptions({
    expiresAt: new Date().getDate() + 31
})


function saveUserInput(inputId) {
    var inputElement = document.getElementById(inputId);
    if (inputElement == null) {
        throw new Error('Invalid inputId');
    }

    $.cookies.set(inputId, inputElement.value);
}

function loadUserInput(inputId) {
    var inputElement = document.getElementById(inputId);
    if (inputElement == null) {
        throw new Error('Invalid inputId');
    }

    inputElement.value = $.cookies.get(inputId);
}
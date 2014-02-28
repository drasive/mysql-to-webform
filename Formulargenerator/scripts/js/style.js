/* ==================================================
    Copyright © 2014, Dimitri Vranken
   ================================================== */

function setActiveNavigationLink(id) {
    var navigationLink = document.getElementById(id);
    if (navigationLink != null) {
        navigationLink.className += " active ";
    }
    else {
        throw new Error("The provided Id is invalid");
    }
}
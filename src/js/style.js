﻿function setActiveNavigationLink(linkId) {
    var navigationLink = document.getElementById(linkId);
    if (navigationLink != null) {
        navigationLink.className += " active ";
    }
    else {
        throw new Error("Invalid linkId");
    }
}
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

function togglePanel() {
    let panel = document.getElementById("searchbar-container");
    panel.classList.toggle("expanded");
}
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

let button = document.getElementsByClassName("toggle-btn");

function togglePanel(element) {
    let panel = document.getElementById(element);
    panel.classList.toggle("expanded");

    let icon = document.querySelector('.toggle-btn .fas');
    icon.classList.toggle("fa-times");
}
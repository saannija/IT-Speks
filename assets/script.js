if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

let button = document.getElementsByClassName("toggle-btn");
let section = document.getElementById("admin-section");

google.charts.load('current',{packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);

function togglePanel(element) {
    let panel = document.getElementById(element);
    panel.classList.toggle("expanded");

    // if(element == "nav-content'"){
    //     section.style.padding = "1.2rem 1.2rem 1.2rem 21rem !important";
    // }

    let icon = document.querySelector('.toggle-btn .fas');
    icon.classList.toggle("fa-times");
}

// function drawChart() {

//     // Set Data
//     const data = google.visualization.arrayToDataTable([
//       ['Contry', 'Mhl'],
//       ['Italy', 55],
//       ['France', 49],
//       ['Spain', 44],
//       ['USA', 24],
//       ['Argentina', 15]
//     ]);
    
//     // Set Options
//     const options = {
//       title: 'World Wide Wine Production'
//     };
    
//     // Draw
//     const chart = new google.visualization.BarChart(document.getElementById('myChart'));
//     chart.draw(data, options);
    
//     }
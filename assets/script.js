if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

let button = document.getElementsByClassName("toggle-btn");
let section = document.getElementById("admin-section");

function togglePanel(element) {
    let panel = document.getElementById(element);
    panel.classList.toggle("expanded");

    let icon = document.querySelector('.toggle-btn .fas');
    icon.classList.toggle("fa-times");

}

let loginWindow = document.getElementById("login-window");
let backgroundOverlay = document.getElementById("background-overlay");

function showLoginWindow(){
    loginWindow.classList.add("show");
    backgroundOverlay.style.display = "block";
    document.body.style.overflow = "hidden";
}

function hideLoginWindow(){
    loginWindow.classList.remove("show");
    backgroundOverlay.style.display = "none";
    document.body.style.overflow = "auto";
}


const ctx = document.getElementById('vacancy-chart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'pie', // or 'bar', 'pie', etc.
    data: {
        labels: ['Software Developer', 'Web Developer', 'System Administrator'],
        datasets: [{
            label: 'Skaits',
            data: [65, 59, 80],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', // ill change colors later
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)', 
                'rgba(153, 102, 255, 0.2)', 
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1,      
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                display: true,
                position: 'right',
            },

            datalabels: {
                formatter: (value, ctx) => {
                    let sum = 0;
                    let dataArr = ctx.chart.data.datasets[0].data;
                    dataArr.map(data => {
                        sum += data;
                    });
                    let percentage = (value*100 / sum).toFixed(2)+"%";
                    return percentage;
                },
                color: '#000',
            }
        }
    },
    plugins: [ChartDataLabels],
});
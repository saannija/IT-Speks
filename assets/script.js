if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

// pagination
const itemsPerPage = 3;
const cards = document.querySelectorAll(".card-a");
const totalItems = cards.length;
const totalPages = Math.ceil(totalItems / itemsPerPage);
let currentPage = 1;

function showPage(page) {
    currentPage = page;
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    cards.forEach((card, index) => {
        if (index >= start && index < end) {
            card.style.display = "flex";
        } else {
            card.style.display = "none";
        }
    });

    pageNumber = document.getElementById("page-number")
    if(pageNumber){
        pageNumber.textContent = `Lapa ${currentPage} no ${totalPages}`;
        updatePaginationButtons();
    }
}

function prevPage() {
    if (currentPage > 1) {
        showPage(currentPage - 1);
    }
}

function nextPage() {
    if (currentPage < totalPages) {
        showPage(currentPage + 1);
    }
}

function showPageAll(page) {
    currentPage = page;
    const start = (currentPage - 1) * itemsPerPageAll;
    const end = start + itemsPerPageAll;

    cardsAll.forEach((card, index) => {
        if (index >= start && index < end) {
            card.style.display = "flex";
        } else {
            card.style.display = "none";
        }
    });

    pageNumber = document.getElementById("page-number-all")
    if(pageNumber){
        pageNumber.textContent = `Lapa ${currentPage} no ${totalPagesAll}`;
        updatePaginationButtons();
    }

}

function prevPageAll() {
    if (currentPage > 1) {
        showPageAll(currentPage - 1);
    }
}

function nextPageAll() {
    if (currentPage < totalPages) {
        showPageAll(currentPage + 1);
    }
}

function updatePaginationButtons() {
    const prevButton = document.querySelector(".pagination .prev");
    const nextButton = document.querySelector(".pagination .next");

    if (currentPage === 1) {
        prevButton.style.display = "none";
    } else {
        prevButton.style.display = "inline-block";
    }

    if (currentPage === totalPages) {
        nextButton.style.display = "none";
    } else {
        nextButton.style.display = "inline-block";
    }

    if (currentPage === totalPagesAll) {
        nextButton.style.display = "none";
    } else {
        nextButton.style.display = "inline-block";
    }
}

showPage(1);
showPageAll(1);

window.prevPage = prevPage;
window.nextPage = nextPage;

window.prevPageAll = prevPageAll;
window.nextPageAll = nextPageAll;


// kartinam
if (document.querySelector('.cards')){
    let cardsContainer = document.querySelector('.cards');
    let cardCount = cardsContainer.getElementsByTagName('a').length;
    
        if (cardCount < 3) {
            cardsContainer.classList.add('fewer-than-three');
        } else {
            cardsContainer.classList.remove('fewer-than-three');
        }
}


// Show | hide navigation
function togglePanel(element) {
    let panel = document.getElementById(element);
    panel.classList.toggle("expanded");

    let icon = document.querySelector('.toggle-btn .fas');
    icon.classList.toggle("fa-times");

}

// Show | hide login window
function showLoginWindow(){
    let loginWindow = document.getElementById("login-window");
    let backgroundOverlay = document.getElementById("background-overlay");

    loginWindow.classList.add("show");
    backgroundOverlay.style.display = "block";
    document.body.style.overflow = "hidden";
}

function hideLoginWindow(){
    let loginWindow = document.getElementById("login-window");
    let backgroundOverlay = document.getElementById("background-overlay");

    loginWindow.classList.remove("show");
    backgroundOverlay.style.display = "none";
    document.body.style.overflow = "auto";
}

// Create new item int the list add/edit page
function createNewItem(itemList) {
    let list = document.getElementById(itemList);
  
    let newListItem = document.createElement("li");
    let newInputField = document.createElement("input");

    newInputField.className = "default-input";
    newInputField.type = "text";

    newListItem.appendChild(newInputField);
    list.appendChild(newListItem);
}

// Load image
const fileInput = document.getElementById('image-input');
const previewImage = document.getElementById('preview-image');

if(fileInput){
    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

// Animated numbers
const countElements = document.querySelectorAll('.count');

countElements.forEach(countElement => {
    const targetNumber = parseInt(countElement.textContent);
    const duration = 2000;
    const interval = 10;

    let currentNumber = 0;
    const increment = (targetNumber / (duration / interval));

    const count = setInterval(function() {
        currentNumber += increment;
        countElement.textContent = Math.round(currentNumber);

        if (currentNumber >= targetNumber) {
            clearInterval(count);
            countElement.textContent = targetNumber;
        }
    }, interval);
});
  


//Create chart
const ctx = document.getElementById('vacancy-chart')

if(ctx){
    ctx.getContext('2d');

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
}


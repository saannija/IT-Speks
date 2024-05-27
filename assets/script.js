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
}

showPage(1);

window.prevPage = prevPage;
window.nextPage = nextPage;

const cardsContainer = document.querySelector('.cards.all-cards');
if(cardsContainer){
const cards_all = Array.from(cardsContainer.children);
const pageNumberDisplay = document.getElementById('page-number-all');
const prevButton = document.querySelector('.prev-all');
const nextButton = document.querySelector('.next-all');

const cardsPerPage = 9;
let currentPage_all = 1;

function displayCards() {
    cardsContainer.innerHTML = '';

    const start = (currentPage_all - 1) * cardsPerPage;
    const end = start + cardsPerPage;

    const cardsToShow = cards_all.slice(start, end);
    cardsToShow.forEach(card => {
        cardsContainer.appendChild(card);
    });

    updatePagination();
}

function updatePagination() {
    const totalPages = Math.ceil(cards_all.length / cardsPerPage);
    pageNumberDisplay.textContent = `Lapa ${currentPage_all} no ${totalPages}`;

    prevButton.style.display = currentPage_all > 1 ? 'inline-block' : 'none';
    nextButton.style.display = currentPage_all < totalPages ? 'inline-block' : 'none';
}

window.prevPageAll = function () {
    if (currentPage_all > 1) {
        currentPage_all--;
        displayCards();
    }
}

window.nextPageAll = function () {
    const totalPages = Math.ceil(cards_all.length / cardsPerPage);
    if (currentPage_all < totalPages) {
        currentPage_all++;
        displayCards();
    }
}

displayCards();
}

// Show | hide navigation
function togglePanel(element) {
    let panel = document.getElementById(element);
    panel.classList.toggle("expanded");

    let icon = document.querySelector('.toggle-btn .fas');
    icon.classList.toggle("fa-times");

}

// Show popup window
function showWindow(window){
    console.log(window);
    let loginWindow = document.getElementById(window);
    let backgroundOverlay = document.getElementById("background-overlay");

    loginWindow.classList.add("show");
    backgroundOverlay.style.display = "block";
    document.body.style.overflow = "hidden";
}

// Hide popup window
function hideWindow(window){
    let loginWindow = document.getElementById(window);
    let backgroundOverlay = document.getElementById("background-overlay");

    loginWindow.classList.remove("show");
    backgroundOverlay.style.display = "none";
    document.body.style.overflow = "auto";
}

// Create new item in the list add/edit vacancy page
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
                    'rgba(56, 176, 0, 0.2)',
                    'rgba(167, 241, 168, 0.2)',
                    'rgba(36, 118, 0, 0.2)',
                    'rgba(90, 169, 50, 0.2)', 
                    'rgba(159, 213, 141, 0.2)', 
                    'rgba(36, 118, 0, 0.2)',
                    'rgba(112, 209, 85, 0.2)'
                ],
                borderColor: [
                    'rgba(56, 176, 0, 0.5)',
                    'rgba(167, 241, 168, 0.5)',
                    'rgba(36, 118, 0, 0.5)',
                    'rgba(90, 169, 50, 0.5)', 
                    'rgba(159, 213, 141, 0.5)', 
                    'rgba(36, 118, 0, 0.5)',
                    'rgba(112, 209, 85, 0.5)'
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


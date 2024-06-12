if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

const modes = document.getElementById('modes');
const isDarkMode = localStorage.getItem('darkMode') === 'enabled';

document.body.classList.toggle('dark-mode', isDarkMode);
modes.classList.toggle('fa-moon', !isDarkMode);
modes.classList.toggle('fa-sun', isDarkMode);

modes.addEventListener('click', () => {
    const darkModeEnabled = document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', darkModeEnabled ? 'enabled' : 'disabled');
    modes.classList.toggle('fa-moon', !darkModeEnabled);
    modes.classList.toggle('fa-sun', darkModeEnabled);
});

// pagination
let itemsPerPage = 3;

if (window.innerWidth > 1400){
    itemsPerPage = 3;
}else{
    itemsPerPage = 4;
}

document.addEventListener('DOMContentLoaded', () => {
    const ascButton = document.querySelector('.sort-old');
    const descButton = document.querySelector('.sort-new');
    const currentSortOrder = localStorage.getItem('sortOrder') || '<?php echo isset($_SESSION["sort_order"]) ? $_SESSION["sort_order"] : "desc"; ?>';

    updateActiveSortButton(currentSortOrder);

    ascButton.addEventListener('click', () => {
        updateActiveSortButton('asc');
        localStorage.setItem('sortOrder', 'asc');
    });

    descButton.addEventListener('click', () => {
        updateActiveSortButton('desc');
        localStorage.setItem('sortOrder', 'desc');
    });

    function updateActiveSortButton(order) {
        if (order === 'asc') {
            ascButton.classList.add('active');
            descButton.classList.remove('active');
        } else {
            ascButton.classList.remove('active');
            descButton.classList.add('active');
        }
    }
});

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

const titles = document.querySelectorAll('#vacancy-container .title h2');
const titlesNews = document.querySelectorAll('.card .title');

titles.forEach(title => {
    const maxLength = 30;
    const originalText = title.textContent;

    if (originalText.length > maxLength) {
        const truncatedText = originalText.substring(0, maxLength) + '...';
        title.textContent = truncatedText;
    }
});


titlesNews.forEach(title => {
    const maxLength = 40;
    const originalText = title.textContent;

    if (originalText.length > maxLength) {
        const truncatedText = originalText.substring(0, maxLength) + '...';
        title.textContent = truncatedText;
    }
});

// Show | hide navigation
function togglePanel(element) {
    let panel = document.getElementById(element);
    panel.classList.toggle("expanded");

    let icon = document.querySelector('.toggle-btn .fas');
    icon.classList.toggle("fa-times");

}

// Show popup window
function showWindow(window){
    localStorage.setItem('popupOpen', 'true');
    localStorage.setItem('popupWindow', window);
    let loginWindow = document.getElementById(window);
    let backgroundOverlay = document.getElementById("background-overlay");

    setTimeout(function() {
        loginWindow.classList.add("show");
        backgroundOverlay.style.display = "block";
        document.body.style.overflow = "hidden";
    }, 200);

}


// Restore popup state on page load
window.onload = function() {
    let popupOpen = localStorage.getItem('popupOpen');
    let window = localStorage.getItem('popupWindow');

    const navigationEntries = performance.getEntriesByType("navigation");
    const navigationType = navigationEntries.length > 0 ? navigationEntries[0].type : "navigate";

    if (navigationType === "reload") {
        clearPopupState();
        
    }else if(popupOpen === 'true') {
        showWindow(window);

    }
}


function clearPopupState() {
    localStorage.removeItem('popupOpen');
    localStorage.removeItem('popupWindow');
}

// Hide popup window
function hideWindow(window){
    let loginWindow = document.getElementById(window);
    let backgroundOverlay = document.getElementById("background-overlay");

    loginWindow.classList.remove("show");
    backgroundOverlay.style.display = "none";
    document.body.style.overflow = "auto";

    clearPopupState();
}

// Create new item in the list add/edit vacancy page
function createNewItem(itemList, value, inputName) {
    let list = document.getElementById(itemList);
  
    let newListItem = document.createElement("li");
    let newInputField = document.createElement("input");

    newInputField.className = "default-input";
    newInputField.type = "text";
    newInputField.name = inputName;
    newInputField.value = value;

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

// Input type file - text
let input = document.getElementById('cv');
if (input){
    document.getElementById('cv').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : 'Nav izvēlēts neviens fails';
        document.getElementById('file-info').textContent = fileName;
    });
}

// Switch latest news
const listItems = document.querySelectorAll('.latest-news-item');
const contents = document.querySelectorAll('.wrapper.contents');

listItems.forEach(item => {
    item.addEventListener('click', () => {
        listItems.forEach(i => i.classList.remove('selected'));
        
        item.classList.add('selected');

        contents.forEach(content => content.classList.remove('active'));
        
        const contentId = item.getAttribute('data-content');
        document.getElementById(contentId).classList.add('active');
    });
});

// Shrinks news page image
window.addEventListener('scroll', function() {
    const image = document.querySelector('.banner-image');

    if(image){
        if (window.scrollY > 50) {
            image.classList.add('shrink');
        } else {
            image.classList.remove('shrink');
        }
    }
});

function refreshLogin(){
    let loginForm = document.getElementById('login-form-admin');
    loginForm.style.display = 'none';

    let loginFormUser = document.getElementById('login-form-user');
    loginFormUser.style.display = 'none';

    let roleForm = document.getElementById('role-selection-form');
    roleForm.style.display = 'flex';
}

function enableEditing() {
    const form = document.getElementById('user-appl-form');
    const inputs = form.querySelectorAll('input[type="text"], input[type="email"]');
    const button = document.getElementById('enableEditing');
    const saveButton = document.getElementById('save-user-info');

    inputs.forEach(input => {
        if (input.readOnly) {
            input.readOnly = false;
        } else {
            input.readOnly = true;
        }
    });

    if (button.innerHTML.includes('<i class="fa-solid fa-pen-to-square">')) {
        button.innerHTML = '<i class="fas fa-times">';
    } else {
        button.innerHTML = '<i class="fa-solid fa-pen-to-square">';
    }

    if (saveButton.style.display === 'none') {
        saveButton.style.display = 'block';
    } else {
        saveButton.style.display = 'none';
    }
}
const calendarDates = document.getElementById("calendar-dates");
const monthYear = document.getElementById("month-year");
const prevButton = document.getElementById("prev");
const nextButton = document.getElementById("next");
const noteModal = document.getElementById("note-modal");
const closeModal = document.getElementById("close-modal");
const selectedDateEl = document.getElementById("selected-date");
const noteText = document.getElementById("note-text");

const months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

let currentDate = new Date();

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    monthYear.textContent = `${months[month]} ${year}`;
    calendarDates.innerHTML = "";

    // Fill in blank days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        calendarDates.appendChild(emptyCell);
    }

    // Fill in actual days of the month
    for (let i = 1; i <= lastDate; i++) {
        const dateCell = document.createElement("div");
        dateCell.textContent = i;
        dateCell.dataset.date = `${year}-${month + 1}-${i}`;
        dateCell.classList.add("date-cell");

        // Fetch notes for this date
        fetch(`fetch_note.php?date=${dateCell.dataset.date}`)
            .then(response => response.json())
            .then(data => {
                if (data.note) {
                    // Create an img element to display the bus picture
                    const busImage = document.createElement("img");
                    busImage.src = "bus.png";  // Path to your bus PNG image
                    busImage.alt = "Bus";
                    busImage.classList.add("bus-image");

                    // Add image to the date cell
                    dateCell.appendChild(busImage);

                    // Store the note content in a data attribute for later use
                    dateCell.dataset.note = data.note;

                    // Add click event to the bus image
                    busImage.addEventListener("click", (event) => {
                        event.stopPropagation(); // Prevent triggering the date cell click event
                        showNoteModal(dateCell.dataset.date, data.note);
                    });
                }
            });

        dateCell.addEventListener("click", () => showNoteModal(dateCell.dataset.date, dateCell.dataset.note));
        calendarDates.appendChild(dateCell);
    }
}

function showNoteModal(date, note) {
    selectedDateEl.textContent = `Date: ${date}`;
    noteText.value = note || "No Bus for this day"; // Show the fetched note or a message if no note exists
    noteModal.style.display = "block";
}

closeModal.addEventListener("click", () => {
    noteModal.style.display = "none";
});

// Navigate to previous month
prevButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

// Navigate to next month
nextButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

// Initialize calendar
renderCalendar(currentDate);
function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();
    const today = new Date(); // Get today's date

    monthYear.textContent = `${months[month]} ${year}`;
    calendarDates.innerHTML = "";

    // Fill in blank days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        calendarDates.appendChild(emptyCell);
    }

    // Fill in actual days of the month
    for (let i = 1; i <= lastDate; i++) {
        const dateCell = document.createElement("div");
        dateCell.textContent = i;
        dateCell.dataset.date = `${year}-${month + 1}-${i}`;
        dateCell.classList.add("date-cell");

        // Check if this date is today's date
        const cellDate = new Date(year, month, i);
        if (cellDate.toDateString() === today.toDateString()) {
            dateCell.classList.add("current-date"); // Add class for current date
        }

        // Fetch notes for this date
        fetch(`fetch_note.php?date=${dateCell.dataset.date}`)
            .then(response => response.json())
            .then(data => {
                if (data.note) {
                    // Create an img element to display the bus picture
                    const busImage = document.createElement("img");
                    busImage.src = "bus.png";  // Path to your bus PNG image
                    busImage.alt = "Bus";
                    busImage.classList.add("bus-image");

                    // Add image to the date cell
                    dateCell.appendChild(busImage);

                    // Store the note content in a data attribute for later use
                    dateCell.dataset.note = data.note;

                    // Add click event to the bus image
                    busImage.addEventListener("click", (event) => {
                        event.stopPropagation(); // Prevent triggering the date cell click event
                        showNoteModal(dateCell.dataset.date, data.note);
                    });
                }
            });

        dateCell.addEventListener("click", () => showNoteModal(dateCell.dataset.date, dateCell.dataset.note));
        calendarDates.appendChild(dateCell);
    }
}

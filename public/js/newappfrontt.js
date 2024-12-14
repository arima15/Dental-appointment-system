document.addEventListener('DOMContentLoaded', function() {
    // Calendar variables
    const calendarBody = document.getElementById('calendar-body');
    const monthYearDisplay = document.querySelector('.month-year');
    const prevMonthBtn = document.querySelector('.prev-month');
    const nextMonthBtn = document.querySelector('.next-month');
    const today = new Date();
    const nextToTimeBtn = document.getElementById('next-to-time');
    const nextToServiceBtn = document.getElementById('next-to-service');
    const backToDateBtn = document.getElementById('back-to-date');
    const backToTimeBtn = document.getElementById('back-to-time');
    const confirmBtn = document.getElementById('confirm-btn');
    let selectedDate = null;
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    const timeSlots = ["09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "02:00 PM", "03:00 PM"];

    // Calendar rendering function
    function renderCalendar(month, year) {
        const firstDay = new Date(year, month).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        calendarBody.innerHTML = '';
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        monthYearDisplay.textContent = `${monthNames[month]} ${year}`;

        let date = 1;
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {
                    const cell = document.createElement('td');
                    row.appendChild(cell);
                } else if (date > daysInMonth) {
                    break;
                } else {
                    const cell = document.createElement('td');
                    const cellText = document.createTextNode(date);
                    cell.appendChild(cellText);
                    const cellDate = new Date(year, month, date);

                    if (cellDate < today.setHours(0, 0, 0, 0)) {
                        cell.classList.add('unavailable-date');
                    } else {
                        cell.classList.add('available-date');
                        cell.addEventListener('click', function() {
                            document.querySelectorAll('td').forEach(td => td.classList.remove('selected-date'));
                            cell.classList.add('selected-date');
                            selectedDate = cellDate;
                            nextToTimeBtn.disabled = false;
                        });
                    }
                    row.appendChild(cell);
                    date++;
                }
            }
            calendarBody.appendChild(row);
        }
    }

    // Step navigation
    nextToTimeBtn.addEventListener('click', function() {
        document.getElementById('step-1').style.display = 'none';
        document.getElementById('step-2').style.display = 'block';
        populateTimeSlots();
    });

    backToDateBtn.addEventListener('click', function() {
        document.getElementById('step-2').style.display = 'none';
        document.getElementById('step-1').style.display = 'block';
    });

    nextToServiceBtn.addEventListener('click', function() {
        document.getElementById('step-2').style.display = 'none';
        document.getElementById('step-3').style.display = 'block';
    });

    backToTimeBtn.addEventListener('click', function() {
        document.getElementById('step-3').style.display = 'none';
        document.getElementById('step-2').style.display = 'block';
    });

    confirmBtn.addEventListener('click', function() {
        const selectedTime = document.getElementById('time-slots').value;
        const selectedService = document.querySelector('.service-option.active').getAttribute('data-value');
        if (selectedDate && selectedTime && selectedService) {
            localStorage.setItem('date', selectedDate.toDateString());
            localStorage.setItem('time', selectedTime);
            localStorage.setItem('service', selectedService);
            alert(`Appointment confirmed on ${selectedDate.toDateString()} at ${selectedTime}`);
            window.location.href = 'confirmation_page';
        } else {
            alert('Please complete all selections.');
        }
    });

    // Populate time slots
    function populateTimeSlots() {
        const timeSlotsDropdown = document.getElementById('time-slots');
        timeSlotsDropdown.innerHTML = '';
        timeSlots.forEach(slot => {
            const option = document.createElement('option');
            option.value = slot;
            option.textContent = slot;
            timeSlotsDropdown.appendChild(option);
        });
        nextToServiceBtn.disabled = false;
    }

    // Service selection handlers
    const serviceOptions = document.querySelectorAll('.service-option');
    const serviceDescription = document.getElementById('service-description');

    serviceOptions.forEach(option => {
        option.addEventListener('click', function() {
            serviceOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            serviceDescription.textContent = this.getAttribute('data-description');
            confirmBtn.disabled = false;
        });
    });

    // Month navigation handlers
    prevMonthBtn.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    nextMonthBtn.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    // Initialize calendar
    renderCalendar(currentMonth, currentYear);
});

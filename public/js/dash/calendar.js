document.addEventListener('DOMContentLoaded', function() {
    const calendarHeader = document.querySelector('.calendar-header span');
    const prevButton = document.querySelector('.calendar-header button:first-child');
    const nextButton = document.querySelector('.calendar-header button:nth-child(3)');
    const todayButton = document.querySelector('.calendar-header button:last-child');
    const calendarBody = document.querySelector('.calendar table tbody');

    let currentDate = new Date();
    let currentMonth = 8; // September (0-based index)
    let currentYear = 2024;

    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    const calendarData = {
        '2024-09-01': 'not-available',
        '2024-09-02': 'not-available',
        '2024-09-03': 'available',
        '2024-09-04': 'holiday',
        '2024-09-05': 'not-available',
        '2024-09-06': 'not-available',
        '2024-09-09': 'not-available',
        '2024-09-10': 'not-available',
        '2024-09-11': 'holiday',
        '2024-09-12': 'not-available',
        '2024-09-13': 'not-available',
        '2024-09-16': 'not-available',
        '2024-09-17': 'not-available',
        '2024-09-18': 'not-available',
        '2024-09-19': 'not-available',
        '2024-09-20': 'not-available',
        '2024-09-23': 'available',
        '2024-09-24': 'available',
        '2024-09-25': 'holiday',
        '2024-09-26': 'not-available',
        '2024-09-27': 'not-available',
        '2024-09-30': 'not-available',
        '2024-10-31': 'holiday',
        '2024-11-01': 'holiday',
        '2024-11-02': 'holiday',
        '2024-11-30': 'holiday',
        '2024-12-08': 'holiday',
        '2024-12-24': 'holiday',
        '2024-12-25': 'holiday',
        '2024-12-30': 'holiday',
        '2024-12-31': 'holiday'
    };

    function generateCalendar(month, year) {
        calendarBody.innerHTML = '';
        calendarHeader.textContent = `${months[month]} ${year}`;

        let firstDay = new Date(year, month, 1).getDay();
        let daysInMonth = new Date(year, month + 1, 0).getDate();

        let date = 1;
        for (let i = 0; i < 6; i++) {
            let row = document.createElement('tr');

            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {
                    let cell = document.createElement('td');
                    row.appendChild(cell);
                } else if (date > daysInMonth) {
                    break;
                } else {
                    let cell = document.createElement('td');
                    const dayNumber = document.createElement('span');
                    dayNumber.classList.add('day-number');
                    dayNumber.textContent = date;
                    cell.appendChild(dayNumber);
                    
                    if (date === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
                        cell.classList.add('today');
                    }
                    
                    const fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    const status = calendarData[fullDate] || 'not-available';
                    
                    if (status && j !== 0 && j !== 6) { // Exclude Saturdays and Sundays
                        cell.classList.add(status);
                        const icon = document.createElement('span');
                        icon.classList.add('status-icon', 'material-icons');
                        switch (status) {
                            case 'available':
                                icon.textContent = 'check_circle';
                                break;
                            case 'no-slots':
                                icon.textContent = 'cancel';
                                break;
                            case 'fully-booked':
                                icon.textContent = 'event_busy';
                                break;
                            case 'holiday':
                                icon.textContent = 'star';
                                break;
                            case 'not-available':
                                icon.textContent = 'block';
                                break;
                        }
                        cell.prepend(icon);
                    }
                    
                    // Add click event listener to each date cell
                    if (status !== 'not-available' && status !== 'holiday') {
                        cell.addEventListener('click', function() {
                            const selectedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                            openAppointmentPage(selectedDate);
                        });
                    }
                    
                    row.appendChild(cell);
                    date++;
                }
            }

            calendarBody.appendChild(row);
            if (date > daysInMonth) {
                break;
            }
        }
    }

    function openAppointmentPage(date) {
        window.location.href = `book appointment/book-appointment.html?date=${date}`;
    }

    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    }

    function goToToday() {
        currentMonth = currentDate.getMonth();
        currentYear = currentDate.getFullYear();
        generateCalendar(currentMonth, currentYear);
    }

    prevButton.addEventListener('click', prevMonth);
    nextButton.addEventListener('click', nextMonth);
    todayButton.addEventListener('click', goToToday);

    generateCalendar(currentMonth, currentYear);
});
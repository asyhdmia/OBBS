document.addEventListener('DOMContentLoaded', function() {
    fetchAvailableDates();
});

function fetchAvailableDates() {
    fetch('app.php?action=available-dates')
        .then(response => response.json())
        .then(data => {
            if (data.dates) {
                populateDates(data.dates);
            } else {
                console.error('No dates found');
            }
        })
        .catch(error => console.error('Error fetching dates:', error));
}

function populateDates(dates) {
    const dateSelect = document.getElementById('appointment-date');
    dates.forEach(date => {
        const option = document.createElement('option');
        option.value = date;
        option.text = date;
        dateSelect.appendChild(option);
    });
}

function bookAppointment() {
    const selectedDate = document.getElementById('appointment-date').value;
    fetch('app.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=book-appointment&date=${selectedDate}`
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('reminder').innerText = data.message;
    })
    .catch(error => console.error('Error booking appointment:', error));
}

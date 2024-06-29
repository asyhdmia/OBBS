document.addEventListener('DOMContentLoaded', async (event) => {
    const selectElement = document.getElementById('appointment-date');

    try {
        const response = await fetch('http://localhost/test/appointmentpage.php?action=available-dates');
        const data = await response.json();
        data.dates.forEach(date => {
            const option = document.createElement('option');
            option.value = date;
            option.textContent = date;
            selectElement.appendChild(option);
        });

        const reminder = localStorage.getItem('appointmentDate');
        if (reminder) {
            document.getElementById('reminder').textContent = `You have an appointment booked on ${reminder}`;
        }
    } catch (error) {
        console.error('Error fetching available dates:', error);
    }
});

async function bookAppointment() {
    const selectedDate = document.getElementById('appointment-date').value;

    try {
        const response = await fetch('http://localhost/test/appointmentpage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `action=book-appointment&date=${selectedDate}`
        });
        const data = await response.json();
        alert(data.message);
        localStorage.setItem('appointmentDate', selectedDate);
        document.getElementById('reminder').textContent = `You have an appointment booked on ${selectedDate}`;
    } catch (error) {
        console.error('Error booking appointment:', error);
    }
}

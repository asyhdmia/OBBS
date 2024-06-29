document.addEventListener('DOMContentLoaded', async (event) => {
    const selectElement = document.getElementById('appointment-date');

    try {
        const response = await fetch('http://localhost/OBBS/Project_obbs/appointmentpage.php?action=available-dates');
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
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
    const donorId = document.getElementById('donor-id').value;
    const selectedDate = document.getElementById('appointment-date').value;

    try {
        const response = await fetch('http://localhost/OBBS/Project_obbs/appointmentpage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `action=book-appointment&donor_id=${donorId}&date=${selectedDate}`
        });
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const data = await response.json();
        if (data.message) {
            alert(data.message);
            localStorage.setItem('appointmentDate', selectedDate);
            document.getElementById('reminder').textContent = `You have an appointment booked on ${selectedDate}`;
        } else if (data.error) {
            alert(data.error);
        }
    } catch (error) {
        console.error('Error booking appointment:', error);
    }
}

async function viewAppointments() {
    const donorId = document.getElementById('donor-id').value;
    const appointmentsDiv = document.getElementById('appointments');
    appointmentsDiv.innerHTML = '';

    try {
        const response = await fetch(`http://localhost/OBBS/Project_obbs/appointmentpage.php?action=view-appointments&donor_id=${donorId}`);
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const data = await response.json();
        if (data.appointments.length > 0) {
            const ul = document.createElement('ul');
            data.appointments.forEach(date => {
                const li = document.createElement('li');
                li.textContent = date;
                ul.appendChild(li);
            });
            appointmentsDiv.appendChild(ul);
        } else {
            appointmentsDiv.textContent = 'No appointments found.';
        }
    } catch (error) {
        console.error('Error fetching appointments:', error);
    }
}

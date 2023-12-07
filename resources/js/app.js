import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


//Set min e max value in date_of_birth input registration
const dateInput = document.getElementById('date_of_birth');

function subtractYears(years) {
    const today = new Date();
    today.setFullYear(today.getFullYear() - years);
    return today.toISOString().split("T")[0];
}

const maxDate = subtractYears(18);
const minDate = subtractYears(100);

dateInput.max = maxDate;
dateInput.min = minDate; 
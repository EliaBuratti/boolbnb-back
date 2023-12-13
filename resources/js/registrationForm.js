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

const passwordEl = document.getElementById('password');
const passwordConfirmEl = document.getElementById('password-confirm');

const submitEl = document.getElementById('submitBtn');

submitEl.addEventListener('click', function(e){
    if (passwordEl.value !== passwordConfirmEl.value) {
        e.preventDefault();
        alert('Passwords are not equals!');
    }
})
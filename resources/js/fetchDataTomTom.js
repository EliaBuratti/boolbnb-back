import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

let resultsSearch = [];
let newResultsSearch = [];

//Dynamic search with tomtom call
async function fetchAddress(url) {
    const response = await fetch(url);
    const data = await response.json();
    const results = data.results;
    results.forEach((result, i) => {
        console.log(result.address.freeformAddress);
        console.log(nationEl.value.includes(results[i].address.countryCode));
        if (result.address.freeformAddress && nationEl.value.includes(results[i].address.countryCode)) {

            resultsSearch[i] = result.address.freeformAddress;
        }

    });
    newResultsSearch = resultsSearch.filter(result => result != undefined);
    return data.results;
};

const addressEl = document.getElementById('address');
const searchResults = document.getElementById('search-results');
const nationEl = document.getElementById('nation');


nationEl.addEventListener('click', function () {
    addressEl.value = '';
    newResultsSearch = [];
    searchResults.innerHTML = '';

})

addressEl.addEventListener('keyup', function () {
    let inputValue = `${addressEl.value}, ${nationEl.value}`;
    console.log(inputValue);
    fetchAddress(`https://api.tomtom.com/search/2/geocode/${inputValue}.json?storeResult=false&limit=10&view=Unified&key=${tomtom_key}`).then(result => console.log(result));
    setTimeout(() => {
        console.log(newResultsSearch);
        displayResults(newResultsSearch);
    }, 500);
});


// function to display search results
function displayResults(results) {
    searchResults.innerHTML = '';
    results.forEach(result => {
        let li = document.createElement('li');
        li.classList.add('list-unstyled')
        li.textContent = result;
        li.addEventListener('click', () => {
            addressEl.value = result;
            searchResults.innerHTML = '';
        });
        searchResults.appendChild(li);
    });
}

// event listener to close search results when clicking outside the input and the results
document.addEventListener('click', (event) => {
    let isClickInsideInput = event.target === addressEl;
    let isClickInsideResults = searchResults.contains(event.target);
    if (!isClickInsideInput && !isClickInsideResults) {
        searchResults.innerHTML = '';
    }
});








import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import { toArray } from 'lodash';
import.meta.glob([
    '../img/**'
])


let resultsSearch = [];
let newResultsSearch = [];
const addressEl = document.getElementById('address');
const nationEl = document.getElementById('nation');



//Dynamic search with tomtom call
const fetchAddress = async (url) => {
    try {
        const response = await fetch(url);
        const data = await response.json();
        const results = data.results;

        results.forEach((result, i) => {


            if (result.address.freeformAddress && nationEl.value.includes(results[i].address.countryCode)) {
                resultsSearch[i] = {
                    'freeformAddress': result.address.freeformAddress
                };
            }
        });
        newResultsSearch = resultsSearch.filter(result => result != undefined);
        autocomplete(addressEl, newResultsSearch);

        return results;
    } catch (error) {
        console.log(error);
    }
};

nationEl.addEventListener('click', function () {
    addressEl.value = '';
})

addressEl.addEventListener('keyup', function () {

    const inputValue = `${addressEl.value},  ${nationEl.value}`;

    console.log(inputValue);
    fetchAddress(`https://api.tomtom.com/search/2/geocode/${inputValue}.json?storeResult=false&limit=10&view=Unified&key=udRMY8mFZ7o4kiJOvK0ShT9DEn82wGyT`);

});



function autocomplete(inp) {

    const arr = newResultsSearch;
    var currentFocus;


    var a, b, i, val = addressEl.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) { return false; }
    currentFocus = -1;

    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", addressEl.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/

    addressEl.parentNode.appendChild(a);
    /*for each item in the array*/

    for (i = 0; i < arr.length; i++) {
        /*create a DIV element for each matching element:*/
        b = document.createElement("DIV");
        b.innerHTML = `<input type='hidden' value='${arr[i].freeformAddress}'>${arr[i].freeformAddress}`;

        /*execute a function when someone clicks on the item value (DIV element):*/
        b.addEventListener("click", function (e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
        });
        a.appendChild(b);
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
}
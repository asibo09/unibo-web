const risultato = document.querySelector("div");

document
        // .querySelector("input") --> seleziona solo il primo che fa match
        // .querySelectorAll("input")[0]
        // .querySelector("input:nth-child(1)")
        // .querySelector("input:fierst-child")
        .querySelector("input:first-of-type")
        .addEventListener("click", function() {
            let testo = risultato.innerHTML;
            testo = testo.toUpperCase();
            risultato.innerHTML = testo;
        });

document
        // .querySelector("input:nth-of-child(2)")
        // .querySelectorAll("input")[1]
        .querySelector("input[value='Testo lowercase']")
        .addEventListener("click", function() {
            let testo = risultato.innerHTML;
            testo = testo.toLowerCase();
            risultato.innerHTML = testo;
        });

document
        .querySelector("input:last-of-type")
        .addEventListener("click", function() {
            let testo = risultato.innerText;
            testo = testo.substring(5,testo.length) + testo.substring(0,5);
            risultato.innerHTML = testo;
        });

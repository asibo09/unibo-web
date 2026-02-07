/* 
Dato il file html 'esercizio_javascript.html' in allegato, creare il codice JavaScript in modo tale che:

Al caricamento della pagina vengano nascoste tutte le immagini, eccetto le prime due. Alla prima immagine deve essere inoltre aggiunta la classe "current". 
Al click su un'immagine, si dovrà controllare se l’immagine ha la classe current e nel caso non fare nulla. In caso contrario, invece, bisognerà aggiungere la classe current, rimuovendola da altre immagini. Successivamente, andranno opportunamente nascoste e visualizzate le immagini in modo che siano visibili: l’immagine con classe current, l’eventuale immagine prima e l’eventuale immagine dopo.
Caricate 2 file: html (vostraemailunibo.html) e il vostro script (vostraemailunibo.js).

N.B. il codice HTML fornito non deve essere modificato (a parte il nome dello vostro script).

N.B.2 La soluzione deve essere abbastanza generale da non dover cambiare codice nel caso si aggiungesse una nuova immagine.

N.B.3 Tra il materiale è presente un video per chiarire il funzionamento 
*/


document.addEventListener("DOMContentLoaded", function () {
    //selezionate tutte le immagini all'interno dello slider
    const images = document.querySelectorAll(".slider-image img")

    //gestisce visibilità basandosi su classe current
    function updateVisibility() {
        images.forEach((img) => {
            //verifica se immagine è quella corrente, precedente o successiva
            const isCurrent = img.classList.contains("current");
            const isPrev = img.nextElementSibling && img.nextElementSibling.classList.contains("current");
            const isNext = img.previousElementSibling && img.previousElementSibling.classList.contains("current");

            if (isCurrent || isNext || isPrev) {
                img.style.display = "inline-block"; 
            } else {
                img.style.display = "none";
            }
        })
    }

    //setup iniziale: viste solo le prime due allo start e la prima aggiunta la classe current
    if (images.length > 0) {
        images[0].classList.add("current");

        images.forEach((img,index) => {
            if (index == 0 || index == 1) {
                img.style.display = "inline-block";
            } else {
                img.style.display = "none";
            }
        })
    }

    images.forEach((img) => {
        img.addEventListener("click", function(){
            //se immagine cliccata ha classe current non fa nulla
            if (this.classList.contains("current")) {
                return;
            }
            //rimossa classe current per tutte le immagini
            images.forEach(i => i.classList.remove("current"));
            //aggiunge classe current a quella cliccata
            this.classList.add("current");
            //aggiorna visibilità: mostra precedente, corrente e successiva
            updateVisibility();
        })
    })






})
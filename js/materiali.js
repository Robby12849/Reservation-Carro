function calculateTotal(row) {
    var quantitaAcquistata = parseInt(row.querySelector("input[name='quantita_acquistata[]']").value);
    var prezzo = parseFloat(row.querySelector("input[name='prezzo[]']").value);
    
    var prezzoTotale = quantitaAcquistata * prezzo;
    
    var prezzoTotaleInput = row.querySelector("input[name='prezzo_totale[]']");
    prezzoTotaleInput.value = prezzoTotale;
}


function setQuantitaAcquistata(row) {
    var quantitaInizialeInput = row.querySelector("input[name='quantita[]']");
    var quantitaSelezionata = parseInt(quantitaInizialeInput.value);
    var quantitaIniziale = parseInt(quantitaInizialeInput.getAttribute("value"));
    
    var quantitaAcquistata = quantitaIniziale - quantitaSelezionata;
    
    var quantitaAcquistataInput = row.querySelector("input[name='quantita_acquistata[]']");
    quantitaAcquistataInput.value = quantitaAcquistata;
    
    calculateTotal(row); // Update the total price when the quantity acquired changes
}



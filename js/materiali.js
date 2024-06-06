function calculateTotal(row) {
    var quantita = row.querySelector("input[name='quantita[]']").value;
    var prezzo = row.querySelector("input[name='prezzo[]']").value;
    var prezzoTotale = row.querySelector("input[name='prezzo_totale[]']");
    prezzoTotale.value = quantita * prezzo;
}

function setQuantitaAcquistata(row) {
    var quantita = row.querySelector("input[name='quantita[]']").value;
    var quantitaAcquistata = row.querySelector("input[name='quantita_acquistata[]']");
    quantitaAcquistata.value = quantita;
}
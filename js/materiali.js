function calculateTotal(row) {
    var quantityInput = row.cells[1].getElementsByTagName('input')[0];
    var priceInput = row.cells[2].getElementsByTagName('input')[0];
    var totalPriceInput = row.cells[3].getElementsByTagName('input')[0];
    var quantityDifferenceInput = row.cells[4].getElementsByTagName('input')[0];

    // Calcola la differenza nella quantità
    var oldQuantity = parseFloat(quantityInput.defaultValue);
    var newQuantity = parseFloat(quantityInput.value);
    var quantityDifference = oldQuantity - newQuantity;

    // Moltiplica la differenza nella quantità per il prezzo
    var price = parseFloat(priceInput.value);
    var totalPrice = quantityDifference * price;

    // Aggiorna il campo del prezzo totale e della differenza di quantità
    totalPriceInput.value = totalPrice;
    quantityDifferenceInput.value = quantityDifference;
}
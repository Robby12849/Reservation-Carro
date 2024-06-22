async function getInput() {
    if (confirm("Vuoi inserire un materiale?")) {
        const nome = prompt("Inserisci nome oggetto:");
        const qta = prompt("Inserisci quantità da acquistare:");
        const costo = prompt("Inserisci costo per oggetto:");
        if (nome && qta && costo) {
            try {
                const response = await fetch('../admin/insertmateriale.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `nome=${encodeURIComponent(nome)}&qta=${encodeURIComponent(qta)}&costo=${encodeURIComponent(costo)}`
                });
                if (response.ok) {
                    const result = await response.text();
                    if (result === 'success') {
                        alert('Inserimento avvenuto con successo!');
                        window.location.href = '../admin/gestiscimaterialiadm.php';
                    } else {
                        alert('Errore durante l\'inserimento.');
                    }
                } else {
                    alert('Errore durante l\'inserimento.');
                }
            } catch (error) {
                console.error('Errore:', error);
                alert('Errore durante l\'inserimento.');
            }
        }
    } else {
        window.location.href = '../admin/gestiscimaterialiadm.php';
    }
}

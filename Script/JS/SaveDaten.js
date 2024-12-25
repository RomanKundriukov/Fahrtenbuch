document.getElementById('submitBtn').addEventListener('click', async function (event) {
    event.preventDefault();
    const form = document.getElementById('fahrtenbuchForm');

    // **7. Formulardaten senden**
    const formData = new FormData(form);
    try {
        const response = await fetch('../scripts/set.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.text();
        if (response.ok) {
            window.location.reload(); // Seite neu laden
            alert('Daten erfolgreich hinzugefügt!');
        } else {
            alert('Fehler beim Speichern der Daten: ' + result);
        }
    } catch (error) {
        console.error('Ein Fehler ist aufgetreten:', error);
        alert('Ein unerwarteter Fehler ist aufgetreten.');
    }
});

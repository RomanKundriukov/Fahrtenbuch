document.getElementById('submitBtn').addEventListener('click', async function () {
    const form = document.getElementById('fahrtenbuchForm');
    const formData = new FormData(form);

    try {
        const response = await fetch('../scripts/set.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.text(); // PHP-Antwort als Text lesen
        if (response.ok) {
            alert('Daten erfolgreich hinzugefügt!'); // Erfolgsmeldung anzeigen
            window.location.reload(); // Seite neu laden
        } else {
            alert('Fehler: ' + result); // Fehler ausgeben
        }
    } catch (error) {
        console.error('Ein Fehler ist aufgetreten:', error);
        alert('Ein unerwarteter Fehler ist aufgetreten.');
    }
});

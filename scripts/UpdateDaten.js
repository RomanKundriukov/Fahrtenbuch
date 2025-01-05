// Validierung und Daten senden
document.getElementById('updBtn').addEventListener('click', async function (event) {
    event.preventDefault();

    const StartDatum = document.getElementById('StartDatumUpdate').value;
    const EndDatum = document.getElementById('EndDatumUpdate').value;
    const UhrzeitVon = document.getElementById('UhrzeitVonUpdate').value;
    const UhrzeitBis = document.getElementById('UhrzeitBisUpdate').value;
    const Zweck = document.getElementById('ZweckUpdate').value;
    const Name = document.getElementById('NameUpdate').value;

    let isValid = true;
    let errorMessage = '';

    // Datum validieren
    const startDate = new Date(StartDatum);
    const endDate = new Date(EndDatum);

    if (isNaN(startDate) || isNaN(endDate) || startDate > endDate) {
        isValid = false;
        errorMessage += 'Startdatum darf nicht nach dem Enddatum liegen.\n';
    }

    // Pflichtfelder
    if (Zweck.trim() === '') {
        isValid = false;
        errorMessage += 'Zweck darf nicht leer sein.\n';
    }
    if (Name.trim() === '') {
        isValid = false;
        errorMessage += 'Name darf nicht leer sein.\n';
    }

    if (!isValid) {
        alert('Bitte korrigieren Sie folgende Fehler:\n' + errorMessage);
        return;
    }

    const form = document.getElementById('fahrtenbuchFormUpdate');
    // Formulardaten senden
    const formData = new FormData(form);
    try {
        const response = await fetch('../scripts/update.php', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            alert('Daten erfolgreich aktualisiert!');
            window.location.reload();
        } else {
            const errorText = await response.text();
            alert('Fehler beim Aktualisieren der Daten: ' + errorText);
        }
    } catch (error) {
        console.error('Ein Fehler ist aufgetreten:', error);
        alert('Ein unerwarteter Fehler ist aufgetreten.');
    }
});


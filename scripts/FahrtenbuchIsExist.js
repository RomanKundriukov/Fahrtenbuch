document.getElementById('submitBtn').addEventListener('click', async function (event) {
    event.preventDefault();
    const form = document.getElementById('fahrtenbuchForm');

    // Felder abrufen
    const StartDatum = document.getElementById('StartDatum').value;
    const EndDatum = document.getElementById('EndDatum').value;
    const UhrzeitVon = document.getElementById('UhrzeitVon').value;
    const UhrzeitBis = document.getElementById('UhrzeitBis').value;
    const KmStart = document.getElementById('KmStart').value;
    const KmEnd = document.getElementById('KmEnd').value;
    const Zweck = document.getElementById('Zweck').value;
    const Name = document.getElementById('Name').value;

    // Validierungsstatus und Fehlermeldungen
    let isValid = true;
    let errorMessage = '';

    // **1. Validierung: Datum**
    const startDate = new Date(StartDatum);
    const endDate = new Date(EndDatum);

    if (isNaN(startDate) || isNaN(endDate)) {
        isValid = false;
        errorMessage += 'Start- und Enddatum müssen gültige Daten sein.\n';
    } else if (startDate > endDate) {
        isValid = false;
        errorMessage += 'Startdatum darf nicht nach dem Enddatum liegen.\n';
    }

    // **2. Validierung: Uhrzeit**
    if (StartDatum === EndDatum && UhrzeitVon && UhrzeitBis) {
        const startTime = UhrzeitVon.split(':').map(Number);
        const endTime = UhrzeitBis.split(':').map(Number);

        if (startTime[0] > endTime[0] || (startTime[0] === endTime[0] && startTime[1] > endTime[1])) {
            isValid = false;
            errorMessage += 'Uhrzeit bis darf nicht vor Uhrzeit von liegen.\n';
        }
    }

    // **3. Validierung: Kilometerstände**
    if (!Number.isFinite(Number(KmStart)) || !Number.isFinite(Number(KmEnd))) {
        isValid = false;
        errorMessage += 'Km Start und Km End müssen Zahlen sein.\n';
    } else if (Number(KmStart) > Number(KmEnd)) {
        isValid = false;
        errorMessage += 'Km Start darf nicht größer als Km End sein.\n';
    }

    // **4. Validierung: Zweck darf keine Zahlen enthalten**
    if (!/^[a-zA-ZäöüÄÖÜß\s]+$/.test(Zweck)) {
        isValid = false;
        errorMessage += 'Zweck darf keine Zahlen enthalten, nur Buchstaben.\n';
    }

    // **5. Validierung: Pflichtfelder**
    if (Name.trim() === '' || Zweck.trim() === '') {
        isValid = false;
        errorMessage += 'Name und Zweck dürfen nicht leer sein.\n';
    }

    // **6. Fehler anzeigen und Verarbeitung abbrechen**
    if (!isValid) {
        alert('Bitte korrigieren Sie folgende Fehler:\n' + errorMessage);
        return;
    }

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

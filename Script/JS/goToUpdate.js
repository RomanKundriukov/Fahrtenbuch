// Stelle sicher, dass das Skript ausgeführt wird, nachdem das DOM geladen ist
document.addEventListener("click", function() {
    // Wähle das Element aus, auf das geklickt werden soll
    const button = document.getElementById("updateFahrt");

    // Überprüfen, ob das Element existiert
    if (button) {
        // Füge einen Klick-Event-Listener hinzu
        button.addEventListener("click", function() {
            // URL zur Zielseite
            const targetUrl = "UpdateFahrten.php";

            // Navigation ausführen
            window.location.href = targetUrl;
        });
    } else {
        console.error("Das Element mit der ID 'navigateButton' wurde nicht gefunden.");
    }
});
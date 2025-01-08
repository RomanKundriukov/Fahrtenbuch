<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neue Fahrt hinzufügen</title>

    <link rel="stylesheet" href="../Style/Dashboard.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="../Image/logo_fahrtenbuch.png" alt="fahrtenbuchlogo" height="70" width="70">
    </div>
    <div class="nav-menu">
        <nav class="nav-button">
            <a href="UberUns.php">Über Uns</a>
        </nav>
        <nav class="nav-button">
            <a href="Kontakten.php">Kontakten</a>
        </nav>
    </div>
</header>
<div class="page">
    <div class="fahrten-title">
        <h1>Neue Fahrt hinzufügen</h1>
    </div>
    <div class="fahrten-table">
        <form class="my-table" method="post" action="../Script/PHP/add.php">
            <table>
                <tr>
                    <td><label for="StartDatum">Startdatum:</label></td>
                    <td><input type="date" id="StartDatum" name="StartDatum" required></td>
                </tr>
                <tr>
                    <td><label for="EndDatum">Enddatum:</label></td>
                    <td><input type="date" id="EndDatum" name="EndDatum" required></td>
                </tr>
                <tr>
                    <td><label for="UhrzeitVon">Uhrzeit von:</label></td>
                    <td><input type="time" id="UhrzeitVon" name="UhrzeitVon" required></td>
                </tr>
                <tr>
                    <td><label for="UhrzeitBis">Uhrzeit bis:</label></td>
                    <td><input type="time" id="UhrzeitBis" name="UhrzeitBis" required></td>
                </tr>
                <tr>
                    <td><label for="KmStart">Km-Start:</label></td>
                    <td><input type="number" id="KmStart" name="KmStart" required></td>
                </tr>
                <tr>
                    <td><label for="KmEnd">Km-Ende:</label></td>
                    <td><input type="number" id="KmEnd" name="KmEnd" required></td>
                </tr>
                <tr>
                    <td><label for="Zweck">Zweck:</label></td>
                    <td><input type="text" id="Zweck" name="Zweck" required></td>
                </tr>
                <tr>
                    <td><label for="Name">Name:</label></td>
                    <td><input type="text" id="Name" name="Name" required></td>
                </tr>
                <tr>
                    <td><label for="Auto">Auto:</label></td>
                    <td><input type="text" id="Auto" name="Auto" required></td>
                </tr>
                <tr>
                    <td><label for="Status">Status:</label></td>
                    <td>
                        <select id="Status" name="Status" required>
                            <option value="Offen">Offen</option>
                            <option value="Abgeschlossen">Abgeschlossen</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit">Fahrt hinzufügen</button>
        </form>
    </div>
</div>
<footer>
    @ 2024 - Fahrtenbuch. Alle Rechte vorbehalten.
</footer>
</body>
</html>

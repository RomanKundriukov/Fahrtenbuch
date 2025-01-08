<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $xmlFile = '../../Data/Fahrtenbuch.xml';

    // XML-Datei laden oder erstellen
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;

    if (file_exists($xmlFile)) {
        $dom->load($xmlFile);
    } else {
        $root = $dom->createElement('Fahrtenbuch');
        $dom->appendChild($root);
    }

    $root = $dom->documentElement;

    // Eingaben validieren
    $startDatum = htmlspecialchars($_POST['StartDatum'], ENT_XML1, 'UTF-8');
    $endDatum = htmlspecialchars($_POST['EndDatum'], ENT_XML1, 'UTF-8');
    $uhrzeitVon = htmlspecialchars($_POST['UhrzeitVon'], ENT_XML1, 'UTF-8');
    $uhrzeitBis = htmlspecialchars($_POST['UhrzeitBis'], ENT_XML1, 'UTF-8');
    $kmStart = filter_var($_POST['KmStart'], FILTER_VALIDATE_INT);
    $kmEnd = filter_var($_POST['KmEnd'], FILTER_VALIDATE_INT);
    $zweck = htmlspecialchars($_POST['Zweck'], ENT_XML1, 'UTF-8');
    $name = htmlspecialchars($_POST['Name'], ENT_XML1, 'UTF-8');
    $auto = htmlspecialchars($_POST['Auto'], ENT_XML1, 'UTF-8');
    $status = htmlspecialchars($_POST['Status'], ENT_XML1, 'UTF-8');

    if ($kmStart === false || $kmEnd === false || $startDatum === '' || $endDatum === '' || $zweck === '' || $name === '' || $auto === '' || $status === '') {
        die('Fehlende oder ungültige Eingabedaten.');
    }

    $kmDiff = $kmEnd - $kmStart;

    // Neues Fahrt-Element hinzufügen
    $fahrt = $dom->createElement('Fahrt');
    $fahrt->appendChild($dom->createElement('StartDatum', $startDatum));
    $fahrt->appendChild($dom->createElement('EndDatum', $endDatum));
    $fahrt->appendChild($dom->createElement('UhrzeitVon', $uhrzeitVon));
    $fahrt->appendChild($dom->createElement('UhrzeitBis', $uhrzeitBis));
    $fahrt->appendChild($dom->createElement('KmStart', $kmStart));
    $fahrt->appendChild($dom->createElement('KmEnd', $kmEnd));
    $fahrt->appendChild($dom->createElement('KmDiff', $kmDiff));
    $fahrt->appendChild($dom->createElement('Zweck', $zweck));
    $fahrt->appendChild($dom->createElement('Name', $name));
    $fahrt->appendChild($dom->createElement('Auto', $auto));
    $fahrt->appendChild($dom->createElement('Status', $status));

    $root->appendChild($fahrt);

    // XML speichern
    if ($dom->save($xmlFile)) {
        echo 'Neue Fahrt erfolgreich hinzugefügt.';
    } else {
        echo 'Fehler beim Speichern der XML-Datei.';
    }
} else {
    echo 'Ungültige Anfrage.';
}
?>
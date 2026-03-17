<?php
date_default_timezone_set('Europe/Warsaw');
// TWOJE HASŁO - ZMIEŃ JE NA JAKIE CHCESZ
$moje_haslo = getenv('GUEST_PASSWORD');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wpisane_haslo = $_POST['haslo'] ?? '';
    $tekst = htmlspecialchars($_POST['wiadomosc'] ?? '');

    // Sprawdzamy, czy hasło pasuje
    if ($wpisane_haslo !== $moje_haslo) {
        die("<h1 style='color:red; background:black; font-family:monospace;'>BŁĄD KRYTYCZNY: NIEAUTORYZOWANY DOSTĘP.</h1>");
    }

    $data = date("Y-m-d H:i");
    
    // Fioletowa ramka dla gościa
    $nowy_wpis = "
    <div style='border: 1px solid #ff00ff; padding: 15px; margin-bottom: 20px; background: rgba(255,0,255,0.05); box-shadow: 0 0 10px rgba(255,0,255,0.2);'>
        <strong style='color: #ff00ff; font-size: 0.8em;'>[ $data ] (WPIS AUTORYZOWANEGO GOŚCIA)</strong>
        <p style='margin-top: 10px; line-height: 1.6; color: #eee;'>$tekst</p>
    </div>\n";

    $stara_tresc = file_get_contents('logi_content.html');
    file_put_contents('logi_content.html', $nowy_wpis . $stara_tresc);

    header("Location: logi.html");
    exit();
}
?>

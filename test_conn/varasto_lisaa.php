<?php
   $n = $_POST["nimi"];
   $k = $_POST["lkm"];
    $username = "user1";  // <= vaihda!
    $password = "";  // <= vaihda
    $dbserver = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "tietoturvallinen_ohjelmointi";
    try {
        $yhteys = new PDO("mysql:host=$dbserver;dbname=$dbname", $dbusername, $dbpassword);
        $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully\n";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    $lause = "INSERT INTO varasto (nimi, lkm) VALUES ('$n', $k)";
    // Yllä on muodostettu SQL-lause ja seuraava kohdistaa lauseen varasto-tauluun
    // eli lisää sinne lomakkeelle syötetyt tiedot
    try {
        $kysely = $yhteys->prepare($lause); 
        $kysely->execute();
    } catch
(PDOException $e) { 
    die("VIRHE NRO 2: " . $e->getMessage()); 
} 
?>
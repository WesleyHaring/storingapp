<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit']; 
$melder = $_POST['melder'];
$type = $_POST['type'];
$prioriteit = $_POST['prioriteit'];
if(isset($_post['prioriteit']))
{
    $prioriteit = true;
}
else
{
    $prioriteit = false;
}
$overige_info = $_POST['overige_info'];
//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen(attractie, capaciteit, melder, type, prioriteit, overige_info) VALUES (:attractie, :capaciteit, :melder, :type, :prioriteit, :overige_info)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":type" => $type,
    ":prioriteit" => $prioriteit,
    ":overige_info" => $overige_info,
]);

header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
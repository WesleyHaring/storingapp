<?php
//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[]="Vul de attractie-naam in.";
}

$capaciteit = $_POST['capaciteit']; 
if(!is_numeric($capaciteit))
{
    $errors[] = "vul voor de capaciteit een geldig getal in";
}

$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[]="Vul de naam van de melder in.";
}

$type = $_POST['type'];
if(empty($type))
{
    $errors[]="Vul de type-soort in.";
}

if(isset($_POST['prioriteit']))
{
    $prioriteit = true;
}
else
{
    $prioriteit = false;
}

if(isset($errors))
{
    var_dump($errors);
    die();
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
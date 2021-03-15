<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>
    
    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php 
        require_once '../backend/conn.php';
        $query = "SELECT * FROM meldingen ";
        $statement = $conn->prepare($query);
        $statement->execute();
        $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
        

        foreach($meldingen as $melding)
        {
            echo "<p>" . $melding['attractie'] . $melding['type'] . $melding['capaciteit'] . $melding['melder'] . $melding['gemeld_op'] . $melding['overige_info'] . "</p>";
        }
        ?>
    </div>  

</body>

</html>

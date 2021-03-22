<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Melding aanpassen</h1>

        <?php
        //Haal het id uit de URL:
        $id = $_GET['id'];

        //1. Haal de verbinding erbij
        require_once '../backend/conn.php';

        //2. Query, vul deze aan met een WHERE zodat je alleen de melding met dit id ophaalt
        $query = "SELECT * FROM meldingen WHERE id= :id";

        //3. Van query naar statement
        $statement = $conn->prepare($query);

        //4. Voer de query uit, voeg hier nog de placeholder toe
        $statement->execute([
            ":id" => $id
        ]);

        //5. Ophalen gegevens, tip: gebruik hier fetch().
        $melding = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <form action="../backend/meldingenController.php" method="POST">
            <!-- (voeg hier opdracht 7 toe) -->
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="action" value="id= :id">

            <div class="form-group">
                <label>Naam attractie:</label>
                <input type="text" name="title" value="<?php echo $melding['attractie']; ?>">
            </div>

            <!-- Zorg dat het type wordt getoond, net als de naam hierboven -->
            <div class="from-group">
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value=""> <?php echo $melding['type']; ?> </option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="draaiend">Draaiende attractie</option>
                    <option value="kinder">Kinderattractie</option>
                    <option value="horeca">Restaurant, cafe, etc</option>
                    <option value="show">Parkshow</option>
                    <option value="water">Waterattractie</option>
                    <option value="overig">Overig</option>
                </select>
            </div>

            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input"
                    value="<?php echo $melding['capaciteit']; ?>">
            </div>

            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <!-- Let op: de checkbox blijft nu altijd uit, pas dit nog aan -->
                <input type="checkbox" name="prioriteit" id="prioriteit">
                <label for="prioriteit">Melding met prioriteit</label>
            </div>

            <div class="form-group"> 
                <label for="melder">Naam melder:</label>
                <!-- Voeg hieronder nog een value-attribuut toe, zoals bij capaciteit -->
                <input type="text" name="melder" id="melder" class="form-input">
            </div>
            
            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4">.....</textarea>
            </div>
            
            <input type="submit" value="Melding aanpassen">

        </form>
    </div>  

</body>

</html>

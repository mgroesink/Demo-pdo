<?php 

require_once("pdo.php");
    // Deze pagina mag alleen geopend worden
    // vanuit de index pagina
    // Als geen id is opgegeven wordt de index pagina geopend
if (!isset($_GET['id'])) {
    header("Location:/index.php");
}

if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
$id = intval($_GET['id']);
if (isset($_POST["delete"]) && $action == "delete") {
    // Verwijder de klant en ga terug naar overzicht
    $sql = "DELETE FROM customer WHERE customerid = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":id" , $_POST["id"]);
    $count = $stm->execute();
    header("Location:/index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Details customer</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    table {
        border-collapse: collapse;
        width: 40%;
    }

    td {
        font-style: italic;
        padding-left: 25px;
        border: 1px solid black;
        text-align: left;
        border: none;
    }

    th {
        background-color: black;
        color: yellow;
        text-align: left;
        padding: 2px;
    }

    .confirm-button {
        width: 200px;
        height: 50px;
        background-color: red;
        color: yellow;
        margin: 25px 0 0 0;
        font-weight: bold;
        border-radius: 20%;
    }
    </style>

</head>

<body>
    <a class="nav-button" href="index.php">Naar klantenlijst</a>
    <table>
        <?php
        try {
            $sql = "SELECT * FROM customer WHERE customerid = :id";
            $stm = $pdo->prepare($sql);
            $stm->bindParam(':id' , $id);
            $stm->execute();
            $row = $stm->fetch();
            echo "<h1>Details van " . $row["Voorletters"] . " " 
                . $row["Tussenvoegsels"] . " " . $row["Achternaam"] . "</h1>";
            echo "<tr><th>Voorletters</th><td>" . $row["Voorletters"] . "</td></tr>";
            echo "<tr><th>Tussenvoegsels</th><td>" . $row["Tussenvoegsels"] . "</td></tr>";
            echo "<tr><th>Achternaam</th><td>" . $row["Achternaam"] . "</td></tr>";
            echo "<tr><th>Email</th><td><a href='mailto:" 
                . $row["Email"] . "'>" . $row["Email"] . "</a></td></tr>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </table>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id?>" />
        <?php 
        if ($action == "delete") {
            echo "<button class='confirm-button' type='submit' name='delete'>BEVESTIG VERWIJDEREN</button>";
        }
        ?>
    </form>

</body>

</html>
<?php

require_once("pdo.php");
try {
    if (isset($_POST["submit"])) {
        $sql = "INSERT INTO customer(voorletters , tussenvoegsels , achternaam , email)";
        $sql .= " VALUES(:voorletters , :tussenvoegsels , :achternaam , :email);";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(':voorletters' , $_POST['voorletters']);
        $stm->bindParam(':tussenvoegsels' , $_POST['tussenvoegsels']);
        $stm->bindParam(':achternaam' , $_POST['achternaam']);
        $stm->bindParam(':email' , $_POST['email']);

        $stm->execute();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Create customer</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    input[type="submit"] {
        border-radius: 10% 10% 0 0;
        padding: 2px 5px;
        font-weight: bold;
        font-size: 1.1em;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <h1>Nieuwe klant toevoegen</h1>
    <a class="nav-button" href="index.php">Naar klantenlijst</a>
    <form method="post">
        <table>
            <tr>
                <td>Voorletters</td>
                <td>
                    <input type="text" name="voorletters" id="voorletters" maxlength="5" required />
                </td>
            </tr>
            <tr>
                <td>Tussenvoegsels</td>
                <td>
                    <input type="text" name="tussenvoegsels" id="tussenvoegsels" maxlength="10" />
                </td>
            </tr>
            <tr>
                <td>Achternaam</td>
                <td>
                    <input type="text" name="achternaam" id="achternaam" maxlength="50" required />
                </td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td>
                    <input type="text" name="email" id="email" maxlength="100" />
                </td>
            </tr>
            <br />
        </table>
        <input type="submit" name="submit" value="Toevoegen" />
    </form>

</body>

</html>
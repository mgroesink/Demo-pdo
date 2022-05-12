<?php 
require_once("pdo.php");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Customerlist</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    input[type="submit"] {
        border-radius: 10% 10% 0 0;
        padding: 2px 5px;
        font-weight: bold;
        font-size: 1.1em;
        margin-top: 10px;
    }

    table {
        border-collapse: collapse;
    }

    td {
        padding: 2px;
        border: 1px solid black;
        text-align: left;
    }

    th {
        background-color: black;
        color: yellow;
    }

    .button {
        background-color: aquamarine;
        border-radius: 10px 10px 0 0;
        padding: 2px 5px;
        text-decoration: none;
        margin: 2px;
    }
    </style>
</head>

<body>
    <h1>Klantoverzicht</h1>
    <a class="nav-button" href="create.php">Nieuwe klant toevoegen</a>
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $sql = "SELECT * FROM customer;";
                $stm = $pdo->query($sql);
                while ($row = $stm->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row["Voorletters"] . " " . $row["Tussenvoegsels"] 
                            . " " . $row["Achternaam"] . "</td>";
                    echo "<td><a href='mailto:" . $row["Email"] . "'>" . $row["Email"] . "</a></td>";
                    // Knop details toevoegen
                    echo "<td style='border:none'><a class='button' href='details.php?action=details&id=" 
                        . $row["CustomerID"] . "'>Details</a></td>";
                    // Knop wijzig toevoegen
                    echo "<td style='border:none'><a class='button' href='edit.php?id=" 
                        . $row["CustomerID"] . "'>Wijzig</a></td>";
                    // Knop wis toevoegen
                    echo "<td style='border:none'><a class='button' href='details.php?action=delete&id=" 
                        . $row["CustomerID"] . "'>Wis</a></td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</body>

</html>
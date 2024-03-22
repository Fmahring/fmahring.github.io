<?php
global $conn;
include "utils/config.php";

$result = $conn->query("SELECT * FROM demo");

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Vname: " . $row["vname"]. "   - NName: " . $row["nname"]. "   Zahl: " . $row["zahl"]. "<br>";
    }
} else {
    echo "0 results";
}






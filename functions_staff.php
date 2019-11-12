<?php
// includes getStaff,listStaff

// LIST STAFF
function listStaff() {
    global $conn;

    $sql = "SELECT * FROM staff";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<div class='staff'>";
        displayData($row);
        if (array_key_exists('photo',$row)) {
            echo "<IMG SRC = '../photos/".$row['photo']."' class='staffPhoto'>";
        }
        echo "</div>";
    }

}


// GET STAFF
function getStaff(){
    global $conn;
    $sql = "SELECT staffID,staffName FROM staff";
    $result = $conn->query($sql);
    echo "<table>";
    echo "<tr><td><span class='emph'>Staff Member:</span></td><td>";
    echo "<SELECT name='staffID'><option value=''></option>";
    while ($row = $result->fetch_assoc()) {
        echo "<OPTION value=".$row['staffID'].">".$row['staffName']."</OPTION>";
    }
    echo "</SELECT></td></tr></table>";
}


?>
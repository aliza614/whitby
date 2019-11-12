<?php
include 'functions.php';

headMe("UPDATE PAGE");

if ((array_key_exists('idkey',$_POST)) and (array_key_exists('id',$_POST)) and (array_key_exists('table',$_POST))) {
        $idkey = $_POST['idkey'];
        $id =  mysqli_real_escape_string($conn,$_POST['id']);
        $table =  $_POST['table'];
} else {
    getOut("MISSING KEY INFO FOR UPDATE");
}

$skips = ['id','idkey','table','action','updateTime'];

global $numerical;
global $conn;
$active = 1;

// print_r($_POST);

if ((array_key_exists('action',$_POST)) and ($_POST['action'] == 'UPDATE')) {
    
    $sql = "UPDATE $table SET ";
    $updates=array();
    foreach (array_keys($_POST) as $key) {
        if (in_array($key,$skips)) {
            continue;
        } else {

            if (in_array($key,$numerical)){
                $numval = intval(mysqli_real_escape_string($conn,$_POST[$key]));
                if ($numval >= 0 ) {
                    array_push($updates,"$key=$numval");
                }
            } else {
                array_push($updates,$key."='".mysqli_real_escape_string($conn,$_POST[$key])."'");
            }
            
        }
        
    }
    $sql=$sql.join(",",$updates)." WHERE $idkey=$id";
    
    // print_r($_POST);
    // out($sql);
    if ($conn->query($sql)) {

        // echo "<h2 class='topper'>SQL ".$sql."</h2>";

        if ($idkey=='deceasedID') {
            showAll($id);
        } else {
            //       showPOC($id); 
            // out("SHOW POC $id");
            getActiveClients($active);
        }
    } else {
        getOut("Update failed $sql");
    }
    
} else {
    if ($idkey == 'deceasedID') {
        showAll($id);
    } else {
//       showPOC($id); 
//        out("SHOW POC $id");
        getActiveClients($active);
    }
}



//print_r($_POST);
tailMe();
?>

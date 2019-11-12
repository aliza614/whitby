<?php
include 'functions.php';
headMe('TNF DELETE PAGE');


$inField = ['table','id','idkey','action'];
$del = array();
global $conn;

foreach ($inField as $k) {
    if (array_key_exists($k,$_POST)) {
        $del[$k] = mysqli_real_escape_string($conn,$_POST[$k]);
    } else {
        getOut("No $k");
    }
}

switch($del['action']) {
    case 'UPDATE':
        updateRow($del['table'],$del['idkey'], $del['id']);
        break;
    case 'CANCEL':
        out ("NOT DELETED");
        break;
    case 'YES':
        $sql = "UPDATE ".$del['table']." SET valid=0 WHERE ".$del['idkey']."=".$del['id'];
        if ($conn->query($sql)) {
            out("All Gone!");
        } else {
            getOut("DELETE FAILED $sql");
        }
        break;
    default:
        getOut("NO ACTIONS HERE");
}

$active = 1;
getActiveClients($active);


tailMe();
?>

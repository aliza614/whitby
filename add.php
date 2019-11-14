<?php
include 'functions.php';
headMe("Add to Database");

$did=0;
$table='';
$new = 0;

if (array_key_exists('new',$_POST)) {
    $new = $_POST['new'];    
} else {

    if (array_key_exists('did',$_POST)) {
        $did = $_POST['did'];
    } else {
        getOut("NO DID TO SHARE");
    }
}

if (array_key_exists('table',$_POST)) {
    $table = $_POST['table'];
} else {
    getOut("NO TABLE TO SHARE");
}


$cols = ['valid'];
$vals = [1];

$skips = ['deceasedID','action','did','table','new'];
foreach ($_POST as $k=>$v) {
    if (in_array($k,$skips)) { continue; }
    $val = trim(mysqli_real_escape_string($conn,$v));
    if (strlen($val) > 0) {
        array_push($cols,$k);
        array_push($vals,"'".$val."'");
    }
}

if (count($cols) > 1) {
    $sql="INSERT INTO $table (".join(",",$cols).") VALUES (".join(",",$vals).")";

    debug_to_console($vals);
    if ( $conn->query($sql)) {
        if ($table == 'pointOfContact') {
            $pid = getLastID();
            $sql = "INSERT INTO deceasedXPOC (POCID,deceasedID,valid) VALUES ($pid,$did,1)";
            $conn->query($sql);
        }
    } else {
        getOut("SQL FAILED $sql"); 
    }
} else {
    out("Nothing to Add");
}

if ($new) {
    $did = getLastID();
//    moreNew($did);    
} 
showAll($did);


tailMe();
?>
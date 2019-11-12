<?php
include 'functions.php';
headMe("NEW ENTRY");

$did=0;
$checkMe = [];

// LOAD ALL THE INPUTS INTO $decvals
$decvals = array();
$repeat = 1;

// CHECK IF REPEAT THROUGH
if (array_key_exists('data',$_POST)) {
 //   $decvals = json_decode();
 $htmlDecode = html_entity_decode($_POST['data']);
 // print_r($htmlDecode);
 $decvals = (array) json_decode($htmlDecode);
// print_r($decvals);
 //print_r($_POST['data']);
    $repeat = 0;
} else {
    // first entry
    foreach (array_keys($_POST) as $df) {
        if (strlen(trim($_POST[$df])) > 0) {
            if($df == 'action') {
                continue;
            } else {
                $decvals[$df]=trim(mysqli_real_escape_string($conn,$_POST[$df]));
            }
        }
    }
}

// PUT ALL THE DATA IN A HIDDEN JSON STRING -  WE MIGHT NEED THIS
$decvalJSON = htmlentities(json_encode($decvals));
$hidden = array('data'=> $decvalJSON);

// ENTER DECEASED DATA
$did = getDid($decvals,$repeat);



// CIRCUMSTANCES
$circFields = array('placeOfDeath','addressOfDeath','accessNotes','signingPhysician','hospiceName','hospiceContact','hospicePhone','hospiceEmail');
$cols = array('deceasedID');
$vals = array($did);
foreach ($circFields as $df) {
    if (array_key_exists($df,$decvals)) {
        array_push($cols,$df);
        $v = "'".$decvals[$df]."'";
        array_push($vals,$v);
    }
}

if (count($cols) > 1 ) {
    $sql = "INSERT INTO circumstances (".join(',',$cols).") VALUES (".join(',',$vals).")";
    $conn->query($sql);
}

// POC
$pocFields = array('POCFirstName','POCLastName','POCemail','POCphone','POCrelation','POCNextOfKin','POCnotes');
    
$cols = array('valid','firstContact');
$vals = array(1,1);
foreach ($pocFields as $df) {
    if (array_key_exists($df,$decvals)) {
        array_push($cols,$df);
        $v = "'".$decvals[$df]."'";
        array_push($vals,$v);
    }
}
    
if (count($cols) > 2 ) {
    $sql = "INSERT INTO pointOfContact (".join(',',$cols).") VALUES (".join(',',$vals).")";
    $conn->query($sql);
    $pocid = getLastID();
    $sql = "INSERT INTO deceasedXPOC (POCID,deceasedID,valid) VALUES($pocid,$did,1)";
    $conn->query($sql);
}
    
showAll($did);    


tailMe();
?>
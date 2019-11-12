<?php
include 'functions.php';
headMe("Welcome to WHITBY");


if( array_key_exists('edrid',$_GET)) {
    $edrid = mysqli_real_escape_string($conn,$_GET['edrid']);
} else {
    getOut("NO EDRID");
}

$sql = "SELECT * FROM EDR WHERE EDRID=$edrid";
$results = $conn->query($sql)->fetch_assoc();

$decName = array('label' => 'Decedent Name','fields'=>['firstName','middleName','lastName','sex','deathDate','birthDate']);
$genInfo = array('label' => 'General Information','fields'=>['placeOfBirth','SSN','military']);
$placeOfDeath = array('label' => 'Place of Death','fields'=>['typeOfPlace','typeOfPlaceOther','placeName','addressOfDeath','cityOfDeath','stateOfDeath','zipOfDeath','countyOfDeath','cityLimits']);
out("DECEDENT");
edrDisp($decName,$results);
edrDisp($genInfo,$results);
edrDisp($placeOfDeath,$results);

out("RESIDENCE RELATIONS");
$res = array('label'=>"Decedent's Residence Address", 'fields' => ['homeless','address','city','state','zip','cityLimits']);
$mar = array('label' => "Decedent's Marital Status At Time Of Death Spouse/Partner(If Wife, Give Maiden Name)", 'fields' => ['maritalStatus','spouseFirstName','spouseMiddleName','spouseLastName'] );
$ssp = array('label'=> 'Same Sex Parents','fields' => ['sameSexParents','role']);
$mom = array('label' => "Decedent's Parents (Mother's Name prior To First Marriage)",'fields'=>['mothersFirstName','mothersMiddleName','mothersLastName']);
$dad = array('label' => "Decedent's Parents (Father's Name)",'fields'=>['fathersFirstName','fathersMiddleName','fathersLastName']);
edrDisp($res,$results);
edrDisp($mar,$results);
edrDisp($ssp,$results);
edrDisp($mom,$results);
edrDisp($dad,$results);

out("RACE EDUCATION");
$edu = array('label'=>"Decedent's Education",'fields'=>['education','occupation','industry']);
$hisp = array('label'=>'Hispanic?','fields'=> ['hispanic','hispanicOther']);
$race = array('label'=> 'Race','fields'=>['race','raceOther']);
edrDisp($edu,$results);
edrDisp($hisp,$results);
edrDisp($race,$results);

out("DISPOSITION");
$inf = array('label'=> 'Informant Information','fields'=>['informantFirstName','informantLastName','informantRelationship','informantRelationshipOther','informantPhone','informantEmail']);
edrDisp($inf,$results);

tailMe();


?>
<?php
// includes getActiveClients, hospiceCall, newClient

// (((((((((((((((((((((( CLIENT FUNCTIONS )))))))))))))))))
// GET ACTIVE CLIENTS
function getActiveClients($active) {
    
    
    $sqlFields = array("deceasedID","firstName","middleName","lastName","birthday","deathday","status","progress");

    $sql = "SELECT ".join(',',$sqlFields)." FROM deceased WHERE deceased.valid=1";
    if ($active) {
        $sql = $sql." AND progress <> 'complete'"; 
    }
    
    global $conn;
    $result = $conn->query($sql);
    $n = 1;
    if ($result->num_rows <= 0) {
        out( "No Active Clients");
        $n = 0;
    } else {
        out ("Active Clients");
        $fields = array("firstName","middleName","lastName","birthday","deathday","age","status","progress");
        $deceased = sortResult($result);
        showList($deceased,$fields,["More","Delete","Update Status"],array('table'=>'deceased'));
    }
}

function hospiceCall() {
    out("HOSPICE CALL");
    
// First Call from Hospice
//  FROM RICHARD EMAIL  
//Full legal name (which we should already have)
//Date of birth:
//Date of death:
//Age: (just to confirm):
//Place of death (if we don’t know it already - and we need it for pick up too.
//Social security#
//Name of certifying physician:
//Contact info for nurse:
//Contact info for immediate next of kin: 

    global $hospiceFields;
    global $deceasedFields;
    global $pocFields;
    
    echo "<form method='POST' action='new.php'>";
    echo "<input type='hidden' name='type' value='hospice'>";

    
    // Separate into Deceased Info and Hospice Info
    $localDeceased = $deceasedFields;
    unset($localDeceased['weight']);
    
    $accessFields= array('placeOfDeath'=>['Place of Death','text'],'addressOfDeath'=>['Address of Death','textarea'],'countyOfDeath'=>['County of Death','text'],'weight'=>['Approximate Weight (enter a number between 1 and 1000 pounds)',
    'number'],'accessNotes'=>['Access Notes','textarea']);
   
    collectInfo("Info about the Deceased",$localDeceased);
    collectInfo("Info about Access",$accessFields);
    collectInfo("Info about the Hospice",$hospiceFields);
    collectInfo("Point Of Contact",$pocFields);
    
    out("Staff");
    getStaff();

    $buttons = array('Submit'=>'Submit','Cancel'=>'Cancel');
    buttRow($buttons);
    echo "</form>";
    
}

function newClient() {
    

    global $deceasedFields;
    global $pocFields;
    global $circFields;
    global $fdFields;
    global $dcFields;
    global $edrFields;
    
    $hideMe = array("new"=>1,'table'=>'deceased');
    
    echo "<form method='POST' action='add.php'>";
    collectInfo("Info about the Deceased",$deceasedFields);
    getStaff();
    hide($hideMe);
    
    $buttons = array('Submit'=>'Submit','Cancel'=>'Cancel');
    buttRow($buttons);
    echo "</form>";
    
}

function moreNew($did) {
    
        out("DIDDLY $did");
        /*

    collectInfo("Info about Circumstances",$circFields);
    out("Info about Procedures");
    collectInfo("EDR",$edrFields);
    collectInfo('Final Disposition',$fdFields);
    collectInfo('Death Certificates',$dcFields);
    
    collectInfo("Point Of Contact",$pocFields);
    */

}

?>
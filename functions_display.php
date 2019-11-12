<?php

// includes out, showList, sortResult, listStaff, showAll, displayData, dcReport
// edrDisp

// (((((((((((((((((( DISPLAY FUNCTIONS  )))))))))))))))))))))))))))

function edrDisp($fields,$results) {
    $dateWords = ['birthDate','deathDate'];
    echo "<TABLE class='edr'>";
    echo "<TR><TH class='edrHeader'>".$fields['label']."</TH></TR>";
    foreach ($fields['fields'] as $k) {
        echo "<TR><TD class='key'>$k</TD><TD class='dispKey'>";
        if (array_key_exists($k,$results)) {
            if (in_array($k,$dateWords)) {
                $dp = explode("-",$results[$k]);
                echo $dp[1].'/'.$dp[2].'/'.$dp[0];
            } else {
                echo $results[$k];
            }
        }
        echo "</TD></TR>";
    } 
    
    echo "</TABLE><BR />";
}


function dcReport() {
    global $conn;
    
    // this got complicated because of joining tables

    $sqlFields = array("deceased.deceasedID","deceased.firstName","deceased.middleName","deceased.lastName","deceased.birthday","deceased.deathday","circumstances.countyOfDeath","circumstances.cityOfDeath","circumstances.valid","procedures.deathCertificates","procedures.deathCertificateStatus");

    $sql = "SELECT DISTINCT ".join(',',$sqlFields)." FROM procedures LEFT JOIN (deceased) ON (deceased.deceasedID=procedures.deceasedID) RIGHT JOIN (circumstances) ON (procedures.deceasedID=circumstances.deceasedID) WHERE deceased.progress <> 'complete' AND deceased.valid=1 AND procedures.deathCertificateStatus <> 'Complete' AND procedures.valid <> 0";
  //    out($sql);
    
    $list = $conn->query($sql);

    if ($list->num_rows == 0 ) {
        getOut("ALL CERTS COMPLETE");
    } 
    

    $listSorted = sortResult($list);


    $fields = array('age');
    foreach($sqlFields as $f) {
        $ff = explode(".",$f);
        if ($ff[1] == 'deceasedID') { 
            continue;
        }
    //    if($ff[1] == 'deathCertificateStatus') {
    //        continue;
    //    }
    
        if($f == 'circumstances.valid') {
            continue;
        }
        array_push($fields,$ff[1]);
        
        // print_r($list);
    }
    
    $more = ['Update Status'];
    $hidden =array('table'=>'procedures');
    
    showList($listSorted,$fields,$more,$hidden);
    
}


function out($msg) {
    echo "<H2>$msg</H2>";
}

function showAll($did) {
    $buttons=array('Update'=>'Update','Delete'=>'Delete');
    // DECEASED
    $row = selectOne('deceased',"deceasedID=$did");
    if (count($row) >  0) {
        out ("DECEASED");
        displayData($row);
        echo "<FORM ACTION='menu.php' METHOD='POST'>";
        buttRow($buttons);
        echo "<INPUT TYPE='HIDDEN' NAME='deceasedID' VALUE='$did'>";
        echo "<INPUT TYPE='HIDDEN' NAME='table' VALUE='deceased'>";
        echo "</FORM>";
        
        showNotes('deceasedNotes',$did);
    } else {
        getOut("NOBODY TO SHOW");
    }
    
    // CIRCUMSTANCES
    $row = selectOne('circumstances',"deceasedID=$did");
    if (count($row) > 0) {
        out("CIRCUMSTANCES");
        displayData($row);
        echo "<FORM ACTION='menu.php' METHOD='POST'>";
        buttRow($buttons);
        echo "<INPUT TYPE='HIDDEN' NAME='deceasedID' VALUE='$did'>";
        echo "<INPUT TYPE='HIDDEN' NAME='table' VALUE='circumstances'>";
        echo "</FORM>";
        
        showNotes('circumstancesNotes',$did);
    } else {
        global $circFields;
        echo "<FORM ACTION='add.php' METHOD='POST'>";
        collectInfo("ADD CIRCUMSTANCES", $circFields);
        buttRow($buttons);
        echo "<INPUT TYPE='HIDDEN' NAME='deceasedID' VALUE='$did'>";
        echo "<INPUT TYPE='HIDDEN' NAME='table' VALUE='circumstances'>";
        echo "</FORM>";

        
    }
    
    // PROCEDURES
    $row = selectOne('procedures',"deceasedID=$did");
    if (count($row) > 0) {
        out("PROCEDURES");
        displayData($row);
        echo "<FORM ACTION='menu.php' METHOD='POST'>";
        buttRow($buttons);
        echo "<INPUT TYPE='HIDDEN' NAME='deceasedID' VALUE='$did'>";
        echo "<INPUT TYPE='HIDDEN' NAME='table' VALUE='procedures'>";
        echo "</FORM>";
        
        showNotes('proceduresNotes',$did);
    } else {

        global $procFields;
        echo "<FORM ACTION='add.php' METHOD='POST'>";
        collectInfo("ADD PROCEDURES", $procFields);
        buttRow($buttons);
        echo "<INPUT TYPE='HIDDEN' NAME='deceasedID' VALUE='$did'>";
        echo "<INPUT TYPE='HIDDEN' NAME='table' VALUE='procedures'>";
        echo "</FORM>";
    }
    
    // CONTACTS
    $buttons['addPOC'] = "Add Another Contact";
    $result = selectMany('deceasedXPOC',"deceasedID=$did");
    if ($result->num_rows > 0) {
        out("POINTS OF CONTACT");
        while ($row = $result->fetch_assoc()  ) {
            $poc = selectOne('pointOfContact',"POCID=".$row['POCID']);
            if (count($poc) > 0 ) {
                displayData($poc);
                echo "<FORM ACTION='menu.php' METHOD='POST'>";
                buttRow($buttons);
                echo "<INPUT TYPE='HIDDEN' NAME='did' VALUE='$did'>";
                echo "<INPUT TYPE='HIDDEN' NAME='POCID' VALUE='".$row['POCID']."'>";
                echo "<INPUT TYPE='HIDDEN' NAME='table' VALUE='pointOfContact'>";
                echo "</FORM>";
                echo "<hr>";
            }
        }
    } else {
        out("NOBODY CONNECTED");
    }
    
}
// JUST SHOW ALL THE FIELDS IN A ROW
function displayData($row) {
    $keys = array_keys($row);
    echo "<div class='dispTable'><TABLE>";
    $i = 0;
    foreach ($keys as $key ) {
        // TWO COLUMNS
        if ($i % 2 == 0) {
            echo "<TR>";
        }
        
        $val = $row[$key];
        if (preg_match('/(\d{4})\-(\d{2})\-(\d{2})/',$val,$matches)) {
            $val=$matches[2].'/'.$matches[3].'/'.$matches[1];
        }
        
        if ($key == 'staffID') {
            $r = selectOne('staff',"staffID=".$row[$key]);
            if (array_key_exists('staffName',$r)) {
                $val = $r['staffName'];
            } else {
                $val = 'Unknown';
            }
        }
        
        echo "<TD>$key</TD><TD class='key'><span class='dispKey'>$val</span></TD>";
        
        if ($i % 2 == 1 ) {
            echo "</TR>";
        }
        $i++;
    }
    if ($i % 2 == 0) {
        echo "</TR>";
    }
    echo "</TABLE></div>";  
}


// DISPLAYS A LIST AND GIVE ACTION OPTIONS
function showList($list,$fields, $more,$hidden) {
    $ncols = count($fields);
    $morelength = count($more);
    $hiddenVals = ['deceasedID','POCID','data','deceasedNoteID','circumstancesNoteID','proceduresNoteID'];
    
    echo '<div class="disp"><table class="listClients">';
    
  //  print_r($list);

    // TABLE HEADER
    echo "<TR>";

    for ($i=0;$i<$ncols;$i++) {
        echo "<TH class='clientTH'>".$fields[$i]."</TH>";
    }
    for ($i=0;$i<$morelength;$i++) {
        echo "<TH class='clientTH'>".$more[$i]."</TH>";
    }
    echo "</TR>";

   
   $updates = array('status'=>'deceased','progress'=>'deceased','deathCertificateStatus'=>'procedures');
   
    foreach ($list as $row) {
        // output data of each row
        echo "<TR>";
        echo "<FORM ACTION='menu.php' METHOD='POST'>";
	
        for ($i=0;$i<$ncols;$i++) {
            
            $val = $row[$fields[$i]];
        
            if (preg_match('/(\d{4})\-(\d{2})\-(\d{2})/',$val,$matches)) {
         
                $val=$matches[2].'/'.$matches[3].'/'.$matches[1];
            }
            
           if (in_array($fields[$i],array_keys($updates))) {
               $valids = getValids($updates[$fields[$i]],$fields[$i]);
               
               $newval = "<SELECT NAME='".$fields[$i]."'>";
               foreach ($valids as $opt) {
                   $newval = $newval."<OPTION VALUE='$opt'";
                   if ($opt==$val) {
                       $newval = $newval." SELECTED";
                   }
                   $newval = $newval.">$opt</OPTION>";
                }
                $val = $newval."</SELECT>";
           }
            
            echo "<TD class='clientTD'>$val</TD>";
        }
        for ($i=0;$i<$morelength;$i++) {
            
            echo "<TD class='clientTD'>";
            buttonMe($more[$i],$more[$i]);
            echo "</TD>";
        }
        
        foreach ($hiddenVals as $hid) {
            if (array_key_exists($hid,$row)) {
                echo "<input type='hidden' name=$hid value='".$row[$hid]."'>";
            }
        }
        foreach ($hidden as $hid=>$hidVal) {
            echo "<input type='hidden' name=$hid value='$hidVal'>";
        }
        
        echo "</FORM></TR>";
    }

    echo '</table></div>';
}


// SORT DECEASED BY DEATH DATE  
function sortResult($result) {
    $deceased = array();
    for ($i=0; $i < $result->num_rows;$i++) {
    // output data of each row
        $row=$result->fetch_assoc();
        $key = $i;
        if (array_key_exists('deathday',$row)) {
            $key = $key.$row['deathday']; 
        } else {
            $key = $key.'0000-00-00';
        }
            
        if (array_key_exists('firstName',$row)) {
            $key = $key.substr($row['firstName'],0,1); 
        } else {
            $key = $key.'0';
        }
            
        if (array_key_exists('lastName',$row)) {
            $key = $key.substr($row['lastName'],0,1); 
        } else {
            $key = $key.'0';
        }

    
        // ADD age
        $row['age'] = '';
        if ((array_key_exists('deathday',$row)) and (array_key_exists('birthday',$row))) {
        
            $dd = $row['deathday'];
            $bd = $row['birthday'];
            $badDates = 0;
            if (($bd != '0000-00-00') and ($dd != '0000-00-00')) {
        
                try {
                    $bdate = date_create_from_format('Y-m-d',$bd);
                }   catch (Exception $e) {
                    $badDates++;
                    out("BAD BIRTHDAY");
                }
                
                try {
                    $ddate = date_create_from_format('Y-m-d',$dd);
                }   catch (Exception $e) {
                    $badDates++;
                    out("BAD DEATHDAY");
                }
            
                if ($badDates == 0) {
                    try {
                        $age = date_diff($ddate,$bdate)->format('%y');
                        $row['age'] = $age;
                    } catch (Exception $e) {
                        out("SUBTRACTION FAILED");
                    }
                } 
            } 
        } 
        $deceased[$key] = $row;
    }
    ksort($deceased);
    return($deceased);
}


?>
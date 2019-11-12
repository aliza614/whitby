<?php
// includes buttonMe, buttRow, updateRow, collectInfo, hide

// PRINT OUT HIDDEN INPUTS
function hide($arr) {
    foreach ($arr as $k=>$v) {
        echo "<INPUT TYPE='hidden' NAME='$k' VALUE='$v'>";
    }
}


// RUN THROUGH A LIST OF FIELDS AND GET INFO
function collectInfo($label,$fields) {
    out($label);
    echo "<table>";
       
    foreach ($fields as $key => $val ) {
        echo "<TR><TD><span class='emph'>".$val[0].":</span></TD><TD>";
        switch($val[1]) {
        case 'date':
            echo "<input type='".$val[1]."' name='$key' value=";            
            if($key == 'deathday') {
                echo date('Y-m-d');
            }
            echo ">";
            break;
        case 'number':
            echo "<input type='".$val[1]."' name='$key' ";
            if ($key == 'weight') {
                echo "min='1' max='1000'";
            }
            if ($key == 'deathCertificates') {
                echo "min='0' max='100'";
            }
            echo ">";
            break;
        case 'textarea':
            echo "<textarea name='$key' class='notes'></textarea>";
            break;
        case 'radio':
            foreach ($val[2] as $opt => $optVal) {
                echo "<input type='radio' name='$key' value='".$opt."'>".$optVal." ";
            }
            break;
        case 'select':
            echo "<select name='$key'>";
            // Start with a blank
            echo "<option value=''></option>";
            foreach ($val[2] as $opt) {
                echo "<option value='$opt'>$opt</option>";
            }
            echo "</select>";
            break;
            
        default:
            echo "<input type='".$val[1]."' name='$key'>";
            break;
        }
        echo "</TD></TR>";
    }
    echo '</table>';
}


function buttRow($buttons) {
    echo "<div class='buttRow'>";
    foreach ($buttons as $k=>$v) {
        buttonMe($k,$v);
    }
    echo "</div>";
    
}

function buttonMe ($buttVal,$buttDisp) {
    echo "<button type='submit' name='action' value='$buttVal' class='butt'>$buttDisp</button>";
}



// UPDATE A ROW
function updateRow($table,$key,$val) {
    $row=selectOne($table, "$key=$val");
    
    global $enum;
    global $notes;
    
    displayData($row);
        
    echo "<br /><hr /><br /><form action='update.php' method='POST'>";
    echo "<INPUT type='hidden' name='table' value='$table'>";
    echo "<TABLE>";
    foreach ($row as $k=>$v ) {
        switch($k) {
            case 'deceasedID':
                echo "<INPUT type='hidden' name='id' value='$v'>";
                echo "<INPUT type='hidden' name='idkey' value='$k'>";
                break;
            case 'deceasedNoteID':
                echo "<INPUT type='hidden' name='id' value='$v'>";
                echo "<INPUT type='hidden' name='idkey' value='$k'>";
                break;
            case 'POCID':
                echo "<INPUT type='hidden' name='id' value='$v'>";
                echo "<INPUT type='hidden' name='idkey' value='$k'>";
                break;
            case 'procedureID':
                echo "<INPUT type='hidden' name='$k' value='$v'>";
                break;
            case 'circumstanceID':
                echo "<INPUT type='hidden' name='$k' value='$v'>";
                break;
            case 'staffID':
                $results = selectMany('staff','staffID > 0');
                echo "<TR><TD>Staff</TD><TD>";
                echo "<select name=$k>";
                $blank = '';
                $selected = $blank;
                // FIRST ONE IS BLANK
                echo "<OPTION value=''>$blank</OPTION>";
                
                while ($r = $results->fetch_assoc()) {
                    echo "<OPTION VALUE=".$r['staffID'];
                    if (intval($r['staffID']) == intval($v)) {
                        echo ' selected';
                    }
                    echo '>'.$r['staffName']."</OPTION>";
                }
                echo "</select>";
                break;
            default:
                echo "<TR><TD>$k</TD><TD>";
                if (in_array($k,$enum)) {
                    $vals = getValids($table,$k);
                    echo "<select name=$k>";
                    $blank = '';
                    $selected = $blank;
                    if (count(trim($v)) > 0) {
                        $selected = $v;
                    }
                    // FIRST ONE IS BLANK
                    echo "<OPTION value=''>$blank</OPTION>";
                    foreach ($vals as $vvv) {
                        echo "<OPTION value='".$vvv."'";
                        if ($vvv == $selected) { echo "selected"; }
                            echo ">$vvv</OPTION>";
                        }
                    echo "</select>";
                } else {
                    $type = 'text';
                    if (in_array($k,$notes)) {
                        echo "<textarea class='note' name=$k>";
                        echo $v;
                        echo "</textarea>";
                    }  else {
                        echo "<input type='$type' name='$k' value='$v'>";
                    }
                }
        }
        echo "</TD></TR>";
        
    }
    echo "</TABLE>";
    $buttons=array('UPDATE'=>'Update','CANCEL'=>'Cancel');
    buttRow($buttons);
    echo "</form>";
    

}
?>
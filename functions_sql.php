<?php


// ((((((((((((((  SQL FUNCTIONS ))))))))))))))))

// includes getValids, selectOne, selectMany, getLastID, getDid

// GET VALIDS FOR ENUMERATED FIELDS
function getValids($table, $field) {
    global $conn;
    $valids=array();
    $sql = "SHOW COLUMNS FROM $table WHERE Field='$field'";
    $ret = $conn->query($sql)->fetch_assoc();
    if (count($ret) > 0) {
        $types = $ret['Type'];
        preg_match("/^enum\(\'(.*)\'\)$/",$types,$matches);
        $valids = explode("','",$matches[1]);
    } else {
        getOut($conn,"NO VALIDS FOUND $sql");
    }
    return($valids); 
}

function selectOne($table,$term) {
    global $conn;
    $row = array();
    $sql = "SELECT * FROM $table WHERE valid=1 AND $term";
    $result = $conn->query($sql);
    if ($result->num_rows > 1 ) {
        out("TOO MANY ROWS");
        getOut($sql);
    }
    if ($result->num_rows == 1 ) {
        $row = $result->fetch_assoc();
    }
    return($row);
}


function selectMany($table,$term) {
    global $conn;
    $row = array();
    $sql = "SELECT * FROM $table WHERE valid=1 AND $term";
    if ( $result = $conn->query($sql) ) {
        return($result);
    } else {
        out ($sql);
        getOut("SQL FAILED");
    }
}

function getLastID() {
    global $conn;
    $dido = $conn->query("SELECT LAST_INSERT_ID()")->fetch_assoc();
    $didox = array_values($dido);
           // print_r($didox);
    return( $didox[0] );
}


// GET did 
function getDid($decvals,$repeat) {
    
    
    $did = 0;
    $checkMe=[];
    global $deceasedFields;
    global $dupCheckFields;
    global $conn;
    global $numerical;
    $cols = array('progress','valid');
    $vals = array("'start'",1);
    
    foreach (array_keys($deceasedFields) as $dcf) {
        if (array_key_exists($dcf,$decvals)) {
            $val = $decvals[$dcf];
            if (strlen($val) > 0) {
                array_push($cols,$dcf);
                if (in_array($dcf,$numerical)) {
                    array_push($vals,$val);   
                } else {
                    array_push($vals,"'".$val."'");
                }
                if (in_array($dcf,$dupCheckFields)) {
                    array_push($checkMe,$dcf);
                }
            }
        }
    }


// CHECK FOR POSSIBLE DUPLICATES

    $sql = "SELECT * FROM deceased WHERE valid=1 AND (";
    $nCheck = count($checkMe);
    if ( $nCheck > 0 ) {
        $i = 1;
        foreach ($checkMe as $dcf) {
            $sql = $sql."UPPER(".$dcf.")='".strtoupper($decvals[$dcf])."'";
            if ($i < $nCheck ) {
                $sql = $sql." OR ";
            }
            $i++;
        }
    }
    $sql = $sql.")";

    $dups = $conn->query($sql);
    if (($dups->num_rows > 0) and ($repeat)) {
    
        echo "<h2>You Entered:</h2>";
        displayData($decvals);
    
        echo "<h2>Possible Duplicates</h2>";
        showList($dups,$dupCheckFields,["More","Update"],array('table'=>'deceased'));
    
        // out("Not a duplicate --- Continue");
        // PUT ALL THE DATA IN A HIDDEN JSON STRING -  WE MIGHT NEED THIS
        $decvalJSON = htmlentities(json_encode($decvals));
        $hidden = array();
        $hidden['data']=$decvalJSON;
        echo '<form method="POST" action="hospice.php">';
        echo "<INPUT TYPE='HIDDEN' NAME='data' VALUE='$decvalJSON'>";
        $buttons = array('nodup'=>'Not a Duplicate. Continue.');
        buttRow($buttons);
        echo '</form>';
    } else {
    
        if (count($cols) > 2 ) {
            $sql = "INSERT INTO deceased (".join(',',$cols).") VALUES (".join(',',$vals).")";
         //   out($sql);
            $conn->query($sql);
            $did = getLastID();
        } else {
            getOut($conn,"Not Enough Data");
        }

    }
    
    return($did);
}
?>
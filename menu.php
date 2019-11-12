<?php

$action = 'NOTHING';

if(in_array('action',array_keys($_POST))) {
    $action = $_POST['action']; 
   // out("I Got Action $action");
} else {
    print_r(array_keys($_POST));
    getOut('NO ACTION!');
}

include 'functions.php';
headMe("Activity Page");

global $conn;


switch ($action) {
    case 'LIST':
        $active = 1;
        getActiveClients($active);
        break;
    case 'DCREPORT':
        dcReport();
        break;
    case 'HOSPICE':
        hospiceCall();
        break;
    case 'NEW':
        newClient();
        break;
    case 'ALL':
        $active = 0;
        getActiveClients($active);
        break;
    case 'STAFF':
        listStaff();
        break;
    case 'CLIENT':
        out($action);
        break;
    case 'CONTACT':
        out($action);
        break;
    case 'More':
        if(in_array('deceasedID',array_keys($_POST))) {
            $did = $_POST['deceasedID']; 
            showAll($did);
        } else {
            print_r(array_keys($_POST));
            getOut('NO DID!');
        }
        break; 
    case 'Delete':
        $id= 0;
        $table = 0;
        $idkey = 'deceasedID';
        if(in_array('deceasedID',array_keys($_POST))) {
            $id = $_POST['deceasedID']; 
        }
        if(in_array('POCID',array_keys($_POST))) {
            $id = $_POST['POCID'];
            $idkey = 'POCID';
        }
        if(in_array('table',array_keys($_POST))) {
            $table = $_POST['table']; 
        } else {
            getOut("NO TABLE");
        }
        
        
        if ($id) {
            $row = selectOne($table,"$idkey=$id");
            displayData($row);
            
            $buttons=array('YES'=>'Yes','UPDATE'=>'Update Instead','CANCEL'=>'Cancel');

            out("Really Delete?");
            echo "<FORM ACTION='delete.php' METHOD='POST'>";
            
            buttRow($buttons);
            $hidden = array('table'=>$table,'idkey'=>$idkey,'id'=>$id);
            foreach($hidden as $hid=>$val ) {
                echo "<INPUT TYPE='hidden' NAME='$hid' VALUE='$val'>";
            }
            echo "</FORM>";
            
        } else {
            print_r(array_keys($_POST));
            getOut('NO DID OR PID!');
        }


        break;
    case 'Update Status':
       // print_r($_POST);
        $stat = 0;
        $table = '';
        if (array_key_exists('table',$_POST)) {
            $table = $_POST['table'];
        } else {
            getOut("NO TABLE TO TALK TO");
        }
        
        $sql = "UPDATE $table SET ";
        if (array_key_exists('status',$_POST)) {
            $sql=$sql."status='".$_POST['status']."'";
            $stat=1;
        }
        if (array_key_exists('progress',$_POST)) {
            if ($stat) {
                $sql = $sql.',';
            }
            $sql=$sql."progress='".$_POST['progress']."'";
            $stat=1;
        }
        if (array_key_exists('deathCertificateStatus',$_POST)) {
            if ($stat) {
                $sql = $sql.',';
            }
            $sql=$sql."deathCertificateStatus='".$_POST['deathCertificateStatus']."'";
            $stat=1;
        }
        
        
        if ($stat) {
            $sql = $sql."WHERE deceasedID=".$_POST['deceasedID'];
            if ($conn->query($sql)) {
                $active=1;
                getActiveClients($active);
            } else {
                getOut("UPDATE TROUBLE ".$sql);
            }
        } else {
            print_r($_POST);
            getOut("NOTHING TO UPDATE");
        }
        break;
    
    case 'Update':
        $table = 0;
        if(in_array('table',array_keys($_POST))) {
            $table = $_POST['table']; 
        } else {
            getOut("NO TABLE");
        }
        $id= 0;
        $idkey = 'deceasedID';
        if(in_array('deceasedID',array_keys($_POST))) {
            $id = $_POST['deceasedID']; 
        }
        if(in_array('POCID',array_keys($_POST))) {
            $id = $_POST['POCID'];
            $idkey = 'POCID';
        }
        updateRow($table,$idkey, $id);
        break;
        
    case 'addPOC':
        if(in_array('did',array_keys($_POST))) {
            addPOC($_POST['did']);
        } else {
            getOut("NO DID TO ADD TO");
        }
        break;
        
    case 'newNote':
        $note = '';
        if(in_array('deceasedID',array_keys($_POST))) {
            $id = $_POST['deceasedID']; 
        } else {
            getOut("NO DID FOR NOTE");
        }
        if (array_key_exists('note',$_POST)) {
            $note = trim(mysqli_real_escape_string($conn,$_POST['note']));
        } else {
            getOut("NO NOTE FOR DID");
        }
        if (array_key_exists('table',$_POST)) {
            $table = trim(mysqli_real_escape_string($conn,$_POST['table']));
        } else {
            getOut("NO TABLE FOR NOTE");
        }
        

        if (strlen($note) > 0) {
            $sql = "INSERT INTO $table (note, valid) VALUES ('$note',1)";
            $conn->query($sql);
            $nid = getLastId();
            switch ($table) {
                case 'deceasedNotes':
                    $xTable = 'deceasedXdeceasedNotes';
                    $xid = 'deceasedNoteID';
                    break;
                case 'circumstancesNotes':
                    $xTable = 'deceasedXcircumstancesNotes';
                    $xid = 'circumstancesNoteID';
                    break;
                case 'proceduresNotes':
                    $xTable = 'deceasedXproceduresNotes';
                    $xid = 'proceduresNoteID';
                    break;
                default:
                    getOut("NO RECOGNIZED XTable");
            }
            
            $sql = "INSERT INTO $xTable ($xid,deceasedID,valid) VALUES ($nid,$id,1)";
            out($sql);
            $conn->query($sql);
        } 
        
        showAll($id);
        
        break;
        
    case 'Delete Note':
        $nid = 0;
        if (array_key_exists('table',$_POST)) {
            $table = trim(mysqli_real_escape_string($conn,$_POST['table']));
        } else {
            getOut("NO TABLE FOR NOTE");
        }

        $ids = ['deceasedNoteID','circumstancesNoteID','proceduresNoteID'];
        foreach($ids as $idName) {
            
            if (array_key_exists($idName,$_POST)) {
                $nid = $_POST[$idName];
                $nidName = $idName;
            }
        }
        $xTable = array('deceasedNoteID' => 'deceasedXdeceasedNotes','circumstancesNoteID' => 'deceasedXcircumstancesNotes','proceduresNoteID' => 'deceasedXproceduresNotes');
        if ($nid > 0) {
        
            $sql = "UPDATE ".$xTable[$nidName]." SET valid=0 WHERE $nidName=$nid";
            $conn->query($sql);
            $sql = "UPDATE $table SET valid=0 WHERE $nidName=$nid";
            $conn->query($sql);
            if (array_key_exists('deceasedID',$_POST)) {
                $did = $_POST['deceasedID'];
                showAll($did);
            } else {
                $active=1;
                getActiveClients($active);
            }
                
        } else {
            print_r($_POST);
            getOut("NO NID FOUND");
        }
        break;
        
                
    case 'Update Note':
        if (array_key_exists('deceasedNoteID',$_POST)) {
            $nid = $_POST['deceasedNoteID'];
            updateRow('deceasedNotes','deceasedNoteID', $nid);
        } else {
            print_r($_POST);
            getOut("NO NID FOUND");
        }
        break;
        
    case 'Cancel':
        $active = 1;
        getActiveClients($active);
        break;
        
    default:
        print_r($_POST);
        getOut("Weird Menu Option");
}

tailMe();
?>
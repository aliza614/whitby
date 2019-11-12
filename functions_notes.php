<?php
// NOTES FUNCTIONS
// includes showNotes, addNote

function showNotes($table,$id) {
    global $conn;
    switch($table) {
        case 'deceasedNotes':
            $xTable = 'deceasedXdeceasedNotes';
            $idName = 'deceasedNoteID';
            break;
        case 'circumstancesNotes':
            $xTable = 'deceasedXcircumstancesNotes';
            $idName = 'circumstancesNoteID';
            break;
        case 'proceduresNotes':
            $xTable = 'deceasedXproceduresNotes';
            $idName = 'proceduresNoteID';
            break;
        default:
            getOut("NO KNOWN TABLE $table");        
    }
    
    $sql = "SELECT * FROM $xTable WHERE valid=1 AND deceasedID=$id"; 
            // out($sql);
    $results = $conn->query($sql);
    if ($results->num_rows > 0) {
        $noteFields = ['updateTime','note'];
        $more = ['Update Note','Delete Note'];
        $hidden=array('deceasedID'=>$id,'table'=>$table);
        $notes=array();
        $i=0;
        while($row=$results->fetch_assoc()) {
            $tF =  "date_format(updateTime, '%W %m/%d/%Y %l:%i %p')";
            $sql = "SELECT $tF,note FROM $table WHERE valid=1 AND $idName=".$row[$idName];
            $note=$conn->query($sql)->fetch_assoc();
            $nArr = array();
            $nArr['updateTime'] = $note[$tF];
            $nArr['note'] = $note['note'];
            $nArr[$idName] = $row[$idName];
            $notes[$i] = $nArr;
            $i++;
        }
        
        showList($notes,$noteFields,$more,$hidden);
    } 
    
    addNote($table,$id);
}

function addNote($table,$id) {
    
    $noteFields = array('note'=>[$table,'textarea']);
    echo "<FORM action='menu.php' method='POST'>";
    echo "<INPUT TYPE='hidden' NAME='action' VALUE='newNote'>";
    echo "<INPUT TYPE='hidden' NAME='deceasedID' VALUE='$id'>";
    echo "<INPUT TYPE='hidden' NAME='table' VALUE='$table'>";
                
    collectInfo("Add a New $table",$noteFields);
    $buttons = array('newNote'=>'Submit','Cancel'=>'Cancel');
    buttRow($buttons);
    echo "</FORM>";
}



?>
<?php
// includes addPOC, showPOC


// (((((((((((((   POC FUNCTIONS )))))))))))))))))))))))

function addPOC($did) {
    global $pocFields;
    echo "<form action='add.php' method='POST'>";
    collectInfo("Point of Contact",$pocFields);
    echo "<INPUT TYPE='hidden' NAME='did' VALUE='$did'>";
    echo "<INPUT TYPE='hidden' NAME='table' VALUE='pointOfContact'>";
    $buttons = array('POCAdd'=>'Add This Contact','Cancel'=>'Cancel');
    buttRow($buttons);
    echo "</form>";
}

function showPOC() {
    getOut("showPOC NOT DONE YET");
}
?>
<?php
// INCLUDES headMe,tailMe, dbConnect, menu, getOut, fillGlobals, goToDrive

// (((((((((((((((( SET UP FUNCTIONS  )))))))))))))))))))))))

function headMe($h1) {
    global $title;
    global $logo;
    global $icon;
    
    echo "<!doctype html><html  lang='en'>";
    echo "<head><meta http-equiv='Content-Type' content='text/html; charset=us-ascii'>";
    echo "<title>$title</title>";
    echo '<link rel="stylesheet" href="css/styles.css">';
    echo "<link rel='icon' href='$icon' sizes='32x32' /></head>";
    
    echo "<div class='header'>";
    echo "<body><img src='$logo' class='logo'>";
    echo "<h1>$h1</h1>";
    echo "</div>";
    
    // SIDEBAR
    echo "<div class='sidebar'>";
    menu();
    echo "</div>";
    
    // MAIN
    echo "<div class='main'>";
    
    
    dbConnect();
    fillGlobals();
    
}

function fillGlobals(){
    global $conn;
    global $pocFields;
    $NOKchoices = getValids('pointOfContact','POCNextOfKin');
    global $pocFields;
    $pocFields['POCNextOfKin'] = ['Next of Kin?','select',$NOKchoices];
    
    global $deceasedFields;
    $sex = getValids('deceased','sex');
    $deceasedFields['sex'] = ['Sex','select',$sex];
    
    $fdType = getValids('procedures','finalDisposition');
    $fdStat = getValids('procedures','dispositionStatus');
    $crem = getValids('procedures','cremains');
    $per = getValids('procedures','permit');
    $edrStat = getValids('procedures','EDRStatus');
    $dcStat = getValids('procedures','deathCertificateStatus');
    
    global $fdFields;
    global $dcFields;
    global $edrFields;
    
    $fdFields['finalDisposition'] = ['Final Disposition','select',$fdType];
    $fdFields['dispositionStatus'] = ['Final Disposition Status','select',$fdStat];
    $fdFields['cremains'] = ['Cremains','select',$crem];
    $fdFields['permit'] = ['Permit','select',$per];
    $edrFields['EDRStatus'] = ['EDR Status','select',$edrStat];
    $dcFields['deathCertificateStatus'] = ['Death Certificate Status','select',$dcStat];
    
}

function dbConnect(){
    global $servername, $username, $password, $dbname;
    global $conn;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    mysqli_set_charset($conn, "utf8");
}

function tailMe() {
    echo "</div>"; // main
    echo "</BODY></HTML>";
    global $conn;
    $conn->close();
}

function menu() {
    out("TASKS");
    
    $tasks = array( 'LIST'=>'List Active Clients', 'DCREPORT' => 'Death Certificate Report', 'HOSPICE' => 'Hospice Call', 'NEW' => 'New Client', 'ALL' => 'List All Clients','STAFF' => 'List Staff' );
    $searchTasks = array( 'CLIENT'=>'Search Clients', 'CONTACT'=>'Search Contacts' );
    
    echo "<FORM action='menu.php' method='POST'>";
    
    foreach ($tasks as $t=>$v) {
        buttonMe($t,$v);
        echo '<hr>';
    }
    echo '<br/>Client Search: <input type="textbox" name="searchName"> any part of the name<br/>';
    
    foreach ($searchTasks as $t=>$v) {
         buttonMe($t,$v).'<br/>';
    }
    
    echo "</FORM>";
    global $driveLink;
    echo "<a href='$driveLink' target='_blank'><button class='butt'>Go to DRIVE</button></a>";
    
}



    
// DIE QUICKLY
function getOut($msg) {
    echo "<h2 class='topper'>You are in the wrong place, my friend. You better leave.</h2>";
    echo "<h2>$msg</h2>";
    tailMe();
    exit();
}
?>




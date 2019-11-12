<?php


// SETUP
$title='WHITBY';
$icon = 'https://www.thenaturalfuneral.com/wp-content/uploads/2018/01/cropped-leafOnlyIcon-32x32.png';
$logo = "https://www.thenaturalfuneral.com/wp-content/uploads/2018/03/TNF_2LineLogo_Final_TM.jpg";


// DATABASE
$servername = "localhost";
$username = "tnf_admin";
$password = "tnfTeam7yaya";
$dbname = "tnf_whitby";
$conn;

$driveLink="";


$enum = ['sex','progress','status','expected','POCNextOfKin','EDRStatus','finalDisposition','deathCertificateStatus','cremains','dispositionStatus','permit'];
$notes = ['deceasedNotes','hospiceNotes','accessNotes','circumstancesNotes','POCnotes','finalDispositionNotes','EDRNotes','deathCertificateNotes','cremainsNotes','permitNotes','TNFProcedureNotes'];
$numerical = ['weight','valid','firstContact','deathCertificates','staffID'];

$pocFields = array('POCFirstName'=>['Point of Contact First Name','text'],'POCLastName'=>['Point of Contact Last Name','text'],'POCemail'=>['Point of Contact email','email'],'POCphone'=>['Point of Contact Phone','tel'],'POCrelation'=>['Point of Contact Relationship','text'],
        'POCNextOfKin'=>[],'POCnotes'=>['Point of Contact Notes','textarea']);

$hospiceFields=array('hospiceName'=>['Hospice Name','text'],'hospiceContact'=>['Name of Hospice Contact'],'hospicePhone'=>['Hospice Contact Phone','tel'],'hospiceEmail'=>['Hospice Email','email'],'hospiceNotes'=>['Hospice Notes','textarea']);

$circFields = array('countyOfDeath'=>["County of Death",'text'],'signingPhysician'=>['Signing Physician','text'], 'placeOfDeath'=>['Place of Death','text'],'addressOfDeath' => ['Address of Death','textArea'],'accessNotes'=>['Access Notes','textArea'], 'circumstancesNotes' =>['Circumstances Notes','textarea'], 'bodyLocation'=>['Location of the Body Now','text']);

$deceasedFields = array ('firstName'=>['First Name','text'], 'middleName'=>['Middle Name','text'],'lastName'=>['Last Name','text'],'birthday'=>['Birthdate','date'],'deathday'=>['Date of Death','date'],'SSN'=>['Social Security Number','text'],'sex'=>[],'weight'=>['Weight','number'],'deceasedNotes'=>['General Notes','textarea']);


 
$edrFields=array('EDRStatus'=>['EDR Status','select',$edrStat],'EDRNotes'=>['EDR Notes','textarea']);

$fdFields=array('finalDisposition'=>['Final Disposition','select',$fdType],'finalDispositionNotes'=>['Final Disposition Notes','textarea'],'cremains'=>['Cremains','select',$crem],'cremainsNotes'=>['Cremains Notes','textarea'],'permit'=>['Permit','select',$per],'permitNotes'=>['Permit Notes','textarea'],'TNFProcedureNotes'=>['TNF Procedure Notes','textarea']);
    

$dcFields=array('deathCertificateStatus'=>['Death Certificate Status','select',$dcStat],'deathCertificates'=>['Death Certificates Requested','number'],'deathCertificateNotes'=>['Death Certificates Notes','textarea']);
    



$dupCheckFields = ['firstName','middleName','lastName','birthday','deathday'];
     
?>
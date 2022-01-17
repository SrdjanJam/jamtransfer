<?
header('Content-Type: text/javascript; charset=UTF-8');
error_reporting(E_PARSE);
 
	# init libs
	require_once '../../../../db/db.class.php';
	require_once '../../../../db/v4_AuthUsers.class.php';
#doc
#	classname:	v4_AuthUsersNoImage
#	scope:		PUBLIC
#
#/doc



############################################################
#			              NAPOMENA 26-07-2018 Leo
############################################################
#Polje Balance je zapravo Deposit koji se povlaci u Expenses
#kada se vozac logira i vidi stanje racuna
#polog se unosu u usersList.Driver fileu
############################################################

class v4_AuthUsersNoImage extends v4_AuthUsers
{
	#	internal variables

	#	Constructor
	public function saveRowNoImage(){

		$result = $this->connection->RunQuery("UPDATE v4_AuthUsers set 
		AuthLevelID = \"$this->AuthLevelID\", 
		DateAdded = \"$this->DateAdded\", 
		LastVisited = \"$this->LastVisited\", 
		AuthUserName = \"$this->AuthUserName\", 
		AuthUserPass = \"$this->AuthUserPass\", 
		AuthUserRealName = \"$this->AuthUserRealName\", 
		Image = \"$this->Image\", 
		AuthUserMail = \"$this->AuthUserMail\", 
		AuthUserNote = \"$this->AuthUserNote\", 
		AuthUserTel = \"$this->AuthUserTel\", 
		AuthUserMob = \"$this->AuthUserMob\", 
		AuthUserFax = \"$this->AuthUserFax\", 
		AuthUserCompany = \"$this->AuthUserCompany\", 
		DriverID = \"$this->DriverID\", 
		AuthCoAddress = \"$this->AuthCoAddress\", 
		Provision = \"$this->Provision\", 
		AuthUserCompanyMB = \"$this->AuthUserCompanyMB\", 
		AuthUserCompanyWeb = \"$this->AuthUserCompanyWeb\", 
		AuthUserCoDesc = \"$this->AuthUserCoDesc\", 
		AuthUserFacebook = \"$this->AuthUserFacebook\", 
		AuthUserTwitter = \"$this->AuthUserTwitter\", 
		AuthUserLinkedIn = \"$this->AuthUserLinkedIn\", 
		AuthUserGooglePlus = \"$this->AuthUserGooglePlus\", 
		
		Temp_pass = \"$this->Temp_pass\", 
		Temp_pass_active = \"$this->Temp_pass_active\", 
		
		Active = \"$this->Active\", 
		Level_access = \"$this->Level_access\", 
		Random_key = \"$this->Random_key\", 
		ContractFile = \"$this->ContractFile\", 
		ContractDate = \"$this->ContractDate\", 
		ContractSignature = \"$this->ContractSignature\", 
		DBImageType = \"$this->DBImageType\", 
		Language = \"$this->Language\", 
		
		Country = \"$this->Country\", 
		IBAN = \"$this->IBAN\",
		SWIFT = \"$this->SWIFT\",
		AccountOwner = \"$this->AccountOwner\",
		AccountBank = \"$this->AccountBank\", 
		City = \"$this->City\",
		Terminal = \"$this->Terminal\",  
		ReturnDiscount = \"$this->ReturnDiscount\",
		AcceptedPayment = \"$this->AcceptedPayment\",
		
		R1Low 		=  \"$this->R1Low\",
		R1Hi  		=  \"$this->R1Hi\",
		R1Percent 	=  \"$this->R1Percent\",
		
		R2Low 		=  \"$this->R2Low\",
		R2Hi  		=  \"$this->R2Hi\",
		R2Percent 	=  \"$this->R2Percent\",
		
		R3Low 		=  \"$this->R3Low\",
		R3Hi  		=  \"$this->R3Hi\",
		R3Percent 	=  \"$this->R3Percent\"
        
		NoteToDriver  		=  \"$this->NoteToDriver\",
		Balance 	=  \"$this->Balance\"
		
		where AuthUserID = \"$this->AuthUserID\"");
	return $result; 
}
	###

}
###

	# init class
	$db = new v4_AuthUsersNoImage();

# init vars
$keyName = '';
$keyValue = '';

if (isset($_REQUEST['keyName']) and $_REQUEST['keyName'] != '') 	$keyName = $_REQUEST['keyName'];
if (isset($_REQUEST['keyValue']) and $_REQUEST['keyValue'] != '') 	$keyValue = $_REQUEST['keyValue'];

$fldList = array();
$out = array();

# if Update - get the row by keyValue
if ($keyName != '' and $keyValue != '') $db->getRow($keyValue);


	if(isset($_REQUEST['AuthUserID'])) { $db->setAuthUserID($db->myreal_escape_string($_REQUEST['AuthUserID']) ); } 

		 	
	if(isset($_REQUEST['AuthLevelID'])) { $db->setAuthLevelID($db->myreal_escape_string($_REQUEST['AuthLevelID']) ); } 

		 	
	if(isset($_REQUEST['Terminal'])) { $db->setTerminal($db->myreal_escape_string($_REQUEST['Terminal']) ); } 

		 	
	if(isset($_REQUEST['Country'])) { $db->setCountry($db->myreal_escape_string($_REQUEST['Country']) ); } 

		 	
	if(isset($_REQUEST['ReturnDiscount'])) { $db->setReturnDiscount($db->myreal_escape_string($_REQUEST['ReturnDiscount']) ); } 

		 	
	if(isset($_REQUEST['Provision'])) { $db->setProvision($db->myreal_escape_string($_REQUEST['Provision']) ); } 

		 	
	if(isset($_REQUEST['AuthUserRealName'])) { $db->setAuthUserRealName($db->myreal_escape_string($_REQUEST['AuthUserRealName']) ); } 

		 	
	if(isset($_REQUEST['AuthUserName'])) { $db->setAuthUserName($db->myreal_escape_string($_REQUEST['AuthUserName']) ); } 

		 	
	if(isset($_REQUEST['AuthUserCompany'])) { $db->setAuthUserCompany($db->myreal_escape_string($_REQUEST['AuthUserCompany']) ); } 

		 	
	if(isset($_REQUEST['DriverID'])) { $db->setDriverID($db->myreal_escape_string($_REQUEST['DriverID']) ); } 

		 	
	if(isset($_REQUEST['BrandName'])) { $db->setBrandName($db->myreal_escape_string($_REQUEST['BrandName']) ); } 

		 	
	if(isset($_REQUEST['ContactPerson'])) { $db->setContactPerson($db->myreal_escape_string($_REQUEST['ContactPerson']) ); } 

		 	
	if(isset($_REQUEST['AuthUserCompanyMB'])) { $db->setAuthUserCompanyMB($db->myreal_escape_string($_REQUEST['AuthUserCompanyMB']) ); } 

		 	
	if(isset($_REQUEST['AuthCoAddress'])) { $db->setAuthCoAddress($db->myreal_escape_string(nl2br($_REQUEST['AuthCoAddress']),false) ); } 

		 	
	if(isset($_REQUEST['City'])) { $db->setCity($db->myreal_escape_string($_REQUEST['City']) ); } 

		 	
	if(isset($_REQUEST['Zip'])) { $db->setZip($db->myreal_escape_string($_REQUEST['Zip']) ); } 

		 	
	if(isset($_REQUEST['CountryName'])) { $db->setCountryName($db->myreal_escape_string($_REQUEST['CountryName']) ); } 

		 	
	if(isset($_REQUEST['CountryID'])) { $db->setCountryID($db->myreal_escape_string($_REQUEST['CountryID']) ); } 

		 	
	if(isset($_REQUEST['AuthUserTel'])) { $db->setAuthUserTel($db->myreal_escape_string($_REQUEST['AuthUserTel']) ); } 

		 	
	if(isset($_REQUEST['AuthUserMob'])) { $db->setAuthUserMob($db->myreal_escape_string($_REQUEST['AuthUserMob']) ); } 

		 	
	if(isset($_REQUEST['EmergencyPhone'])) { $db->setEmergencyPhone($db->myreal_escape_string($_REQUEST['EmergencyPhone']) ); } 

		 	
	if(isset($_REQUEST['AuthUserFax'])) { $db->setAuthUserFax($db->myreal_escape_string($_REQUEST['AuthUserFax']) ); } 

		 	
	if(isset($_REQUEST['AuthUserMail'])) { $db->setAuthUserMail($db->myreal_escape_string($_REQUEST['AuthUserMail']) ); } 
	
	
	if(isset($_REQUEST['AuthUserNote1'])) { $db->setAuthUserNote1($db->myreal_escape_string(nl2br($_REQUEST['AuthUserNote1']),false) ); } 
	
	
	if(isset($_REQUEST['AuthUserCoDesc'])) { $db->setAuthUserCoDesc($db->myreal_escape_string($_REQUEST['AuthUserCoDesc']) ); } 

		 	
	if(isset($_REQUEST['AuthUserNote'])) { $db->setAuthUserNote($db->myreal_escape_string(nl2br($_REQUEST['AuthUserNote']),false) ); } 

		 	
	if(isset($_REQUEST['AccountBank'])) { $db->setAccountBank($db->myreal_escape_string($_REQUEST['AccountBank']) ); } 

		 	
	if(isset($_REQUEST['AccountOwner'])) { $db->setAccountOwner($db->myreal_escape_string($_REQUEST['AccountOwner']) ); } 

		 	
	if(isset($_REQUEST['SWIFT'])) { $db->setSWIFT($db->myreal_escape_string($_REQUEST['SWIFT']) ); } 

		 	
	if(isset($_REQUEST['IBAN'])) { $db->setIBAN($db->myreal_escape_string($_REQUEST['IBAN']) ); } 

		 	
	if(isset($_REQUEST['AuthUserPassNew']) and $_REQUEST['AuthUserPassNew'] != '') { 
		$db->setAuthUserPass( md5($_REQUEST['AuthUserPassNew']) ); 
	} 

		 	
	if(isset($_REQUEST['AuthUserCompanyWeb'])) { $db->setAuthUserCompanyWeb($db->myreal_escape_string($_REQUEST['AuthUserCompanyWeb']) ); } 

		 	
	if(isset($_REQUEST['AuthUserFacebook'])) { $db->setAuthUserFacebook($db->myreal_escape_string($_REQUEST['AuthUserFacebook']) ); } 

		 	
	if(isset($_REQUEST['AuthUserTwitter'])) { $db->setAuthUserTwitter($db->myreal_escape_string($_REQUEST['AuthUserTwitter']) ); } 

		 	
	if(isset($_REQUEST['AuthUserLinkedIn'])) { $db->setAuthUserLinkedIn($db->myreal_escape_string($_REQUEST['AuthUserLinkedIn']) ); } 

		 	
	if(isset($_REQUEST['AuthUserGooglePlus'])) { $db->setAuthUserGooglePlus($db->myreal_escape_string($_REQUEST['AuthUserGooglePlus']) ); } 

		 	
	if(isset($_REQUEST['DateAdded'])) { $db->setDateAdded($db->myreal_escape_string($_REQUEST['DateAdded']) ); } 

		 	
	if(isset($_REQUEST['LastVisited'])) { $db->setLastVisited($db->myreal_escape_string($_REQUEST['LastVisited']) ); } 

		 	
	if(isset($_REQUEST['Image'])) { $db->setImage($db->myreal_escape_string($_REQUEST['Image']) ); } 

		 	
	if(isset($_REQUEST['Temp_pass'])) { $db->setTemp_pass($db->myreal_escape_string($_REQUEST['Temp_pass']) ); } 

		 	
	if(isset($_REQUEST['Temp_pass_active'])) { $db->setTemp_pass_active($db->myreal_escape_string($_REQUEST['Temp_pass_active']) ); } 

		 	
	if(isset($_REQUEST['Level_access'])) { $db->setLevel_access($db->myreal_escape_string($_REQUEST['Level_access']) ); } 

		 	
	if(isset($_REQUEST['Random_key'])) { $db->setRandom_key($db->myreal_escape_string($_REQUEST['Random_key']) ); } 

		 	
	if(isset($_REQUEST['ContractFile'])) { $db->setContractFile($db->myreal_escape_string($_REQUEST['ContractFile']) ); } 

		 	
	if(isset($_REQUEST['ContractDate'])) { $db->setContractDate($db->myreal_escape_string($_REQUEST['ContractDate']) ); } 

		 	
	if(isset($_REQUEST['ContractSignature'])) { $db->setContractSignature($db->myreal_escape_string($_REQUEST['ContractSignature']) ); } 

/*		 	
	if(isset($_REQUEST['DBImage'])) { $db->setDBImage($db->myreal_escape_string($_REQUEST['DBImage']) ); } 

		 	
	if(isset($_REQUEST['DBImageType'])) { $db->setDBImageType($db->myreal_escape_string($_REQUEST['DBImageType']) ); } 
*/
		 	
	if(isset($_REQUEST['Language'])) { $db->setLanguage($db->myreal_escape_string($_REQUEST['Language']) ); } 

		 	
	if(isset($_REQUEST['Active'])) { $db->setActive($db->myreal_escape_string($_REQUEST['Active']) ); } 

	if(isset($_REQUEST['AcceptedPayment'])) { $db->setAcceptedPayment($db->myreal_escape_string($_REQUEST['AcceptedPayment']) ); } 	

		 	
	if(isset($_REQUEST['R1Low'])) { $db->setR1Low($db->myreal_escape_string($_REQUEST['R1Low']) ); } 

		 	
	if(isset($_REQUEST['R1Hi'])) { $db->setR1Hi($db->myreal_escape_string($_REQUEST['R1Hi']) ); } 

		 	
	if(isset($_REQUEST['R1Percent'])) { $db->setR1Percent($db->myreal_escape_string($_REQUEST['R1Percent']) ); } 

		 	
	if(isset($_REQUEST['R2Low'])) { $db->setR2Low($db->myreal_escape_string($_REQUEST['R2Low']) ); } 

		 	
	if(isset($_REQUEST['R2Hi'])) { $db->setR2Hi($db->myreal_escape_string($_REQUEST['R2Hi']) ); } 

		 	
	if(isset($_REQUEST['R2Percent'])) { $db->setR2Percent($db->myreal_escape_string($_REQUEST['R2Percent']) ); } 

		 	
	if(isset($_REQUEST['R3Low'])) { $db->setR3Low($db->myreal_escape_string($_REQUEST['R3Low']) ); } 

		 	
	if(isset($_REQUEST['R3Hi'])) { $db->setR3Hi($db->myreal_escape_string($_REQUEST['R3Hi']) ); } 

		 	
	if(isset($_REQUEST['R3Percent'])) { $db->setR3Percent($db->myreal_escape_string($_REQUEST['R3Percent']) ); } 

		 	
	if(isset($_REQUEST['PR1Low'])) { $db->setPR1Low($db->myreal_escape_string($_REQUEST['PR1Low']) ); } 

		 	
	if(isset($_REQUEST['PR1Hi'])) { $db->setPR1Hi($db->myreal_escape_string($_REQUEST['PR1Hi']) ); } 

		 	
	if(isset($_REQUEST['PR1Percent'])) { $db->setPR1Percent($db->myreal_escape_string($_REQUEST['PR1Percent']) ); } 

		 	
	if(isset($_REQUEST['PR2Low'])) { $db->setPR2Low($db->myreal_escape_string($_REQUEST['PR2Low']) ); } 

		 	
	if(isset($_REQUEST['PR2Hi'])) { $db->setPR2Hi($db->myreal_escape_string($_REQUEST['PR2Hi']) ); } 

		 	
	if(isset($_REQUEST['PR2Percent'])) { $db->setPR2Percent($db->myreal_escape_string($_REQUEST['PR2Percent']) ); } 

		 	
	if(isset($_REQUEST['PR3Low'])) { $db->setPR3Low($db->myreal_escape_string($_REQUEST['PR3Low']) ); } 

		 	
	if(isset($_REQUEST['PR3Hi'])) { $db->setPR3Hi($db->myreal_escape_string($_REQUEST['PR3Hi']) ); } 

		 	
	if(isset($_REQUEST['PR3Percent'])) { $db->setPR3Percent($db->myreal_escape_string($_REQUEST['PR3Percent']) ); } 

		 	
	if(isset($_REQUEST['FR1Low'])) { $db->setFR1Low($db->myreal_escape_string($_REQUEST['FR1Low']) ); } 

		 	
	if(isset($_REQUEST['FR1Hi'])) { $db->setFR1Hi($db->myreal_escape_string($_REQUEST['FR1Hi']) ); } 

		 	
	if(isset($_REQUEST['FR1Percent'])) { $db->setFR1Percent($db->myreal_escape_string($_REQUEST['FR1Percent']) ); } 

		 	
	if(isset($_REQUEST['FR2Low'])) { $db->setFR2Low($db->myreal_escape_string($_REQUEST['FR2Low']) ); } 

		 	
	if(isset($_REQUEST['FR2Hi'])) { $db->setFR2Hi($db->myreal_escape_string($_REQUEST['FR2Hi']) ); } 

		 	
	if(isset($_REQUEST['FR2Percent'])) { $db->setFR2Percent($db->myreal_escape_string($_REQUEST['FR2Percent']) ); } 

		 	
	if(isset($_REQUEST['FR3Low'])) { $db->setFR3Low($db->myreal_escape_string($_REQUEST['FR3Low']) ); } 

		 	
	if(isset($_REQUEST['FR3Hi'])) { $db->setFR3Hi($db->myreal_escape_string($_REQUEST['FR3Hi']) ); } 

		 	
	if(isset($_REQUEST['FR3Percent'])) { $db->setFR3Percent($db->myreal_escape_string($_REQUEST['FR3Percent']) ); } 

		 	
	if(isset($_REQUEST['NoteToDriver'])) { $db->setNoteToDriver($db->myreal_escape_string($_REQUEST['NoteToDriver']) ); } 

		 	
	if(isset($_REQUEST['Balance'])) { $db->setBalance($db->myreal_escape_string($_REQUEST['Balance']) ); } 

		 	

$upd = '';
$newID = '';

// ako je update, azuriraj trazeni slog

if ($keyName != '' and $keyValue != '') {
	$res = $db->saveRow();
	$upd = 'Updated';
	if($res !== true) $upd = $res;
}

// inace dodaj novi slog	
if ($keyName != '' and $keyValue == '') {
	// validacija za uname, pass
	$newUserName = $_REQUEST['AuthUserName'];
	$newPassword = $_REQUEST['AuthUserPassNew'];
	$newAU = new v4_AuthUsers();
	$auKeys = $newAU->getKeysBy("AuthUserID", "ASC", "WHERE AuthUserName = '{$newUserName}'");

	if (count($auKeys) > 0) {
		die('User Name already exists');
	} else if (!isset($newPassword) or ($newPassword == '')) {
		die('Please set password');
	} else {
		$newID = $db->saveAsNew();
	}
}


$out = array(
	'update' => $upd,
	'insert' => $newID
);

# send output back
$output = json_encode($out);
echo $_REQUEST['callback'] . '(' . $output . ')';
	


<script type="text/x-handlebars-template" id="v4_AuthUsersEditTemplate">
<form id="v4_AuthUsersEditForm{{AuthUserID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{ID}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_AuthUsers('{{AuthUserID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_AuthUsers('{{AuthUserID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_AuthUsers('{{AuthUserID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_AuthUsers('{{AuthUserID}}', '<?= $inList ?>');">
				<i class="ic-print"></i>
				</button>
			<? } ?>	
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserID"><?=AUTHUSERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserID" id="AuthUserID" class="w100" value="{{AuthUserID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthLevelID"><?=AUTHLEVELID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthLevelID" id="AuthLevelID" class="w100" value="{{AuthLevelID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Terminal"><?=TERMINAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Terminal" id="Terminal" class="w100" value="{{Terminal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Country"><?=COUNTRY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Country" id="Country" class="w100" value="{{Country}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReturnDiscount"><?=RETURNDISCOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReturnDiscount" id="ReturnDiscount" class="w100" value="{{ReturnDiscount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Provision"><?=PROVISION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Provision" id="Provision" class="w100" value="{{Provision}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserRealName"><?=AUTHUSERREALNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserRealName" id="AuthUserRealName" class="w100" value="{{AuthUserRealName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserName"><?=AUTHUSERNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserName" id="AuthUserName" class="w100" value="{{AuthUserName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserCompany"><?=AUTHUSERCOMPANY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserCompany" id="AuthUserCompany" class="w100" value="{{AuthUserCompany}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverID"><?=DRIVERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverID" id="DriverID" class="w100" value="{{DriverID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="BrandName"><?=BRANDNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="BrandName" id="BrandName" class="w100" value="{{BrandName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContactPerson"><?=CONTACTPERSON;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContactPerson" id="ContactPerson" class="w100" value="{{ContactPerson}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserCompanyMB"><?=AUTHUSERCOMPANYMB;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserCompanyMB" id="AuthUserCompanyMB" class="w100" value="{{AuthUserCompanyMB}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthCoAddress"><?=AUTHCOADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="AuthCoAddress" id="AuthCoAddress" rows="5" 
					class="textarea" cols="50" style="width:100%">{{AuthCoAddress}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="City"><?=CITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="City" id="City" class="w100" value="{{City}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Zip"><?=ZIP;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Zip" id="Zip" class="w100" value="{{Zip}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryName"><?=COUNTRYNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryName" id="CountryName" class="w100" value="{{CountryName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CountryID"><?=COUNTRYID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CountryID" id="CountryID" class="w100" value="{{CountryID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserTel"><?=AUTHUSERTEL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserTel" id="AuthUserTel" class="w100" value="{{AuthUserTel}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserMob"><?=AUTHUSERMOB;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserMob" id="AuthUserMob" class="w100" value="{{AuthUserMob}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="EmergencyPhone"><?=EMERGENCYPHONE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="EmergencyPhone" id="EmergencyPhone" class="w100" value="{{EmergencyPhone}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserFax"><?=AUTHUSERFAX;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserFax" id="AuthUserFax" class="w100" value="{{AuthUserFax}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserMail"><?=AUTHUSERMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserMail" id="AuthUserMail" class="w100" value="{{AuthUserMail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserCoDesc"><?=AUTHUSERCODESC;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="AuthUserCoDesc" id="AuthUserCoDesc" rows="5" 
					class="textarea" cols="50" style="width:100%">{{AuthUserCoDesc}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserNote"><?=AUTHUSERNOTE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="AuthUserNote" id="AuthUserNote" rows="5" 
					class="textarea" cols="50" style="width:100%">{{AuthUserNote}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AccountBank"><?=ACCOUNTBANK;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AccountBank" id="AccountBank" class="w100" value="{{AccountBank}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AccountOwner"><?=ACCOUNTOWNER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AccountOwner" id="AccountOwner" class="w100" value="{{AccountOwner}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SWIFT"><?=SWIFT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SWIFT" id="SWIFT" class="w100" value="{{SWIFT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="IBAN"><?=IBAN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="IBAN" id="IBAN" class="w100" value="{{IBAN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserPass"><?=AUTHUSERPASS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserPass" id="AuthUserPass" class="w100" value="{{AuthUserPass}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserCompanyWeb"><?=AUTHUSERCOMPANYWEB;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserCompanyWeb" id="AuthUserCompanyWeb" class="w100" value="{{AuthUserCompanyWeb}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserFacebook"><?=AUTHUSERFACEBOOK;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserFacebook" id="AuthUserFacebook" class="w100" value="{{AuthUserFacebook}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserTwitter"><?=AUTHUSERTWITTER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserTwitter" id="AuthUserTwitter" class="w100" value="{{AuthUserTwitter}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserLinkedIn"><?=AUTHUSERLINKEDIN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserLinkedIn" id="AuthUserLinkedIn" class="w100" value="{{AuthUserLinkedIn}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AuthUserGooglePlus"><?=AUTHUSERGOOGLEPLUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AuthUserGooglePlus" id="AuthUserGooglePlus" class="w100" value="{{AuthUserGooglePlus}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DateAdded"><?=DATEADDED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DateAdded" id="DateAdded" class="w100" value="{{DateAdded}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LastVisited"><?=LASTVISITED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LastVisited" id="LastVisited" class="w100" value="{{LastVisited}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Image"><?=IMAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Image" id="Image" class="w100" value="{{Image}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Temp_pass"><?=TEMP_PASS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Temp_pass" id="Temp_pass" class="w100" value="{{Temp_pass}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Temp_pass_active"><?=TEMP_PASS_ACTIVE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Temp_pass_active" id="Temp_pass_active" class="w100" value="{{Temp_pass_active}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Level_access"><?=LEVEL_ACCESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Level_access" id="Level_access" class="w100" value="{{Level_access}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Random_key"><?=RANDOM_KEY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Random_key" id="Random_key" class="w100" value="{{Random_key}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContractFile"><?=CONTRACTFILE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContractFile" id="ContractFile" class="w100" value="{{ContractFile}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContractDate"><?=CONTRACTDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContractDate" id="ContractDate" class="w100" value="{{ContractDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContractSignature"><?=CONTRACTSIGNATURE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContractSignature" id="ContractSignature" class="w100" value="{{ContractSignature}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DBImage"><?=DBIMAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DBImage" id="DBImage" class="w100" value="{{DBImage}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DBImageType"><?=DBIMAGETYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DBImageType" id="DBImageType" class="w100" value="{{DBImageType}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Language"><?=LANGUAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Language" id="Language" class="w100" value="{{Language}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Active"><?=ACTIVE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Active" id="Active" class="w100" value="{{Active}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AcceptedPayment"><?=ACCEPTEDPAYMENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AcceptedPayment" id="AcceptedPayment" class="w100" value="{{AcceptedPayment}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R1Low"><?=R1LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R1Low" id="R1Low" class="w100" value="{{R1Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R1Hi"><?=R1HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R1Hi" id="R1Hi" class="w100" value="{{R1Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R1Percent"><?=R1PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R1Percent" id="R1Percent" class="w100" value="{{R1Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R2Low"><?=R2LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R2Low" id="R2Low" class="w100" value="{{R2Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R2Hi"><?=R2HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R2Hi" id="R2Hi" class="w100" value="{{R2Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R2Percent"><?=R2PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R2Percent" id="R2Percent" class="w100" value="{{R2Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R3Low"><?=R3LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R3Low" id="R3Low" class="w100" value="{{R3Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R3Hi"><?=R3HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R3Hi" id="R3Hi" class="w100" value="{{R3Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="R3Percent"><?=R3PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="R3Percent" id="R3Percent" class="w100" value="{{R3Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR1Low"><?=PR1LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR1Low" id="PR1Low" class="w100" value="{{PR1Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR1Hi"><?=PR1HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR1Hi" id="PR1Hi" class="w100" value="{{PR1Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR1Percent"><?=PR1PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR1Percent" id="PR1Percent" class="w100" value="{{PR1Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR2Low"><?=PR2LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR2Low" id="PR2Low" class="w100" value="{{PR2Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR2Hi"><?=PR2HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR2Hi" id="PR2Hi" class="w100" value="{{PR2Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR2Percent"><?=PR2PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR2Percent" id="PR2Percent" class="w100" value="{{PR2Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR3Low"><?=PR3LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR3Low" id="PR3Low" class="w100" value="{{PR3Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR3Hi"><?=PR3HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR3Hi" id="PR3Hi" class="w100" value="{{PR3Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PR3Percent"><?=PR3PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PR3Percent" id="PR3Percent" class="w100" value="{{PR3Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR1Low"><?=FR1LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR1Low" id="FR1Low" class="w100" value="{{FR1Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR1Hi"><?=FR1HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR1Hi" id="FR1Hi" class="w100" value="{{FR1Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR1Percent"><?=FR1PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR1Percent" id="FR1Percent" class="w100" value="{{FR1Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR2Low"><?=FR2LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR2Low" id="FR2Low" class="w100" value="{{FR2Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR2Hi"><?=FR2HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR2Hi" id="FR2Hi" class="w100" value="{{FR2Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR2Percent"><?=FR2PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR2Percent" id="FR2Percent" class="w100" value="{{FR2Percent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR3Low"><?=FR3LOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR3Low" id="FR3Low" class="w100" value="{{FR3Low}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR3Hi"><?=FR3HI;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR3Hi" id="FR3Hi" class="w100" value="{{FR3Hi}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FR3Percent"><?=FR3PERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FR3Percent" id="FR3Percent" class="w100" value="{{FR3Percent}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_AuthUsers('{{AuthUserID}}', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>
    	</div>
    	<? } ?>

	</div>
</form>


	<script>

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	</script>
</script>
	
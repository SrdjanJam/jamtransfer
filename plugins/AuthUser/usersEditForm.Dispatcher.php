
<script type="text/x-handlebars-template" id="userEditTemplate">
<form id="userEditForm{{AuthUserID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">

	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{AuthUserRealName}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn btn-default" title="Close" 
					onclick="return editCloseUser('{{AuthUserID}}', '<?= $inList ?>');">
					<i class="fa fa-chevron-up l"></i>
					</button>
				<? } ?>
			<? } ?>
			
			<button class="btn btn-info" title="Save Changes" 
			onclick="return editSaveUser('{{AuthUserID}}', '<?= $inList ?>');">
			<i class="fa fa-save l"></i>
			</button>
			<? if (!$isNew) { ?>
				<a class="btn btn-danger" title="Login as User" 
				href="index.php?p=dashboard&sa_u={{AuthUserID}}&sa_l={{AuthLevelID}}">
				<i class="fa fa-user l"></i>
				</a>
			<? } ?>
		</div>
	</div>

	<div class="box-body ">
	
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1{{AuthUserID}}" data-toggle="tab"><?= PROFILE ?></a></li>
                <? if ($_SESSION['AuthLevelID'] == DRIVER_USER) { ?>
                <li><a href="#tab_2{{AuthUserID}}" data-toggle="tab"><?= SURCHARGES ?></a></li>
                <? } ?>
            </ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1{{AuthUserID}}">		
	
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3 "><label><?= IMAGE ?></label></div>
								<div class="col-md-9">
									<div id="imageDiv">
										<img src="api/showProfileImage.php?UserID={{AuthUserID}}"
										style="max-height:160px; max-width:160px;overflow:hidden;" 
										class="img-thumbnail">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "></div>
								<div class="col-md-9">
									<form name="form" action="" method="POST" enctype="multipart/form-data">
										<input type="file" name="imageFile" id="imageFile" class="hidden" 
										onchange="return ajaxFileUpload();">
										<input type="hidden" name="UserID" id="UserID" value="{{AuthUserID}}">
										<br>
										<button id="imgUpload" class="btn btn-xs btn-default" 
											onclick="$('#imageFile').click();return false;">
											<?= UPLOAD_NEW_IMAGE ?>
										</button> <small>(200x200px)</small>
									</form>
									<br><br>
								</div>
							</div>					
							<div class="row">
								<div class="col-md-3 "><label><?= ID ?></label></div>
								<div class="col-md-9"><strong>{{AuthUserID}}</strong></div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= STATUS ?></label></div>
								<div class="col-md-9">
									{{#if Active}}
										<?= ACTIVE ?>
									{{else}}
										<?= NOT_ACTIVE ?>
									{{/if}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= LANGUAGE ?></label></div>
								<div class="col-md-9">
									{{Language}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= USER_NAME ?></label></div>
								<div class="col-md-9">{{AuthUserName}}</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 "><label><?= NEW_PASSWORD ?></label></div>
								<div class="col-md-9">
									<input type="hidden" name="AuthUserPass" value="{{AuthUserPass}}">
									<input type="text"  name="AuthUserPassNew" class="w25">
								</div>
							</div>							

						    {{#compare AuthLevelID "!=" '2'}}
						        <div class="row">
							        <div class="col-md-3 "><label><?= REAL_NAME?></label></div>
							        <div class="col-md-9">
								        <input id="AuthUserRealName" name="AuthUserRealName" type="text"  class="w100"
								         value="{{AuthUserRealName}}"
								        <?= READ_ONLY_FLD ?> required>
							        </div>
						        </div>
						    {{/compare}}

							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_NAME ?></label></div>
								<div class="col-md-9">
									<input type="text"  name="AuthUserCompany" class="w100"
									 value="{{AuthUserCompany}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= BRAND_NAME ?></label></div>
								<div class="col-md-9">
									<input type="text"  name="BrandName" class="w100"
									 value="{{BrandName}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= CONTACT_PERSON ?></label></div>
								<div class="col-md-9">
									<input type="text"  name="ContactPerson" class="w100"
									 value="{{ContactPerson}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_ADDRESS ?></label></div>
								<div class="col-md-9">
									<textarea class="textarea" name="AuthCoAddress" id="AuthCoAddress" 
									cols="40" rows="2"
									 style="width:100%">
										{{AuthCoAddress}}
									</textarea><br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= CITY ?></label></div>
								<div class="col-md-9">
									<input id="City" name="City" type="text"  class="w100"
									required value="{{City}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= ZIP ?></label></div>
								<div class="col-md-9">
									<input id="Zip" name="Zip" type="text"  class="w25"
									required value="{{Zip}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= COUNTRY ?></label></div>
								<div class="col-md-9">
									<select id="CountryName" name="CountryName" class="w100" required">
									{{#select CountryName}}
										<option value=""> --- </option>
										<?
										require_once ROOT .'/db/v4_Countries.class.php';
										$c = new v4_Countries();
										$k = $c->getKeysBy('CountryName', 'asc');
										foreach($k as $nn => $id) {
											$c->getRow($id);
											echo '<option value="'.$c->getCountryName().'">'.$c->getCountryName() . '</option>';
										}
										?>
									{{/select}}	
									</select>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 "><label><?= EMAIL ?></label></div>
								<div class="col-md-9">
									<input id="AuthUserMail" name="AuthUserMail" type="email"  class="w100"
									required value="{{AuthUserMail}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= TEL ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AuthUserTel" class="w100 " value="{{AuthUserTel}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= MOB ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AuthUserMob" class="w100 " value="{{AuthUserMob}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= EMERGENCY_PHONE ?></label></div>
								<div class="col-md-9">
									<input type="text" name="EmergencyPhone" class="w100 " value="{{EmergencyPhone}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= FAX ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AuthUserFax" class="w100 " value="{{AuthUserFax}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

						{{#compare AuthLevelID "==" '2'}}
							<div class="row">
								<div class="col-md-3 "><label><?= PROVISION ?></label></div>
								<div class="col-md-9">
									<input type="text" name="Provision" class="w25 " value="{{Provision}}"
									<?= READ_ONLY_FLD ?>> %
								</div>
							</div>
						{{/compare}}

						{{#compare AuthLevelID "==" '4'}}
							<div class="row">
								<div class="col-md-3 "><label><?= PROVISION ?></label></div>
								<div class="col-md-9">
									<input type="text" name="Provision" class="w25 " value="{{Provision}}"
									<?= READ_ONLY_FLD ?>> %
								</div>
							</div>
						{{/compare}}
					</div>

					<div class="col-md-6">
						{{#compare AuthLevelID "==" '31'}}

							<div class="row">
								<div class="col-md-3 "><label><?= COUNTRY_SHORT ?></label></div>
								<div class="col-md-9">
									<input type="text" name="Country" class="w25"
									 value="{{Country}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= TERMINAL ?></label></div>
								<div class="col-md-9">
									<input type="text" name="Terminal" class="w100"
									 value="{{Terminal}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
						{{/compare}}

							<div class="row">
								<div class="col-md-3 "><label><?= TAX_NUMBER ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AuthUserCompanyMB" class="w100"
									 value="{{AuthUserCompanyMB}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= ACCOUNT_OWNER ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AccountOwner" class="w100"
									 value="{{AccountOwner}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 "><label><?= ACCOUNT_BANK ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AccountBank" class="w100"
									 value="{{AccountBank}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 "><label><?= IBAN ?></label></div>
								<div class="col-md-9">
									<input type="text" name="IBAN" class="w100"
									 value="{{IBAN}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>														

							<div class="row">
								<div class="col-md-3 "><label><?= SWIFT ?></label></div>
								<div class="col-md-9">
									<input type="text" name="SWIFT" class="w100"
									 value="{{SWIFT}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>	


							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_WEB ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AuthUserCompanyWeb" class="w100"
									 value="{{AuthUserCompanyWeb}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>


							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_DESC ?></label></div>
								<div class="col-md-9">
									<textarea class="textarea" name="AuthUserCoDesc" id="AuthUserCoDesc" 
									cols="40" rows="4"
									 style="width:100%">
										{{{AuthUserCoDesc}}}
									</textarea><br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= NOTE ?></label></div>
								<div class="col-md-9">
									<textarea class="textarea" name="AuthUserNote" id="AuthUserNote" 
									cols="40" rows="4"
									 style="width:100%">
										{{AuthUserNote}}
									</textarea><br>
								</div>
							</div>

					    <hr>

						<div class="row">
							<div class="col-md-3 "><label><?= DATE_ADDED ?></label></div>
							<div class="col-md-9">
								{{DateAdded}}
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 "><label><?= CONTRACT_FILE ?></label></div>
							<div class="col-md-9">
								{{ContractFile}}
							</div>
						</div>
							<div class="row">
							<div class="col-md-3 "><label><?= CONTRACT_DATE ?></label></div>
							<div class="col-md-9">
								{{ContractDate}}
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 "><label><?= CONTRACT_SIGNATURE ?></label></div>
							<div class="col-md-9">
								{{ContractSignature}}
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 "><label><?= LAST_VISIT ?></label></div>
							<div class="col-md-9">
								{{LastVisited}}
							</div>
						</div>
						
						</div>
					</div>

					<!-- Statuses and messages -->
					<div class="box-footer">
						<? if (!$isNew and $_REQUEST['p'] != 'profileEdit') { ?>
							<div>
								<button class="btn btn-default xpull-right" onclick="return deleteUser('{{AuthUserID}}', '<?= $inList ?>');">
									<i class="fa fa-trash-o l"></i> <?= DELETE_USER ?>
								</button>
							</div>
						<? } ?>

					</div>
		    	</div> {{!-- tab1 end --}}

				<div class="tab-pane" id="tab_2{{AuthUserID}}">
					<div class="row">
						<div class="col-md-3">
							<label for="SurCategory"><?=SURCATEGORY;?></label>
						</div>
						<div class="col-md-9">
							<select name="SurCategory" id="SurCategory" class="w100" 
							onchange="globalSurcharges({{AuthUserID}});">
								{{#select SurCategory}}
									<option value="1"><?= DEFINE_GLOBAL ?></option>
									<option value="0"><?= NO_SURCHARGES ?></option>
								{{/select}}								
							</select>

							<input type="hidden" name="SurID" id="SurID" class="w100" value="{{SurID}}">
						</div>
					</div>
					<div id="globalSurcharges{{AuthUserID}}"></div>
				</div> {{!-- tab-pane tab_2 --}}						
	    </div><!-- box-body-->
</form>

	<script>
		globalSurcharges({{AuthUserID}});
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": false, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": false, //Button to insert an image. Default true,
				"color": false //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});

		function ajaxFileUpload()
		{
			$("#loading")
			.ajaxStart(function(){
				$(this).show();
			})
			.ajaxComplete(function(){
				$(this).hide();
			});

			var UserID = $("#UserID").val();
			
			$.ajaxFileUpload
			(
				{
					url: window.root + '/cms/api/saveProfileImage.php?UserID='+UserID,
					secureuri:false,
					fileElementId:'imageFile',
					dataType: 'json',
					//data:{UserID: UserID},
					success: function (data, status)
					{
						if(typeof(data.error) != 'undefined')
						{
							if(data.error != '')
							{
								alert(data.error);
							}else
							{
								//alert(data.msg);
								$("#imageDiv > img").attr('src', 'upload/'+data.img);

								$.get( window.root+"/cms/api/deleteTempImage.php?image="+data.img, function( data ) {
								});
							}
						}

					},
					error: function (data, status, e)
					{
						// console.log(data);
                        alert(e);
					}
				}
			)
			return false;
		}

		function validateUname (input) {
			console.log(input);
		}
	</script>
</script>


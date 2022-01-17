<script type="text/x-handlebars-template" id="userEditTemplate">
	<form id="userEditForm{{AuthUserID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
		<div class="box-header">
			<div class="box-title">
				<? if ($isNew) { ?>
					<h3><?= NNEW ?></h3>
					<input type="hidden" name="AuthLevelID" id="AuthLevelID" value="32">
				<? } else { ?>
					<h3><?= EDIT ?> - {{AuthUserRealName}}</h3>
					<input type="hidden" name="AuthLevelID" id="AuthLevelID" value="{{AuthLevelID}}">
				<? } ?>
			</div>
			<div class="box-tools pull-right">
			
				<span id="statusMessage" class="text-info xl"></span>
			
				<? if (!$isNew) { ?>
					<? if ($inList=='true') { ?>
						<button class="btn btn-warning" title="Close" 
						onclick="return editCloseUser('{{AuthUserID}}', '<?= $inList ?>');">
						<i class="fa fa-chevron-up l"></i>
						</button>
					<? } ?>
				<? } ?>
			
				<button class="btn btn-info" title="Save Changes" 
				onclick="return editSaveUser('{{AuthUserID}}', '<?= $inList ?>');">
				<i class="fa fa-save l"></i>
				</button>
			</div>
		</div>

		<div class="box-body ">
			<div class="nav-tabs-custom">
		        <ul class="nav nav-tabs">
		            <li class="active"><a href="#tab_1{{AuthUserID}}" data-toggle="tab"><?= PROFILE ?></a></li>
					<li><a style="opacity:0" href="#tab_2{{AuthUserID}}" data-toggle="tab"></a></li> 
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
											<input type="file" name="imageFile" id="imageFile" 
											onchange="return ajaxFileUpload();" class="hidden">
											<input type="hidden" name="UserID" id="UserID" value="{{AuthUserID}}">

											<? if ($isNew) { ?>
												<input type="hidden" name="DriverID" id="DriverID" value=<?= '"'.$_SESSION['AuthUserID'].'"'; ?>>
												<input type="hidden" name="DateAdded" id="DateAdded" value=<?= '"'.date('Y-m-d').'"' ?>>
											<? } else { ?>
												<input type="hidden" name="DriverID" id="DriverID" value="{{DriverID}}">
											<? } ?>

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
									<div class="col-md-9">
										  <strong>{{AuthUserID}}</strong> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 "><label><?= STATUS ?></label></div>
									<div class="col-md-9">
										<select name="Active" id="Active">
											{{#select Active}}
											<option value="0"><?= NOT_ACTIVE?></option>
											<option value="1"><?= ACTIVE?></option>
											{{/select}}
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= LANGUAGE ?></label></div>
									<div class="col-md-9">
										{{languageSelect Language}}
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= USER_NAME ?></label></div>
									<div class="col-md-9">
										<input type="text"  name="AuthUserName" class="w100" value="{{AuthUserName}}"
										<?= READ_ONLY_FLD ?> required>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= NEW_PASSWORD ?></label></div>
									<div class="col-md-9">
										<input type="hidden" name="AuthUserPass" value="{{AuthUserPass}}">
										<input type="text"  name="AuthUserPassNew" class="w25">
									</div>
								</div>	

								<div class="row">
									<div class="col-md-3 "><label><?= REAL_NAME?></label></div>
									<div class="col-md-9">
										<input id="AuthUserRealName" name="AuthUserRealName" type="text"  class="w100"
										 value="{{AuthUserRealName}}"
										<?= READ_ONLY_FLD ?> required>
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
									<div class="col-md-3 "><label><?= FAX ?></label></div>
									<div class="col-md-9">
										<input type="text" name="AuthUserFax" class="w100 " value="{{AuthUserFax}}"
										<?= READ_ONLY_FLD ?>>
									</div>
								</div>
								<?//Bilo je potrebno dodat polog (deposit), iskoristeno polje koje je prije bilo balance sve osim polja u tablici v4_AuthUsers koje je ostalo naziva Balance?>
								<div class="row">
									<div class="col-md-3 "><label><?= DEPOSIT ?></label></div>
									<div class="col-md-9">
										<input type="text" name="Balance" class="w100 " value="{{Balance}}"
										<?= READ_ONLY_FLD ?>>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="row">
									<div class="col-md-3 "><label><?= COMPANY_NAME ?></label></div>
									<div class="col-md-9">
										<input type="text"  name="AuthUserCompany" class="w100"
										 value="{{AuthUserCompany}}"
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
									<div class="col-md-3 "><label><?= COMPANY_ADDRESS ?></label></div>
									<div class="col-md-9">
										<textarea class="textarea" name="AuthCoAddress" id="AuthCoAddress" 
										cols="40" rows="4"
										 style="width:100%">
											{{AuthCoAddress}}
										</textarea><br>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 "><label><?= COMPANY_DESC ?></label></div>
									<div class="col-md-9">
										<textarea class="textarea" name="AuthUserCoDesc" id="AuthUserCoDesc" 
										cols="40" rows="6"
										 style="width:100%">
											{{{AuthUserCoDesc}}}
										</textarea><br>
									</div>
								</div>



								<div class="row">
									<div class="col-md-3 "><label><?= NOTE_TO_DRIVER ?></label></div>
									<div class="col-md-9">
										<textarea name="NoteToDriver" id="NoteToDriver" 
										cols="40" rows="4"
										 style="width:100%">{{NoteToDriver}}</textarea><br>
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
			.ajaxStart(function(){$(this).show();})
			.ajaxComplete(function(){$(this).hide();});

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
	</script>
</script>


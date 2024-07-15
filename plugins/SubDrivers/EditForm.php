<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{AuthUserID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{AuthUserID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{AuthUserID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{AuthUserID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
	
		<div class="nav-tabs-custom">

			<div class="tab-content">			
				<div class="tab-pane active" id="tab_1{{AuthUserID}}">		

					<div class="row">
						<div class="col-md-6">
							<? if (!$isNew) { ?>
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
										<input type="file" name="imageFile" id="imageFile" class="hidden" >
										<input type="hidden" name="UserID" id="UserID" value="{{AuthUserID}}">
										<br>
										<button id="imgUpload" class="btn btn-xs btn-default" 
											onclick="$('#imageFile').click();return false;">
											<?= UPLOAD_NEW_IMAGE ?>
										</button> <small>(200x200px)</small>
									<br><br>
								</div>
							</div>	
							<? } ?>				
							<div class="row">
								<div class="col-md-3 "><label><?= ID ?></label></div>
								<div class="col-md-9">
									  <strong>{{AuthUserID}}</strong> 
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= STATUS ?></label></div>
								<div class="col-md-9">
									<!--{{yesNoSliderEdit Active 'Active' }}!-->
									<select name="Active" id="Active">
										{{#select Active}}
											<option value="0"><?= NOT_ACTIVE?></option>
											<option value="2"><?= SEMI?> <?= ACTIVE?></option>
											<option value="1"><?= ACTIVE?></option>
										{{/select}}
									</select>
								</div>
							</div>

						</div>	
						<div class="col-md-6">

							<div class="row">
								<div class="col-md-3 "><label><?= USER_NAME ?></label></div>
								<div class="col-md-9">
									<input type="text"  name="AuthUserName" class="w100" value="{{AuthUserName}}" onclick="validateUname(this)"
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
								<div class="col-md-3 "><label><?= EMAIL ?></label></div>
								<div class="col-md-9">
									<input id="AuthUserMail" name="AuthUserMail" type="email"  class="w100"
									value="{{AuthUserMail}}"
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
							<? if (!PARTNERLOG) {?>
							<div class="row">
								<div class="col-md-3 "><label><?= RAPTORID ?></label></div>
								<div class="col-md-9">
									<input type="text" name="AuthUserFax" class="w100 " value="{{AuthUserFax}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>							
														
							<div class="row">
								<div class="col-md-3 "><label><?= FLAT_PLACE_ID ?></label></div>
								<div class="col-md-9">
									<input type="text" name="IBAN" class="w100"
									 value="{{IBAN}}"
									<?= READ_ONLY_FLD ?>>
								</div>
							</div>														
							<? } ?>

						</div>
					</div>	
		    	</div> {{!-- tab1 end --}}
	    </div><!-- box-body-->

</form>
	<script>
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
		
		
		$("#imageFile").on("change", function(ev) {
			var file = $(this)[0].files[0];
			
			var fd = new FormData();
			fd.append('imageFile', file);
			var UserID=$(this).next().val();
			$.ajax({
				url: "./plugins/SubDrivers/saveProfileImage.php?UserID="+UserID,
				type: "POST",
				processData: false,
				contentType: false,
				data: fd,
				success: function (msg) {
					toastr['success'](window.success);	
					location.reload();
				},
			});
			
		});
		

		function validateUname (input) {
			console.log(input);
		}
	</script>
</script>


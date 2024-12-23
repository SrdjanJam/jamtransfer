<form name="UserProfile" method="post" action="">
	<div class="box-header">
		<div class="box-tools pull-right">
			<button type="submit" name="save" class="btn btn-info" title="{$SAVE_CHANGES}">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>
	<br><br>
	<div class="box-body ">
		<div class="nav-tabs-custom">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="row">
							<div class="col-md-12">
								<input id="AuthUserRealName" name="AuthUserRealName" type="text" class="form-control input-xl"
								 value="{$AuthUserRealName}"
								{$READ_ONLY_FLD} disabled>
							</div>
						</div>			
						<div class="row">
							<div class="col-md-3"><label>{$IMAGE}</label></div>
							<div class="col-md-6">
								<div id="imageDiv">
									<img src="api/showProfileImage.php?UserID={$AuthUserID}"
									style="max-height:160px; max-width:160px;overflow:hidden;" 
									class="img-thumbnail">
								</div>
							</div>
							<div class="col-md-3">
								<input type="file" name="imageFile" id="imageFile" class="hidden" >
								<input type="hidden" name="AuthUserID" id="AuthUserID" value="{$AuthUserID}">
								<button id="imgUpload" class="btn btn-xs btn-default" 
									onclick="$('#imageFile').click();return false;">
									{$UPLOAD_NEW_IMAGE}
								</button> <small>(200x200px)</small>
							</div>	
						</div>
					</div>	
					
					<div class="row">
						<div class="col-md-3"><label>{$USER_NAME}</label></div>
						<div class="col-md-3">
							<input type="text" name="AuthUserName" class="form-control" value="{$AuthUserName}"
							{$READ_ONLY_FLD} required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3"><label>{$NEW_PASSWORD}</label></div>
						<div class="col-md-9">
							<input type="hidden" name="AuthUserPass" value="{$AuthUserPass}">
							<input type="text"  name="AuthUserPassNew" class="form-control">
						</div>
					</div>						
					<div class="row">
						<div class="col-md-3"><label>MobLog {$PASSWORD}</label></div>
						<div class="col-md-9">
							<input type="text" name="Temp_pass" value="{$Temp_pass}">
						</div>
					</div>	
				</div>
				<div class="col-md-6">					
					<div class="row">
						<div class="col-md-3"><label>
							{$COMPANY_NAME}
						</label></div>
						<div class="col-md-9">
							<input id="AuthUserCompany" name="AuthUserCompany" type="text" class="form-control"
							 value="{$AuthUserCompany}"
							{$READ_ONLY_FLD} required>
						</div>
					</div>						
					<div class="row">
						<div class="col-md-3"><label>
							{$BRAND_NAME}
						</label></div>
						<div class="col-md-9">
							<input id="BrandName" name="BrandName" type="text" class="form-control"
							 value="{$BrandName}"
							{$READ_ONLY_FLD} required>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-3"><label>
							{$CONTACT_PERSON}
						</label></div>
						<div class="col-md-9">
							<input id="ContactPerson" name="ContactPerson" type="text" class="form-control"
							 value="{$ContactPerson}"
							{$READ_ONLY_FLD} required>
						</div>
					</div>									
					<div class="row">
						<div class="col-md-3"><label>{$EMAIL}</label></div>
						<div class="col-md-9">
							<input id="AuthUserMail" name="AuthUserMail" type="text" class="form-control"
							required value="{$AuthUserMail}"
							{$READ_ONLY_FLD}>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3"><label>{$TEL}</label></div>
						<div class="col-md-9">
							<input type="text" name="AuthUserTel" class="form-control" value="{$AuthUserTel}"
							{$READ_ONLY_FLD}>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3"><label>{$MOB}</label></div>
						<div class="col-md-9">
							<input type="text" name="AuthUserMob" class="form-control" value="{$AuthUserMob}"
							{$READ_ONLY_FLD}>
						</div>
					</div>								
				
					<div class="row">					
						<div class="col-md-3"><label>WWW</label></div>
						<div class="col-md-9">
							<input type="text" class="form-control" name="AuthUserCompanyWeb" 
							 value="{$AuthUserCompanyWeb}"
							{$READ_ONLY_FLD}>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3"><label>{$ADDRESS}</label></div>
						<div class="col-md-9">
							<input type="text" class="form-control" name="AuthCoAddress" id="AuthCoAddress" 
							 value="{$AuthCoAddress}"
							{$READ_ONLY_FLD}/>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>	
</form>
<script>
{literal}
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
	$smarty.request.save
	toastr['success'](window.success);	
{/literal}	
</script>	
{if isset($smarty.request.save)}
	<script>
	{literal}
		toastr['success']('{/literal}{$SUCCESS}{literal}');	
	{/literal}
	</script>
{/if}	
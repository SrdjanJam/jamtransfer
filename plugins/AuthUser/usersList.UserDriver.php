<script type="text/x-handlebars-template" id="usersListTemplate">

	{{#each users}}
		<div  onclick="editUser({{AuthUserID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="user_{{AuthUserID}}">
		
					<div class="col-sm-1 col-xs-4">
						<img src="api/showProfileImage.php?UserID={{AuthUserID}}" 
						   style="max-height:60px; max-width:60px;" 
						   class="img-thumbnail">
					</div>
					<div class="col-sm-3 col-xs-6">
						<strong>{{AuthUserName}}</strong>
						<br>
						{{#compare Active ">" 0}}
							<i class="fa fa-circle text-green"></i>
						{{else}}
							<i class="fa fa-circle text-red"></i>
						{{/compare}}
						&nbsp;
						ID: <strong>{{AuthUserID}}</strong> 
						{{displayUserLevelText AuthLevelID}} 
					</div>
					<div class="col-sm-2 col-xs-12">
						<strong>{{AuthUserCompany}}</strong>
						<br>
						<small>{{AuthUserRealName}}</small>
						<br>
						<small>{{Country}} {{Terminal}}</small>						
					</div>
					<div class="col-sm-3 col-xs-12">
						<a href="index.php?p=quickEmail&EmailAddress={{AuthUserMail}}"  
						class="btn btn-default btn-sm"><i class="fa fa-envelope"></i> {{AuthUserMail}}</a>
						<br>
						<small>
						{{#if AuthUserTel}}
						<i class="fa fa-phone"></i> {{AuthUserTel}}<br>
						{{/if}}
						{{#if AuthUserMob}}
						<i class="fa fa-phone"></i> {{AuthUserMob}}<br>
						{{/if}}						
						{{#if EmergencyPhone}}
						<i class="fa fa-phone red-text"></i> {{EmergencyPhone}}
						{{/if}}
						</small>
					</div>

					<div class="col-sm-3">
						<small>{{{AuthUserNote}}}</small>
					</div>
			</div>
		</div>
		<div id="usersWrapper{{AuthUserID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{AuthUserID}}" class="row">
				<div id="oneUser{{AuthUserID}}" >
					<?= THERE_ARE_NO_DATA ?>
				</div>
			</div>
		</div>

	{{/each}}
	<script>
	$(document).ready(function(){	
		var id=$("#UseDriverID").val();	
		$(".listTile").each(function(){
			var user_id1='user_'+id;
			var user_id=$(this).attr('id');
			if (user_id!=user_id1 && id!=0) $(this).hide();
		})		
	});
	</script>
</script>

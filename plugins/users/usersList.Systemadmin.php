<script type="text/x-handlebars-template" id="usersListTemplate">

	{{#each users}}
		<div  onclick="editUser({{AuthUserID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="user_{{AuthUserID}}">
		
					<div class="col-sm-1 col-xs-4">
						<img src="a/showProfileImage.php?UserID={{AuthUserID}}" 
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
						<small>{{Country}} {{Terminal}}</small>
					</div>
					<div class="col-sm-3 col-xs-12">
						<a href="index.php?p=quickEmail&EmailAddress={{AuthUserMail}}"  
						class="btn btn-default btn-sm"><i class="fa fa-envelope"></i> {{AuthUserMail}}</a>
						<br>
						<small>{{AuthUserTel}}</small>
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


</script>

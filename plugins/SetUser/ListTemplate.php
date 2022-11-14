<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=AUTHUSER_IMAGE;?>
		</div>

		<div class="col-md-4">
			<?=AUTHUSER_ID;?>
		</div>

		<div class="col-md-2">
			<?=EMAIL;?>
		</div>

		<div class="col-md-1">
			<?=SETASDRIVER;?>
		</div>
					
	</div>


	{{#each Item}}
		<div class="one-item-class">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="user_{{AuthUserID}}">

				<!-- AUTHUSER_IMAGE: -->
				<div class="col-sm-1 col-xs-4">
					<img src="api/showProfileImage.php?UserID={{AuthUserID}}" 
						style="max-height:60px; max-width:60px;" 
						class="img-thumbnail">
				</div>
				<!-- AUTHUSER_ID -->
				<div class="col-sm-4 col-xs-6">
					<strong>{{AuthUserName}}</strong>
					ID: <strong>{{AuthUserID}}</strong> {{DriverID}}
				</div>
				<!-- EMAIL -->
				<div class="col-sm-2 col-xs-12">
					<a href="index.php?p=quickEmail&EmailAddress={{AuthUserMail}}"  
					class="btn btn-default btn-sm"><i class="fa fa-envelope"></i> {{AuthUserMail}}</a>
				</div>
				<!-- SET AS DRIVER: -->
				<div class="col-sm-1">
					{{#compare AuthLevelID "==" '31'}}
						<a class="btn btn-danger btn-danger-target" title="Sat as Driver" 
						href="satAsDriver/{{AuthUserID}}">
							<i class="fa fa-car l"></i>
						</a>
					{{/compare}}
				</div>
			</div>
		</div>
	{{/each}}

</script>
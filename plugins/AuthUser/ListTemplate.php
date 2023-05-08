<?
	require_once ROOT.'/db/v4_AuthLevels.class.php';
	$al = new v4_AuthLevels();
	$authLevels = $al->getKeysBy('AuthLevelName', 'asc');
	foreach($authLevels as $nn => $id) {
		$al->getRow($id);
		$arr_row['id']=$al->getAuthLevelID();
		$arr_row['name']=$al->getAuthLevelName();
		$arr_all[]=$arr_row;
	}
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
	$smarty->assign('selectactive',true);

?>	
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=AUTHUSER_IMAGE;?>
		</div>

		<div class="col-md-1">
			<?=ID;?>
		</div>
		
		<div class="col-md-3">
			<?=NAME;?>
		</div>

		<div class="col-md-1">
			<?=AUTHUSER_LEVEL;?>
		</div>		

		<div class="col-md-2">
			<i class="fa fa-envelope"></i>
		</div>

		<div class="col-md-2">
			<i class="fa fa-phone"></i>
		</div>

		<div class="col-md-1">
			<i class="fa fa-message"></i>
		</div>

		<div class="col-md-1">
			<?=ACTIVE;?>
		</div>
					
	</div>


	{{#each Item}}
		<div onclick="oneItem({{AuthUserID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{AuthUserID}}">

				<!-- AUTHUSER_IMAGE: -->
				<div class="col-sm-1 col-xs-4">
				{{#compare DBImage "==" "1"}}
					<img src="api/showProfileImage.php?UserID={{AuthUserID}}" 
						style="max-height:60px; max-width:60px;" 
						class="img-thumbnail">
				{{/compare}}		
				</div>

				<!-- AUTHUSER_ID -->
				<div class="col-sm-1 col-xs-12">
					{{AuthUserID}}
				</div>
				
				<div class="col-sm-3 col-xs-6">
					<strong>
						{{#compare AuthUserRealName "!==" ""}}
							{{AuthUserRealName}}
						{{else}}
							{{AuthUserCompany}}
						{{/compare}}	
					</strong>
				</div>

				<!-- AUTHUSER_LEVEL -->
				<div class="col-sm-1 col-xs-6">
					{{displayUserLevelText AuthLevelID}} 					
					{{#compare AuthLevelID "==" '31'}}
						<a class="btn" title="<?=SETASDRIVER;?>" 
						href="satAsDriver/{{AuthUserID}}">
							<i class="fas fa-external-link"></i>
						</a>
					{{/compare}}
				</div>

				<!-- EMAIL -->
				<div class="col-sm-2 col-xs-12">
					<small>{{AuthUserMail}}</small>
				</div>

				<!-- PHONE -->
				<div class="col-sm-2 col-xs-12">
				<small>
					{{#if AuthUserMob}}
						{{AuthUserMob}}
					{{else}}	
						{{EmergencyPhone}}
					{{/if}}						
				</small>
				</div>

				<!-- MESSAGE: -->
				<div class="col-sm-1">
					{{#compare AuthUserNote "!==" ''}}
						<i class="fa fa-circle text-green"></i>
					{{/compare}}	
				</div>
				
				<!-- Active: -->
				<div class="col-sm-1 col-xs-6">
					{{#compare Active ">" 0}}
						<i class="fa fa-circle text-green"></i>
					{{else}}
						<i class="fa fa-circle text-red"></i>
					{{/compare}}
				</div>

			</div>


		</div>
		

		<div id="ItemWrapper{{AuthUserID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{AuthUserID}}" class="row">
				<div id="one_Item{{AuthUserID}}" >
					<?= THERE_ARE_NO_DATA ?>
				</div>
			</div>
		</div>

	{{/each}}



</script>
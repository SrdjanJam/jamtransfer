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
			<?=AUTHUSER_ID;?>
		</div>
		
		<div class="col-md-2">
			<?=AUTHUSER_LEVEL;?>
		</div>		

		<div class="col-md-2">
			<?=AUTHUSERCOMPANY;?>
		</div>

		<div class="col-md-2">
			<?=EMAIL;?>
		</div>

		<div class="col-md-2">
			<?=TELEPHONE;?>
		</div>

		<div class="col-md-2">
			<?=AUTHUSERNOTE;?>
		</div>
					
	</div>


	{{#each Item}}
		<div  onclick="oneItem({{AuthUserID}});">
		
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
					<div class="col-sm-1 col-xs-6">
						<strong>{{AuthUserName}}</strong>
						<br>
						{{#compare Active ">" 0}}
							<i class="fa fa-circle text-green"></i>
						{{else}}
							<i class="fa fa-circle text-red"></i>
						{{/compare}}
						&nbsp;
						ID: <strong>{{AuthUserID}}</strong> {{DriverID}}
					</div>

					<!-- AUTHUSER_LEVEL -->
					<div class="col-sm-2 col-xs-6">
						{{displayUserLevelText AuthLevelID}} 
					</div>

					<!-- AUTHUSERCOMPANY -->
					<div class="col-sm-2 col-xs-12">
						<strong>{{AuthUserCompany}}</strong>
						<br>
						<small>{{AuthUserRealName}}</small>
						<br>
						<!-- Razmotriti: -->
						<!-- <small>{{Country}} {{Terminal}}</small>						 -->
					</div>

					<!-- EMAIL -->
					<div class="col-sm-2 col-xs-12">
						<a href="index.php?p=quickEmail&EmailAddress={{AuthUserMail}}"  
						class="btn btn-default btn-sm"><i class="fa fa-envelope"></i> {{AuthUserMail}}</a>
					</div>

					<!-- PHONE -->
					<div class="col-sm-2 col-xs-12">
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

					<!-- MESSAGE: -->
					<div class="col-sm-2">
						{{#compare AuthUserNote "!==" ''}}
							<p style="color:#d12020;font-weight:bold;">Message</p>	
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

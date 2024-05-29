<?
	$arr_row['id']=1;
	$arr_row['name']="Operator send";
	$arr_all[]=$arr_row;		
	$arr_row['id']=2;
	$arr_row['name']="System send";
	$arr_all[]=$arr_row;	
	$arr_row['id']=3;
	$arr_row['name']="Received";
	$arr_all[]=$arr_row;
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
	if (!isset($_SESSION['UseDriverID'])) {
		$arr_row2['id']=2;
		$arr_row2['name']="Agents";
		$arr_all2[]=$arr_row2;		
		$arr_row2['id']=31;
		$arr_row2['name']="Drivers";
		$arr_all2[]=$arr_row2;	
		$smarty->assign('options2',$arr_all2);
		$smarty->assign('selecttype2',true);
	}
	
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- LABELS: -->
	<div class="row row-edit">
		<div class="col-md-1"> <?=ID;?> </div>
		<div class="col-md-2"> <?=USERS;?> </div>
		<div class="col-md-2"> <?=SCHEDULE_TIME;?> </div>
		<div class="col-md-1"> <?=SEND_NUMBER;?> </div>
		<div class="col-md-2"> <?=CONFIRM_TIME;?> </div>
		<div class="col-md-1"> <?=STATUS;?> </div>
		<div class="col-md-2"> <?=TITLE;?> </div>	
		<div class="col-md-1">
			<?=SEND;?>/<?=RECEIVE;?>
		</div>		
	</div>
	
	{{#each Item}}
	<!-- MAIN CONTENT: -->
		<div  onclick="oneItem({{ID}});">
			<div class="row {{color}} pad1em listTile listTitleEdit" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
			
				<div class="col-md-1"> {{ID}} </div>
				<div class="col-md-2"> {{DriverName}} </div>
				<div class="col-md-2"> {{ScheduleTime}} </div>
				<div class="col-md-1"> {{SendNumber}} </div>
				<div class="col-md-2"> {{ConfirmTime}} </div>
				<div class="col-sm-1">
					{{#compare Status ">" 0}}
						<i class="fa fa-check text-green"></i>
					{{else}}
						<i class="fa fa-close text-red"></i>
					{{/compare}}
				</div>				<div class="col-md-2"> <strong>{{Title}}</strong> </div>
				<div class="col-md-1">
					{{#compare Direction "==" 1}}
						<i class="fa fa-arrow-circle-o-up fa-xl text-green"></i> <?=SEND;?>
					{{/compare}}	
					{{#compare Direction "==" 2}}
						<i class="fa fa-arrow-circle-o-down fa-xl text-green"></i> <?=RECEIVE;?>
					{{/compare}}
				</div>	
				<div style="background:white; color:black" class="col-md-12"><h2>{{Body}}</h2></div>				
			</div>
		</div>

		<div id="ItemWrapper{{ID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{ID}}" class="row">
				<div id="one_Item{{ID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>


	{{/each}}


</script>



	

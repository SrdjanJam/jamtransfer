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

<!-- LIST: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=MAILID;?>
		</div>

		<div class="col-md-3">
			<?=PARTNER;?>
		</div>
		
		<div class="col-md-3">
			<?=SUBJECT;?>
		</div>

		<div class="col-md-2">
			<?=SENT_TIME;?>
		</div>

		<div class="col-md-1">
			<?=STATUS;?>
		</div>		
		<div class="col-md-1">
			<?=SEND;?>/<?=RECEIVE;?>
		</div>
					
	</div>

<!-- ONE ITEM: -->
	{{#each Item}}
		<div  onclick="oneItem({{MailID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{MailID}}">

			
				<div class="col-sm-1">
					{{MailID}}
				</div>

				<div class="col-sm-3">
					{{UserName}}
				</div>				
				
				<div class="col-sm-3">
					{{{Subject}}}
				</div>
				
				<div class="col-sm-2">
					{{SentTime}}
				</div>

				<div class="col-sm-1">
					{{#compare Status ">" 0}}
						<i class="fa fa-check text-green"></i>
					{{else}}
						<i class="fa fa-close text-red"></i>
					{{/compare}}
				</div>
				<div class="col-md-1">
					{{#compare Direction "==" 1}}
						<i class="fa fa-arrow-circle-o-up fa-xl text-green"></i> <?=SEND;?>
					{{/compare}}	
					{{#compare Direction "==" 2}}
						<i class="fa fa-arrow-circle-o-down fa-xl text-green"></i> <?=RECEIVE;?>
					{{/compare}}
				</div>				
				<!--<div style="background:white; color:black" class="col-md-12"><h4>{{{Body}}}</h4></div>!--->				
			</div>
		</div>
		<div id="ItemWrapper{{MailID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{MailID}}" class="row">
				<div id="one_Item{{MailID}}" >
					<?= LOADING ?>
				</div>
			</div>
		</div>

	{{/each}}


</script>
	

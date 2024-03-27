<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- LABELS: -->
	<div class="row row-edit">
		<div class="col-md-1"> <?=ID;?> </div>
		<div class="col-md-4"> <?=TITLE;?> </div>	
		<!-- <div class="col-md-2"> <?=BODY;?> </div>
		<div class="col-md-2"> <?=USER_ID;?> </div>
		<div class="col-md-1"> <?=SEND_RULE;?> </div>
		<div class="col-md-2"> <?=SCHEDULE_TIME;?> </div>
		<div class="col-md-1"> <?=SEND_TIME_FIRST;?> </div>
		<div class="col-md-1"> <?=SEND_TIME_LAST;?> </div>
		<div class="col-md-1"> <?=CONFIRM_TIME;?> </div>
		<div class="col-md-1"> <?=SEND_NUMBER;?> </div>
		<div class="col-md-1"> <?=STATUS;?> </div> -->
	</div>
	
	{{#each Item}}
	<!-- MAIN CONTENT: -->
		<div  onclick="oneItem({{ID}});">
			<div class="row {{color}} pad1em listTile listTitleEdit" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
			
				<div class="col-md-1"> <strong>{{ID}}</strong> </div>
				<div class="col-md-4"> <strong>{{Title}}</strong> </div>

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



	

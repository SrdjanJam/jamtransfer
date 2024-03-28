<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- LABELS: -->
	<div class="row row-edit">
		<div class="col-md-1"> <?=ID;?> </div>
		<div class="col-md-3"> <?=TITLE;?> </div>	
		<div class="col-md-2"> <?=SUBDRIVERS;?> </div>
		<div class="col-md-2"> <?=SCHEDULE_TIME;?> </div>
		<div class="col-md-2"> <?=CONFIRM_TIME;?> </div>
		<div class="col-md-1"> <?=STATUS;?> </div>
	</div>
	
	{{#each Item}}
	<!-- MAIN CONTENT: -->
		<div  onclick="oneItem({{ID}});">
			<div class="row {{color}} pad1em listTile listTitleEdit" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
			
				<div class="col-md-1"> <strong>{{ID}}</strong> </div>
				<div class="col-md-3"> <strong>{{Title}}</strong> </div>
				<div class="col-md-2"> {{userName UserID "AuthUserRealName"}} </div>
				<div class="col-md-2"> {{ScheduleTime}} </div>
				<div class="col-md-2"> {{ConfirmTime}} </div>
				<div class="col-md-1"> {{Status}} </div>				

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



	

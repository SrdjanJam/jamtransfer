<?
	$smarty->assign('selectactive',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<!-- LABELS: -->
	<div class="row row-edit">
		<div class="col-md-1"> <?=ID;?> </div>
		<div class="col-md-2"> <?=SUBDRIVERS;?> </div>
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
			
				<div class="col-md-1"> <strong>{{ID}}</strong> </div>
				<div class="col-md-2"> {{DriverName}} </div>
				<div class="col-md-2"> {{ScheduleTime}} </div>
				<div class="col-md-1"> {{SendNumber}} </div>
				<div class="col-md-2"> {{ConfirmTime}} </div>
				<div class="col-md-1"> {{Status}} </div>	
				<div class="col-md-2"> <strong>{{Title}}</strong> </div>
				<div class="col-md-1">
					{{#compare Direction "==" 1}}
						<i class="fa fa-arrow-circle-o-up fa-xl text-green"></i> <?=SEND;?>
					{{/compare}}	
					{{#compare Direction "==" 2}}
						<i class="fa fa-arrow-circle-o-down fa-xl text-green"></i> <?=RECEIVE;?>
					{{/compare}}
				</div>					
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



	

<?
	$smarty->assign('selectsolved',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

<!-- LIST: -->
	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=MAILID;?>
		</div>

		<div class="col-md-3">
			<?=CREATE_TIME;?>
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
					{{CreateTime}}
				</div>				
				
				<div class="col-sm-3">
					{{Subject}}
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
	

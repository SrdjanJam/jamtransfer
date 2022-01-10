
<script type="text/x-handlebars-template" id="v4_InvoicesMasterEditTemplate">
<form id="v4_InvoicesMasterEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{ID}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_InvoicesMaster('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_InvoicesMaster('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_InvoicesMaster('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_InvoicesMaster('{{ID}}', '<?= $inList ?>');">
				<i class="ic-print"></i>
				</button>
			<? } ?>	
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ID" id="ID" class="w100" value="{{ID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="InvoiceNumber"><?=INVOICENUMBER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="InvoiceNumber" id="InvoiceNumber" class="w100" value="{{InvoiceNumber}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DateCreated"><?=DATECREATED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DateCreated" id="DateCreated" class="w100" value="{{DateCreated}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DueDate"><?=DUEDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DueDate" id="DueDate" class="w100" value="{{DueDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PartnerID"><?=PARTNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PartnerID" id="PartnerID" class="w100" value="{{PartnerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Instructions"><?=INSTRUCTIONS;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Instructions" id="Instructions" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Instructions}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Subtotal"><?=SUBTOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Subtotal" id="Subtotal" class="w100" value="{{Subtotal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TaxPercent"><?=TAXPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TaxPercent" id="TaxPercent" class="w100" value="{{TaxPercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TaxAmount"><?=TAXAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TaxAmount" id="TaxAmount" class="w100" value="{{TaxAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Total"><?=TOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Total" id="Total" class="w100" value="{{Total}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Currency"><?=CURRENCY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Currency" id="Currency" class="w100" value="{{Currency}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="EURToCurrency"><?=EURTOCURRENCY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="EURToCurrency" id="EURToCurrency" class="w100" value="{{EURToCurrency}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubtotalEUR"><?=SUBTOTALEUR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubtotalEUR" id="SubtotalEUR" class="w100" value="{{SubtotalEUR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TaxAmountEUR"><?=TAXAMOUNTEUR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TaxAmountEUR" id="TaxAmountEUR" class="w100" value="{{TaxAmountEUR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TotalEUR"><?=TOTALEUR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TotalEUR" id="TotalEUR" class="w100" value="{{TotalEUR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Status"><?=STATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Status" id="Status" class="w100" value="{{Status}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CreatorID"><?=CREATORID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CreatorID" id="CreatorID" class="w100" value="{{CreatorID}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_InvoicesMaster('{{ID}}', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>
    	</div>
    	<? } ?>

	</div>
</form>


	<script>

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	</script>
</script>
	
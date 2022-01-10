
<script type="text/x-handlebars-template" id="v4_InvoicesEditTemplate">
<form id="v4_InvoicesEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Invoices('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Invoices('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Invoices('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Invoices('{{ID}}', '<?= $inList ?>');">
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
						<label for="UserID"><?=USERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserID" id="UserID" class="w100" value="{{UserID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Type"><?=TYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Type" id="Type" class="w100" value="{{Type}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="StartDate"><?=STARTDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="StartDate" id="StartDate" class="w100" value="{{StartDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="EndDate"><?=ENDDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="EndDate" id="EndDate" class="w100" value="{{EndDate}}">
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
						<label for="InvoiceDate"><?=INVOICEDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="InvoiceDate" id="InvoiceDate" class="w100" value="{{InvoiceDate}}">
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
						<label for="SumPrice"><?=SUMPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SumPrice" id="SumPrice" class="w100" value="{{SumPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SumSubtotal"><?=SUMSUBTOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SumSubtotal" id="SumSubtotal" class="w100" value="{{SumSubtotal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CommPrice"><?=COMMPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CommPrice" id="CommPrice" class="w100" value="{{CommPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CommSubtotal"><?=COMMSUBTOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CommSubtotal" id="CommSubtotal" class="w100" value="{{CommSubtotal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TotalPriceEUR"><?=TOTALPRICEEUR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TotalPriceEUR" id="TotalPriceEUR" class="w100" value="{{TotalPriceEUR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TotalSubTotalEUR"><?=TOTALSUBTOTALEUR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TotalSubTotalEUR" id="TotalSubTotalEUR" class="w100" value="{{TotalSubTotalEUR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VATNotApp"><?=VATNOTAPP;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VATNotApp" id="VATNotApp" class="w100" value="{{VATNotApp}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VATBaseTotal"><?=VATBASETOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VATBaseTotal" id="VATBaseTotal" class="w100" value="{{VATBaseTotal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VATtotal"><?=VATTOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VATtotal" id="VATtotal" class="w100" value="{{VATtotal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="GrandTotal"><?=GRANDTOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="GrandTotal" id="GrandTotal" class="w100" value="{{GrandTotal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CreatedBy"><?=CREATEDBY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CreatedBy" id="CreatedBy" class="w100" value="{{CreatedBy}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CreatedDate"><?=CREATEDDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CreatedDate" id="CreatedDate" class="w100" value="{{CreatedDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Note"><?=NOTE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Note" id="Note" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Note}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaymentDate"><?=PAYMENTDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaymentDate" id="PaymentDate" class="w100" value="{{PaymentDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaymentAmtEUR"><?=PAYMENTAMTEUR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaymentAmtEUR" id="PaymentAmtEUR" class="w100" value="{{PaymentAmtEUR}}">
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


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Invoices('{{ID}}', '<?= $inList ?>');">
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
	
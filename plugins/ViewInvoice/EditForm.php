<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<button class="btn btn-warning" title="<?= CLOSE?>" 
			onclick="return editCloseItem('{{ID}}');">
			<i class="fa fa-close"></i>
			</button>

			<button class="btn btn-danger" title="<?= CANCEL ?>" 
			onclick="return deleteItem('{{ID}}');">
			<i class="fa fa-ban"></i>
			</button>
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{ID}}');">
			<i class="fa fa-save"></i>
			</button>
			{{#compare Type "==" 1}}
			<a href="/pdf/RA_{{replaceChars InvoiceNumber "/" "-"}}.pdf" 
			class="btn btn-danger" title="<?= PRINTIT ?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> Agent
			</a>
			<a href="/pdf/RK_{{replaceChars InvoiceNumber "/" "-"}}.pdf" 
			class="btn btn-success" title="<?= PRINTIT ?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> Knjig.
			</a>			
			{{/compare}}
			{{#compare Type "==" 2}}

			<a href="/pdf/RD_{{replaceChars InvoiceNumber "/" "-"}}.pdf"  
			class="btn btn-danger" title="<?= PRINTIT ?>" target="_blank">
			<i class="fa fa-file-pdf-o"></i> Driver
			</a>
			
			{{/compare}}				
			
		</div>
	</div>
	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row hidden">
					<div class="col-md-3">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						{{ID}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="UserID"><?=USER;?></label>
					</div>
					<div class="col-md-9">
						<input type="hidden" name="UserID" id="UserID" class="w100" value="{{UserID}}">
						{{userName UserID "AuthUserCompany"}}
					</div>
				</div>

				<div class="row hidden">
					<div class="col-md-3">
						<label for="Type"><?=TYPE;?></label>
					</div>
					<div class="col-md-9">
						{{Type}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="StartDate"><?=STARTDATE;?></label>
					</div>
					<div class="col-md-9">
						{{StartDate}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="EndDate"><?=ENDDATE;?></label>
					</div>
					<div class="col-md-9">
						{{EndDate}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="InvoiceNumber"><?=INVOICENUMBER;?></label>
					</div>
					<div class="col-md-9">
						{{InvoiceNumber}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="InvoiceDate"><?=INVOICEDATE;?></label>
					</div>
					<div class="col-md-9">
						<? if(isset($_SESSION['AuthUserID']) and $_SESSION['AuthUserID'] == 2146){?>
							<input type="text" name="InvoiceDate" id="InvoiceDate" value="{{InvoiceDate}}"/>
						<?} else {?>
							{{InvoiceDate}}
						<?}?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Status"><?=PAID;?></label>
					</div>
					<div class="col-md-9">
						{{#compare Type "==" 1}}
						{{paymentStatusSelect Status}} 
						{{else}}
						{{driverPaymentSelect Status}} 		 				
						{{/compare}} 
						<!--{{yesNoSelect Status 'Status' }}!-->
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="AmountEUR"><?=AMOUNTEUR;?></label>
					</div>
					<div class="col-md-9">
						{{GrandTotal}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="VATtotal"><?=VATTOTAL;?></label>
					</div>
					<div class="col-md-9">
						{{VATtotal}}
					</div>
				</div>
			</div>		
	    </div>
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


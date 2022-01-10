
<script type="text/x-handlebars-template" id="v4_CustomersEditTemplate">
<form id="v4_CustomersEditForm{{CustID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Customers('{{CustID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Customers('{{CustID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Customers('{{CustID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Customers('{{CustID}}', '<?= $inList ?>');">
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
						<label for="Site"><?=SITE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Site" id="Site" class="w100" value="{{Site}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustID"><?=CUSTID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustID" id="CustID" class="w100" value="{{CustID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustType"><?=CUSTTYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustType" id="CustType" class="w100" value="{{CustType}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustFirstName"><?=CUSTFIRSTNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustFirstName" id="CustFirstName" class="w100" value="{{CustFirstName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustLastName"><?=CUSTLASTNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustLastName" id="CustLastName" class="w100" value="{{CustLastName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustCountry"><?=CUSTCOUNTRY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustCountry" id="CustCountry" class="w100" value="{{CustCountry}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustLanguage"><?=CUSTLANGUAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustLanguage" id="CustLanguage" class="w100" value="{{CustLanguage}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustEmail"><?=CUSTEMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustEmail" id="CustEmail" class="w100" value="{{CustEmail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustAddress"><?=CUSTADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustAddress" id="CustAddress" class="w100" value="{{CustAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustCity"><?=CUSTCITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustCity" id="CustCity" class="w100" value="{{CustCity}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustZip"><?=CUSTZIP;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustZip" id="CustZip" class="w100" value="{{CustZip}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustMobile"><?=CUSTMOBILE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustMobile" id="CustMobile" class="w100" value="{{CustMobile}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustPass"><?=CUSTPASS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustPass" id="CustPass" class="w100" value="{{CustPass}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustSubscribed"><?=CUSTSUBSCRIBED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustSubscribed" id="CustSubscribed" class="w100" value="{{CustSubscribed}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustActive"><?=CUSTACTIVE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustActive" id="CustActive" class="w100" value="{{CustActive}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustImage"><?=CUSTIMAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustImage" id="CustImage" class="w100" value="{{CustImage}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustImageType"><?=CUSTIMAGETYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustImageType" id="CustImageType" class="w100" value="{{CustImageType}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Customers('{{CustID}}', '<?= $inList ?>');">
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
	
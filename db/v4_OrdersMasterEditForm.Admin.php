
<script type="text/x-handlebars-template" id="v4_OrdersMasterEditTemplate">
<form id="v4_OrdersMasterEditForm{{MOrderID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_OrdersMaster('{{MOrderID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_OrdersMaster('{{MOrderID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_OrdersMaster('{{MOrderID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_OrdersMaster('{{MOrderID}}', '<?= $inList ?>');">
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
						<label for="SiteID"><?=SITEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SiteID" id="SiteID" class="w100" value="{{SiteID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderKey"><?=MORDERKEY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderKey" id="MOrderKey" class="w100" value="{{MOrderKey}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderID"><?=MORDERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderID" id="MOrderID" class="w100" value="{{MOrderID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderStatus"><?=MORDERSTATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderStatus" id="MOrderStatus" class="w100" value="{{MOrderStatus}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderType"><?=MORDERTYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderType" id="MOrderType" class="w100" value="{{MOrderType}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderDate"><?=MORDERDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderDate" id="MOrderDate" class="w100" value="{{MOrderDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderTime"><?=MORDERTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderTime" id="MOrderTime" class="w100" value="{{MOrderTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MUserID"><?=MUSERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MUserID" id="MUserID" class="w100" value="{{MUserID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MUserLevelID"><?=MUSERLEVELID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MUserLevelID" id="MUserLevelID" class="w100" value="{{MUserLevelID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MTransferPrice"><?=MTRANSFERPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MTransferPrice" id="MTransferPrice" class="w100" value="{{MTransferPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MDriverExtrasPrice"><?=MDRIVEREXTRASPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MDriverExtrasPrice" id="MDriverExtrasPrice" class="w100" value="{{MDriverExtrasPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MProvision"><?=MPROVISION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MProvision" id="MProvision" class="w100" value="{{MProvision}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MExtrasPrice"><?=MEXTRASPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MExtrasPrice" id="MExtrasPrice" class="w100" value="{{MExtrasPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderPriceEUR"><?=MORDERPRICEEUR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderPriceEUR" id="MOrderPriceEUR" class="w100" value="{{MOrderPriceEUR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MEurToCurrencyRate"><?=MEURTOCURRENCYRATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MEurToCurrencyRate" id="MEurToCurrencyRate" class="w100" value="{{MEurToCurrencyRate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderCurrencyPrice"><?=MORDERCURRENCYPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderCurrencyPrice" id="MOrderCurrencyPrice" class="w100" value="{{MOrderCurrencyPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderCurrency"><?=MORDERCURRENCY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderCurrency" id="MOrderCurrency" class="w100" value="{{MOrderCurrency}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPaymentMethod"><?=MPAYMENTMETHOD;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPaymentMethod" id="MPaymentMethod" class="w100" value="{{MPaymentMethod}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPaymentStatus"><?=MPAYMENTSTATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPaymentStatus" id="MPaymentStatus" class="w100" value="{{MPaymentStatus}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPayNow"><?=MPAYNOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPayNow" id="MPayNow" class="w100" value="{{MPayNow}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPayLater"><?=MPAYLATER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPayLater" id="MPayLater" class="w100" value="{{MPayLater}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MInvoiceAmount"><?=MINVOICEAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MInvoiceAmount" id="MInvoiceAmount" class="w100" value="{{MInvoiceAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MAgentCommision"><?=MAGENTCOMMISION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MAgentCommision" id="MAgentCommision" class="w100" value="{{MAgentCommision}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCustomerID"><?=MCUSTOMERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCustomerID" id="MCustomerID" class="w100" value="{{MCustomerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPaxFirstName"><?=MPAXFIRSTNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPaxFirstName" id="MPaxFirstName" class="w100" value="{{MPaxFirstName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPaxLastName"><?=MPAXLASTNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPaxLastName" id="MPaxLastName" class="w100" value="{{MPaxLastName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPaxTel"><?=MPAXTEL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPaxTel" id="MPaxTel" class="w100" value="{{MPaxTel}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MPaxEmail"><?=MPAXEMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPaxEmail" id="MPaxEmail" class="w100" value="{{MPaxEmail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardType"><?=MCARDTYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardType" id="MCardType" class="w100" value="{{MCardType}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardFirstName"><?=MCARDFIRSTNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardFirstName" id="MCardFirstName" class="w100" value="{{MCardFirstName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardLastName"><?=MCARDLASTNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardLastName" id="MCardLastName" class="w100" value="{{MCardLastName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardEmail"><?=MCARDEMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardEmail" id="MCardEmail" class="w100" value="{{MCardEmail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardTel"><?=MCARDTEL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardTel" id="MCardTel" class="w100" value="{{MCardTel}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardAddress"><?=MCARDADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardAddress" id="MCardAddress" class="w100" value="{{MCardAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardCity"><?=MCARDCITY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardCity" id="MCardCity" class="w100" value="{{MCardCity}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardZip"><?=MCARDZIP;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardZip" id="MCardZip" class="w100" value="{{MCardZip}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardCountry"><?=MCARDCOUNTRY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardCountry" id="MCardCountry" class="w100" value="{{MCardCountry}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardNumber"><?=MCARDNUMBER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardNumber" id="MCardNumber" class="w100" value="{{MCardNumber}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardCVD"><?=MCARDCVD;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardCVD" id="MCardCVD" class="w100" value="{{MCardCVD}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCardExpDate"><?=MCARDEXPDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCardExpDate" id="MCardExpDate" class="w100" value="{{MCardExpDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MConfirmFile"><?=MCONFIRMFILE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MConfirmFile" id="MConfirmFile" class="w100" value="{{MConfirmFile}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCancelFile"><?=MCANCELFILE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCancelFile" id="MCancelFile" class="w100" value="{{MCancelFile}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MChangeFile"><?=MCHANGEFILE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MChangeFile" id="MChangeFile" class="w100" value="{{MChangeFile}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MSubscribe"><?=MSUBSCRIBE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MSubscribe" id="MSubscribe" class="w100" value="{{MSubscribe}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MAcceptTerms"><?=MACCEPTTERMS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MAcceptTerms" id="MAcceptTerms" class="w100" value="{{MAcceptTerms}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MSendEmail"><?=MSENDEMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MSendEmail" id="MSendEmail" class="w100" value="{{MSendEmail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MEmailSentDate"><?=MEMAILSENTDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MEmailSentDate" id="MEmailSentDate" class="w100" value="{{MEmailSentDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MCustomerIP"><?=MCUSTOMERIP;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MCustomerIP" id="MCustomerIP" class="w100" value="{{MCustomerIP}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MOrderLang"><?=MORDERLANG;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MOrderLang" id="MOrderLang" class="w100" value="{{MOrderLang}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_OrdersMaster('{{MOrderID}}', '<?= $inList ?>');">
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
	
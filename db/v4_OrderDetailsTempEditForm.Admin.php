
<script type="text/x-handlebars-template" id="v4_OrderDetailsTempEditTemplate">
<form id="v4_OrderDetailsTempEditForm{{DetailsID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_OrderDetailsTemp('{{DetailsID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_OrderDetailsTemp('{{DetailsID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_OrderDetailsTemp('{{DetailsID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_OrderDetailsTemp('{{DetailsID}}', '<?= $inList ?>');">
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
						<label for="DetailsID"><?=DETAILSID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DetailsID" id="DetailsID" class="w100" value="{{DetailsID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="OrderID"><?=ORDERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OrderID" id="OrderID" class="w100" value="{{OrderID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TNo"><?=TNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TNo" id="TNo" class="w100" value="{{TNo}}">
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
						<label for="UserLevelID"><?=USERLEVELID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserLevelID" id="UserLevelID" class="w100" value="{{UserLevelID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="AgentID"><?=AGENTID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="AgentID" id="AgentID" class="w100" value="{{AgentID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CustomerID"><?=CUSTOMERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CustomerID" id="CustomerID" class="w100" value="{{CustomerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TransferStatus"><?=TRANSFERSTATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TransferStatus" id="TransferStatus" class="w100" value="{{TransferStatus}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="OrderDate"><?=ORDERDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OrderDate" id="OrderDate" class="w100" value="{{OrderDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TaxidoComm"><?=TAXIDOCOMM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TaxidoComm" id="TaxidoComm" class="w100" value="{{TaxidoComm}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ServiceID"><?=SERVICEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ServiceID" id="ServiceID" class="w100" value="{{ServiceID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="RouteID"><?=ROUTEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FlightNo"><?=FLIGHTNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FlightNo" id="FlightNo" class="w100" value="{{FlightNo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FlightTime"><?=FLIGHTTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FlightTime" id="FlightTime" class="w100" value="{{FlightTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaxName"><?=PAXNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaxName" id="PaxName" class="w100" value="{{PaxName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupID"><?=PICKUPID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupID" id="PickupID" class="w100" value="{{PickupID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupName"><?=PICKUPNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupName" id="PickupName" class="w100" value="{{PickupName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupPlace"><?=PICKUPPLACE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupPlace" id="PickupPlace" class="w100" value="{{PickupPlace}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupAddress"><?=PICKUPADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupAddress" id="PickupAddress" class="w100" value="{{PickupAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupDate"><?=PICKUPDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupDate" id="PickupDate" class="w100" value="{{PickupDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupTime"><?=PICKUPTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PickupTime" id="PickupTime" class="w100" value="{{PickupTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PickupNotes"><?=PICKUPNOTES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="PickupNotes" id="PickupNotes" rows="5" 
					class="textarea" cols="50" style="width:100%">{{PickupNotes}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropID"><?=DROPID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DropID" id="DropID" class="w100" value="{{DropID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropName"><?=DROPNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DropName" id="DropName" class="w100" value="{{DropName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropPlace"><?=DROPPLACE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DropPlace" id="DropPlace" class="w100" value="{{DropPlace}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropAddress"><?=DROPADDRESS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DropAddress" id="DropAddress" class="w100" value="{{DropAddress}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DropNotes"><?=DROPNOTES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DropNotes" id="DropNotes" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DropNotes}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PriceClassID"><?=PRICECLASSID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PriceClassID" id="PriceClassID" class="w100" value="{{PriceClassID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DetailPrice"><?=DETAILPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DetailPrice" id="DetailPrice" class="w100" value="{{DetailPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriversPrice"><?=DRIVERSPRICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriversPrice" id="DriversPrice" class="w100" value="{{DriversPrice}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Discount"><?=DISCOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Discount" id="Discount" class="w100" value="{{Discount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ExtraCharge"><?=EXTRACHARGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ExtraCharge" id="ExtraCharge" class="w100" value="{{ExtraCharge}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaymentMethod"><?=PAYMENTMETHOD;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaymentMethod" id="PaymentMethod" class="w100" value="{{PaymentMethod}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaymentStatus"><?=PAYMENTSTATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaymentStatus" id="PaymentStatus" class="w100" value="{{PaymentStatus}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PayNow"><?=PAYNOW;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PayNow" id="PayNow" class="w100" value="{{PayNow}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PayLater"><?=PAYLATER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PayLater" id="PayLater" class="w100" value="{{PayLater}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="InvoiceAmount"><?=INVOICEAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="InvoiceAmount" id="InvoiceAmount" class="w100" value="{{InvoiceAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ProvisionAmount"><?=PROVISIONAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ProvisionAmount" id="ProvisionAmount" class="w100" value="{{ProvisionAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PaxNo"><?=PAXNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PaxNo" id="PaxNo" class="w100" value="{{PaxNo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehiclesNo"><?=VEHICLESNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehiclesNo" id="VehiclesNo" class="w100" value="{{VehiclesNo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleType"><?=VEHICLETYPE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleType" id="VehicleType" class="w100" value="{{VehicleType}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="VehicleID"><?=VEHICLEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="VehicleID" id="VehicleID" class="w100" value="{{VehicleID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverID"><?=DRIVERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverID" id="DriverID" class="w100" value="{{DriverID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverName"><?=DRIVERNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverName" id="DriverName" class="w100" value="{{DriverName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverEmail"><?=DRIVEREMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverEmail" id="DriverEmail" class="w100" value="{{DriverEmail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverTel"><?=DRIVERTEL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverTel" id="DriverTel" class="w100" value="{{DriverTel}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverConfStatus"><?=DRIVERCONFSTATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverConfStatus" id="DriverConfStatus" class="w100" value="{{DriverConfStatus}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverConfDate"><?=DRIVERCONFDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverConfDate" id="DriverConfDate" class="w100" value="{{DriverConfDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverConfTime"><?=DRIVERCONFTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverConfTime" id="DriverConfTime" class="w100" value="{{DriverConfTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverNotes"><?=DRIVERNOTES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="DriverNotes" id="DriverNotes" rows="5" 
					class="textarea" cols="50" style="width:100%">{{DriverNotes}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverPayment"><?=DRIVERPAYMENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverPayment" id="DriverPayment" class="w100" value="{{DriverPayment}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverPaymentAmt"><?=DRIVERPAYMENTAMT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverPaymentAmt" id="DriverPaymentAmt" class="w100" value="{{DriverPaymentAmt}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Rated"><?=RATED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Rated" id="Rated" class="w100" value="{{Rated}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverPickupDate"><?=DRIVERPICKUPDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverPickupDate" id="DriverPickupDate" class="w100" value="{{DriverPickupDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverPickupTime"><?=DRIVERPICKUPTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverPickupTime" id="DriverPickupTime" class="w100" value="{{DriverPickupTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubDriver"><?=SUBDRIVER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubDriver" id="SubDriver" class="w100" value="{{SubDriver}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Car"><?=CAR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Car" id="Car" class="w100" value="{{Car}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubDriver2"><?=SUBDRIVER2;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubDriver2" id="SubDriver2" class="w100" value="{{SubDriver2}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Car2"><?=CAR2;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Car2" id="Car2" class="w100" value="{{Car2}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubDriver3"><?=SUBDRIVER3;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubDriver3" id="SubDriver3" class="w100" value="{{SubDriver3}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Car3"><?=CAR3;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Car3" id="Car3" class="w100" value="{{Car3}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubPickupDate"><?=SUBPICKUPDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubPickupDate" id="SubPickupDate" class="w100" value="{{SubPickupDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubPickupTime"><?=SUBPICKUPTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubPickupTime" id="SubPickupTime" class="w100" value="{{SubPickupTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubFlightNo"><?=SUBFLIGHTNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubFlightNo" id="SubFlightNo" class="w100" value="{{SubFlightNo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubFlightTime"><?=SUBFLIGHTTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SubFlightTime" id="SubFlightTime" class="w100" value="{{SubFlightTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TransferDuration"><?=TRANSFERDURATION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TransferDuration" id="TransferDuration" class="w100" value="{{TransferDuration}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="PDFFile"><?=PDFFILE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="PDFFile" id="PDFFile" class="w100" value="{{PDFFile}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Extras"><?=EXTRAS;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Extras" id="Extras" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Extras}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubDriverNote"><?=SUBDRIVERNOTE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="SubDriverNote" id="SubDriverNote" rows="5" 
					class="textarea" cols="50" style="width:100%">{{SubDriverNote}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="StaffNote"><?=STAFFNOTE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="StaffNote" id="StaffNote" rows="5" 
					class="textarea" cols="50" style="width:100%">{{StaffNote}}</textarea>
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
						<label for="DriverInvoiceNumber"><?=DRIVERINVOICENUMBER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverInvoiceNumber" id="DriverInvoiceNumber" class="w100" value="{{DriverInvoiceNumber}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverInvoiceDate"><?=DRIVERINVOICEDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverInvoiceDate" id="DriverInvoiceDate" class="w100" value="{{DriverInvoiceDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="CashIn"><?=CASHIN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CashIn" id="CashIn" class="w100" value="{{CashIn}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FinalNote"><?=FINALNOTE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="FinalNote" id="FinalNote" rows="5" 
					class="textarea" cols="50" style="width:100%">{{FinalNote}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SubFinalNote"><?=SUBFINALNOTE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="SubFinalNote" id="SubFinalNote" rows="5" 
					class="textarea" cols="50" style="width:100%">{{SubFinalNote}}</textarea>
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_OrderDetailsTemp('{{DetailsID}}', '<?= $inList ?>');">
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
	

<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//

	var data_v4_OrderDetails = [];
	function all_v4_OrderDetails() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	//var status = $("#UserLevel").val(); // prikazuje samo Usere sa levelom
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'all_v4_OrderDetailsFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = WEBSITEURL + '/cms/p/modules/v4_OrderDetails/v4_OrderDetails_All.php?where='+where+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&callback=?';

		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(v4_OrderDetailsData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o transferima
			  var data = v4_OrderDetailsData.data;
			  recordsTotal = v4_OrderDetailsData.recordsTotal;
		
			  paginator(page,recordsTotal,length, callFunction);
			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
			  });

				data_v4_OrderDetails = data;
			
				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#v4_OrderDetailsListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({v4_OrderDetails : data_v4_OrderDetails});

				$("#show_v4_OrderDetails").html(HTML);
		  },
		  error: function() { alert('Get error occured.');}

		});

	}


	function one_v4_OrderDetails(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#v4_OrderDetailsWrapper"+id).css('display') != 'none') {$("#v4_OrderDetailsWrapper"+id).hide('slow'); return;}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = WEBSITEURL + '/cms/p/modules/v4_OrderDetails/v4_OrderDetails_One.php?DetailsID='+id;

		// sakrij sve ostale elemente prije nego se otvori novi
		if(inList==true) { $(".editFrame").hide('slow'); $(".editFrame form").html('');}

		// idemo po podatke
		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',
			success: function(data) {

				// CUSTOM STUFF
				if(inList==true) {
					$.each(data, function(i, item) {
						data[i].color ='white';
					});
				}

				var source   = $("#v4_OrderDetailsEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#t_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#one_v4_OrderDetails"+id).html(HTML);

				$("#v4_OrderDetailsWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}


	function new_v4_OrderDetails() { 
		var data = {

	 			SiteID: '',
	 			DetailsID: '',
	 			OrderID: '',
	 			TNo: '',
	 			UserID: '',
	 			UserLevelID: '',
	 			AgentID: '',
	 			CustomerID: '',
	 			TransferStatus: '',
	 			OrderDate: '',
	 			TaxidoComm: '',
	 			ServiceID: '',
	 			RouteID: '',
	 			FlightNo: '',
	 			FlightTime: '',
	 			PaxName: '',
	 			PickupID: '',
	 			PickupName: '',
	 			PickupPlace: '',
	 			PickupAddress: '',
	 			PickupDate: '',
	 			PickupTime: '',
	 			PickupNotes: '',
	 			DropID: '',
	 			DropName: '',
	 			DropPlace: '',
	 			DropAddress: '',
	 			DropNotes: '',
	 			PriceClassID: '',
	 			DetailPrice: '',
	 			DriversPrice: '',
	 			Discount: '',
	 			ExtraCharge: '',
	 			DriverExtraCharge: '',
	 			Provision: '',
	 			PaymentMethod: '',
	 			PaymentStatus: '',
	 			PayNow: '',
	 			PayLater: '',
	 			InvoiceAmount: '',
	 			ProvisionAmount: '',
	 			PaxNo: '',
	 			VehiclesNo: '',
	 			VehicleType: '',
	 			VehicleID: '',
	 			DriverID: '',
	 			DriverName: '',
	 			DriverEmail: '',
	 			DriverTel: '',
	 			DriverConfStatus: '',
	 			DriverConfDate: '',
	 			DriverConfTime: '',
	 			DriverNotes: '',
	 			DriverPayment: '',
	 			DriverPaymentAmt: '',
	 			Rated: '',
	 			DriverPickupDate: '',
	 			DriverPickupTime: '',
	 			SubDriver: '',
	 			Car: '',
	 			SubDriver2: '',
	 			Car2: '',
	 			SubDriver3: '',
	 			Car3: '',
	 			SubPickupDate: '',
	 			SubPickupTime: '',
	 			SubFlightNo: '',
	 			SubFlightTime: '',
	 			TransferDuration: '',
	 			PDFFile: '',
	 			Extras: '',
	 			SubDriverNote: '',
	 			StaffNote: '',
	 			InvoiceNumber: '',
	 			InvoiceDate: '',
	 			DriverInvoiceNumber: '',
	 			DriverInvoiceDate: '',
	 			CashIn: '',
	 			FinalNote: '',
	 			SubFinalNote: ''
			};
				var source   = $("#v4_OrderDetailsEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data);

				$("#new_v4_OrderDetails").html(HTML);

				$("#v4_OrderDetailsWrapperNew").show('slow');

	}


	function editClosev4_OrderDetails(id, inList) {
		if (notDefined(inList)) {inList=true;}
		if (inList==true) { $(".editFrame").hide('slow');$(".editFrame form").html(''); }
		return false;
	}

	function editSavev4_OrderDetails(id, inList) { 
	
		if($("#v4_OrderDetailsEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_OrderDetailsEditForm"+id).serializeObject();
		var formData = $("#v4_OrderDetailsEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_OrderDetails/'+
		'v4_OrderDetails_Save.php?callback=?&keyName=DetailsID&keyValue='+id+'&'+ formData;
	
		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data, status) {

				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

				// osvjezi podatke na ekranu za zadani element
				if (inList==true) {
					refreshv4_OrderDetailsData(id, newData);
					$(".editFrame").hide('slow');
					$(".editFrame form").html('');
				}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}

	function deletev4_OrderDetails(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_OrderDetailsEditForm"+id).serializeObject();
		var formData = $("#v4_OrderDetailsEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_OrderDetails/'+
		'v4_OrderDetails_Delete.php?DetailsID='+ id+'&'+formData+'&callback=?';
	
		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data) {

				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

				// osvjezi podatke na ekranu za zadani element
				if (inList==true) {
					all_v4_OrderDetails();
					//refreshUserData(id, newData);
				}
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});

		return false;
	}


	function editPrintv4_OrderDetails(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

	  	if(inList==true) { $(".editFrame").hide('slow'); $(".editFrame form").html('');}
	  	alert('Printed');
	  	
	  return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshv4_OrderDetailsData(id, newData) {

	  var result = $.grep(data_v4_OrderDetails, function(e){ return e.DetailsID == id; });

	  if (result.length == 0) {
		// not found
	  } else if (result.length == 1) {

		    // ovo je u biti slog datoteke - result[0]
		    //result[0].PaxName = $("#PassengerName").val();
		    //result[0].PickupName = $("#PassengerName").val();


		    // ovdje je trik za referncu kroz ime varijable

		    // najprije napraviti novi objekt - jer ovaj vec ima [0] ...
		    var ress = result[0];


		    $.each(newData,function(name, value){
		    	// ... onda se moze pristupiti pojedninacnoj vrijednosti preko varijable
		    	ress[name] = value;
		    });

		    ress.color = 'orange-2';

		    changeall_v4_OrderDetails(id, ress);

		    data = data_v4_OrderDetails;

		    var source   = $("#v4_OrderDetailsListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({v4_OrderDetails : data});

		    $("#show_v4_OrderDetails").html(HTML);

	  } else {
		// multiple items found
	  }

	}

	/* promjena cijelog sloga datoteke odjednom */
	function changeall_v4_OrderDetails( id, sve ) {
	   for (var i in data_v4_OrderDetails) {
		 if (data_v4_OrderDetails[i].DetailsID == id) {
		    data_v4_OrderDetails[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
</script>			
		

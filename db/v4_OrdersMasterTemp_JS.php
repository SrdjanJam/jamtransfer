
<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//

	var data_v4_OrdersMasterTemp = [];
	function all_v4_OrdersMasterTemp() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	//var status = $("#UserLevel").val(); // prikazuje samo Usere sa levelom
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'all_v4_OrdersMasterTempFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = WEBSITEURL + '/cms/p/modules/v4_OrdersMasterTemp/v4_OrdersMasterTemp_All.php?where='+where+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&callback=?';

		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(v4_OrdersMasterTempData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o transferima
			  var data = v4_OrdersMasterTempData.data;
			  recordsTotal = v4_OrdersMasterTempData.recordsTotal;
		
			  paginator(page,recordsTotal,length, callFunction);
			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
			  });

				data_v4_OrdersMasterTemp = data;
			
				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#v4_OrdersMasterTempListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({v4_OrdersMasterTemp : data_v4_OrdersMasterTemp});

				$("#show_v4_OrdersMasterTemp").html(HTML);
		  },
		  error: function() { alert('Get error occured.');}

		});

	}


	function one_v4_OrdersMasterTemp(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#v4_OrdersMasterTempWrapper"+id).css('display') != 'none') {$("#v4_OrdersMasterTempWrapper"+id).hide('slow'); return;}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = WEBSITEURL + '/cms/p/modules/v4_OrdersMasterTemp/v4_OrdersMasterTemp_One.php?MOrderID='+id;

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

				var source   = $("#v4_OrdersMasterTempEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#t_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#one_v4_OrdersMasterTemp"+id).html(HTML);

				$("#v4_OrdersMasterTempWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}


	function new_v4_OrdersMasterTemp() { 
		var data = {

	 			SiteID: '',
	 			MOrderKey: '',
	 			MOrderID: '',
	 			MOrderStatus: '',
	 			MOrderType: '',
	 			MOrderDate: '',
	 			MOrderTime: '',
	 			MUserID: '',
	 			MUserLevelID: '',
	 			MTransferPrice: '',
	 			MDriverExtrasPrice: '',
	 			MProvision: '',
	 			MExtrasPrice: '',
	 			MOrderPriceEUR: '',
	 			MEurToCurrencyRate: '',
	 			MOrderCurrencyPrice: '',
	 			MOrderCurrency: '',
	 			MPaymentMethod: '',
	 			MPaymentStatus: '',
	 			MPayNow: '',
	 			MPayLater: '',
	 			MInvoiceAmount: '',
	 			MAgentCommision: '',
	 			MCustomerID: '',
	 			MPaxFirstName: '',
	 			MPaxLastName: '',
	 			MPaxTel: '',
	 			MPaxEmail: '',
	 			MCardType: '',
	 			MCardFirstName: '',
	 			MCardLastName: '',
	 			MCardEmail: '',
	 			MCardTel: '',
	 			MCardAddress: '',
	 			MCardCity: '',
	 			MCardZip: '',
	 			MCardCountry: '',
	 			MCardNumber: '',
	 			MCardCVD: '',
	 			MCardExpDate: '',
	 			MConfirmFile: '',
	 			MCancelFile: '',
	 			MChangeFile: '',
	 			MSubscribe: '',
	 			MAcceptTerms: '',
	 			MSendEmail: '',
	 			MEmailSentDate: '',
	 			MCustomerIP: '',
	 			MOrderLang: ''
			};
				var source   = $("#v4_OrdersMasterTempEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data);

				$("#new_v4_OrdersMasterTemp").html(HTML);

				$("#v4_OrdersMasterTempWrapperNew").show('slow');

	}


	function editClosev4_OrdersMasterTemp(id, inList) {
		if (notDefined(inList)) {inList=true;}
		if (inList==true) { $(".editFrame").hide('slow');$(".editFrame form").html(''); }
		return false;
	}

	function editSavev4_OrdersMasterTemp(id, inList) { 
	
		if($("#v4_OrdersMasterTempEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_OrdersMasterTempEditForm"+id).serializeObject();
		var formData = $("#v4_OrdersMasterTempEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_OrdersMasterTemp/'+
		'v4_OrdersMasterTemp_Save.php?callback=?&keyName=MOrderID&keyValue='+id+'&'+ formData;
	
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
					refreshv4_OrdersMasterTempData(id, newData);
					$(".editFrame").hide('slow');
					$(".editFrame form").html('');
				}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}

	function deletev4_OrdersMasterTemp(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_OrdersMasterTempEditForm"+id).serializeObject();
		var formData = $("#v4_OrdersMasterTempEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_OrdersMasterTemp/'+
		'v4_OrdersMasterTemp_Delete.php?MOrderID='+ id+'&'+formData+'&callback=?';
	
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
					all_v4_OrdersMasterTemp();
					//refreshUserData(id, newData);
				}
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});

		return false;
	}


	function editPrintv4_OrdersMasterTemp(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

	  	if(inList==true) { $(".editFrame").hide('slow'); $(".editFrame form").html('');}
	  	alert('Printed');
	  	
	  return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshv4_OrdersMasterTempData(id, newData) {

	  var result = $.grep(data_v4_OrdersMasterTemp, function(e){ return e.MOrderID == id; });

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

		    changeall_v4_OrdersMasterTemp(id, ress);

		    data = data_v4_OrdersMasterTemp;

		    var source   = $("#v4_OrdersMasterTempListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({v4_OrdersMasterTemp : data});

		    $("#show_v4_OrdersMasterTemp").html(HTML);

	  } else {
		// multiple items found
	  }

	}

	/* promjena cijelog sloga datoteke odjednom */
	function changeall_v4_OrdersMasterTemp( id, sve ) {
	   for (var i in data_v4_OrdersMasterTemp) {
		 if (data_v4_OrdersMasterTemp[i].MOrderID == id) {
		    data_v4_OrdersMasterTemp[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
</script>			
		

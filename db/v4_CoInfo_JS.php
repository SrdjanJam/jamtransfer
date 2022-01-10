
<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//

	var data_v4_CoInfo = [];
	function all_v4_CoInfo() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	//var status = $("#UserLevel").val(); // prikazuje samo Usere sa levelom
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'all_v4_CoInfoFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = WEBSITEURL + '/cms/p/modules/v4_CoInfo/v4_CoInfo_All.php?where='+where+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&callback=?';

		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(v4_CoInfoData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o transferima
			  var data = v4_CoInfoData.data;
			  recordsTotal = v4_CoInfoData.recordsTotal;
		
			  paginator(page,recordsTotal,length, callFunction);
			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
			  });

				data_v4_CoInfo = data;
			
				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#v4_CoInfoListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({v4_CoInfo : data_v4_CoInfo});

				$("#show_v4_CoInfo").html(HTML);
		  },
		  error: function() { alert('Get error occured.');}

		});

	}


	function one_v4_CoInfo(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#v4_CoInfoWrapper"+id).css('display') != 'none') {$("#v4_CoInfoWrapper"+id).hide('slow'); return;}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = WEBSITEURL + '/cms/p/modules/v4_CoInfo/v4_CoInfo_One.php?ID='+id;

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

				var source   = $("#v4_CoInfoEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#t_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#one_v4_CoInfo"+id).html(HTML);

				$("#v4_CoInfoWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}


	function new_v4_CoInfo() { 
		var data = {

	 			ID: '',
	 			co_name: '',
	 			co_address: '',
	 			co_tel: '',
	 			co_fax: '',
	 			co_city: '',
	 			co_country: '',
	 			co_zip: '',
	 			co_email: '',
	 			co_taxno: '',
	 			co_bank: '',
	 			co_accountno: '',
	 			co_iban: '',
	 			co_swift: '',
	 			co_domestictax: '',
	 			co_foreigntax: '',
	 			co_eurinfo: '',
	 			co_paymentinfo: '',
	 			co_facebook: '',
	 			co_twitter: '',
	 			co_linkedin: '',
	 			co_youtube: '',
	 			co_googleplus: '',
	 			co_todo: ''
			};
				var source   = $("#v4_CoInfoEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data);

				$("#new_v4_CoInfo").html(HTML);

				$("#v4_CoInfoWrapperNew").show('slow');

	}


	function editClosev4_CoInfo(id, inList) {
		if (notDefined(inList)) {inList=true;}
		if (inList==true) { $(".editFrame").hide('slow');$(".editFrame form").html(''); }
		return false;
	}

	function editSavev4_CoInfo(id, inList) { 
	
		if($("#v4_CoInfoEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_CoInfoEditForm"+id).serializeObject();
		var formData = $("#v4_CoInfoEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_CoInfo/'+
		'v4_CoInfo_Save.php?callback=?&keyName=ID&keyValue='+id+'&'+ formData;
	
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
					refreshv4_CoInfoData(id, newData);
					$(".editFrame").hide('slow');
					$(".editFrame form").html('');
				}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}

	function deletev4_CoInfo(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_CoInfoEditForm"+id).serializeObject();
		var formData = $("#v4_CoInfoEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_CoInfo/'+
		'v4_CoInfo_Delete.php?ID='+ id+'&'+formData+'&callback=?';
	
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
					all_v4_CoInfo();
					//refreshUserData(id, newData);
				}
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});

		return false;
	}


	function editPrintv4_CoInfo(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

	  	if(inList==true) { $(".editFrame").hide('slow'); $(".editFrame form").html('');}
	  	alert('Printed');
	  	
	  return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshv4_CoInfoData(id, newData) {

	  var result = $.grep(data_v4_CoInfo, function(e){ return e.ID == id; });

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

		    changeall_v4_CoInfo(id, ress);

		    data = data_v4_CoInfo;

		    var source   = $("#v4_CoInfoListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({v4_CoInfo : data});

		    $("#show_v4_CoInfo").html(HTML);

	  } else {
		// multiple items found
	  }

	}

	/* promjena cijelog sloga datoteke odjednom */
	function changeall_v4_CoInfo( id, sve ) {
	   for (var i in data_v4_CoInfo) {
		 if (data_v4_CoInfo[i].ID == id) {
		    data_v4_CoInfo[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
</script>			
		

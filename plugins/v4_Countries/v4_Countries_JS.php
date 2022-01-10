
<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//
	window.root = 'plugins/v4_Countries/';
	var data_v4_Countries = [];
	function all_v4_Countries() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	//var status = $("#UserLevel").val(); // prikazuje samo Usere sa levelom
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'all_v4_CountriesFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = window.root+'v4_Countries_All.php?where='+where+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&callback=?';
		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(v4_CountriesData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o transferima
			  var data = v4_CountriesData.data;
			  recordsTotal = v4_CountriesData.recordsTotal;
		
			  paginator(page,recordsTotal,length, callFunction);
			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
			  });

				data_v4_Countries = data;
			
				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#v4_CountriesListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({v4_Countries : data_v4_Countries});

				$("#show_v4_Countries").html(HTML);
		  },
		  error: function() { alert('Get error occured.');}

		});

	}


	function one_v4_Countries(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#v4_CountriesWrapper"+id).css('display') != 'none') {$("#v4_CountriesWrapper"+id).hide('slow'); return;}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = window.root + 'v4_Countries_One.php?CountryID='+id;
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

				var source   = $("#v4_CountriesEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#t_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#one_v4_Countries"+id).html(HTML);

				$("#v4_CountriesWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}


	function new_v4_Countries() { 
		var data = {

	 			CountryID: '',
	 			CountryName: '',
	 			CountryNameEN: '',
	 			CountryNameRU: '',
	 			CountryNameFR: '',
	 			CountryNameDE: '',
	 			CountryNameIT: '',
	 			CountryNameSE: '',
	 			CountryNameNO: '',
	 			CountryNameES: '',
	 			CountryNameNL: '',
	 			CountryDesc: '',
	 			CountryDescEN: '',
	 			CountryDescRU: '',
	 			CountryDescFR: '',
	 			CountryDescDE: '',
	 			CountryDescIT: '',
	 			CountryDescSE: '',
	 			CountryDescNO: '',
	 			CountryDescES: '',
	 			CountryDescNL: '',
	 			CountryISO: '',
	 			CountryCode: '',
	 			CountryCode3: '',
	 			PhonePrefix: '',
	 			Currency: ''
			};
				var source   = $("#v4_CountriesEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data);

				$("#new_v4_Countries").html(HTML);

				$("#v4_CountriesWrapperNew").show('slow');

	}


	function editClosev4_Countries(id, inList) {
		if (notDefined(inList)) {inList=true;}
		if (inList==true) { $(".editFrame").hide('slow');$(".editFrame form").html(''); }
		return false;
	}

	function editSavev4_Countries(id, inList) { 
	
		if($("#v4_CountriesEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_CountriesEditForm"+id).serializeObject();
		var formData = $("#v4_CountriesEditForm"+id).serialize();

		// update data on server
		var url = window.root + 'v4_Countries/'+
		'v4_Countries_Save.php?callback=?&keyName=CountryID&keyValue='+id+'&'+ formData;
	
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
					refreshv4_CountriesData(id, newData);
					$(".editFrame").hide('slow');
					$(".editFrame form").html('');
				}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}

	function deletev4_Countries(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_CountriesEditForm"+id).serializeObject();
		var formData = $("#v4_CountriesEditForm"+id).serialize();

		// update data on server
		var url = window.root + 'v4_Countries/'+
		'v4_Countries_Delete.php?CountryID='+ id+'&'+formData+'&callback=?';
	
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
					all_v4_Countries();
					//refreshUserData(id, newData);
				}
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});

		return false;
	}


	function editPrintv4_Countries(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

	  	if(inList==true) { $(".editFrame").hide('slow'); $(".editFrame form").html('');}
	  	alert('Printed');
	  	
	  return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshv4_CountriesData(id, newData) {

	  var result = $.grep(data_v4_Countries, function(e){ return e.CountryID == id; });

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

		    changeall_v4_Countries(id, ress);

		    data = data_v4_Countries;

		    var source   = $("#v4_CountriesListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({v4_Countries : data});

		    $("#show_v4_Countries").html(HTML);

	  } else {
		// multiple items found
	  }

	}

	/* promjena cijelog sloga datoteke odjednom */
	function changeall_v4_Countries( id, sve ) {
	   for (var i in data_v4_Countries) {
		 if (data_v4_Countries[i].CountryID == id) {
		    data_v4_Countries[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
</script>			
		

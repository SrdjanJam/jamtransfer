
<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//

	var data_v4_VehicleTypes = [];
	function all_v4_VehicleTypes() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	//var status = $("#UserLevel").val(); // prikazuje samo Usere sa levelom
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'all_v4_VehicleTypesFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = WEBSITEURL + '/cms/p/modules/v4_VehicleTypes/v4_VehicleTypes_All.php?where='+where+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&callback=?';

		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(v4_VehicleTypesData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o transferima
			  var data = v4_VehicleTypesData.data;
			  recordsTotal = v4_VehicleTypesData.recordsTotal;
		
			  paginator(page,recordsTotal,length, callFunction);
			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
			  });

				data_v4_VehicleTypes = data;
			
				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#v4_VehicleTypesListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({v4_VehicleTypes : data_v4_VehicleTypes});

				$("#show_v4_VehicleTypes").html(HTML);
		  },
		  error: function() { alert('Get error occured.');}

		});

	}


	function one_v4_VehicleTypes(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#v4_VehicleTypesWrapper"+id).css('display') != 'none') {$("#v4_VehicleTypesWrapper"+id).hide('slow'); return;}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = WEBSITEURL + '/cms/p/modules/v4_VehicleTypes/v4_VehicleTypes_One.php?VehicleTypeID='+id;

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

				var source   = $("#v4_VehicleTypesEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#t_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#one_v4_VehicleTypes"+id).html(HTML);

				$("#v4_VehicleTypesWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}


	function new_v4_VehicleTypes() { 
		var data = {

	 			VehicleTypeID: '',
	 			VehicleTypeName: '',
	 			VehicleTypeNameEN: '',
	 			VehicleTypeNameRU: '',
	 			VehicleTypeNameFR: '',
	 			VehicleTypeNameDE: '',
	 			VehicleTypeNameIT: '',
	 			Min: '',
	 			Max: '',
	 			VehicleClass: '',
	 			Description: '',
	 			DescriptionEN: '',
	 			DescriptionRU: '',
	 			DescriptionFR: '',
	 			DescriptionDE: '',
	 			DescriptionIT: ''
			};
				var source   = $("#v4_VehicleTypesEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data);

				$("#new_v4_VehicleTypes").html(HTML);

				$("#v4_VehicleTypesWrapperNew").show('slow');

	}


	function editClosev4_VehicleTypes(id, inList) {
		if (notDefined(inList)) {inList=true;}
		if (inList==true) { $(".editFrame").hide('slow');$(".editFrame form").html(''); }
		return false;
	}

	function editSavev4_VehicleTypes(id, inList) { 
	
		if($("#v4_VehicleTypesEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_VehicleTypesEditForm"+id).serializeObject();
		var formData = $("#v4_VehicleTypesEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_VehicleTypes/'+
		'v4_VehicleTypes_Save.php?callback=?&keyName=VehicleTypeID&keyValue='+id+'&'+ formData;
	
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
					refreshv4_VehicleTypesData(id, newData);
					$(".editFrame").hide('slow');
					$(".editFrame form").html('');
				}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}

	function deletev4_VehicleTypes(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_VehicleTypesEditForm"+id).serializeObject();
		var formData = $("#v4_VehicleTypesEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_VehicleTypes/'+
		'v4_VehicleTypes_Delete.php?VehicleTypeID='+ id+'&'+formData+'&callback=?';
	
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
					all_v4_VehicleTypes();
					//refreshUserData(id, newData);
				}
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});

		return false;
	}


	function editPrintv4_VehicleTypes(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

	  	if(inList==true) { $(".editFrame").hide('slow'); $(".editFrame form").html('');}
	  	alert('Printed');
	  	
	  return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshv4_VehicleTypesData(id, newData) {

	  var result = $.grep(data_v4_VehicleTypes, function(e){ return e.VehicleTypeID == id; });

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

		    changeall_v4_VehicleTypes(id, ress);

		    data = data_v4_VehicleTypes;

		    var source   = $("#v4_VehicleTypesListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({v4_VehicleTypes : data});

		    $("#show_v4_VehicleTypes").html(HTML);

	  } else {
		// multiple items found
	  }

	}

	/* promjena cijelog sloga datoteke odjednom */
	function changeall_v4_VehicleTypes( id, sve ) {
	   for (var i in data_v4_VehicleTypes) {
		 if (data_v4_VehicleTypes[i].VehicleTypeID == id) {
		    data_v4_VehicleTypes[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
</script>			
		

<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//

	var allCountries = [];
	function getAllCountries() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'getAllCountriesFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = window.root + '/cms/a/allCountries.php?where='+where+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&callback=?';

		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(allCountriesData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o transferima
			  var data = allCountriesData.data;
			  recordsTotal = allCountriesData.recordsTotal;
	
			  paginator(page,recordsTotal,length, callFunction);
			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
			  });

				allCountries = data;
			
				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#countriesListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({countries : allCountries});

				$("#showCountries").html(HTML);
		  },
		  error: function() { alert('Get error occured.');}

		});

	}


	function showOneCountry(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#countriesWrapper"+id).css('display') != 'none') {$("#countriesWrapper"+id).hide('slow'); return;}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = window.root + '/cms/a/oneCountry.php?CountryID='+id;

		// sakrij sve ostale elemente prije nego se otvori novi
		if(inList==true) { $(".editFrame").hide('slow'); }

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

				var source   = $("#countryEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#t_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#oneCountry"+id).html(HTML);

				$("#countriesWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}

	function editCloseCountry(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}
		//elementShown = true;
		//$(".shown").removeClass('shown');
		//$(".formClass").parent().parent().hide();
		//$(".formClass").html('');
	
		if (inList==true) { $(".editFrame").hide('slow'); }

		return false;
	}

	function editSaveCountry(id, inList) { 
	
		if($("#countryEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		var newData = $("#countryEditForm"+id).serializeObject();
		var formData = $("#countryEditForm"+id).serialize();

		// update data on server
		var url = window.root + '/cms/a/'+
		'setDbData.php?callback=?&table=v4_Countries&keyName=CountryID&keyValue='+id+'&'+ formData;
	
		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data, status) {
				if(typeof(data.insert) != 'undefined')
				{
					//showOneUser(data.insert);
				}
				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

				// osvjezi podatke na ekranu za zadani element
				if (inList==true) {
					refreshUserData(id, newData);
					$(".editFrame").hide('slow');
				}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}

	function deleteCountry(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#countryEditForm"+id).serializeObject();
		var formData = $("#countryEditForm"+id).serialize();

		// update data on server
		var url = window.root + '/cms/a/'+
		'deleteCountry.php?CountryID='+ id+'&'+formData+'&callback=?';
	
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
					getAllUsers();
					//refreshUserData(id, newData);
				}
				$(".editFrame").hide('slow');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});

		return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshCountryData(id, newData) {

	  var result = $.grep(allCountries, function(e){ return e.CountryID == id; });

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

		    changeAllCountries(id, ress);

		    data = allCountries;

		    var source   = $("#countriesListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({countries : data});

		    $("#showCountries").html(HTML);

	  } else {
		// multiple items found
	  }

	}

	/* promjena vrijednosti u object array-u */
	function changeUserName( id, newName ) {
	   for (var i in allUsers) {
		 if (allUsers[i].AuthUserID == id) {
		    allUsers[i].AuthUserRealName = newName;
		    break; //Stop this loop, we found it!
		 }
	   }
	}

	/* promjena cijelog sloga datoteke odjednom */
	function changeAllCountries( id, sve ) {
	   for (var i in allCountries) {
		 if (allCountries[i].CountryID == id) {
		    allCountries[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
</script>	

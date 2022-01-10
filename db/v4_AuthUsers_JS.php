
<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//

	var data_v4_AuthUsers = [];
	function all_v4_AuthUsers() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	//var status = $("#UserLevel").val(); // prikazuje samo Usere sa levelom
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'all_v4_AuthUsersFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = WEBSITEURL + '/cms/p/modules/v4_AuthUsers/v4_AuthUsers_All.php?where='+where+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&callback=?';

		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(v4_AuthUsersData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o transferima
			  var data = v4_AuthUsersData.data;
			  recordsTotal = v4_AuthUsersData.recordsTotal;
		
			  paginator(page,recordsTotal,length, callFunction);
			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
			  });

				data_v4_AuthUsers = data;
			
				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#v4_AuthUsersListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({v4_AuthUsers : data_v4_AuthUsers});

				$("#show_v4_AuthUsers").html(HTML);
		  },
		  error: function() { alert('Get error occured.');}

		});

	}


	function one_v4_AuthUsers(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#v4_AuthUsersWrapper"+id).css('display') != 'none') {$("#v4_AuthUsersWrapper"+id).hide('slow'); return;}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = WEBSITEURL + '/cms/p/modules/v4_AuthUsers/v4_AuthUsers_One.php?AuthUserID='+id;

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

				var source   = $("#v4_AuthUsersEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#t_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#one_v4_AuthUsers"+id).html(HTML);

				$("#v4_AuthUsersWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}


	function new_v4_AuthUsers() { 
		var data = {

	 			AuthUserID: '',
	 			AuthLevelID: '',
	 			Terminal: '',
	 			Country: '',
	 			ReturnDiscount: '',
	 			Provision: '',
	 			AuthUserRealName: '',
	 			AuthUserName: '',
	 			AuthUserCompany: '',
	 			DriverID: '',
	 			BrandName: '',
	 			ContactPerson: '',
	 			AuthUserCompanyMB: '',
	 			AuthCoAddress: '',
	 			City: '',
	 			Zip: '',
	 			CountryName: '',
	 			CountryID: '',
	 			AuthUserTel: '',
	 			AuthUserMob: '',
	 			EmergencyPhone: '',
	 			AuthUserFax: '',
	 			AuthUserMail: '',
	 			AuthUserCoDesc: '',
	 			AuthUserNote: '',
	 			AccountBank: '',
	 			AccountOwner: '',
	 			SWIFT: '',
	 			IBAN: '',
	 			AuthUserPass: '',
	 			AuthUserCompanyWeb: '',
	 			AuthUserFacebook: '',
	 			AuthUserTwitter: '',
	 			AuthUserLinkedIn: '',
	 			AuthUserGooglePlus: '',
	 			DateAdded: '',
	 			LastVisited: '',
	 			Image: '',
	 			Temp_pass: '',
	 			Temp_pass_active: '',
	 			Level_access: '',
	 			Random_key: '',
	 			ContractFile: '',
	 			ContractDate: '',
	 			ContractSignature: '',
	 			DBImage: '',
	 			DBImageType: '',
	 			Language: '',
	 			Active: '',
	 			AcceptedPayment: '',
	 			R1Low: '',
	 			R1Hi: '',
	 			R1Percent: '',
	 			R2Low: '',
	 			R2Hi: '',
	 			R2Percent: '',
	 			R3Low: '',
	 			R3Hi: '',
	 			R3Percent: '',
	 			PR1Low: '',
	 			PR1Hi: '',
	 			PR1Percent: '',
	 			PR2Low: '',
	 			PR2Hi: '',
	 			PR2Percent: '',
	 			PR3Low: '',
	 			PR3Hi: '',
	 			PR3Percent: '',
	 			FR1Low: '',
	 			FR1Hi: '',
	 			FR1Percent: '',
	 			FR2Low: '',
	 			FR2Hi: '',
	 			FR2Percent: '',
	 			FR3Low: '',
	 			FR3Hi: '',
	 			FR3Percent: ''
			};
				var source   = $("#v4_AuthUsersEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data);

				$("#new_v4_AuthUsers").html(HTML);

				$("#v4_AuthUsersWrapperNew").show('slow');

	}


	function editClosev4_AuthUsers(id, inList) {
		if (notDefined(inList)) {inList=true;}
		if (inList==true) { $(".editFrame").hide('slow');$(".editFrame form").html(''); }
		return false;
	}

	function editSavev4_AuthUsers(id, inList) { 
	
		if($("#v4_AuthUsersEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_AuthUsersEditForm"+id).serializeObject();
		var formData = $("#v4_AuthUsersEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_AuthUsers/'+
		'v4_AuthUsers_Save.php?callback=?&keyName=AuthUserID&keyValue='+id+'&'+ formData;
	
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
					refreshv4_AuthUsersData(id, newData);
					$(".editFrame").hide('slow');
					$(".editFrame form").html('');
				}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}

	function deletev4_AuthUsers(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#v4_AuthUsersEditForm"+id).serializeObject();
		var formData = $("#v4_AuthUsersEditForm"+id).serialize();

		// update data on server
		var url = WEBSITEURL + '/cms/p/modules/v4_AuthUsers/'+
		'v4_AuthUsers_Delete.php?AuthUserID='+ id+'&'+formData+'&callback=?';
	
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
					all_v4_AuthUsers();
					//refreshUserData(id, newData);
				}
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});

		return false;
	}


	function editPrintv4_AuthUsers(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		if (notDefined(inList)) {inList=true;}

	  	if(inList==true) { $(".editFrame").hide('slow'); $(".editFrame form").html('');}
	  	alert('Printed');
	  	
	  return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshv4_AuthUsersData(id, newData) {

	  var result = $.grep(data_v4_AuthUsers, function(e){ return e.AuthUserID == id; });

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

		    changeall_v4_AuthUsers(id, ress);

		    data = data_v4_AuthUsers;

		    var source   = $("#v4_AuthUsersListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({v4_AuthUsers : data});

		    $("#show_v4_AuthUsers").html(HTML);

	  } else {
		// multiple items found
	  }

	}

	/* promjena cijelog sloga datoteke odjednom */
	function changeall_v4_AuthUsers( id, sve ) {
	   for (var i in data_v4_AuthUsers) {
		 if (data_v4_AuthUsers[i].AuthUserID == id) {
		    data_v4_AuthUsers[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
</script>			
		

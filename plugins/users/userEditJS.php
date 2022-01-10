<script type="text/javascript">
	//
	// USERS EDIT FORM FUNCTIONS *********************************************************************************
	//

	var allUsers = [];

	
	function getAllUsers() {

		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	var status = $("#UserLevel").val(); // prikazuje samo Usere sa levelom
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici
	 	var active = $("#active").val(); // dropdown za broj prikazanih usera na stranici

	 	// advanced search
	 	var sortOrder  = $("#sortOrder").val();
	 	
		var callFunction = 'getAllUsersFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
		//

	 	var url = 'a/allUsers.php?where='+where+'&UserLevel='+status+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&active='+active+'&callback=?';
		$.ajax({
			type: 'GET',
			url: url,
			//async: false,
			contentType: "application/json",
			dataType: 'jsonp',
			success: function(allUsersData) {

				// CUSTOM STUFF
				// uzmi samo podatke o transferima
				var data = allUsersData.data;
				recordsTotal = allUsersData.recordsTotal;

				paginator(page,recordsTotal,length, callFunction);

				$.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
				});

				allUsers = data;

				// poziva se handlebars da pripremi prikaz
				// template je u parts/transferList.Driver.php

				var source   = $("#usersListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({users : allUsers});

				$("#showUsers").html(HTML);
			},
			error: function(e) {
				alert('Get error occured: ' + e.responseText);
				// console.log(e);
			}
		});
	}
	
	function editUser(id,inList) { 

		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if(inList==true) {
			if ( $("#usersWrapper"+id).css('display') != 'none') {
				$("#usersWrapper"+id).hide('slow'); 
				return true;
			}
		}

		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = 'a/oneUser.php?AuthUserID='+id;

		// sakrij sve ostale elemente prije nego se otvori novi
		if(inList==true) { $(".editFrame").hide('slow');  }

		// idemo po podatke
		$.ajax({
			type: 'GET',
			url: url,
			async: true,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data) {

				// CUSTOM STUFF
				if(inList==true) {
					$.each(data, function(i, item) {
						data[i].color ='white';
					});
				}

				var source   = $("#userEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data[0]);

				// promjena boje pozadine zadnje gledane plocice
				if(inList==true) { $("#user_"+id).removeClass('white').addClass('bg-light-blue'); }

				$("#oneUser"+id).html(HTML);

				$("#usersWrapper"+id).show('slow');
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}

	function editCloseUser(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}
		//elementShown = true;
		//$(".shown").removeClass('shown');
		//$(".formClass").parent().parent().hide();
		//$(".formClass").html('');
	
		if (inList==true) { $(".editFrame").hide('slow');  }
		else { window.location = "cms/"; 	}

		return false;
	}


	function new_v4_AuthUsers() { 
		var data = {

	 			AuthUserID: '',
	 			AuthLevelID: '',
	 			DateAdded: '',
	 			LastVisited: '',
	 			AuthUserName: '',
	 			AuthUserPass: '',
	 			AuthUserRealName: '',
	 			Image: '',
	 			AuthUserMail: '',
	 			AuthUserNote: '',
	 			AuthUserTel: '',
	 			AuthUserMob: '',
	 			AuthUserFax: '',
	 			AuthUserCompany: '',
	 			DriverID: '',
	 			AuthCoAddress: '',
	 			Provision: '',
	 			AuthUserCompanyMB: '',
	 			AuthUserCompanyWeb: '',
	 			AuthUserCoDesc: '',
	 			AuthUserFacebook: '',
	 			AuthUserTwitter: '',
	 			AuthUserLinkedIn: '',
	 			AuthUserGooglePlus: '',
	 			Temp_pass: '',
	 			Temp_pass_active: '',
	 			Active: '',
	 			Level_access: '',
	 			Random_key: '',
	 			ContractFile: '',
	 			ContractDate: '',
	 			ContractSignature: '',
	 			DBImage: '',
	 			DBImageType: '',
	 			Language: '',
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
	 			FR3Percent: '',
	 			NoteToDriver: '',
	 			Balance: ''
			};
				var source   = $("#userEditTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template(data);

				$("#oneUserNew").html(HTML);

				$("#usersWrapperNew").show('slow');

	}


	function editSaveUser(id, inList) {
		//if($("#userEditForm"+id).valid() == false) {return false;}
		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

		var newData = $("#userEditForm"+id).serializeObject();
		var formData = $("#userEditForm"+id).serialize();
		
		// update data on server
		var url = 'cms/p/modules/users/'+
		'v4_AuthUsers_Save.php?callback=?&keyName=AuthUserID&keyValue='+id+'&'+ formData;	
		console.log(url);
		$.ajax({
			type: 'POST',
			url: url,
			//async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data, status) {
				var newID = '';
				if(typeof(data.insert) == 'number')
				{
					//showOneUser(data.insert);
					var newID = data.insert;
					//console.log(newID);
				}
				
				editSavev4_SurGlobal(newID);
				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');
				
				// osvjezi podatke na ekranu za zadani element
				if (inList==true) {
					refreshUserData(id, newData);
					$(".editFrame").hide('slow');
				} else {
					$.toaster('User profile saved', 'Done', 'success blue-2');
					//$("#userEditForm"+id).delay(3500).hide('slow');
					//window.location = "cms/";
					
				}
			},
			error: function(xhr, status, error) {
				alert("Save error occured: " + xhr.responseText);
				// console.log(xhr);
				// console.log("Status: " + status);
				// console.log("Status text: " + xhr.statusText);
				// console.log("Response text: " + xhr.responseText);
				// console.log("Error: " + error);
			}
		});

		return false;
	}

	function deleteUser(id, inList) { 

		if (notDefined(inList)) {inList=true;}

		var newData = $("#userEditForm"+id).serializeObject();
		var formData = $("#userEditForm"+id).serialize();

		// update data on server
		var url = 'a/'+
		'deleteUser.php?AuthUserID='+ id+'&'+formData+'&callback=?';
	
		$.ajax({
			type: 'GET',
			url: url,
			//async: false,
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


	function editPrintUser(id, inList) {
		// default value. inList znaci je li prikaz sa liste ili nije
		//if (typeof inList === "undefined" || inList === null) { inList = true; }
		if (notDefined(inList)) {inList=true;}

	  	if(inList==true) { $(".editFrame").hide('slow'); }
	  	alert('Document Printed');
	  	
	  return false;
	}


	/* trazenje elementa object array-a i refresh liste transfera */
	function refreshUserData(id, newData) {

	  var result = $.grep(allUsers, function(e){ return e.AuthUserID == id; });

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

		    changeAllUsers(id, ress);

		    data = allUsers;

		    var source   = $("#usersListTemplate").html();
		    var template = Handlebars.compile(source);

		    var HTML = template({users : data});

		    $("#showUsers").html(HTML);

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
	function changeAllUsers( id, sve ) {
	   for (var i in allUsers) {
		 if (allUsers[i].AuthUserID == id) {
		    allUsers[i] = sve;
		    break; //Stop this loop, we found it!
		 }
	   }
	}
	
	
	
	
	function globalSurcharges(id) {
		if (notDefined(id)) {id='';}
	
		var formData = $("#userEditForm"+id).serialize();
		var newData = $("#userEditForm"+id).serializeObject();

		if(newData.SurCategory == 1) {
			// Global surcharges
			var url = 'v4_SurGlobal.Edit.Form.php?OwnerID='+id+'&'+formData;
			$.ajax({
				type: 'GET',
				url: url,
				//async: false,
				//contentType: "application/json",
				//dataType: 'jsonp',
				success: function(data) {

					$("#globalSurcharges"+id).html(data);
					$("#globalSurcharges"+id).show('slow');

				},
				error: function(xhr, status, error) {alert("Error occured: " + xhr.status + " " + xhr.statusText+" "); }
			});
		} 
		
		
		if(newData.SurCategory == 0) {
			// nema surcharges. Ako ih je bilo, trebalo bi ih izbrisati?
			$("#globalSurcharges"+id).hide('slow');
			$("#globalSurcharges"+id).html('');
		}
	}
	
	
	
	function editSavev4_SurGlobal(newID) { 

		if (newID != '') {
			$("#OwnerID").val(newID);
		}


		var newData = $("#v4_SurGlobalEditForm").serializeObject();
		var formData = $("#v4_SurGlobalEditForm").serialize();
		

		// update data on server
		var url = 'cms/p/modules/v4_SurGlobal/'+
		'v4_SurGlobal_Save.php?callback=?&'+ formData;
	
		$.ajax({
			type: 'POST',
			url: url,
			//async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data, status) {

				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return true;
	}		
</script>	

	var data_Items = [];
	window.base='http://localhost/jamtransfer/';
	function allItems() {
		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	var status = $("#Type").val(); // prikazuje po tipu	
	 	var status2 = $("#Type2").val(); // prikazuje po tipu	
		
	 	var active = $("#Active").val(); // prikazuje samo aktivne	
	 	var approved = $("#Approved").val(); // prikazuje samo aktivne	
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici
	 	var transfersFilter = $("#transfersFilter").val(); // filter za transfere
	 	var orderid = $("#orderid").val(); // filter za orderid
	 	var detailid = $("#detailid").val(); // filter za detailid
	 	var sortOrder  = $("#sortOrder").val();		
	 	var orderFromID = $("#orderFromID").val();
		if (typeof orderFromID=='undefined') orderFromID='';
	 	var locationName = $("#locationName").val();
		if (typeof locationName=='undefined') locationName='';
	 	var paymentNumber = $("#paymentNumber").val();
		if (typeof paymentNumber=='undefined') paymentNumber='';		
	 	var driverName = $("#driverName").val();
		if (typeof driverName=='undefined') driverName='';
	 	var agentName = $("#agentName").val();
		if (typeof agentName=='undefined') agentName='';
	 	var agentOrder = $("#agentOrder").val();
		if (typeof agentOrder=='undefined') agentOrder='';
	 	var passengerData = $("#passengerData").val();
		if (typeof passengerData=='undefined') passengerData='';
		var paymentMethod = $("#PaymentMethod").val();
		if (typeof paymentMethod=='undefined') paymentMethod='-1';		
		var driverConfStatus = $("#DriverConfStatusChoose").val();
		if (typeof driverConfStatus=='undefined') driverConfStatus='-1';		
		var yearsOrder = $("#yearsOrder").val();
		if (typeof yearsOrder=='undefined') yearsOrder='0';
	 	var yearsPickup = $("#yearsPickup").val();
		var currentTime = new Date();
		if (typeof yearsPickup=='undefined') yearsPickup=currentTime.getFullYear();
	 	var sortField = $("#sortField").val();
		if (typeof sortField=='undefined') sortField='PickupDate';	 	
		var sortDirection = $("#sortDirection").val();
		if (typeof sortDirection=='undefined') sortDirection='DESC';	
		var routeID = $("#routeID").val();
		if (typeof routeID=='undefined') routeID=0;	
		var vehicleTypeID = $("#vehicleTypeID").val();
		if (typeof vehicleTypeID=='undefined') vehicleTypeID=0;	
		var vehicleID = $("#vehicleID").val();
		if (typeof vehicleID=='undefined') vehicleID=0;	
		var subdriverID = $("#subdriverID").val();
		if (typeof subdriverID=='undefined') subdriverID=0;	
		var actionID = $("#actionID").val();
		if (typeof actionID=='undefined') actionID=0;	
		if ($("#listExtras").is(':checked')) var listExtras=1;
		else var listExtras=0;
		var callFunction = 'allItems()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();

		if(typeof page==='undefined') {page=1;}
		if(page<=0) {page=1;}
	 	var url = window.root+'All.php?where='+where+
		'&Type='+status+
		'&Type2='+status2+
		'&Active='+active+
		'&Approved='+approved+
	 	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+
		'&transfersFilter='+transfersFilter+
		'&orderid='+orderid+
		'&detailid='+detailid+
		'&orderFromID='+orderFromID+
		'&paymentNumber='+paymentNumber+
		'&locationName='+locationName+
		'&driverName='+driverName+
		'&agentName='+agentName+
		'&agentOrder='+agentOrder+
		'&passengerData='+passengerData+
		'&paymentMethod='+paymentMethod+
		'&driverConfStatus='+driverConfStatus+
		'&yearsOrder='+yearsOrder+
		'&yearsPickup='+yearsPickup+
		'&sortField='+sortField+
		'&sortDirection='+sortDirection+
		'&listExtras='+listExtras+
		'&routeID='+routeID+
		'&vehicleTypeID='+vehicleTypeID+
		'&vehicleID='+vehicleID+
		'&subdriverID='+subdriverID+
		'&actionID='+actionID+
		'&callback=?';
		console.log(window.base+url);
		$.ajax({
		 type: 'GET',
		  url: url,
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(ItemsData) {

			  // CUSTOM STUFF
			  // uzmi samo podatke o itemima
			  var data = ItemsData.data;
			  recordsTotal = ItemsData.recordsTotal;
			  paginator(page,recordsTotal,length, callFunction);
			  $.each(data, function(i, item) {
				data[i].color ='white';
			  });
				data_Items = data;
				// poziva se handlebars da pripremi prikaz
				var source   = $("#ItemListTemplate").html();
				var template = Handlebars.compile(source);

				var HTML = template({Item : data_Items});

				$("#show_Items").html(HTML);
				
			  $("#PaymentMethod").prepend('<option value="-1">All method</option>');
			  $("#PaymentMethod option[value="+paymentMethod+"]").prop("selected", true)
			  $("#PaymentMethod").change(function() {
				  allItems();
			  }) 			  
			  $("#DriverConfStatusChoose").prepend('<option value="-1">All status</option>');
			  $("#DriverConfStatusChoose option[value="+driverConfStatus+"]").prop("selected", true)
			  $("#DriverConfStatusChoose").change(function() {
				  allItems();
			  }) 
			  if (ItemsData.yearsOrder ) {
				  var yearsOrderArr = ItemsData.yearsOrder;
				  $.each(yearsOrderArr, function(i, item) {
					    $('#yearsOrder').append('<option value="'+yearsOrderArr[i]+'">'+yearsOrderArr[i]+'</option>');
					});
					$("#yearsOrder option[value="+yearsOrder+"]").prop("selected", true)
			  }				  
			  if (ItemsData.orderFromID) {
				  $("#orderFromID").val(ItemsData.orderFromID);
			  }
			  if (ItemsData.paymentNumber ) {
				  $("#paymentNumber").val(ItemsData.paymentNumber);
			  }				  
			  if (ItemsData.locationName ) {
				  $("#locationName").val(ItemsData.locationName);
			  }				  
			  if (ItemsData.driverName ) {
				  $("#driverName").val(ItemsData.driverName);
			  }				 
			  if (ItemsData.agentName ) {
				  $("#agentName").val(ItemsData.agentName);
			  }				  
			  if (ItemsData.agentOrder ) {
				  $("#agentOrder").val(ItemsData.agentOrder);
			  }				  
			  if (ItemsData.passengerData ) {
				  $("#passengerData").val(ItemsData.passengerData);
			  }				  
			  if (ItemsData.yearsPickup ) {
				  var yearsPickupArr = ItemsData.yearsPickup;
				  $.each(yearsPickupArr, function(i, item) {
					    $('#yearsPickup').append('<option value="'+yearsPickupArr[i]+'">'+yearsPickupArr[i]+'</option>');
					});
					$("#yearsPickup option[value="+yearsPickup+"]").prop("selected", true)
			  }	
		      if (orderid>0 || detailid>0) $('.itemsheader').hide();
		      if (orderid>0 || detailid>0) $('#pageSelect').hide();
		      if (listExtras==1) $('#listExtras').prop('checked', true);
			  if ($(window).width() < 760) filtersDown();
			  else	filtersUP();	
			  
		  },
		  error: function() { alert('Get error occured.');}
		});
	}
	function filtersUP() {
		$('.itemsheader').show();
		$('#filtersUP').hide();
		$('#filtersDown').show();
	}		
	function filtersDown() {
		$('.itemsheader').hide();
		$('#pageSelect').show();		
		$('#filtersDown').hide();	
		$('#filtersUP').show();		
	}	
	function oneItem(id,tab) { 

		// click na element - hide element ako je vec prikazan, nema potrebe za ajax
		if ( $("#ItemWrapper"+id).css('display') != 'none') {
			$("#ItemWrapper"+id).hide('slow'); 
			if (typeof tab == 'undefined') return;
			if (window.tab == tab) return;
		}
		// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
		var url = window.root + 'One.php?ItemID='+id;
		if (typeof tab !== 'undefined') {
			url = url + '&tab='+tab;
			$('.'+window.tab).removeClass('grey');
			window.tab=tab;
			$('#t_'+id+' .'+tab).addClass('grey');
		}	
		// sakrij sve ostale elemente prije nego se otvori novi
		$(".editFrame").hide('slow'); $(".editFrame form").html('');
		// idemo po podatke
		console.log(window.base+url);
		

		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'json',
			success: function(data) {
				// CUSTOM STUFF
				$('.bg-light-blue').removeClass('bg-light-blue').addClass('white');

				var source   = $("#ItemEditTemplate").html();
				var template = Handlebars.compile(source);
				var HTML = template(data[0]);
				// promjena boje pozadine zadnje gledane plocice
				$("#t_"+id).removeClass('white').addClass('bg-light-blue');

				$("#one_Item"+id).html(HTML);

				$("#ItemWrapper"+id).show('slow');

				// Trun off:
				// $("#ItemWrapper"+id)[0].scrollIntoView({
				// 	behavior: "smooth", // or "auto" or "instant"
				// 	block: "start" // or "end"
				// });	

				$('.dorder, .dpayment, .dtransfer, .dpdriver, .dagent, .dpassenger').hide();
				$('.d'+tab).show();
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});
	}
	function new_Item() { 
		var source   = $("#ItemEditTemplate").html();
		var template = Handlebars.compile(source);
		var HTML = template();
		$("#new_Item").html(HTML);
		$("#ItemWrapperNew").show('slow');
	}


	function editCloseItem(id) {
		$(".editFrame").hide('slow');$(".editFrame form").html(''); 
		return false;
	}

	function editSaveItem(id) {
		if($("#ItemEditForm"+id).valid() == false) {return false;}
		var newData = $("#ItemEditForm"+id).serializeObject();
		var formData = $("#ItemEditForm"+id).serialize();
		// update data on server
		var url = window.root + 'Save.php';
		var data = 'callback=?&id=' + id + '&' + formData;
		console.log(url+'?'+data);		
		$.ajax({
			type: 'POST',
			url: url,
			data: data,			
			async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data, status) {
				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');
				// osvjezi podatke na ekranu za zadani element
				if (id == '') {
					alert ('New Item created');
					window.location.href = window.currenturl;
				}	
				else allItems();
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});
		return false;
	}

	function deleteItem(id) { 
		// update data on server
		var url = window.root + 'Delete.php?ID='+ id+'&'+'&callback=?';
		console.log(window.base+url);
		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data) {

				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

				// osvjezi podatke na ekranu za zadani element
				allItems();
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});
		return false;
	}

	function setDriverItem(id) {
		var url = window.root + 'SetForDriver.php?ID='+ id+'&'+'&callback=?';
		console.log(window.base+url);
		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			//contentType: "application/json",
			dataType: 'jsonp',
			success: function(data) {

				$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

				// osvjezi podatke na ekranu za zadani element
				allItems();
				$(".editFrame").hide('slow');
				$(".editFrame form").html('');
			},
			error: function(xhr, status, error) {alert("Delete error occured: " + xhr.status + " " + xhr.statusText+" "); }
		});
		return false;
	}	
	function editSaveTerminal(placeid, driverid) { 
		// update data on server
		var url = window.root + 'SaveTerminal.php?PlaceID='+placeid+'&DriverID='+ driverid;
		console.log(window.base+url);		
		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',
			success: function(data, status) {
				if(data.update == 'Exist') {alert ("This place already connected to driver")}
				else {alert ("This place connected to driver")}
			},
			error: function(xhr, status, error) {alert("Save error occured: " + xhr.status + " " + xhr.statusText); }
		});

		return false;
	}	
	function approveReview (id, val,button) {
		var url= window.root + "ajax_updateApproved.php";
		console.log(window.base+url);		
		$.ajax({
			url: url,
			type: "POST",
			data: {
				ID: id,
				value: val
			},
			success: function (result) {
				if (result==1) var savefield='Approve';
				else var savefield='Discard';
				document.getElementById("buttons_"+id).innerHTML = savefield;
			}
		});
	}	
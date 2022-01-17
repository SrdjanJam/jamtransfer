<script>
// VARIABLES AVAILABLE TO ALL FUNCTIONS

var allTransfers = [];
var drivers = [];

/*
Uzima podatke za listu transfera
parametri dolaze iz input/select polja u formu
pa ih treba definirati tamo
*/

function getAllTransfers() {

	// podaci iz input polja - filtriranje
	var where = $("#whereCondition").val(); // glavni filter koji uvijek radi
	var document = $("#documentFilter").val(); // glavni filter koji uvijek radi
	var status = $("#status").val(); // prikazuje samo transfere koji imaju taj status
	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	var length = $("#length").val(); // dropdown za broj prikazanih transfera na stranici
	// advanced search
	var advancedSearch = '';
	var orderOnly = $("#order_only").html();
	var bookedCond = $("#filterBooked").val();
	var bookedDate = $("#filterBookedDate").val();
	var pickupCond = $("#filterPickup").val();
	var pickupDate = $("#filterPickupDate").val();
	var driverCond = $("#filterDriverID").val();
	var sortOrder = $("#sortOrder option:selected").val();
	var extraServices = $("#extraServicesChoose").val();
	var archive = $("#arh").html();
	if (archive=='archive') archive=1;
	else archive=0;
	var ajax_request; // holds current ajax request
	// slozi dodatni where uvjet
	if (bookedDate != '') {
		advancedSearch += ' AND OrderDate ' + bookedCond + " '" + bookedDate + "' ";
	}

	if (pickupDate != '') {
		advancedSearch += ' AND PickupDate ' + pickupCond + " '" + pickupDate + "' ";
	}

	if (driverCond != '0') {
		advancedSearch += ' AND v4_OrderDetails.DriverID = '+  driverCond ;
	}

	if (extraServices == "only") {
		advancedSearch += ' AND ExtraCharge > 0';
	}
	else if (extraServices == "none") {
		advancedSearch += ' AND ExtraCharge = 0';
	}
	if (orderOnly == 'order_only') 	{
		advancedSearch = '';
	}	
	if (advancedSearch != '' && advancedSearch != ' AND DriverID = '+  driverCond) { $("#advancedSearchActive").html('<i class="fa fa-toggle-on l text-red"></i>');}
	else $("#advancedSearchActive").html('<i class="fa fa-toggle-off l"></i>');
	
	var callFunction = 'getAllTransfersFilter()'; // funkcija koju paginator poziva kod promjene stranice
	
	// ovo koristi i paginator funkcija!
	var recordsTotal = 0;
	var page  = $("#pageSelector").val();

	if(typeof page==='undefined') {page=1;}
	if(page<=0) {page=1;}

	var url = 'plugins/transfers/allTransfers.php?where='+where+advancedSearch+'&status='+status+
	'&Search='+filter+'&page='+page+'&length='+length+'&sortOrder='+sortOrder+'&archive='+archive+'&document='+document;

	console.log('url:'+url);

	// kill previous request if still active
	if(typeof ajax_request !== 'undefined') ajax_request.abort();

	ajax_request = $.ajax({
		type: 'GET',
		url: url,
		async: true,
		contentType: "application/json",
		dataType: 'jsonp',
		success: function(allTransfersData) {

			// CUSTOM STUFF
			// uzmi samo podatke o transferima
			var data = allTransfersData.data;
			recordsTotal = allTransfersData.recordsTotal;

			paginator(page,recordsTotal,length, callFunction);

			$.each(data, function(i, item) {
				data[i].color ='white';
				//var ts = data[i].TransferStatus;
				//data[i].TransferStatus = statusDescription.status[ts].desc;
				if(data[i].TransferStatus == '3') {data[i].color = 'red lighten-3';}
			});

			allTransfers = data;

			// poziva se handlebars da pripremi prikaz
			// template je u parts/transferList.Driver.php

			var source   = $("#transfersTemplate").html();
			var template = Handlebars.compile(source);

			var HTML = template({transfers : allTransfers});

			$("#showTransfers").html(HTML);
			//$(".timepicker").pickatime({format: 'H:i', interval: 10});
			$(".timepicker").JAMTimepicker();
			},
		error: function(error) {
			alert('Get All Transfers error');
			console.log("Get All Transfers error: "); 
			console.log(error);
		}
	});
}

/*
PAGINATOR BLOCK
Omogucava paginaciju.
U #infoShow div koji mora biti u formu pise podatke o ukupnom broju slogova i trenutnoj stranici
U #pageSelect div koji mora biti u formu ubacuje dropdown gdje se bira stranica koja ce se prikazati
parametri:
	page - broj trenutno prikazane stranice. Inicijalno mora biti 1
	recordsTotal - ukupni broj podataka za prikaz
	length - broj podataka na stranici
	callFunction - funkcija koja se poziva za svaku promjenu stranice
*/
function paginator(page, recordsTotal, length, callFunction) {

		var iPage = parseInt(page,10);

		if (iPage <= 1) {iPage=1;}

		// izracunaj broj stranica
		iMaxPages = parseInt(recordsTotal,10) / parseInt(length,10);

		// vidi ima li ostatka
		var iRemainder = parseInt(recordsTotal,10) % parseInt(length,10);

		// ako ima, dodaj jos jednu stranicu
		if(iRemainder > 0) {
			iMaxPages = parseInt(recordsTotal,10) / parseInt(length,10)+parseInt(1,10);
		}

		// ne idi dalje od zadnje stranice
		if (iPage > parseInt(iMaxPages,10)) {iPage=parseInt(iMaxPages,10);}

		//prvi prikazani slog na stranici
		var begin = parseInt(length,10) * parseInt(iPage,10)-parseInt(length,10);

		// INFO BLOCK -> #infoShow div element
		$("#infoShow").html('<span class="text-light-blue"><i class="ic-stack"></i> ' + recordsTotal + ' | ' +
		'<i class="fa fa-eye"></i> ' +
		parseInt(begin+1,10) + '-' + parseInt(parseInt(begin,10)+parseInt(length,10),10) +
		' | <i class="ic-file"></i> ' + parseInt(iPage,10) + '/' + parseInt(iMaxPages,10)) + '</span>';


		// PAGINATION DROPDOWN and BUTTONS -> #pageSelect div element
		var selHtml = '<button class="btn btn-primary align" onclick="paginatorPrevPage();">Prev</button>';
		selHtml += '<select id="pageSelector" onchange="'+ callFunction + ';">'; // ajax refresh prikaza
		for (var i=1;i<=iMaxPages;i++)
		{
			selHtml += '<option value="'+i+'"';
			if (i==iPage) {selHtml += ' selected="selected" ';}
			selHtml += '>'+parseInt(i,10)+'</option>';
		}

		selHtml += '</select>';
		selHtml += '<button class="btn btn-primary align" onclick="paginatorNextPage();">Next</button>';
		$("#pageSelect").html(selHtml);
}

function paginatorNextPage() {
	var thisPage = $("#pageSelector").val();
	$("#pageSelector").val(parseInt(thisPage) + parseInt(1)).change();
	$('html, body').animate({ scrollTop: 0 }, 'slow');
}

function paginatorPrevPage() {
	var thisPage = $("#pageSelector").val();
	var prevPage = parseInt(thisPage) - parseInt(1);
	if(prevPage <= 1) { prevPage = 1; }
	$("#pageSelector").val(prevPage).change();
	$('html, body').animate({ scrollTop: 0 }, 'slow');
}

/* end of paginator block ****************************************************/


function showOneTransfer(id,inList) {
	// default value. inList znaci je li prikaz sa liste ili nije
	//if (typeof inList === "undefined" || inList === null) { inList = true; }
	if (notDefined(inList)) {inList=true;}
	// click na element - hide element ako je vec prikazan, nema potrebe za ajax
	if(inList==true) {
		if ( $("#transferWrapper"+id).css('display') != 'none') {
			$("#transferWrapper"+id).hide('slow'); return;
		}
	}

	// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
	var url = 'plugins/transfers/oneTransfer.php?where=WHERE DetailsID='+id;
console.log(url);

	// sakrij sve ostale elemente prije nego se otvori novi
	if(inList==true) {
		$(".editFrame").hide('slow');
		$(".form").parent().html(''); // cisti sadrzaj prethodno otvorenih form-ova iz memorije
	}
	
	// idemo po podatke
	$.ajax({
	   type: 'GET',
		url: url,
		async: false,
		contentType: "application/json",
		dataType: 'jsonp',
		cache: false,
		success: function(data) {

			var source   = $("#transferTemplate").html();
			var template = Handlebars.compile(source);

			var HTML = template(data);

			if(inList==true) { $("#t_"+id).removeClass('white').addClass('xblue lighten-4 xblack-text'); }
			
			$("#oneTransfer"+id).html(HTML);

			if(inList==true) { $("#transferWrapper"+id).show('slow'); }

			//$('html,body').animate({scrollTop: $("#transferWrapper"+id).offset().top }, 500);
			$(".datepicker").pickadate({format:'yyyy-mm-dd', formatSubmit: 'yyyy-mm-dd'});
			//$(".timepicker").pickatime({format: 'H:i', interval: 10});
			$(".timepicker").JAMTimepicker();
		}
	});
}

/*function showOneTransferN(id,inList) {
	// default value. inList znaci je li prikaz sa liste ili nije
	//if (typeof inList === "undefined" || inList === null) { inList = true; }
	if (notDefined(inList)) {inList=true;}
	// click na element - hide element ako je vec prikazan, nema potrebe za ajax
	if(inList==true) {
		if ( $("#transferWrapper"+id).css('display') != 'none') {
			$("#transferWrapper"+id).hide('slow'); return;
		}
	}

	// ako element nije prikazan, uzmi potrebne podatke i prikazi ga
	var url = 'api/oneTransferN.php?where=WHERE DetailsID='+id;

	// sakrij sve ostale elemente prije nego se otvori novi
	if(inList==true) {
		$(".editFrame").hide('slow');
		$(".form").parent().html(''); // cisti sadrzaj prethodno otvorenih form-ova iz memorije
	}

	// idemo po podatke
	$.ajax({
	   type: 'GET',
		url: url,
		async: false,
		contentType: "application/json",
		dataType: 'jsonp',
		cache: false,
		success: function(data) {

			var source   = $("#transferTemplate").html();
			var template = Handlebars.compile(source);

			var HTML = template(data);

			if(inList==true) { $("#t_"+id).removeClass('white').addClass('xblue lighten-4 xblack-text'); }

			$("#oneTransfer"+id).html(HTML);

			if(inList==true) { $("#transferWrapper"+id).show('slow'); }

			//$('html,body').animate({scrollTop: $("#transferWrapper"+id).offset().top }, 500);
			$(".datepicker").pickadate({format:'yyyy-mm-dd', formatSubmit: 'yyyy-mm-dd'});
			//$(".timepicker").pickatime({format: 'H:i', interval: 10});
			$(".timepicker").JAMTimepicker();
		}
	});
}*/

function editClose(id, inList) {
	$(".editFrame").hide('slow'); $(".form").parent().html('');
	return false;
}

function editSave(id, inList) {
	
	checkValues();
	
	// default value. inList znaci je li prikaz sa liste ili nije
	if (notDefined(inList)) {inList=true;}

	var newData = $("#transferEditForm"+id).serializeObject();
	var formData = $("#transferEditForm"+id).serialize();
	console.log(formData);

	// update data on server
	//var url = 'api/'+
	//'setDbData.php?table=v4_OrderDetails&keyName=DetailsID&keyValue='+id+'&'+ formData;
	var url = 'api/'+
	'saveTransfer.php?DetailsID='+id+'&'+ formData;
console.log (url);
	$.ajax({
		type: 'POST',
		url: url,
		async: false,
		contentType: "application/json",
		//dataType: 'jsonp',
		success: function(data) {

			$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

			// osvjezi podatke na ekranu za zadani element
			if (inList==true) {
				//getAllTransfers(); //ovo je problem... ne znam treba li
				refreshData(id, newData);

				$(".editFrame").hide('slow');
			} else {
				location.reload(true);
			}



		},
		error: function(xhr, status, error) {
			alert("Save error occured: " + xhr.status + " " + xhr.statusText);
		}
	});

	return false;
}
function deleteTransfer(id, inList) {
	if (notDefined(inList)) {inList=true;}
	return changeTransferStatus(id, '9', inList);
}

function cancelTransfer(id, inList) {
	if (notDefined(inList)) {inList=true;}
	return changeTransferStatus(id, '3', inList);
}

function completedTransfer(id, inList) {
	if (notDefined(inList)) {inList=true;}
	return changeTransferStatus(id, '5', inList);
}

function activateTransfer(id, inList) {
	if (notDefined(inList)) {inList=true;}
	return changeTransferStatus(id, '1', inList);
}
function changeTransferStatus(id, newStatus, inList) {
	// inList znaci je li prikaz sa liste ili nije
	if (newStatus==9) var message='Are you sure? This delete permanently this transfer and all its data.';
	else var message='Are you sure?';
	if(!confirm(message)) return false;

	if (notDefined(inList)) {inList=true;}

	var formData = $("#transferEditForm"+id).serialize();

	// update data on server
	var url = 'api/'+
	'changeTransferStatus.php?DetailsID='+id+'&NewStatus='+ newStatus + '&'+ formData;
	console.log(url);

	$.ajax({
		type: 'POST',
		url: url,
		async: false,
		contentType: "application/json",
		//dataType: 'jsonp',
		success: function(data) {

			$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

			// osvjezi podatke na ekranu za zadani element
			if (inList==true) {
				getAllTransfers();
				//refreshData(id, newData);
				//$(".editFrame").hide('slow');
			}
		},
		error: function(xhr, status, error) {alert("Error occured: " + xhr.status + " " + xhr.statusText); }
	});

	return false;
}



function changeDriverConfStatus(id, newStatus,inList) {
	// inList znaci je li prikaz sa liste ili nije

	if(!confirm('Are you sure?')) return false;

	if (notDefined(inList)) {inList=true;}
	$("#DriverConfStatus").val(newStatus);

	var formData = $("#transferEditForm"+id).serialize();

	// update data on server
	var url = 'api/'+
	'changeDriverConfStatus.php?DetailsID='+id+'&NewStatus='+ newStatus + '&'+ formData;

	$.ajax({
		type: 'POST',
		url: url,
		async: false,
		contentType: "application/json",
		//dataType: 'jsonp',
		success: function(data) {

			$("#statusMessage").html('<i class="ic-checkmark-circle s"></i> ');

			// osvjezi podatke na ekranu za zadani element
			if (inList==true) {
				getAllTransfers();
				//refreshData(id, newData);
				//$(".editFrame").hide('slow');
			}
		},
		error: function(xhr, status, error) {alert("Error occured: " + xhr.status + " " + xhr.statusText); }
	});

	return false;
}


function editPrint(id, inList) {
	// default value. inList znaci je li prikaz sa liste ili nije
	//if (typeof inList === "undefined" || inList === null) { inList = true; }
	if (notDefined(inList)) {inList=true;}

	if(inList==true) {
		window.print();
		//$(".editFrame").hide('slow');
	}
	alert('Document Printed');

  return false;
}


/* trazenje elementa object array-a i refresh liste transfera */
function refreshData(id, newData) {

  var result = $.grep(allTransfers, function(e){ return e.DetailsID == id; });

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

		ress.color = 'xgreen lighten-4 xblack-text';

		changeAll(id, ress);

		data = allTransfers;

		var source   = $("#transfersTemplate").html();
		var template = Handlebars.compile(source);

		var HTML = template({transfers : data});

		$("#showTransfers").html(HTML);
		//alert(result[0].Name);

  } else {
	// multiple items found
  }

}

/* promjena vrijednosti u object array-u */
function changeName( id, newName ) {
   for (var i in allTransfers) {
	 if (allTransfers[i].DetailsID == id) {
		allTransfers[i].PaxName = newName;
		break; //Stop this loop, we found it!
	 }
   }
}

/* promjena cijelog sloga datoteke odjednom */
function changeAll( id, sve ) {
   for (var i in allTransfers) {
	 if (allTransfers[i].DetailsID == id) {
		allTransfers[i] = sve;
		break; //Stop this loop, we found it!
	 }
   }
}


function applyChangeDriver(selectElement) {

	alert('Old driver and New driver will be informed of this change!');


	var id   = $("#DriverSelect").val();
/*  var name = $("#DriverSelect option:selected").attr('data-realName');
	//var id   = $("#DriverSelect option:selected").val();

	var tel  = $("#DriverSelect option:selected").attr('data-tel');
	var email= $("#DriverSelect option:selected").attr('data-email');


	// izmjena podataka u input poljima (hidden)
	// tako da se kod save-a mogu upisati u db
	$("#DriverID").val(id);
	$("#DriverName").val(name);
	$("#DriverTel").val(tel);
	$("#sendEmailTo").val(email);
*/
	$("#DriverConfDate").val('');
	$("#DriverConfTime").val('');

	if(id != 0) {
		$("#DriverConfStatus").val('1');
	} else {
		$("#DriverConfStatus").val('0');
	}
/*
	//$("#newDriverName").html(name);
	$("#newDriverConfirm").html('');
	$("#newDriverTel").html(tel);
	$("#newDriverEmail").html(email);
*/
			var newDriverEmail = $(selectElement).find(':selected').data('email');
			var newDriverTel   = $(selectElement).find(':selected').data('tel');
			var newDriverName  = $(selectElement).find(':selected').data('realname');
			var newDriverID = $(selectElement).val();

			$("#newDriverEmail").text(newDriverEmail);
			$("#newDriverTel").text(newDriverTel);
			$("#sendEmailTo").val(newDriverEmail);

			$("#DriverName").val(newDriverName);
			$("#DriverTel").val(newDriverTel);
			$("#DriverEmail").val(newDriverEmail);
			$("#DriverID").val(newDriverID);
console.log('newDriverID:' + newDriverID);
			// reset confirmation values
			//$("#DriverConfStatus").val('1');
			$("#DriverConfDate").val('');
			$("#DriverConfTime").val('');

}


// ponovno slanje potvrde vozacu ili putniku
function sendUpdateEmail(mailTo, mailFrom, fromName, subject, message, profile, DetailsID, responseButton) {
	var reason = $( "#ChangeTransferReason option:selected" ).text();
	console.log(reason);
	$responseButton = $(responseButton);
	var url = 'api/sendUpdateEmailN.php' +
		'?mailTo=' + mailTo +
		'&mailFrom=' + mailFrom +
		'&fromName=' + fromName +
		'&subject=' + subject +
		'&message=' + message +
		'&profile=' + profile +
		'&DetailsID=' + DetailsID +
		'&reason=' + reason +	
		'&callback=?';

	if (confirm("Are you sure?")) {
		$responseButton.children("div").html('Sending...');

		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',
			success: function(data) {
				$responseButton.children("div").html(data);
			}
		});
	}

	return false;
}


function sendEmailToDriver(transferId, tNo) {
	var subject = 'Update';
	var message = $("#DriverNotes").val();

	//var to		= 'bogo.split@gmail.com';

	// u produkciji ovo staviti
	var to = $("#sendEmailTo").val();

	var url = 'api/'+
		"sendEmail.php?to=" + to +
		"&subject=Ref. Order ID: " + transferId + '-' + tNo + ': '+ subject +
		"&message="+ message +
		"&callback=?";
	$("#sendMessageResponse").html('Sending...');

	$.ajax({
		type: 'POST',
		url: url,
		async: false,
		contentType: "application/json",
		dataType: 'jsonp',
		success: function(data) {
			$("#sendMessageResponse").html(data);
		}
	});

	return false;
}


function checkValues() {

	var DetailPrice = $('#DetailPrice').val();
	var ExtraCharge = $('#ExtraCharge').val();
	var Discount = $('#Discount').val();
	var ProvisionAmount = $('#ProvisionAmount').val();
	var PayLater = $('#PayLater').val();
	var PayNow = $('#PayNow').val();
	var InvoiceAmount = $('#InvoiceAmount').val();
	var DriversPrice = $('#DriversPrice').val();
	var DriverExtraCharge = $('#DriverExtraCharge').val();
	var DriverPaymentAmt = $('#DriverPaymentAmt').val();

	if (Number(DetailPrice)==0) alert ('Check Detail Price');
	if (Number(DriversPrice)==0) alert ('Check Driver Price');
	if ((Number(PayLater)+Number(PayNow)+Number(InvoiceAmount))==0) alert ('No Payment value');
	if ((Number(PayLater)+Number(PayNow)+Number(InvoiceAmount)+Number(ProvisionAmount)-Number(DetailPrice)-Number(ExtraCharge)+Number(DetailPrice)*Number(Discount)/100)!=0) alert ('Check prices');
	if ((Number(DriversPrice)+Number(DriverExtraCharge)-Number(DetailPrice)-Number(ExtraCharge)+Number(DetailPrice)*Number(Discount)/100) > 0) alert ('Driver price is greater than Detail price');

}

</script>
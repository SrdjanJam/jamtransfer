	var data_Items = [];
	window.base='http://localhost/jamtransfer/';
	var validationFields = ["PlaceTypeEN", "PlaceTypeRUS"];

	function allItems() {
		// podaci iz input polja - filtriranje
		var where  = $("#whereCondition").val(); // glavni filter koji uvijek radi
	 	var status = $("#Type").val(); // prikazuje po tipu	
	 	var status2 = $("#Type2").val(); // prikazuje po tipu	
	 	var status3 = $("#Type3").val(); // prikazuje po tipu	
		
	 	var active = $("#Active").val(); // prikazuje samo aktivne	
	 	var approved = $("#Approved").val(); // prikazuje samo aktivne	
	 	var filter = $("#Search").val(); // filtrira prema zadanom tekstu
	 	var length = $("#length").val(); // dropdown za broj prikazanih usera na stranici
	 	var transfersFilter = $("#transfersFilter").val(); // filter za transfere
	 	var orderid = $("#orderid").val(); // filter za orderid
	 	var detailid = $("#detailid").val(); // filter za detailid
	 	var sortOrder  = $("#sortOrder").val();		
	 	var orderFromDate = $("#orderFromDate").val();
		if (typeof orderFromDate=='undefined') orderFromDate='';
		var orderToDate = $("#orderToDate").val();
		if (typeof orderToDate=='undefined') orderToDate='';
	 	var pickupFromDate = $("#pickupFromDate").val();
		if (typeof pickupFromDate=='undefined') pickupFromDate='';
		var currentTime = new Date();			
		//if (typeof pickupFromDate=='undefined') pickupFromDate=currentTime.getFullYear()+'-01-01';
	 	var pickupToDate = $("#pickupToDate").val();
		if (typeof pickupToDate=='undefined') pickupToDate='';		
	 	var order = $("#order").val();
		if (typeof order=='undefined') order='';
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
		//if (typeof paymentMethod=='undefined') paymentMethod='-1';		
		var driverConfStatus = $("#DriverConfStatusChoose").val();
		//if (typeof driverConfStatus=='undefined') driverConfStatus='-1';
		var yearsOrder = $("#yearsOrder").val();
		if (typeof yearsOrder=='undefined') yearsOrder='0';
	 	var yearsPickup = $("#yearsPickup").val();
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
		if ($("#paymentChecker").is(':checked')) var paymentChecker=1;
		else var paymentChecker=0;		
		if ($("#flightTimeChecker").is(':checked')) var flightTimeChecker=1;
		else var flightTimeChecker=0;
		var reportBy = $("#reportBy").val();
		if (typeof reportBy=='undefined') reportBy='UserID';			
		var action = $("#action").val();
		if (typeof action=='undefined') action='0';		
		var callFunction = 'allItems()'; // funkcija koju paginator poziva kod promjene stranice
	
		// ovo koristi i paginator funkcija!
	 	var recordsTotal = 0;
	 	var page  = $("#pageSelector").val();
		if(typeof page==='undefined') {var page=1;}
		if(page<=0) {var page=1;}
	 	var url = window.root+'All.php';
		var data = 	
		'where='+where+
		'&Type='+status+
		'&Type2='+status2+
		'&Type3='+status3+
		'&Active='+active+
		'&Approved='+approved+
	 	'&Search='+filter+
		'&page='+page+
		'&length='+length+
		'&sortOrder='+sortOrder+
		'&transfersFilter='+transfersFilter+
		'&orderid='+orderid+
		'&detailid='+detailid+
		'&orderFromDate='+orderFromDate+
		'&orderToDate='+orderToDate+
		'&pickupFromDate='+pickupFromDate+
		'&pickupToDate='+pickupToDate+
		'&paymentNumber='+paymentNumber+	
		'&order='+order+
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
		'&paymentChecker='+paymentChecker+
		'&flightTimeChecker='+flightTimeChecker+
		'&routeID='+routeID+
		'&vehicleTypeID='+vehicleTypeID+
		'&vehicleID='+vehicleID+
		'&subdriverID='+subdriverID+
		'&actionID='+actionID+
		'&reportBy='+reportBy+
		'&action='+action+
		'&callback=?';
		console.log(url+'?'+data);
		$.ajax({
		 type: 'GET',
		  url: url+'?'+data,
		  //url: url,
		  //data: data,			
		  async: false,
		  contentType: "application/json",
		  dataType: 'jsonp',
		  success: function(ItemsData) {

			  // CUSTOM STUFF
			  var sum = ItemsData.sum;
			  // uzmi samo podatke o itemima
			  recordsTotal = ItemsData.recordsTotal;
			  paginator(page,recordsTotal,length, callFunction);
			  var data = ItemsData.data;			  
			  $.each(data, function(i, item) {
				data[i].color ='white';
			  });
				data_Items = data;
				// poziva se handlebars da pripremi prikaz
				var source   = $("#ItemListTemplate").html();
				var template = Handlebars.compile(source);
				var HTML = template({Item : data_Items, Item2: sum });
				$("#show_Items").html(HTML);
				
			/*if	(ItemsData.showfilter == 0) {
				$('.filter1').remove();
				$('.filter2').remove();
			}	
			  $("#PaymentMethod").prepend('<option value="-1">All method</option>');
			  $("#PaymentMethod option[value="+paymentMethod+"]").prop("selected", true)
			  $("#PaymentMethod").change(function() {
				  allItems();
			  }) 			  
			  $("#DriverConfStatusChoose").prepend('<option value="-1">All status</option>');
			  $("#DriverConfStatusChoose option[value="+driverConfStatus+"]").prop("selected", true)
			  $("#DriverConfStatusChoose").change(function() 
				  allItems();
			  }) */
			  if (ItemsData.yearsOrder ) {
				  var yearsOrderArr = ItemsData.yearsOrder;
				  $.each(yearsOrderArr, function(i, item) {
					    $('#yearsOrder').append('<option value="'+yearsOrderArr[i]+'">'+yearsOrderArr[i]+'</option>');
					});
					$("#yearsOrder option[value="+yearsOrder+"]").prop("selected", true)
			  }				  
			  if (ItemsData.orderFromDate) {
				  $("#orderFromDate").val(ItemsData.orderFromDate);
			  }				  
			  if (ItemsData.orderToDate) {
				  $("#orderToDate").val(ItemsData.orderToDate);
			  }			  
			  if (ItemsData.pickupFromDate) {
				  $("#pickupFromDate").val(ItemsData.pickupFromDate);
			  }			  
			  if (ItemsData.pickupToDate) {
				  $("#pickupToDate").val(ItemsData.pickupToDate);
			  }			 
			  if (ItemsData.sortField) {
				  $("#sortField").val(ItemsData.sortField);
			  }			  
			  if (ItemsData.sortDirection) {
				  $("#sortDirection").val(ItemsData.sortDirection);
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
			  if (ItemsData.reportBy ) {
				  $("#reportBy").val(ItemsData.reportBy);
			  }			  
			  if (ItemsData.action ) {
				  $("#action").val(ItemsData.action);
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
		      if (paymentChecker==1) $('#paymentChecker').prop('checked', true);
		      if (flightTimeChecker==1) $('#flightTimeChecker').prop('checked', true);
			  if (typeof window.filter == 'undefined') window.filter="down";
			  if ($(window).width() < 760 || window.filter == "down") filtersDown();
			  else	filtersUP();
				datetimepicker();			  
		  },
		  error: function() { alert('Get error occured.');}
		});
	}
	function filtersUP() {
		window.filter="up";
		$('.itemsheader2').show();
		$('#filtersUP').hide();
		$('#filtersDown').show();
	}		
	function filtersDown() {
		window.filter="down";		
		$('.itemsheader2').hide();
		$('#pageSelect').show();		
		$('#filtersDown').hide();	
		$('#filtersUP').show();		
	}	
	function oneItem(id,tab) { 
		var ModuleID=$('#ModuleID').val();
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
		$(".editFrame").hide(); 
		$(".editFrame form").html('');
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
				
				datetimepicker();
				
				// Trun off:
				// $("#ItemWrapper"+id)[0].scrollIntoView({
				// 	behavior: "smooth", // or "auto" or "instant"
				// 	block: "start" // or "end"
				// });	

				//$('.dorder, .dpayment, .dtransfer, .dpdriver, .dagent, .dpassenger').hide();
				//$('.d'+tab).show();
			},
			error: function(xhr, status, error) {alert("Show error occured: " + xhr.status + " " + xhr.statusText); }
		});

		var url =  "plugins/fieldsSettings.php?ModuleID="+ModuleID;
		console.log(url);
		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',
			success: function(out) {
				$.each(out.data, function() {
					console.log(this);
					var name = this.Name;
					if (this.Hidden != 1) {
						if (this.Disabled != 1) {
							if (this.Required == 1) $('.box-body').find("[name='"+name+"']").attr('required',true);
						} else 	$('.box-body').find("[name='"+name+"']").attr('disabled','disabled');
					} else $('.box-body').find("[name='"+name+"']").attr('hidden',true);
				})
			}	
		});	
		
	}
	function new_Item() { 

		var source   = $("#ItemEditTemplate").html();
		var template = Handlebars.compile(source);
		var HTML = template();
		$("#new_Item").html(HTML);
		$("#ItemWrapperNew").show('slow');
		
		var fieldsSettings = $("#fieldsSettings").val();
		if (fieldsSettings==1) fieldSetter();
	//})		
	}


	function editCloseItem(id) {
		$(".editFrame").hide('slow');$(".editFrame form").html(''); 
		return false;
	}

	function sendItem(id) {
		if($("#ItemEditForm"+id).valid() == false) {return false;}
		var newData = $("#ItemEditForm"+id).serializeObject();
		var formData = $("#ItemEditForm"+id).serialize();
		// update data on server
		var url = window.root + 'Send.php';
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
	function editSaveItem(id,returnT) {
		if (typeof returnT=='undefined') returnT=0;	
		$("#ItemEditForm"+id+" input ").each(function(){
			if( $.inArray($(this).attr('name'), validationFields) !== -1 ) {
				$(this).attr('required','required');
			}			
		})	
		if($("#ItemEditForm"+id).valid() == false) {return false;}
		var newData = $("#ItemEditForm"+id).serializeObject();
		//var formData = encodeURIComponent($("#ItemEditForm"+id).serialize());
		//var formData = $("#ItemEditForm"+id+" textarea:not('.textarea_html')").serialize();
		
		var formData='';
		$("#ItemEditForm"+id).find("input, select, textarea").each(function(){
			var encodehtml=htmlEnc($(this).val());
			formData=formData+'&'+$(this).attr('name')+'='+encodehtml;
		});
		console.log(formData);
						
		// update data on server
		var url = window.root + 'Save.php';
		var data = 'callback=?&id=' + id + '&' + formData + '&return=' + returnT;
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
					if (typeof data.page!=='undefined' && data.page=="orders") window.currenturl=window.currenturl+'/detail/'+data.insert
					else toastr['success']('New Item created');	
					setTimeout( function(){ 
						window.location.href = window.currenturl;					
					}  , 500 );
				}	
				else {
					if (typeof data.returnT!=='undefined' && data.returnT==1) {
						window.currenturl=window.currenturl+'/order/'+data.orderid;
						toastr['success']('New Item created');
						setTimeout( function(){ 
							window.location.href = window.currenturl;					
						}  , 500 );						
					}	
					else toastr['success']('Item updated');	
					setTimeout( function(){ 
						allItems();					
					}  , 500 );	
				}	
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

	function fieldSetter() {
		$('button').hide();
		var mid = $("#ModuleID").val();
		var lid = $("#levelID").val();
		$('iframe').each(function() {
			$(this).remove();
		})		
		$('input:not(:hidden), textarea').each(function() {
			var name=$(this).attr('name');
			$("#fsBlock input").attr('data-attr',name);
			var fsHTML = $("#fsBlock").html();
			$(this).after(fsHTML);			
			$(this).hide();
		})	
		
		var url =  "plugins/fieldsSettings.php?ModuleID="+mid+"&LevelID="+lid;
		console.log(url);
		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',
			success: function(out) {
				$.each(out.data, function() {
					console.log(this);
					var name = this.Name;
					if (this.Required == 1) $(":checkbox[name='required'][data-attr='"+name+"']").prop('checked',true);
					if (this.Disabled == 1) $(":checkbox[name='disabled'][data-attr='"+name+"']").prop('checked',true);
					if (this.Hidden == 1) $(":checkbox[name='hidden'][data-attr='"+name+"']").prop('checked',true);
				})
			}	
		});	
		
		$(":checkbox").click(function() {
			if ($(this).prop('checked')) var check=1;
			else var check=0;
			var fname=$(this).attr('data-attr');
			var setType = $(this).attr('name');
			var param = 'LevelID='+lid+'&ModuleID='+mid+'&Name='+fname+'&SetType='+setType+'&SetValue='+check;
			var url =  "plugins/fieldsSetter.php?"+param;
			console.log(url);
			$.ajax({
				type: 'GET',
				url: url,
				async: false,
				success: function() {
					toastr['success']('Item updated');
				}	
			});
		});	
	}

	
	function datetimepicker() {
		$('.datepicker').datetimepicker({
			// yearOffset:2,
			lang:'en',
			timepicker:false,
			format:'Y-m-d',
			formatDate:'Y-m-d',
			closeOnDateSelect:true
			// minDate:'-1970/01/02', // yesterday is minimum date
			// maxDate:'+1970/01/02' // and tommorow is maximum date calendar
		});
		$('.timepicker').clockTimePicker();	
	}	

	function htmlEnc(s) {
		var value=encodeURIComponent(s);
		if (value.indexOf('style')>-1) value =  value.replace(/style/g,'WstyleW');
		if (value.indexOf('img')>-1) value =  value.replace(/img/g,'WimgW');
		if (value.indexOf('src')>-1) value =  value.replace(/src/g,'WsrcW');
		if (value.indexOf('script')>-1) value =  value.replace(/script/g,'WscriptW');		
		if (value.indexOf('link')>-1) value =  value.replace(/link/g,'WlinkW');		
		if (value.indexOf('&')>-1) value =  value.replace(/&/g,'%26');
		//if (value.indexOf('+')>-1) value =  value.replace(/\+/g,'%2B');	
		return value;	
	  /*return s.replace(/&/g, '&amp;')
		.replace(/</g, '%25lt;')
		.replace(/>/g, '%25gt;')
		.replace(/'/g, '%25#39;')
		.replace(/"/g, '%25#34;');*/
		
	}
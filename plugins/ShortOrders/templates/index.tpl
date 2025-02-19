<form id="headerform" action="" method="post">
	<div class="row">	
		<div class="col-md-2">
			<span class="text-light-blue">
				<i class="ic-stack"></i> <span id="countObject">{$countObject}</span> | 
				<i class="fa fa-eye"></i> <span id="offsetFrom">{$offsetFrom}</span>-<span id="offsetTo">{$offsetTo}</span> | 
				<i class="ic-file"></i> <span id="pageno">{$smarty.request.pageno}</span>/<span id="pagesno">{$pagesno}</span>
			</span>
		</div>
		<div id="transferStatusSelect" class="col-md-2">
			<i class="fa fa-list-ul"></i>
			<select class="w75 form-control" id="transferStatusSelect" name="transferStatus" style="width:50%;">
				<option value="0">---</option>
				{section name=pom loop=$status_keys}
					<option value="{$status_keys[pom]}" {if $smarty.request.transferStatus eq $status_keys[pom]}selected{/if}>{$StatusDescription[{$status_keys[pom]}]}</option>
				{/section}	
			</select>
		</div>
		<div class="col-md-2">
			<i class="fa fa-eye edit-fa"></i>
			<select id="length" name="pagelength" class="w75 form-control control-edit" style="width:50%;">
				<option value="5" {if $smarty.request.pagelength eq '5'} selected {/if}> 5 </option>
				<option value="10" {if $smarty.request.pagelength eq '10'} selected {/if}> 10 </option>
				<option value="20" {if $smarty.request.pagelength eq '20'} selected {/if}> 20 </option>
				<option value="50" {if $smarty.request.pagelength eq '50'} selected {/if}> 50 </option>
				<option value="100" {if $smarty.request.pagelength eq '100'} selected {/if}> 100 </option>
			</select>
		</div>		
		<div class="col-md-2">
			<i class="fa fa-search"></i>
			<input class="" type="text" name="Search" class=" w75" value="{$smarty.request.Search}" placeholder="Text + Enter to Search">
		</div>			
		<div id="pageSelect" class="col-md-2">
			<button class="btn btn-primary align" onclick="paginatorPrevPage();">Prev</button>
			<select id="pageSelector" name="pageno" style="padding: 2px;width:20%;border-radius:5px;box-shadow: 0px 0px 4px 1px #888888;">
				{section name=pom loop=$pages}
					<option value="{$pages[pom]}" {if $smarty.request.pageno eq $pages[pom]}selected{/if}>{$pages[pom]}</option>
				{/section}	
			</select>
			<button class="btn btn-primary align" onclick="paginatorNextPage();" style="margin-top:0;">Next</button>		
		</div>
		<div id="durationTime" class="col-md-2"><i class="fa-solid fa-hourglass-start"></i> {$durtime}</div>
	</div>		
	<button class="btn-block" type="button" data-toggle="collapse" data-target="#header" aria-expanded="false" aria-controls="collapseExample">
		Advanced search
	</button>
	<div class="row collapse" id="header">
		<div class="col-md-2">
			<select name="filterDatePeriod" id="filterDatePeriod" class="form-control">
				<option value="OrderDate>=" {if $smarty.request.filterDatePeriod eq "OrderDate>="}SELECT{/if}>{$AFTER_INCLUDING} {$ORDER_DATE}</option>
				<option value="OrderDate>" {if $smarty.request.filterDatePeriod eq "OrderDate>"}SELECT{/if}> {$AFTER} {$ORDER_DATE}</option>
				<option value="OrderDate<" {if $smarty.request.filterDatePeriod eq "OrderDate<"}SELECT{/if}> {$BEFORE} {$ORDER_DATE}</option>
				<option value="OrderDate=" {if $smarty.request.filterDatePeriod eq "OrderDate="}SELECT{/if}> {$ON} {$ORDER_DATE}</option>		
				<option value="PickupDate>=" {if $smarty.request.filterDatePeriod eq "PickupDate>="}SELECT{/if}> {$AFTER_INCLUDING} {$PICKUP_DATE}</option>
				<option value="PickupDate>" {if $smarty.request.filterDatePeriod eq "PickupDate>"}SELECT{/if}> {$AFTER} {$PICKUP_DATE}</option>
				<option value="PickupDate<" {if $smarty.request.filterDatePeriod eq "PickupDate<"}SELECT{/if}> {$BEFORE} {$PICKUP_DATE}</option>
				<option value="PickupDate=" {if $smarty.request.filterDatePeriod eq "PickupDate="}SELECT{/if}> {$ON} {$PICKUP_DATE}</option>
			</select>
		</div>
		<div class="col-md-2">
			<input type="text" name="filterDate" class="w50 datepicker" value="{$smarty.request.filterDate}">
		</div>	

		<div class="col-md-2">
			<select name="sortOrder" id="sortOrder" value="{$sortOrder}" class="form-control">
				<option value="OrderDate DESC" {if $smarty.request.sortOrder eq "OrderDate DESC"}SELECT{/if}>{$ORDER_DATE} {$DESCENDING} </option>
				<option value="OrderDate ASC" {if $smarty.request.sortOrder eq "OrderDate ASC"}SELECT{/if}>{$ORDER_DATE} {$ASCENDING} </option>
				<option value="PickupDate DESC" {if $smarty.request.sortOrder eq "PickupDate DESC"}SELECT{/if}>{$PICKUP_DATE} {$DESCENDING} </option>
				<option value="PickupDate ASC" {if $smarty.request.sortOrder eq "PickupDate ASC"}SELECT{/if}>{$PICKUP_DATE} {$ASCENDING} </option>
			</select>
		</div>

		<div class="col-md-2">
			<select class="form-control" name="extraServices" id="extraServicesChoose">
				<option value="-1"> {$ANY}</option>
				<option value=">0" {if $smarty.request.extraServices eq ">0"}SELECT{/if}> {$ONLY_EXTRAS} </option>
				<option value="=0" {if $smarty.request.extraServices eq "=0"}SELECT{/if}> {$NO_EXTRAS} </option>
			</select>
		</div>
		<div class="col-md-2">
			<strong>Process duration:<br> {$durtime}</strong>
		</div>	
	</div>
</form>
<div id='tablerows'>
{section name=pom loop=$ordersD}
	<button class="btn-block {$ordersD[pom].cancel}" type="button" data-toggle="collapse" data-id="{$ordersD[pom].DetailsID}" data-target="#collapseExample{$ordersD[pom].DetailsID}" aria-expanded="false" aria-controls="collapseExample">
		<div class="">	
			<div class="row">
				<div class="col-md-2">
					<i class="fa fa-user"></i> <strong>{$ordersD[pom].PaxName}</strong><br>
					<small>
						<i class="fa fa-envelope-o"></i> {$ordersD[pom].Master.MPaxEmail}
						<br>
						<i class="fa fa-phone"></i> {$ordersD[pom].Master.MPaxTel}
						<br>
						<small>{$ordersD[pom].OrderDate} {$ordersD[pom].Master.MOrderTime}</small>
					</small>
				</div>
				<div class="col-md-2">
					<strong>{$ordersD[pom].Master.MOrderID} - {$ordersD[pom].TNo}</strong><br>
					{$ordersD[pom].DetailPrice|number_format:2:".":","} € + {$ordersD[pom].ExtraCharge} € <br>
					<small>{$StatusDescription[{$ordersD[pom].TransferStatus}]}</small>
				</div>
				<div class="col-md-2">
					{$ordersD[pom].PickupDate} / {$ordersD[pom].PickupTime}<br>
					<i class="fa fa-user-times"></i> <strong>{$ordersD[pom].PaxNo}</strong>&nbsp;
					<i class="fa fa-car"></i> <strong>{$ordersD[pom].VehiclesNo}</strong><br>
					{if $ordersD[pom].ExtrasArr|count gt 0}
						<i class="fa fa-suitcase" style="color:#900"></i>
					{/if}
				</div>

				<div class="col-md-3">
					<strong>{$ordersD[pom].PickupName}</strong>
					<br>
					<strong>{$ordersD[pom].DropName}</strong>
					<br>
					{if $ordersD[pom].StaffNote}<small style="color:red">STAFF NOTE</small>{/if}	
				</div>
				<div class="col-md-3">
					{if $ordersD[pom].DriverName}
						<i class="fa fa-car"></i> {$ordersD[pom].DriverName}
					{/if}	
					<br>
					<span class="{$driverConfClass[{$ordersD[pom].DriverConfStatus}]}">{$DriverConfStatus[{$ordersD[pom].DriverConfStatus}]}</span>
					{if $ordersD[pom].FinalNote}<span class="note btn btn-danger">Note</span>{/if}	
					<br>
					<small>{$ordersD[pom].DriverConfDate} {$ordersD[pom].DriverConfTime}</small>	
					<br>
					{if $ordersD[pom].PaymentMethod eq 1} {$ordersD[pom].Master.MCardNumber}	{/if}
					{if $ordersD[pom].PaymentMethod eq 3} {$ordersD[pom].Master.MCardNumber}	{/if}
				</div>
				{if $ordersD[pom].FinalNote}<small style="color:red">{$ordersD[pom].FinalNote}</small>{/if}	
			</div>
		</div>			
	</button>
	<div class="collapse" id="collapseExample{$ordersD[pom].DetailsID}">
		<div class="card card-body">
			{include file="{$root}/plugins/{$base}/templates/edit.tpl"}
		</div>
	</div>
{/section}
</div>
  {*<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a>*}

<script>
{literal}
	const ids = ["tablerows", "pageSelector", "countObject","offsetFrom","offsetTo","pageno","pagesno","durationTime"];

	$('#headerform select, #headerform input').change(function(){
		event.preventDefault();
		var param = $('#headerform').serialize();
		console.log(window.location+'?'+param);
		 $.ajax({
				type: "POST",
				//contentType: "application/json; charset=utf-8",
				url: window.location,
				data: param,
				success: function(data) {
					$.each(ids, function(index, value) {
						changeHTML(value,data);
					});
				},
				error: function(result) {
					alert("Error");
				}
			});   	
		$('#headerform').submit();
	})
	$(".drivers-modal").click(function(){
		var id=$(this).attr("data-target");
		var DetailsID=$(this).attr("data-detailsid");
		var RouteID=$(this).attr("data-routeid");
		var PickupDate=$(this).attr("data-pickupdate");
		var PickupTime=$(this).attr("data-pickuptime");
		var AgentID=$(this).attr("data-agentid");
		$(id).find(".driverByRoute").html(listDrivers(RouteID,  PickupDate, PickupTime, AgentID));
		$(".selectowner").click(function(){
			$(".modalbutton").trigger("click");
			var href=$(this).parents().find('#confirlmLink'+DetailsID+' a').attr('href');
			var olddriverid=$(this).parents().find('#DriverID'+DetailsID).val();
			href=href.replace(olddriverid,$(this).attr("data-ownerid"));
			$(this).parents().find('#confirlmLink'+DetailsID+' a').attr('href',href);
			$(this).parents().find('#DriverName'+DetailsID).html($(this).html());
			$(this).parents().find('#DriverID'+DetailsID).val($(this).attr("data-ownerid"));
			$(this).parents().find('#DriverTel'+DetailsID).html($(this).attr("data-mobile"));
			$(this).parents().find('#DriverEmail'+DetailsID).html($(this).attr("data-mail"));
			$(this).parents().find('#DriverConfStatus'+DetailsID).html('<span class="{/literal}{$driverConfClass[1]}{literal}">{/literal}{$DriverConfStatus[1]}{literal}</span>');
		})		
	})
	$(".logs-modal").click(function(){
		var DetailsID=$(this).attr("data-detailsid");
		var id=$(this).attr("data-target");
		var param="id="+DetailsID;
		var url= "plugins/ShortOrders/getLogs.php";
		console.log(url+'?'+param);
		$.ajax({
			url: url,
			type: "GET",
			data: param,
			success: function (data) {
				$(id).find(".logs").html(data);
			}
		})
	})

	$(".ExtrasID").change(function(){
		if ($(this).find("option:selected").val()!=-1) {
			$(this).parent().parent().find(".ExtrasPrice").removeClass("hidden");
			$(this).parent().parent().find(".ExtrasQty").removeClass("hidden");
			$(this).parent().parent().find(".multiple").removeClass("hidden");
		}	
		else {
			$(this).parent().parent().find(".ExtrasPrice").addClass("hidden");
			$(this).parent().parent().find(".ExtrasPrice").val(0);
			$(this).parent().parent().find(".ExtrasQty").addClass("hidden");
			$(this).parent().parent().find(".ExtrasQty").val(0);
			$(this).parent().parent().find(".ExtrasQty").trigger("change");
			$(this).parent().parent().find(".multiple").addClass("hidden");
		}	
	})	
	$(".ExtrasPrice,.ExtrasQty").change(function(){
		var price=Number(0);
		var DetailsID=$(this).attr("data-id");
		$(this).parent().parent().parent().find('.extrasrow').each(function(){
			var pr=Number($(this).find(".ExtrasPrice").val());
			$(this).find(".ExtrasPrice").val(pr.toFixed(2));
			price=price+Number($(this).find(".ExtrasPrice").val())*Number($(this).find(".ExtrasQty").val());
		})
		$("#collapseExample"+DetailsID).find(".ExtraCharge").val(Number(price).toFixed(2));
		$("#collapseExample"+DetailsID).find("#ExtraChargeShow").html(Number(price).toFixed(2));
	})
	$(".save").click(function(){
		var id = $(this).attr("data-id");
		var param=$("#form"+id).serialize();
		var url= "plugins/ShortOrders/saveTransfer.php";
		console.log(url+'?'+param);
		$.ajax({
			url: url,
			type: "GET",
			data: param,
			success: function (data) {
				if (data==="OK") {
					toastr['success'](window.success);	
					$("#headerform input").trigger("change");
				}	
				else toastr['fail']("Something wrong");	
			},
			error: function (data) {
				toastr['fail']("Something wrong");	
			}
		})
	})
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
	
	function changeHTML(id,data) {
		var id='#'+id;
		var html=$($.parseHTML(data)).find(id).html();
		$(id).html(html);					
	}
	
	function listDrivers(RouteID,  PickupDate, PickupTime, AgentID) {
		var url = 'api/getCarsAjax.php?RouteID='+RouteID+'&TransferDate='+PickupDate+'&TransferTime='+PickupTime+'&AgentID='+AgentID+'&callback=';
		var list = '';
		var funcArgs = '';
		console.log(url);
		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',

			success: function(data) {
				$.each(data, function(i,val) {
					//funcArgs = "'" + val.OwnerID + "', '" + val.VehicleTypeID + "', '" + val.VehicleTypeName + "', '" + val.DriverEmail + "', '" + val.DriverTel + "'";
					//funcArgs += ", '" + val.FinalPrice + "', '" + val.DriversPrice + "'";
					var surcharges ='';
					if (val.NightPrice!=0) surcharges = '<br>Night: '+val.NightPrice;
					if (val.MonPrice!=0) surcharges += '<br>Monday: '+ val.MonPrice;
					if (val.TuePrice!=0) surcharges += '<br>Tuesday: '+ val.TuePrice;
					if (val.WedPrice!=0) surcharges += '<br>Wednesday: '+ val.WedPrice;
					if (val.ThuPrice!=0) surcharges += '<br>Thusday: '+ val.ThuPrice;
					if (val.FriPrice!=0) surcharges += '<br>Friday: '+ val.FriPrice;
					if (val.SatPrice!=0) surcharges += '<br>Saterday: '+  val.SatPrice;
					if (val.SunPrice!=0) surcharges += '<br>Sunday: '+ val.SunPrice;
					if (val.S1Price!=0) surcharges += '<br>Season1: '+  val.S1Price;
					if (val.S2Price!=0) surcharges += '<br>Season2: '+  val.S2Price;
					if (val.S3Price!=0) surcharges += '<br>Season3: '+  val.S3Price;
					if (val.S4Price!=0) surcharges += '<br>Season4: '+  val.S4Price;
					if (val.S5Price!=0) surcharges += '<br>Season5: '+  val.S5Price;
					if (val.S6Price!=0) surcharges += '<br>Season6: '+  val.S6Price;
					if (val.S7Price!=0) surcharges += '<br>Season7: '+  val.S7Price;
					if (val.S8Price!=0) surcharges += '<br>Season8: '+  val.S8Price;
					if (val.S9Price!=0) surcharges += '<br>Season9: '+  val.S9Price;
					if (val.S10Price!=0) surcharges += '<br>Season10: '+ val.S10Price;
					if (val.SpecialDatesPrice!=0) surcharges += '<br>Special Date: '+ val.SpecialDatesPrice;
					if (val.StatusCompany!="") var select='red-123';					
					//else if (val.VehicleTypeID==VehicleType) var select='green-123';
					else var select='';
					val.DriverCompany=val.DriverCompany+val.Contract;
					list += '<div class="row selectable selectable-edit '+select+'">';
					list += '<div class="col-md-3" style="text-align:center;">' + val.DriverCompanyButton + val.StatusCompany  + '</div>';
					list += '<div class="col-md-1" style="text-align:center;">' + val.VehicleTypeID + '</div>';
					list += '<div class="col-md-1 right">' + val.DriversPrice + '</div>';	   /* Neto */					
					list += '<div title="Surcharges" data-content="' +surcharges + '" class="col-md-1 right mytooltip">' + val.AddToPrice + '</div>';		  /* Additions */
					list += '<div class="col-md-1 right">' + val.Provision + '</div>';		  /* Provision */
					list += '<div class="col-md-2 right">' + val.FinalPrice + '</div>';		 /* FinalPrice */
					//list += '<div class="col-md-1 right">' + val.Provision2 + '</div>';		  /* Provision */
					//list += '<div class="col-md-2 right">' + val.FinalPrice2 + '</div>';		 /* FinalPrice */
					list += '</div>';
				});

			},
			error: function(data) {
				console.log('Error:');
				console.log(data);
			}
		});
		return list;
	}
	
{/literal}	
</script>




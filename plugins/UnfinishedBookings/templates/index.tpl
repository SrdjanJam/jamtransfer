<form id="headerform" action="" method="post">
	<div class="row">	
		<div class="col-md-2">
			<span class="text-light-blue">
				<i class="ic-stack"></i> <span id="countObject">{$countObject}</span> | 
				<i class="fa fa-eye"></i> <span id="offsetFrom">{$offsetFrom}</span>-<span id="offsetTo">{$offsetTo}</span> | 
				<i class="ic-file"></i> <span id="pageno">{$smarty.request.pageno}</span>/<span id="pagesno">{$pagesno}</span>
			</span>
		</div>
		<div class="col-md-2">
			<i class="fa fa-eye edit-fa"></i>
			<select id="length" name="pagelength" class="w75 form-control control-edit f_ch" style="width:50%;">
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
			<select class="f_ch" id="pageSelector" name="pageno" style="padding: 2px;width:20%;border-radius:5px;box-shadow: 0px 0px 4px 1px #888888;">
				{section name=pom loop=$pages}
					<option value="{$pages[pom]}" {if $smarty.request.pageno eq $pages[pom]}selected{/if}>{$pages[pom]}</option>
				{/section}	
			</select>
			<button class="btn btn-primary align" onclick="paginatorNextPage();" style="margin-top:0;">Next</button>		
		</div>
	</div>		
	<button class="btn-block" type="button" data-toggle="collapse" data-target="#header" aria-expanded="false" aria-controls="collapseExample">
		Advanced search
	</button>
	<div class="row collapse" id="header">
		<div class="col-md-2">
			<select name="sortOrder" id="sortOrder" value="{$sortOrder}" class="form-control">
				<option value="PickupDate ASC, PickupTime ASC" {if $smarty.request.sortOrder eq "PickupDate ASC PickupTime ASC"}SELECTED{/if}>{$PICKUP_DATE} {$ASCENDING} </option>
				<option value="PickupDate DESC, PickupTime DESC" {if $smarty.request.sortOrder eq "PickupDate DESC, PickupTime DESC"}SELECTED{/if}>{$PICKUP_DATE} {$DESCENDING} </option>
				<option value="OrderDate ASC" {if $smarty.request.sortOrder eq "OrderDate ASC"}SELECTED{/if}>{$ORDER_DATE} {$ASCENDING} </option>
				<option value="OrderDate DESC" {if $smarty.request.sortOrder eq "OrderDate DESC"}SELECTED{/if}>{$ORDER_DATE} {$DESCENDING} </option>
			</select>
		</div>

		<div class="col-md-2">
			<select class="form-control" name="extraServices" id="extraServicesChoose">
				<option value="-1"> {$ANY}</option>
				<option value=">0" {if $smarty.request.extraServices eq ">0"}SELECTED{/if}> {$ONLY_EXTRAS} </option>
				<option value="=0" {if $smarty.request.extraServices eq "=0"}SELECTED{/if}> {$NO_EXTRAS} </option>
			</select>
		</div>
		<div class="col-md-2">
			<button id="apply" class="form-contol btn-primary" type="button">Apply</button>
		</div>	
	</div>
</form>
<div id='tablerows'>
{section name=pom loop=$ordersD}
	<button class="btn-block {$ordersD[pom].cancel}" type="button" data-toggle="collapse" data-id="{$ordersD[pom].DetailsID}" data-target="#collapseExample{$ordersD[pom].DetailsID}" aria-expanded="false" aria-controls="collapseExample">
		<div class="">	
			<div class="row">
				<div class="col-md-2">
					<a target='_blank' href='{$ordersD[pom].UserLink}'><i class="fa fa-user"></i> <strong>{$ordersD[pom].UserName}</strong></a>
					{$ordersD[pom].Level}
					<small>
						<br>
						<i class="fa fa-envelope-o"></i> {$ordersD[pom].UserEmail}
						<br>
						<i class="fa fa-phone"></i> {$ordersD[pom].UserPhone}
						<br>
					</small>
				</div>
				<div class="col-md-2">
					<small><strong>{$ordersD[pom].OrderDate} {$ordersD[pom].Master.MOrderTime}</strong></small><br>
					<strong>{$ordersD[pom].OrderID} - {$ordersD[pom].TNo}</strong><br>
					{$ordersD[pom].DetailPrice|number_format:2:".":","} € + {$ordersD[pom].ExtraCharge} € <br>
				</div>
				<div class="col-md-2">
					{$ordersD[pom].PickupDate} / {$ordersD[pom].PickupTime}<br>
					<i class="fa fa-user-times"></i> <strong>{$ordersD[pom].PaxNo}</strong>&nbsp;
					{if $ordersD[pom].VehicleType}
						<br><i class="fa fa-car"></i> <strong>{$ordersD[pom].VehicleTypeName} {$ordersD[pom].VehiclesNo}</strong><br>
					{/if}	
				</div>

				<div class="col-md-3">
					<strong>{$ordersD[pom].PickupName}</strong>
					<br>
					<strong>{$ordersD[pom].DropName}</strong>
					<br>
				</div>
				<div class="col-md-3">
					<strong>{$ordersD[pom].Step}</strong><br>
					{section name=pom2 loop=$ordersD[pom].transfers}
						<div class='badge'>
							<a target='_blank' 
								href='orders/detail/{$ordersD[pom].transfers[pom2].TransferID}'
								title='<b>{$ordersD[pom].transfers[pom2].TransferText} </b>' 
								data-content='
									<br/>{$ORDER_DATE}: {$ordersD[pom].transfers[pom2].OrderDate}
									<br/>{$PICKUP_DATE}: {$ordersD[pom].transfers[pom2].PickupDate}
									<br/>{$FROM}: {$ordersD[pom].transfers[pom2].PickupName}
									<br/>{$TO}: {$ordersD[pom].transfers[pom2].DropName}
									<br/>{$PRICE}: {$ordersD[pom].transfers[pom2].DetailPrice}
									<br/>{$TRANSFER_STATUS}: {$StatusDescription[{$ordersD[pom].transfers[pom2].TransferStatus}]}
								' 
								class="mytooltip"								
								
							>
								{$ordersD[pom].transfers[pom2].TransferText}
							</a>
						</div>
					{/section}
					<br>
					{*<a href='https://prod.jamtransfer.com/send/emailQuote/tempToLive?tok={$ordersD[pom].Master.MOrderKey}'>
						Make PreOrder
					</a>*}
					<br>
				</div>
			</div>
		</div>			
	</button>
{/section}
</div>

{literal}	
<script>
	$('#apply').click(function(){
		sbm_header();
	})	
	function sbm_header() {
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
	}
	
	$(".save").click(function(){
		var id = $(this).attr("data-id");
		var param=$("#form"+id).serialize();
		var url= "plugins/UnfinishedBookings/saveTransfer.php";
		console.log(url+'?'+param);
		$.ajax({
			url: url,
			type: "GET",
			data: param,
			success: function (data) {
				if (data==="OK") {
					toastr['success'](window.success);	
					sbm_header();
				}	
				else alert(data);	
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
	
	$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});

	
{/literal}	
</script>


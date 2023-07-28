	<style>
		.payment-label, .payment-content{
			display: flex;
		}
		.payment-label div, .payment-content div{
			flex: 1 1 0px; /* or flex:100%; */
			padding-left: 5px;
		}


		.payment-label{
			padding: 10px 5px;
			color:#179ae6;
			border-bottom: 1px solid #179ae6;
			font-weight: bold;
		}
		.payment-label div{
			border-right: 1px solid #179ae6;
		}
		.payment-label div:last-child {
  			border: none;
		}


		.payment-content{
			border-bottom: 1px solid #3d5766;
			padding: 5px;
		}
		.payment-content div{
			border-right: 1px solid #3d5766;
		}
		.payment-content div:last-child {
  			border: none;
		}


		.box-body .payment-content:last-child{
			border: none;
		}
	</style>


    <div class="box box-info">

        <div class="box-header">
            <i class="fa fa-credit-card"></i>
            <h3 class="box-title">{$UNFINISHED_ONLINE_PAYMENT}</h3>
		</div>

		<div class="box-body">

			<div class="payment-label">
				<div>{$NUMBER_KEY}</div>
				<div>{$NAME}</div>
				<div>{$EMAIL}</div>
				<div>{$TIME}</div>
				<div>{$EUR}</div>
				{* <div>Status</div> *}
			</div>

			{if count($payments) gt 0}

			{section name=index loop=$payments}
				<div class="payment-content">
					<div> {$payments[index].MOrderKey}  </div>
					<div> {$payments[index].MPaxFirstName} {$payments[index].MPaxLastName} </div>
					<div> {$payments[index].MPaxEmail} </div>
					<div> {$payments[index].MOrderDate} {$payments[index].MOrderTime} </div>
					<div> {$payments[index].MPayNow} </div>
					{* <div> {$payments.MPaymentStatus} </div> *}
				</div>
			{/section}

			{else}
				<div class="payment-content">
					<div>No unfinished payment</div>
				</div>
			{/if}

		</div>
	</div>	
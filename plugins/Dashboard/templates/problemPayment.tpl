

	<div class="box box-info">
        <div class="box-header">
            <i class="fa fa-credit-card"></i>
            <h3 class="box-title">Disputed online payment</h3>
			<div class="pull-right box-tools">
				<button class="btn btn-info btn-sm" data-name="problem-payment" data-name2="test"><i class="fa fa-plus"></i></button>
                <button class="btn btn-warning btn-sm" data-widget='remove' 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
		</div>

		<div class="box-body problem-payment">
			<div class="row">	
				<div class="col-md-1">Order ID</div>
				<div class="col-md-1">Name</div>
				<div class="col-md-4"><small>Email</small></div>
				<div class="col-md-3">Time</div>
				<div class="col-md-1">EUR</div>
				<div class="col-md-2">Payment Number</div>
			</div>
			{if count($porders) gt 0}
			{section name=index loop=$porders}
			<div class="row">
				<div class="col-md-1">{$porders[index].MOrderID}</div>
				<div class="col-md-1">{$porders[index].MPaxFirstName} {$porders[index].MPaxLastName} </div>
				<div class="col-md-4">
					</small><a target='_blank'
					href="https://ipg.monri.com/transactions?utf8=%E2%9C%93&q%5Btransaction_type_eq%5D=&q%5Bstatus_eq%5D=&q%5Bresponse_code_eq%5D=&q%5Beci_eq%5D=&q%5Benrolled_eq%5D=&q%5Bpares_status_eq%5D=&q%5Bcc_type_eq%5D=&q%5Bcurrency_eq%5D=&q%5Bagent_id_eq%5D=&q%5Bmerchant_id_eq%5D=&q%5Bdirection_eq%5D=&q%5Bsource_eq%5D=&q%5Bpayment_provider_logid_eq%5D=&q%5Bid_eq%5D=&q%5Border_number_cont%5D=&q%5Border_info_cont%5D=&q%5Breference_number_or_infoswitch_internal_rrn_cont%5D=&q%5Bsystan_cont%5D=&q%5Bamount_eq%5D=&q%5Bmasked_pan_cont%5D=&q%5Bapproval_code_cont%5D=&q%5Bch_full_name_cont%5D=&q%5Bch_email_cont%5D={$porders[index].MPaxEmail}&q%5Bch_country_cont%5D=&q%5Bip_cont%5D=&q%5Bcompany_name_cont%5D=&q%5Bresponse_message_cont%5D=&q%5Bintegration_type_cont%5D=&q%5Blibrary_cont%5D=&q%5Blibrary_version_cont%5D=&q%5Bpayout_date_cont%5D=&q%5Bpayout_reference_cont%5D=&q%5Bid_gteq%5D=&q%5Bid_lteq%5D=&q%5Bcreated_at_gteq%5D=01.01.2023+00%3A00&q%5Bcreated_at_lteq%5D=&q%5Bamount_gteq%5D=&q%5Bamount_lteq%5D=&q%5Bmaxmind_risk_score_gteq%5D=&q%5Bmaxmind_risk_score_lteq%5D=&q%5Bnumber_of_installments_gteq%5D=&q%5Bnumber_of_installments_lteq%5D=&tab=values"
					>{$porders[index].MPaxEmail}</a></small>
				</div>
				<div class="col-md-3"><small>{$porders[index].MOrderDate} {$porders[index].MOrderTime} </small></div>
				<div class="col-md-1">{$porders[index].MPayNow} </div>		
				<div class="col-md-2">
					<small><a target="_blank" href="https://ipg.monri.com/transactions?utf8=%E2%9C%93&q%5Btransaction_type_eq%5D=&q%5Bstatus_eq%5D=&q%5Bresponse_code_eq%5D=&q%5Beci_eq%5D=&q%5Benrolled_eq%5D=&q%5Bpares_status_eq%5D=&q%5Bcc_type_eq%5D=&q%5Bcurrency_eq%5D=&q%5Bagent_id_eq%5D=&q%5Bmerchant_id_eq%5D=&q%5Bdirection_eq%5D=&q%5Bsource_eq%5D=&q%5Bpayment_provider_logid_eq%5D=&q%5Bid_eq%5D=&q%5Border_number_cont%5D=
					{$porders[index].MCardNumber}
					&q%5Border_info_cont%5D=&q%5Breference_number_or_infoswitch_internal_rrn_cont%5D=&q%5Bsystan_cont%5D=&q%5Bamount_eq%5D=&q%5Bmasked_pan_cont%5D=&q%5Bapproval_code_cont%5D=&q%5Bch_full_name_cont%5D=&q%5Bch_email_cont%5D=&q%5Bch_country_cont%5D=&q%5Bip_cont%5D=&q%5Bcompany_name_cont%5D=&q%5Bresponse_message_cont%5D=&q%5Bintegration_type_cont%5D=&q%5Blibrary_cont%5D=&q%5Blibrary_version_cont%5D=&q%5Bpayout_date_cont%5D=&q%5Bpayout_reference_cont%5D=&q%5Bid_gteq%5D=&q%5Bid_lteq%5D=&q%5Bcreated_at_gteq%5D=01.01.2023+00%3A00&q%5Bcreated_at_lteq%5D=&q%5Bamount_gteq%5D=&q%5Bamount_lteq%5D=&q%5Bmaxmind_risk_score_gteq%5D=&q%5Bmaxmind_risk_score_lteq%5D=&q%5Bnumber_of_installments_gteq%5D=&q%5Bnumber_of_installments_lteq%5D=&tab=values">
					{$porders[index].MCardNumber}</a></small>
				</div>		
			</div>			
			{/section}
			{/if}
		</div>	
	</div>	
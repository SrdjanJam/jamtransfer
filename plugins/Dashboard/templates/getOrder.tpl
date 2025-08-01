    <!-- get transfer  widget -->
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-car"></i>
            <h3 class="box-title">{$GET_TRANSFER_ORDER}</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                
                <button class="btn btn-info btn-sm" data-name="get-order"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-warning btn-sm"  
                data-toggle="tooltip" data-widget='remove' title="Remove"><i class="fa fa-times"></i></button>

            </div><!-- /. tools -->
        </div>
        <div class="box-body get-order">
			<form action="shortOrders/order" method="post"> 
				<div class="row">
					<div class="col-md-4">{$TRANSFER_ORDER_NUMBER} </div>
					<div class="col-md-3">
						<input class="form-control" type="text" name="orderid" size="5"
						 id="orderid" value=""> 
					</div>
					<div class="col-md-3">
						<button class="pull-right btn btn-default" type="submit" name="Confirm">
							<i class="fa fa-check l"></i> {$VIEW}
						</button>	
					</div>		
				</div>
			</form>
        </div>
    </div>
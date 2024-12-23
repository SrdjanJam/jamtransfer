<style>
                                  
    @media screen and (min-width:1398px) and (max-width: 1880px) {
        .target {
            font-weight: bold;
            color: #fbfbfb;
            animation-name: rightToLeft;
            animation-duration: 4.5s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            /* animation: rightToLeft 4.5s linear infinite; */
            white-space: nowrap;
            }

            @keyframes rightToLeft {
                0% {
                    transform: translateX(200px);
                }
                100% {
                    transform: translateX(-160px);
                }
            }

    }

    @media screen and (max-width: 550px){
        .target {
            font-weight: bold;
            color: #fbfbfb;
            animation-name: rightToLeft;
            animation-duration: 4.5s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            /* animation: rightToLeft 4.5s linear infinite; */
            white-space: nowrap;
            }

            @keyframes rightToLeft {
                0% {
                    transform: translateX(200px);
                }
                100% {
                    transform: translateX(-160px);
                }
            }
    }

</style>

                    <!-- Small boxes (Stat box) -->
                    <div id="top" class="row">
						{if $smarty.session.AuthLevelID ne 31}
                        <div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/newTransfers">
                                <div class="small-box xblue xwhite-text">
                                    <div class="inner">
                                        <h3>
                                            {$todayBooking}
                                        </h3>
                                        <p>
                                            {$FROM} {$YESTERDAY}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-cloud-download"></i>
                                    </div>
                                    
                                        <span  class="small-box-footer">
                                            {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                        </span>
                                    
                                </div>
                            </a>
                        </div><!-- ./col -->

                        {*<div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/active">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>
                                            {$activeOrders}
                                        </h3>
                                        <p>
                                            {$ACTIVE}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-plane"></i>
                                    </div>
                                    
                                        <span  class="small-box-footer">
                                            More info <i class="fa fa-arrow-circle-right"></i>
                                        </span>
                                    
                                </div>
                            </a>
                        </div><!-- ./col -->

                        <div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/confirmed">
                                <div class="small-box xgreen  xwhite-text">
                                    <div class="inner">
                                        <h3>
                                            {$confirmedOrders}
                                        </h3>
                                        <p>
                                            {$CONFIRMED}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-checkmark"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
						</div>*}

                        <div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notConfirmed">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>
                                            {$notConfirmedOrders}
                                        </h3>
                                        <p>
                                            {$NOT_CONFIRMED} {$ALL}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->      

						{*<div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notConfirmedToday">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>
                                            {$notConfirmedOrdersToday}
                                        </h3>
                                        <div style="overflow-x: hidden;overflow-y: hidden;">
                                            <p class="target">
                                                {$TODAY_UNCONFIRMED_DECLINED} 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->	

						<div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notConfirmedTomorrow">
                                <div class="small-box bg-orange">
                                    <div class="inner">
                                        <h3>
                                            {$notConfirmedOrdersTomorrow}
                                        </h3>
                                        <div style="overflow-x: hidden;overflow-y: hidden;">
                                            <p class="target">
                                                {$TOMORROW_UNCORFIRMED_DECLINED} 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->*}

						<div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notConfirmedTodayTomorrow">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>
                                            {$notConfirmedOrdersTodayTomorrow}
                                        </h3>
                                        <div style="overflow-x: hidden;overflow-y: hidden;">
                                            <p class="target">
                                                {$TODAY}/{$TOMORROW_UNCORFIRMED_DECLINED}  
                                            </p>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->							
						
						<div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/notAssign">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3>
                                            {$notAssign}
                                        </h3>
                                        <div style="overflow-x: hidden;overflow-y: hidden;">
                                            <p class="target">
                                                 {$NOT_ASSIGNED_3}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios7-alarm"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->	
						
                        <div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/declined">
                                <div class="small-box red darken-2 xwhite-text">
                                    <div class="inner">
                                        <h3>
                                            {$declined}
                                        </h3>
                                        <p>
                                            {$DECLINED}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-nuclear"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->

                        <div class="col-lg-2 col-md-4 col-xs-6">
                            <!-- small box -->
                            <a href="orders/tomorrow">
                                <div class="small-box teal darken-2 xwhite-text">
                                    <div class="inner">
                                        <h3>
                                            {$tomorrowTransfers}
                                        </h3>
                                        <p>
                                            {$TOMORROW}
                                        </p>
                                    </div>
                                    <div class="icon ">
                                        <i class="fa fa-car"></i>
                                    </div>
                                     <span class="small-box-footer">
                                        {$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div><!-- ./col -->
						{else}
							<div class="col-lg-3 col-md-3 col-xs-6">
								<!-- small box -->
								<a href="dashboard#unassigned">
									<div class="small-box bg-yellow">
										<div class="inner">
											<h3>
												{$noOfTransfers4}
											</h3>
											<div style="overflow-x: hidden;overflow-y: hidden;">
												<p class="target">
													 {$UNASSIGNED_TRANSFERS}
												</p>
											</div>
										</div>
										<div class="icon">
											<i class="ion ion-ios7-alarm"></i>
										</div>
										 <span class="small-box-footer">
											{$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
										</span>
									</div>
								</a>
							</div><!-- ./col -->	
							<div class="col-lg-3 col-md-3 col-xs-6">
								<!-- small box -->
								<a href="dashboard#unconfirmed">
									<div class="small-box bg-warning">
										<div class="inner">
											<h3>
												{$noOfTransfers}
											</h3>
											<p>
												{$UNCONFIRMED_TRANSFERS}
											</p>
										</div>
										<div class="icon">
											<i class="ion ion-ios7-alarm"></i>
										</div>
										 <span class="small-box-footer">
											{$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
										</span>
									</div>
								</a>
							</div><!-- ./col -->  							
							<div class="col-lg-3 col-md-3 col-xs-6">
								<!-- small box -->
								<a href="dashboard#uncompleted">
									<div class="small-box bg-aqua">
										<div class="inner">
											<h3>
												{$noOfTransfers2}
											</h3>
											<p>
												{$UNCOMPLETED_TRANSFERS}
											</p>
										</div>
										<div class="icon">
											<i class="ion ion-ios7-alarm"></i>
										</div>
										 <span class="small-box-footer">
											{$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
										</span>
									</div>
								</a>
							</div><!-- ./col -->  							
							<div class="col-lg-3 col-md-3 col-xs-6">
								<!-- small box -->
								<a href="dashboard#todaytommorow">
									<div class="small-box xgreen xwhite-text">
										<div class="inner">
											<h3>
												{$noOfTransfers3}
											</h3>
											<p>
												{$TODAY}&{$TOMORROW}
											</p>
										</div>
										<div class="icon">
											<i class="ion ion-ios7-alarm"></i>
										</div>
										 <span class="small-box-footer">
											{$MORE_INFO} <i class="fa fa-arrow-circle-right"></i>
										</span>
									</div>
								</a>
							</div><!-- ./col -->  
							<script>
								$('document').ready(function(){
									if (location.hash) {
										let target = location.hash;
										document.querySelector(target).scrollIntoView();
									}
								})	
							</script>	
						{/if}

                    </div><!-- /.row -->

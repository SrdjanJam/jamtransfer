					{if $smallBoxes} 
						{include file="plugins/Dashboard/templates/smallBoxes.tpl"}
					{/if}					
					{if $translatorPanel} 
						<h2>{$TRANSLATOR_PANEL_FOR} {$smarty.session.UserRealName}</h2>
					{/if}
					{include file="plugins/Dashboard/templates/emptyRow.tpl"} 			

					{if $charts} 
						{include file="plugins/Dashboard/templates/charts.tpl"}
					{/if}
					
					<div class="row">
						{$driverSettingsExist}
									
						{if $unConfirmedTransfers}
						<section class="col-lg-12 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/unConfirmedTransfers.tpl"} 
						</section>	
						{/if}						
												
						{if $presentTransfers}
						<section class="col-lg-12 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/presentTransfers.tpl"} 
						</section>	
						{/if}						
						
						{if $unCompletedTransfers}
						<section class="col-lg-12 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/unCompletedTransfers.tpl"} 
						</section>	
						{/if}						
								
						{if $unAssignedTransfers}
						<section class="col-lg-12 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/unAssignedTransfers.tpl"} 
						</section>	
						{/if}	
						
						{if $getOrder}
						<section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/getOrder.tpl"} 			
						</section><!-- /.Left col -->
						{/if}						
						{if $getRoutePrices}
						<section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/getRoutePrices.tpl"} 			
						</section><!-- /.Left col -->
						{/if}
						
						{if $getUnfinishedPayment}						
						<section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/getUnfinishedPayment.tpl"} 			
						</section>
						{/if}						
						
						{if $problemPayment}						
						<section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/problemPayment.tpl"} 			
						</section>
						{/if}

						{if $todo}
                        <section class="col-lg-6 xconnectedSortable">
							{include file="plugins/Dashboard/templates/todo.tpl"} 								
                        </section>
						{/if}
						{if $actualTransfers}
                        <section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/actualTransfers.tpl"} 			
                        </section>
						{/if}

						{if $quickEmail}
                        <section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/quickEmail.tpl"} 
                        </section>
						{/if}
                        <section class="col-lg-6 xconnectedSortable">
                        </section>

						{if $bookingConversionRate}
							<section class="col-lg-6 xconnectedSortable"> 
								{include file="plugins/Dashboard/templates/bookingConversionRate.tpl"} 			
							</section><!-- /.Left col -->
						{/if}						
						
						{if $calculateProvision}
							<section class="col-lg-6 xconnectedSortable"> 
								{include file="plugins/Dashboard/templates/calculateProvision.tpl"} 			
							</section><!-- /.Left col -->
						{/if}						
						
						{if $subDriverPanel}
							<section class="col-lg-12 xconnectedSortable">
								{include file="plugins/SubDriverPanel/templates/index.tpl"} 			
							</section><!-- /.Left col -->
						{/if}
						
						{if $calendar}
							<section class="col-lg-12 xconnectedSortable">
								{include file="plugins/Calendar/templates/index.tpl"} 			
							</section><!-- /.Left col -->
						{/if}						
						
                    </div>	        


					{include file="plugins/Dashboard/templates/script.tpl"}
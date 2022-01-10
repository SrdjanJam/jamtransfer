<?
	ob_start();
?>
  <!-- Static navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top shadowMedium" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">ADMIN</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li id="dashboard"><a href="dashboard"><?= DASHBOARD ?></a></li>
		  <li id="calendar"><a href="calendar">Calendar</a></li>
          <li id="transfersList" class="dropdown">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
          		<?= TRANSFERS ?> <span class="caret"></span>
          	</a>
            	<ul class="dropdown-menu" role="menu">
          		<li><a href="transfersList/noDriver"><?= NO_DRIVER ?></a></li>
          		<li><a href="transfersList/notConfirmed"><?= NOT_CONFIRMED ?></a></li>
          		<li><a href="transfersList/confirmed"><?= CONFIRMED ?></a></li>
          		<li><a href="transfersList/declined"><?= DECLINED ?></a></li>
				<li><a href="transfersList/canceled"><?= CANCELLED ?></a></li>
				<li><a href="transfersList/noshow"><?= NO_SHOW ?></a></li>
				<li><a href="transfersList/driverError"><?= DRIVER_ERROR ?></a></li>
				<li><a href="updatedTransfersList"><?= UPDATED ?></a></li>
				<li><a href="transfersList/agent"><?= AGENT_TRANSFERS?></a></li>
				<li><a href="transfersList/notConfirmedAgent"><?= AGENT_TRANSFERS?> <?= NOT_CONFIRMED ?></a></li>
				<li><a href="transfersList/notCompleted">Not Completed</a></li>
				<li><a href="transfersList/invoice2">Invoice 2</a></li>
				<li class="divider"></li>
          		<li><a href="transfersList"><?= ALL_TRANSFERS ?></a></li>
          		<li class="divider"></li>					
          		<li><a href="transfersList/archive">Archived Transfers</a></li>
          		<li class="divider"></li>								
          		<li id="booking"><a href="booking/step1"><?= BOOKING ?></a></li>
				<li class="divider"></li>
          		<li id="freeForm"><a href="freeForm"><?= FREEFORM ?></a></li>
          	</ul>
          </li>
          
          <li id="users"><a href="users"><?= USERS ?> </a>

          </li>
		<? if ($_SESSION['AuthUserID'] != '2146') { ?>
          <li id="siteContent" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            	<?= SITE_CONTENT ?> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
            	<!--<li id="siteSettings"><a href="index.php?p=siteSettings"><?= SITE_SETTINGS ?></a></li>-->
          		<li id="fileman"><a href="index.php?p=fileman"><?= IMAGE_MANAGER ?></a></li>
          		<li id="siteArticles"><a href="index.php?p=siteArticles"><?= ARTICLES ?></a></li>
          		<li id="sitePages"><a href="index.php?p=sitePages"><?= PAGES ?></a></li>
          		<li id="coInfo"><a href="index.php?p=coInfo"><?= COMPANY_INFO ?></a></li>
          		<!--<li id="coTexts"><a href="index.php?p=coTexts"><?= COMPANY_TEXTS ?></a></li>-->
          		<li id="headerImages"><a href="index.php?p=headerImages"><?= HEADER_IMAGES ?></a></li> 
          		<li><a href="/" target="_blank"><?= VIEW_SITE ?></a></li>
				<li id="routeReviews"><a href="index.php?p=routeReviews"><?= ROUTE_REVIEWS ?></a></li>

          		<li class="divider"></li>
				<li><a href="index.php?p=refreshCache"
				onclick="return confirm('Refresh cache?\n(This could take a while)')">
					<?= REFRESH_CACHE ?>
				</a></li>
          	</ul>
          </li>

          <li id="masterSettings" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            	Masters <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
            	<li id="countries"><a href="index.php?p=countries"><?= COUNTRIES ?></a></li>
          		<li id="locations"><a href="index.php?p=locationTypes"><?= LOCATION_TYPES ?></a></li>				
          		<li id="locations"><a href="index.php?p=locations"><?= LOCATIONS ?></a></li>
          		<li id="routes"><a href="index.php?p=routes"><?= ROUTES ?></a></li>
				<li id="vehicleTypes"><a href="index.php?p=vehicleTypes"><?= VEHICLE_TYPES ?></a></li>
				<li id="extraServices"><a href="index.php?p=extraServices"><?= EXTRA_SERVICES ?></a></li>
				<li id="actions"><a href="index.php?p=actions">Actions</a></li>
				<li id="approvedFuelPrice"><a href="index.php?p=approvedFuelPrice">Approved Fuel Price</a></li>
          	</ul>
          </li>

          <li id="serviceSettings" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            	Services <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
				<li id="setDriver"><a href="index.php?p=setDriver"><? if ($_SESSION['UseDriverID']==0) echo "Set Driver";
				else echo "Unset Driver"; ?>
				</a></li>			
				<li class="divider"></li>	
          		<li id="terminals"><a href="index.php?p=terminals">Terminals</a></li>  				
          		<li id="driverRoutes"><a href="index.php?p=driverRoutes"><?= DRIVER_ROUTES ?></a></li>
          		<li id="vehicles"><a href="index.php?p=vehicles"><?= VEHICLES ?></a></li>  
          		<li id="extras"><a href="index.php?p=extras"><?= EXTRAS ?></a></li>
				<li class="divider"></li>
				<li id="dateSettings"><a href="index.php?p=dateSettings"><?= DATE_SETTINGS ?></a></li>
				
          	</ul>
          </li>
		  
          <li id="priceSettings" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            	Prices <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">		
            	<li id="prices"><a href="index.php?p=prices"><?= PRICES ?></a></li>
				<li id="coupons"><a href="index.php?p=coupons"><?= COUPONS ?></a></li>
            	<li class="divider"></li>
				<li id="special"><a href="index.php?p=special"><?= SPECIALDATES ?></a></li>
				<li id="special"><a href="index.php?p=specialtimes"><?= SPECIALTIMES ?></a></li>
          		<!--<li id="daySettings"><a href="index.php?p=daySettings"><?= DAY_SETTINGS ?></a></li> -->
          		<!--<li id="dateSettings"><a href="index.php?p=dateSettings"><?= DATE_SETTINGS ?></a></li> -->
          		<!--<li id="nightSettings"><a href="index.php?p=nightSettings"><?= NIGHT_SETTINGS ?></a></li> -->
				<li class="divider"></li>
				<li id="transcs"><a href="index.php?p=transcs">Cost Structure</a></li>			
				<!--<li role="presentation" class="dropdown-header"><?= OTHER ?></li> -->
				<li id="pricesExport"><a href="index.php?p=pricesExport&Active=1"><?= PRICES_EXPORT ?></a></li>
				<li id="pricesImport"><a href="index.php?p=pricesImport&Active=1"><?= PRICES_IMPORT ?></a></li>
				<li id="pricesList"><a href="index.php?p=priceList"><?= PRICE_LIST ?></a></li>
				<li id="pricesExport"><a href="index.php?p=allPricesExport&Active=1"><?= ALL_PRICES_EXPORT ?></a></li>
				<li id="pricesExport"><a href="index.php?p=allPricesExport2"><?= ALL_PRICES_EXPORT ?> 2</a></li>
          	</ul>
          </li>	
		<?}?>

          <li id="reports" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            	Invoice <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
				<li class="dropdown-header"><?= BILLING ?></li>    
				<li id="agentsWTransfers"><a href="index.php?p=invoices">
					<i class="fa fa-exclamation-circle red-text"></i> <?= INVOICES_AGENTS ?><br><small>...read help first!</small></a></li>
				<li class="divider"></li>				
				<!--<li id="agentsByBDate"><a href="index.php?p=invoiceSum"><?= SUMMARY_INVOICE_DRIVER ?></a></li>-->
				<li id="driversWTransfers"><a href="index.php?p=driversWTransfersCash"><?= DRIVERS_WITH_TRANSFERS ?> - <?= CASH ?></a></li>
				<li id="driversBalance"><a href="index.php?p=driversBalanceCash"><?= DRIVERS_BALANCE ?> - <?= CASH ?></a></li>
				<li id="driversWTransfers"><a href="index.php?p=driversWTransfers"><?= DRIVERS_WITH_TRANSFERS ?> - <?= OTHER ?></a></li>
				<li id="driversBalance"><a href="index.php?p=driversBalance"><?= DRIVERS_BALANCE ?> - <?= OTHER ?></a></li>
				<li class="divider"></li>
				<li id="agentsWTransfers"><a href="index.php?p=agentsWTransfersCash"><?= AGENTS_WITH_TRANSFERS ?> - <?= CASH ?></a></li>
				<li id="agentsWTransfers"><a href="index.php?p=agentsWTransfers"><?= AGENTS_WITH_TRANSFERS ?> - <?= OTHER ?></a></li>
				<li class="divider"></li>				
				<li id="exchangeRate"><a href="index.php?p=exchangeRate"><?= EXCHANGE_RATE ?></a></li>
				<li id="vatRate"><a href="index.php?p=vatRate">Vat rate</a></li>
          	</ul>			
          </li>



          <li id="reports" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            	<?= REPORTS ?> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
            	<li id="promet"><a href="index.php?p=promet"><?= TRANSFERS_SUMMARY ?></a></li>
            	<li id="promet2"><a href="index.php?p=promet2"><?= TRANSFERS_SUMMARY_BOOKING ?></a></li>

            	<!--<li id="turnover"><a href="index.php?p=turnover"><?= TURNOVER ?></a></li>
				<li id="netIncome"><a href="index.php?p=netIncome"><?= NET_INCOME ?></a></li>
          		<li id="bookingIncome"><a href="index.php?p=bookingIncome"><?= BOOKING ?></a></li>
				
          		<li id="canceledOrders"><a href="index.php?p=canceledOrders"><?= CANCELED_ORDERS ?></a></li>!-->
          		<li class="divider"></li>
          		<li class="dropdown-header"><?= ORDERS ?></li>              		
          		<li id="agentsByTrDate">
					<a href="index.php?p=agentOrders&ByWhat=1">...<?= ORDERS_BY_TR_DATE ?></a>
				</li>
          		<li id="agentsByBDate">
					<a href="index.php?p=agentOrders&ByWhat=2">...<?= ORDERS_BY_B_DATE ?></a>
				</li>
          		<li id="agentsByBDate">
					<a href="index.php?p=taxiSiteOrdersBookingDate">...<?= TAXI_SITE_ORDERS.'-'.BOOKING_DATE ?></a>
				</li>
				<li class="divider"></li>
				<li class="dropdown-header"><?= DRIVERS ?></li>                  
				<!--<li id="agentsByBDate"><a href="index.php?p=driversChart"><?= TOP_DRIVERS ?></a></li>!-->
				<!--<li><a href="index.php?p=emailsForm"><?= CLIENT_EMAILS ?></a></li>!-->
				<!--<li><a href="index.php?p=driversEmails"><?= DRIVERS_EMAIL_LIST ?></a></li>!-->
				<li><a href="index.php?p=driversEmailsActive"><?= DRIVERS_EMAIL_LIST ?> - Active</a></li>
				<li class="divider"></li>

				<!--<li><a href="index.php?p=exportAgentEmails"><?= AGENT_REPORT ?></a></li>!-->
				<li><a href="index.php?p=surveyReportForm"><?= SURVEY ?></a></li>
				<li class="divider"></li>
				<li id="subHist"><a href="index.php?p=subHist"><?= SUBDRIVER_HISTORY ?></a></li>
				<li id="timelineOperatorReview"><a href="index.php?p=timelineReview">Timeline Review</a></li>
				<li id="tranRatio"><a href="index.php?p=tranRatio">Transfers Ratio</a></li>
				<li id="tranStat"><a href="indexN.php?p=transfersReview">Transfers Review</a></li>				
          	</ul>
          </li>



          <!--<li id="reports" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            	Help <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
				<li id="procedures"><a href="indexN.php?p=procedures">Procedures</a></li>				
				<li id="tutorials"><a href="indexN.php?p=tutorials">Tutorials</a></li>				
				<li id="documents"><a href="indexN.php?p=documents">Documents</a></li>		 						
          	</ul>			
          </li>!--->


        </ul>
        <ul class="nav navbar-nav navbar-right">
					 <li class="dropdown user user-menu">
					<?
					if (isset($_SESSION['UseDriverID']) && $_SESSION['UseDriverID']>0) {
						//echo $_SESSION['UseDriverID'];
						require_once '../db/v4_AuthUsers.class.php';
						$au = new v4_AuthUsers();
						$au->getRow($_SESSION['UseDriverID']);
						echo "<span style='font-size:80%'>Driver:<br>".$au->getAuthUserRealName()."</span>";
					}	
					?>	
					</li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span><?= $_SESSION['UserName'] ?> <i class="caret"></i> &nbsp;</span>
							&nbsp;
                            <img src="a/showProfileImage.php?UserID=<?= $_SESSION['AuthUserID']?>" 
                                class="img-circle" alt="User Image" style="height:2em;padding:-.5em;margin:-.5em"/>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="a/showProfileImage.php?UserID=<?= $_SESSION['AuthUserID']?>" 
                                class="img-circle" alt="User Image" />
                                <p>
                                    <?= $_SESSION['UserName'] ?> - <?= $_SESSION['GroupProfile'] ?>
                                    <small><?= MEMBER_SINCE.' '. $_SESSION['MemberSince'] ?></small>
                                </p>
                            </li>
                            <!-- Menu Body 
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>-->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="index.php?p=profileEdit" class="btn btn-default btn-flat">
                                    	<?= PROFILE ?>
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout.php" class="btn btn-default btn-flat"><?= SIGN_OUT ?></a>
                                </div>
                            </li>
                        </ul>
                    </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </div>
<?
	$output = ob_get_contents();
	ob_end_clean();
	//htmldecode($output);
	$smarty->assign("menu_render",$output);
?>	
  
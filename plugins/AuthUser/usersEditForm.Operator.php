
<script type="text/x-handlebars-template" id="userEditTemplate">
<form id="userEditForm{{AuthUserID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">

	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{AuthUserRealName}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn btn-default" title="Close" 
					onclick="return editCloseUser('{{AuthUserID}}', '<?= $inList ?>');">
					<i class="fa fa-chevron-up l"></i>
					</button>
				<? } ?>
			<? } ?>
		</div>
	</div>

	<div class="box-body ">
	
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1{{AuthUserID}}" data-toggle="tab"><?= PROFILE ?></a></li>
                <? if ($_SESSION['AuthLevelID'] == DRIVER_USER) { ?>
                <li><a href="#tab_2{{AuthUserID}}" data-toggle="tab"><?= SURCHARGES ?></a></li>
                <? } ?>
            </ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1{{AuthUserID}}">		
	
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3 "><label><?= IMAGE ?></label></div>
								<div class="col-md-9">
									<div id="imageDiv">
										<img src="api/showProfileImage.php?UserID={{AuthUserID}}"
										style="max-height:160px; max-width:160px;overflow:hidden;" 
										class="img-thumbnail">
									</div>
								</div>
							</div>				
							<div class="row">
								<div class="col-md-3 "><label><?= ID ?></label></div>
								<div class="col-md-9"><strong>{{AuthUserID}}</strong></div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= STATUS ?></label></div>
								<div class="col-md-9">
									{{#if Active}}
										<?= ACTIVE ?>
									{{else}}
										<?= NOT_ACTIVE ?>
									{{/if}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= LANGUAGE ?></label></div>
								<div class="col-md-9">{{Language}}</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= USER_NAME ?></label></div>
								<div class="col-md-9">{{AuthUserName}}</div>
							</div>					

						    {{#compare AuthLevelID "!=" '2'}}
						        <div class="row">
							        <div class="col-md-3 "><label><?= REAL_NAME?></label></div>
							        <div class="col-md-9">{{AuthUserRealName}}</div>
						        </div>
						    {{/compare}}

							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_NAME ?></label></div>
								<div class="col-md-9">
									{{AuthUserCompany}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= BRAND_NAME ?></label></div>
								<div class="col-md-9">
									{{BrandName}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= CONTACT_PERSON ?></label></div>
								<div class="col-md-9">
									{{ContactPerson}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_ADDRESS ?></label></div>
								<div class="col-md-9">
									{{AuthCoAddress}}
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 "><label><?= CITY ?></label></div>
								<div class="col-md-9">{{City}}</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= ZIP ?></label></div>
								<div class="col-md-9">{{Zip}}</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= COUNTRY ?></label></div>
								<div class="col-md-9">{{Country}}</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= EMAIL ?></label></div>
								<div class="col-md-9">{{AuthUserMail}}</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= TEL ?></label></div>
								<div class="col-md-9">{{AuthUserTel}}</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= MOB ?></label></div>
								<div class="col-md-9">{{AuthUserMob}}</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= EMERGENCY_PHONE ?></label></div>
								<div class="col-md-9">{{EmergencyPhone}}</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= FAX ?></label></div>
								<div class="col-md-9">
									{{AuthUserFax}}
								</div>
							</div>	
							
						</div>

						<div class="col-md-6">
							

						{{#compare AuthLevelID "==" '31'}}

							<div class="row">
								<div class="col-md-3 "><label><?= COUNTRY_SHORT ?></label></div>
								<div class="col-md-9">
									{{Country}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= TERMINAL ?></label></div>
								<div class="col-md-9">
									{{Terminal}}
								</div>
							</div>
						{{/compare}}

							<div class="row">
								<div class="col-md-3 "><label><?= TAX_NUMBER ?></label></div>
								<div class="col-md-9">
									{{AuthUserCompanyMB}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= ACCOUNT_OWNER ?></label></div>
								<div class="col-md-9">
									{{AccountOwner}}				
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_WEB ?></label></div>
								<div class="col-md-9">
									{{AuthUserCompanyWeb}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3 "><label><?= COMPANY_DESC ?></label></div>
								<div class="col-md-9">
									<small>{{{AuthUserCoDesc}}}</small>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 "><label><?= NOTE ?></label></div>
								<div class="col-md-9">
									<small>{{AuthUserNote}}</small>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3">
									<label><?= ACCEPTED_PAYMENT ?> - not active</label>
								</div>
								<div class="col-md-9">
									{{AcceptedPaymentName}}
								</div>
							</div>						
					    <hr>

						<div class="row">
							<div class="col-md-3 "><label><?= DATE_ADDED ?></label></div>
							<div class="col-md-9">{{DateAdded}}</div>
						</div>

						<div class="row">
							<div class="col-md-3 "><label><?= LAST_VISIT ?></label></div>
							<div class="col-md-9">{{LastVisited}}</div>
						</div>
						
						</div>
					</div>	
	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew and $_REQUEST['p'] != 'profileEdit') { ?>
			<div>
			</div>
    	<? } ?>

	</div>


		    	</div> {{!-- tab1 end --}}
		    	
				<div class="tab-pane" id="tab_2{{AuthUserID}}">
					<div class="row">
						<div class="col-md-3">
							<label for="SurCategory"><?=SURCATEGORY;?></label>
						</div>
						<div class="col-md-9">
							<select name="SurCategory" id="SurCategory" class="w100" 
							onchange="globalSurcharges({{AuthUserID}});">
								{{#select SurCategory}}
									<option value="1"><?= DEFINE_GLOBAL ?></option>
									<option value="0"><?= NO_SURCHARGES ?></option>
								{{/select}}								
							</select>
							
							<input type="hidden" name="SurID" id="SurID" class="w100" value="{{SurID}}">
						</div>
					</div>
					<div id="globalSurcharges{{AuthUserID}}"></div>

				</div> {{!-- tab-pane tab_2 --}}						
						
	    </div><!-- box-body-->
		    


</form>


	<script>
		globalSurcharges({{AuthUserID}});
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": false, //Italics, bold, etc. Default true
				"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": false, //Button which allows you to edit the generated HTML. Default false
				"link": false, //Button to insert a link. Default true
				"image": false, //Button to insert an image. Default true,
				"color": false //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
		
		
		
		function ajaxFileUpload()
		{
			$("#loading")
			.ajaxStart(function(){
				$(this).show();
			})
			.ajaxComplete(function(){
				$(this).hide();
			});

			var UserID = $("#UserID").val();
			
			$.ajaxFileUpload
			(
				{
					url: window.root + '/cms/api/saveProfileImage.php?UserID='+UserID,
					secureuri:false,
					fileElementId:'imageFile',
					dataType: 'json',
					//data:{UserID: UserID},
					success: function (data, status)
					{
						if(typeof(data.error) != 'undefined')
						{
							if(data.error != '')
							{
								alert(data.error);
							}else
							{
								//alert(data.msg);
								$("#imageDiv > img").attr('src', 'upload/'+data.img);

								$.get( window.root+"/cms/api/deleteTempImage.php?image="+data.img, function( data ) {
								});
							}
						}

					},
					error: function (data, status, e)
					{
						// console.log(data);
                        alert(e);
					}
					
				}
			)
		
			return false;

		}
		
	
	</script>
</script>



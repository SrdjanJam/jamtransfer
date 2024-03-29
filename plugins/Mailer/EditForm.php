<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{MailID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			<span id="statusMessage" class="text-info xl"></span>
			<button class="btn btn-primary" title="<?= SEND?>"
				onclick="return sendItem('{{MailID}}');">
				<i class="fa fa-envelope"></i>
			</button>			
			<button class="btn btn-warning" title="<?= CLOSE?>"
				onclick="return editCloseItem('{{MailID}}');">
				<i class="fa fa-close"></i>
			</button>
			<button id="save_button" class="btn btn-info" title="<?= SAVE_CHANGES ?>"
				onclick="return editSaveItem('{{MailID}}');">
				<i class="fa fa-save"></i>
			</button>
		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<? if (!$isNew) { ?>

				<!-- CreatorID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Creator"><?=CREATOR;?></label>
					</div>
					<div class="col-md-9">
						{{userName CreatorID "AuthUserRealName"}}
					</div>
				</div>
				<? } ?>	
				<!-- FromName: -->
				<div class="row">
					<div class="col-md-3">
						<label for="FromName"><?=FROM_NAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromName" value="{{FromName}}">
					</div>
				</div>

				<!-- ToName: -->
				<div class="row">
					<div class="col-md-3">
						<label for=ToName"><?=EMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ToName" value="{{ToName}}">
					</div>
				</div>

				<!-- ReplyTo -->
				<div class="row">
					<div class="col-md-3">
						<label for=ReplyTo"><?=REPLY_TO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ReplyTo" value="{{ReplyTo}}">
					</div>
				</div>

				<!-- Subject: -->
				<div class="row">
					<div class="col-md-3">
						<label for=Subject"><?=SUBJECT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Subject" value="{{Subject}}">
					</div>
				</div>

				<!-- Body: -->
				<div class="row">
					<div class="col-md-3">
						<label for=Body"><?=BODY;?></label>
					</div>
					<div class="col-md-9">
						<textarea class="textarea" style="width:100%" name="Body" id="Body">{{Body}}</textarea>
					</div>
				</div>

				<!-- Attachment: -->
				<div class="row">
					<div class="col-md-3">
						<label for=Attachment"><?=ATTACHMENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Attachment" value="{{Attachment}}">
					</div>
				</div>
				<? if (!$isNew) { ?>
				<!-- Status: -->
				<div class="row">
					<div class="col-md-3">
						<label for=Status"><?=STATUS;?></label>
					</div>
					<div class="col-md-9">
						<input readonly type="text" name="Status" value="{{Status}}">
					</div>
				</div>

				<!--CreateTime: -->
				<div class="row">
					<div class="col-md-3">
						<label for=CreateTime"><?=CREATE_TIME;?></label>
					</div>
					<div class="col-md-9">
						<input readonly type="text" name="CreateTime" value="{{CreateTime}}">
					</div>
				</div>

				<!--SentTime: -->
				<div class="row">
					<div class="col-md-3">
						<label for=SentTime"><?=SENT_TIME;?></label>
					</div>
					<div class="col-md-9">
						<input readonly type="text" name="SentTime" value="{{SentTime}}">
					</div>
				</div>
				<? } ?>
				<input type="hidden" name="OwnerID" value="<?=$_SESSION["UseDriverID"]?>">
				<input type="hidden" name="CreatorID" value="<?=$_SESSION["AuthUserID"]?>">
				<input type="hidden" name="Direction" value="1">

			</div>				
				
		</div>
	</div>

</form>

	<script>
		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font 
				
		});
	
		$('.solved input').change(function() {
			$('#save_button').trigger('click');
		})	
	</script>
</script>


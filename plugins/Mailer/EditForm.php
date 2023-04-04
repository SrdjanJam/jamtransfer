<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{MailID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			<span id="statusMessage" class="text-info xl"></span>
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
				<!-- MailID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="MailID"><?=MAILID;?></label>
					</div>
					<div class="col-md-9">
						{{MailID}}
					</div>
				</div>

				<!-- CreatorID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="CreatorID"><?=CREATOR_ID;?></label>
					</div>
					<div class="col-md-9">
						{{CreatorID}}
					</div>
				</div>

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
						<label for=ToName"><?=TO_NAME;?></label>
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
						<textarea class="textarea" name="Body" id="Body">{{Body}}</textarea>
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

				<!-- Status: -->
				<div class="row">
					<div class="col-md-3">
						<label for=Status"><?=STATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Status" value="{{Status}}">
					</div>
				</div>

				<!--CreateTime: -->
				<div class="row">
					<div class="col-md-3">
						<label for=CreateTime"><?=CREATE_TIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="CreateTime" value="{{CreateTime}}">
					</div>
				</div>

				<!--SentTime: -->
				<div class="row">
					<div class="col-md-3">
						<label for=SentTime"><?=SENT_TIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SentTime" value="{{SentTime}}">
					</div>
				</div>
				
			

			</div>				
				
		</div>
	</div>

</form>

	<script>
		$('.solved input').change(function() {
			$('#save_button').trigger('click');
		})	</script>
</script>


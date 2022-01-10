<?
error_reporting(E_PARSE);
	# init libs

	require_once '../../../../db/v4_Routes.class.php';


	# init vars
	$out = array();


	# init class
	$db = new v4_Routes();


	# filters

	$RouteID = $_REQUEST['RouteID'];
echo $RouteID;
	# Details  red
	$db->getRow($RouteID);

	# Details  red
	$db->getRow($dbk[0]);

	# get fields and values
	$detailFlds = $db->fieldValues();

	$out = $detailFlds;

?>

<form id="v4_RoutesEditForm<?= $out['RouteID'] ?>" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?>: <?= $out['RouteName'] ?></h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn btn-warning" title="<?= CLOSE?>" 
					onclick="return editClosev4_Routes('<?= $out['RouteID'] ?>', '<?= $inList ?>');">
					<i class="ic-close"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Routes('<?= $out['RouteID'] ?>', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Routes('<?= $out['RouteID'] ?>', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Routes('<?= $out['RouteID'] ?>', '<?= $inList ?>');">
				<i class="ic-print"></i>
				</button>
			<? } ?>	
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<?= $out['OwnerID'] ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="RouteID"><?=ROUTEID;?></label>
					</div>
					<div class="col-md-9">
						<?= $out['RouteID'] ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromID"><?=FROMID;?></label>
					</div>
					<div class="col-md-9" id="fromSelect<?= $out["RouteID"]?>">
						<select  class="w100" name="FromID_<?= $out['RouteID']?>" id="FromID_<?= $out['RouteID']?>">
						<?//= placeSelect( $out['FromID'],'FromID_'.$out['RouteID']); ?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToID"><?=TOID;?></label>
					</div>
					<div class="col-md-9">
					<select  class="w100" name="ToID_<?= $out['RouteID']?>" id="ToID_<?= $out['RouteID']?>">

						<?//= placeSelect( $out['ToID'],'ToID_'.$out['RouteID']); ?>
					</select>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Approved"><?=APPROVED;?></label>
					</div>
					<div class="col-md-9">
						<?= yesNoSelect( $out['Approved'], 'Approved_'.$out['RouteID']) ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="RouteName"><?=ROUTENAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteName_<?= $out['RouteID'] ?>" id="RouteName_<?= $out['RouteID'] ?>" class="w100" readonly="readonly"
						value="<?= $out['RouteName'] ?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Km"><?=KM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Km_<?= $out['RouteID'] ?>" id="Km_<?= $out['RouteID'] ?>" class="w100" value="<?= $out['Km'] ?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Duration"><?=DURATION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Duration_<?= $out['RouteID'] ?>" id="Duration_<?= $out['RouteID'] ?>" class="w100" value="<?= $out['Duration'] ?>">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Routes('<?= $out['RouteID'] ?>', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>
    	</div>
    	<? } ?>

	</div>
</form>


	<script>
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
		
		$("#FromID_<?= $out['RouteID']?>").change(function(){
			var from = $("#FromID_<?= $out['RouteID']?> option:selected").text();
			var to   = $("#ToID_<?= $out['RouteID']?> option:selected").text();
			$("#RouteName_<?= $out['RouteID']?>").val(from + ' - ' + to);
		});

		$("#ToID_<?= $out['RouteID']?>").change(function(){
			var from = $("#FromID_<?= $out['RouteID']?> option:selected").text();
			var to   = $("#ToID_<?= $out['RouteID']?> option:selected").text();		
			$("#RouteName_<?= $out['RouteID']?>").val(from + ' - ' + to);

		});


function placeSelector(id, fieldName, containerId,suffix) {
		var url = window.root + '/cms/a/getPlaces.php?callback=';
		//var selector = "<select class=\"w100\" name=\""+fieldName+"\" id=\""+fieldName+"\" >";
		//selector += '<option value="0"> --- </option>';

		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',
			cache: true,

            beforeSend: function () {
                if (placesCache.exist(url)) {
					selector = createPlacesSelector(placesCache.get(url), id, fieldName, containerId,suffix);
					//console.log(placesCache.get(url) );
                    return false;
                }
                return true;
            },
            success: function (data) {
                placesCache.set(url, data);
                selector = createPlacesSelector(data, id, fieldName, containerId,suffix);
            }
				
		});

		
		$("#"+fieldName).append(selector); 
}

function createPlacesSelector(data, id, fieldName,containerId,suffix) {

    //var selector = "<select class=\"w100\" name=\""+fieldName+"_"+suffix+"\" id=\""+fieldName+"_"+suffix+"\" >";
    //var selector = "<select class=\"w100\" name=\""+fieldName+"\" id=\""+fieldName+"\" >";
    var selector = "";
		selector += '<option value="0"> --- </option>';
		
		$.each(data, function(i,val) {
			selector += '<option value="' + val.PlaceID + '" ';


			if (val.PlaceID == id) {
				selector += ' selected="selected" ';
			}

			selector += '>' + val.PlaceName;
			selector += '</option>';
		});

		selector += '</select>';
		
		return selector;   
}

placeSelector('<?= $out['FromID']?>', 'FromID_<?= $out["RouteID"]?>', 'fromSelect<?= $out["RouteID"]?>','<?= $out["RouteID"]?>');
placeSelector('<?= $out['ToID']?>', 'ToID_<?= $out["RouteID"]?>', 'toSelect<?= $out["RouteID"]?>','<?= $out['RouteID']?>');
	</script>

<?

function placeSelect($id,$name) {
	
	return '<select name="'.$name.'" id="'.$name.'">
				<option>Place select</option>
				<option>Place select2</option>
				<option>Place select3</option>
			</select>
	';
}

function yesNoSelect($id,$name) {
	$zero = $one = '';
	if ($id == 0)	$zero = 'selected="selected"';
	if ($id == 1)	$one  = 'selected="selected"';
	$retVal  = '<select name="'.$name.'" id="'.$name.'">';
	$retVal .= '<option value="0" '.$zero.'>'.  NO . '</option>';
	$retVal .= '<option value="1" '.$one.'>'.  YES . '</option>';
	
	$retVal .= '</select>';
	return $retVal;
}

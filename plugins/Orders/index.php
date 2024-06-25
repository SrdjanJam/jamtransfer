<?	
	if (PARTNERLOG) $partner="Driver";
	else $partner="";
	if (!$isNew && !$isEdit) require_once 'ListTemplate'.$partner.'.php';
	if (!PARTNERLOG) require_once 'EditForm'.$partner.'.php';
	
	$smarty->assign('ItemID','DetailsID');
	
		
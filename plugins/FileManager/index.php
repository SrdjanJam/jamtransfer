<?

$dir = 'i/website/';
$validTypes = array('jpg', 'jpeg', 'JPG', 'png', 'PNG', 'webp', 'WEBP');
$file_arr=array();
if (is_dir($dir)) {
	if ($dh = opendir($dir)) {
		$i = 1;
		while (($file = readdir($dh)) !== false) {
			if ( in_array(pathinfo($file, PATHINFO_EXTENSION), $validTypes ) ) {
				$file_row=array();
				$file_row['count']=$i;
				$file_row['file']=$file;
				$file_arr[]=$file_row;
				$i++;
			}
		}
		closedir($dh);
	}
} 
array_multisort( array_column($file_arr, "file"), SORT_ASC, $file_arr );
$smarty->assign('dir',$dir);
$smarty->assign('file_arr',$file_arr);
 

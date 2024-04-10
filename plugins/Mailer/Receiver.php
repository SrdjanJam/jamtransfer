<?php
require_once '../../config.php';
require_once ROOT . '/db/v4_Mailer.class.php';
$ml=new v4_Mailer;
	
	$email="office@jamtransfer.com";
	$pass="IRM86bk^GDu6";
	$range="SINCE ".date('Y-m-d',strtotime("-1 days"));;
	$imap = imap_open('{mail.jamtransfer.com:993/imap/ssl}INBOX', $email, $pass);
	// Retrieve the incoming mail
	$messages = imap_search($imap,$range);
	foreach ($messages as $message) {
		// Get the message header
		$structure = imap_fetchstructure($imap, $message);
		$mail_row = imap_headerinfo($imap, $message);
		$part = $structure->parts[1];
		if($part->encoding == 3) $subject = imap_base64($mail_row->subject);
		else if($part->encoding == 1) $subject = imap_8bit($mail_row->subject);
		else $subject = imap_qprint($mail_row->subject);			
		$section=create_part_array($structure, $prefix="");	
		
		
		foreach ($section as $sec) {
			if ($sec['part_object']->subtype=="HTML" or $sec['part_object']->subtype=="PLAIN") {
				$body=imap_fetchbody($imap, $message, 1);
				if($sec['part_object']->encoding == 3) {
					$body= imap_base64($body);
				} else if($sec['part_object']->encoding == 1) {
					$body= imap_8bit($body);
				} else {
					$body= imap_qprint($body);
				}
			}
		}
		$where=" WHERE CreateTime='".getMailDate($mail_row->udate)."' AND FromName='".getEmailAddress($mail_row->from)."' ";
		$mlkeys=$ml->getKeysBy("MailID", "ASC", $where);
		if (count($mlkeys)==0) {
			$ml->setCreateTime(getMailDate($mail_row->MailDate));
			$ml->setSentTime(getMailDate($mail_row->Date));
			$ml->setSubject($subject);
			$ml->setBody($body);
			$ml->setDirection(2);
			$ml->setStatus(1);
			$ml->setFromName(getEmailAddress($mail_row->from));
			$ml->setToName(getEmailAddress($mail_row->to));
			$ml->setReplyTo(getEmailAddress($mail_row->to));
			$ml->setCreateTime(getMailDate($mail_row->udate));
			$ml->setSentTime(getMailDate($mail_row->udate));
			$ml->setType(3);
			if (getUserIDFromMail(getEmailAddress($mail_row->from))) {
				$ml->setOwnerID(getUserIDFromMail(getEmailAddress($mail_row->from)));			
				$ml->setCreatorID(getUserIDFromMail(getEmailAddress($mail_row->from)));			
			} else {
				$ml->setOwnerID(0);			
				$ml->setCreatorID(0);					
			}
			$ml->saveAsNew();
			
		}
	}	
	imap_close($imap);	

	function getEmailAddress($mail) {
		$mail=$mail[0];
		$mail=$mail->mailbox."@".$mail->host;
		return $mail;		
	}	
	
	function getMailDate($date) {
		date_default_timezone_set("Europe/Paris");
		$date=date("Y-m-d H:i:s",$date);
		return $date;		
	}	

	function create_part_array($structure, $prefix="") {
		//print_r($structure);
		if (sizeof($structure->parts) > 0) {    // There some sub parts
			foreach ($structure->parts as $count => $part) {
				add_part_to_array($part, $prefix.($count+1), $part_array);
			}
		}else{    // Email does not have a seperate mime attachment for text
			$part_array[] = array('part_number' => $prefix.'1', 'part_object' => $obj);
		}
	   return $part_array;
	}
	// Sub function for create_part_array(). Only called by create_part_array() and itself. 
	function add_part_to_array($obj, $partno, & $part_array) {
		$part_array[] = array('part_number' => $partno, 'part_object' => $obj);
		if ($obj->type == 2) { // Check to see if the part is an attached email message, as in the RFC-822 type
			//print_r($obj);
			if (sizeof($obj->parts) > 0) {    // Check to see if the email has parts
				foreach ($obj->parts as $count => $part) {
					// Iterate here again to compensate for the broken way that imap_fetchbody() handles attachments
					if (sizeof($part->parts) > 0) {
						foreach ($part->parts as $count2 => $part2) {
							add_part_to_array($part2, $partno.".".($count2+1), $part_array);
						}
					}else{    // Attached email does not have a seperate mime attachment for text
						$part_array[] = array('part_number' => $partno.'.'.($count+1), 'part_object' => $obj);
					}
				}
			}else{    // Not sure if this is possible
				$part_array[] = array('part_number' => $prefix.'.1', 'part_object' => $obj);
			}
		}else{    // If there are more sub-parts, expand them out.
			if (sizeof($obj->parts) > 0) {
				foreach ($obj->parts as $count => $p) {
					add_part_to_array($p, $partno.".".($count+1), $part_array);
				}
			}
		}
	}
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
		$body=imap_fetchbody($imap, $message, 1);
		if($part->encoding == 3) {
			$mail_row->body = imap_base64($body);
			$mail_row->subject = imap_base64($mail_row->subject);
		} else if($part->encoding == 1) {
			$mail_row->body = imap_8bit($body);
			$mail_row->subject = imap_8bit($mail_row->subject);
		} else {
			$mail_row->body = imap_qprint($body);
			$mail_row->subject = imap_qprint($mail_row->subject);			
		}
		
		$where=" WHERE CreateTime='".getMailDate($mail_row->udate)."' AND FromName='".getEmailAddress($mail_row->from)."' ";
		$mlkeys=$ml->getKeysBy("MailID", "ASC", $where);
		if (count($mlkeys)==0) {
			$ml->setCreateTime(getMailDate($mail_row->MailDate));
			$ml->setSentTime(getMailDate($mail_row->Date));
			$ml->setSubject($mail_row->subject);
			$ml->setBody($mail_row->body);
			$ml->setDirection(2);
			$ml->setStatus(1);
			$ml->setFromName(getEmailAddress($mail_row->from));
			$ml->setToName(getEmailAddress($mail_row->to));
			$ml->setReplyTo(getEmailAddress($mail_row->to));
			$ml->setCreateTime(getMailDate($mail_row->udate));
			$ml->setSentTime(getMailDate($mail_row->udate));
			$ml->setCreatorID(getUserIDFromMail(getEmailAddress($mail_row->from)));			
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

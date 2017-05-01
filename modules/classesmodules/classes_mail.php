<?
	function mailer($from, $to, $subj, $body)
	{
	 $from="From: $from\nReply-To: $from\nX-Priority: 1\nContent-Type: text/plain; charset=\"utf-8\"\n";
//	 $from=convert_cyr_string($from,"w","k");
//	 $to=convert_cyr_string($to,"w","k");
//	 $subj=convert_cyr_string($subj,"w","k");
//	 $body=convert_cyr_string($body,"w","k");
	 mail($to,$subj,$body,$from);
	}
?>
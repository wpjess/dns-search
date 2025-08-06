<?php
function ARecord($domainName) { 
    $get_A_records = dns_get_record(trim($domainName), DNS_A);
	$result = "";
    if (empty($get_A_records)) {
      return "[No A Records Found]";
    }
    foreach ($get_A_records as $Arecord) {
      $hostname = gethostbyaddr($Arecord['ip']);
      $result = $result . $Arecord['ip'] . " (" . $hostname . ")<br>";
    }
	return $result;
}

function wwwRecord($domainName) {
    $wwwname = "www.".$domainName;
    $get_www_records = dns_get_record(trim($wwwname), DNS_A);
    $result = "";
      if (empty($get_www_records)) {
        return "[No www Records Found]";
      }
      foreach ($get_www_records as $wwwrecord) {
        $hostname = gethostbyaddr($wwwrecord['ip']);
        $result = $result . $wwwrecord['ip'] . " (" . $hostname . ")<br>";
      }
    return $result;
}

function AAAARecord($domainName) {
    $get_AAAA_records  = dns_get_record(trim($domainName), DNS_AAAA);
	$result = "";
    if (empty($get_AAAA_records)) {
      return "[No AAAA Records Found]";
    }
    foreach ($get_AAAA_records as $AAAArecord) {
	  $result = $result . $AAAArecord['ipv6'] ."<br>";
    }
	return $result;
}

function MXRecord($domainName) {
    $get_MX_records = dns_get_record(trim($domainName), DNS_MX);
	$result = "";
    if (empty($get_MX_records)) {
      //echo "<font color=grey>[MX None Found!]</font>\n<br>";
      return "[No MX Records Found]";
    }
    foreach ($get_MX_records as $MXrecord) {
      //echo "" . $MXrecord['target'] . " (" . $MXrecord['pri'] . ")\n<br>";
      $result = $result. $MXrecord['target'] . " (" . $MXrecord['pri'] . ")<br>";
    }
	return $result;
}

function NSRecord($domainName) {
    $get_NS_records  = dns_get_record(trim($domainName), DNS_NS);
	$result = "";
    if (empty($get_NS_records)) {
      return "[No NS Found]";
    }
    foreach ($get_NS_records as $NSrecord) {
      $hostname = gethostbyname($NSrecord['target']);
      $result = $result. $NSrecord['target'] . " (" . $hostname. ")<br>";
    }
	return $result;
}

function SOARecord($domainName) {
    $get_SOA_records  = dns_get_record(trim($domainName), DNS_SOA);
    $result = "";
	if (empty($get_SOA_records)) {
      return "[No SOA Records Found]";
    }
    foreach ($get_SOA_records as $SOArecord) {
      $result = $result.  "<b>Primary nameserver</b> : " . $SOArecord['mname'] . "\n<br>" . "<b>Hostmaster E-mail address</b> : " . $SOArecord['rname'] . "\n<br>" . "<b>Serial</b> : " . $SOArecord['serial'] . "\n<br>" . "<b>Refresh</b> : " . $SOArecord['refresh'] . "\n<br>" . "<b>Retry</b> : " . $SOArecord['retry'] . "\n<br>" . "<b>Expire</b> : " . $SOArecord['expire'] . "\n<br>" . "<b>Default TTL</b> : " . $SOArecord['minimum-ttl'] . "\n<br>";
    }
	
	return $result;
}

function TXTRecord($domainName) {
    $get_TXT_records  = dns_get_record(trim($domainName), DNS_TXT);
	$result = "";
    if (empty($get_TXT_records)) {
		return "[No TXT Records Found]";
    }
    foreach ($get_TXT_records as $TXTrecord) {
      $result = $result.  $TXTrecord['txt'] . "\n<br>";
    }
	
	return $result; 
}

function SRVRecord($domainName) {
    $get_SRV_records  = dns_get_record(trim($domainName), DNS_SRV);
	$result = "";
    if (empty($get_SRV_records)) {
		return "[No SRV Records Found]";
    }
    foreach ($get_SRV_records as $SRVrecord) {
      $result = $result.  $SRVrecord['target'] . " (" . $SRVrecord['pri'] . ")\n<br>";
    }
	
	return $result; 
}

function CNAMERecord($domainName) {
    $get_CNAME_records  = dns_get_record("www.".trim($domainName), DNS_CNAME);
	  $result = "";
    if (empty($get_CNAME_records)) {
		return "[No CNAME Records Found]";
    }
    foreach ($get_CNAME_records as $CNAMErecord) {
      $result = $result.  $CNAMErecord['target'] . " (TTL : " . $CNAMErecord['ttl'] . ")\n<br>";
    }
	
	return $result; 
}
?>

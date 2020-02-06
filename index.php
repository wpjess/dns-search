<!DOCTYPE HTML>
<?php 
	require "functions/domain.php";
	require "functions/whois.php";

	if(isset($_GET['domain'])) {
		$domainName = $_GET['domain'];
		$domain = trim($domainName);
		$input = trim($domain, '/');
		if (!preg_match('#^http(s)?://#', $input)) {
		    $input = 'http://' . $input;
		}
		$urlParts = parse_url($input);
		$domain = preg_replace('/^www\./', '', $urlParts['host']);
					
        $a = ARecord($domain);
        $www = wwwRecord($domain);
		$aaaa = AAAARecord($domain);
		$mx = MXRecord($domain);
		$ns = NSRecord($domain);
		$soa = SOARecord($domain);
		$txt = TXTRecord($domain);
		$srv = SRVRecord($domain);
		$cname = CNAMERecord($domain);

		if(ValidateIP($domain)) {
			$whois = LookupIP($domain);
		}
		elseif(ValidateDomain($domain)) {
			$whois = LookupDomain($domain);
		}
	}
	

	if(isset($_POST['submit']))  {
	    if(isset($_POST['domain'])) {

		$domainName = $_POST['domain'];
		$domain = trim($domainName);
		$input = trim($domain, '/');
		if (!preg_match('#^http(s)?://#', $input)) {
		    $input = 'http://' . $input;
		}
		$urlParts = parse_url($input);
		$domain = preg_replace('/^www\./', '', $urlParts['host']);
					
        $a = ARecord($domain);
        $www = wwwRecord($domain);
		$aaaa = AAAARecord($domain);
		$mx = MXRecord($domain);
		$ns = NSRecord($domain);
		$soa = SOARecord($domain);
		$txt = TXTRecord($domain);
		$srv = SRVRecord($domain);
		$cname = CNAMERecord($domain);
					
		if(ValidateIP($domain)) {
			$whois = LookupIP($domain);
		}
		elseif(ValidateDomain($domain)) {
			$whois = LookupDomain($domain);
		}
	}
}
	
?>
<html>
<!-- made by Jess :) -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>DNS Search</title>
    <meta name="description" content="DNS Lookup">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="wrapper">
        <header id="header" class="alt">
            <h1><a href="index.php">DNS Search</a></h1>
            <form method="POST" />
            <div>
                <input type="text" name="domain" placeholder="<?php if(isset($domainName)) { echo $domain;} else { echo 'website.com';} ?>" value="" required/>
            </div>
            &nbsp;

            <div>
                <input id="submit-domain" type="submit" name="submit" value="Submit" class="button  small" />
            </div>

            </form>
            <?php if(isset($domainName)) { ?>
                <p>Results for: <a href="http://<?php echo $domain; ?>" target="_blank"><strong><?php echo $domainName; ?></strong></a></p>

                <?php } ?>

        </header>

        <?php if(isset($domainName)) { ?>
            
            <nav id="nav">
                <ul>
                    <li><a href="#a" class="active">A</a></li>
                    <li><a href="#mx">MX</a></li>
                    <li><a href="#ns">NS</a></li>
                    <li><a href="#soa">SOA</a></li>
                    <li><a href="#txt">TXT</a></li>
                    <li><a href="#srv">SRV</a></li>
                    <li><a href="#cname">CNAME</a></li>
                    <li><a href="#whois">WHOIS</a></li>
                    <li><a href="https://mxtoolbox.com/SuperTool.aspx?action=blacklist%3a<?php echo $domain; ?>&run=toolpage" target="_blank">Blacklist Check</a></li>
                </ul>
            </nav>
           
            <?php } ?>

        <div id="main">
                   
                    <?php if(isset($domainName)) { ?>

                        <section id="a" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                        <h2>IPv4 and IPv6 Records</h2>
                                    </header>
                                    <h3><strong>A</strong></h3>
                                    <p><?php echo $a; ?></p>
                                    <h3><strong>www</strong></h3>
                                    <p><?php echo $www; ?></p>
                                    <h3><strong>AAAA</strong></h3>
                                    <p><?php echo $aaaa; ?></p>
                                </div>
                            </div>
                        </section>

                        <section id="mx" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                        <h2>MX Records</h2>
                                    </header>
                                    <p><?php echo $mx; ?></p>
                                </div>
                            </div>
                        </section>

                        <section id="ns" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                        <h2>NS Records</h2>
                                    </header>
                                    <p><?php echo $ns; ?></p>
                                </div>
                            </div>
                        </section>

                        <section id="soa" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                        <h2>SOA Records</h2>
                                    </header>
                                    <p><?php echo $soa; ?></p>
                                </div>
                            </div>
                        </section>

                        <section id="txt" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                        <h2>TXT Records</h2>
                                    </header>
                                    <p><?php echo $txt; ?></p>
                                </div>
                            </div>
                        </section>

                        <section id="srv" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                        <h2>SRV Records</h2>
                                    </header>
                                    <p><?php echo $srv; ?></p>
                                </div>
                            </div>
                        </section>

                        <section id="cname" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                        <h2>CNAME Records</h2>
                                    </header>
                                    <p><?php echo $cname; ?></p>
                                </div>
                            </div>
                        </section>

                        <section id="whois" class="main">
                            <div class="dns-section">
                                <div class="content">
                                    <header class="dns-title">
                                    	<h2>WHOIS</h2>
                                    </header>
                                    <p><?php echo $whois; ?></p>
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                
        </div>
    </div>

    <br /><br /><br />

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.scrollex.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/util.js"></script>
    <script src="js/main.js"></script>
    <script>
        $('.wrapper').css("height", $(document).height());
    </script>

    <?php if(isset($domainName)) { ?>
    <style type="text/css">
        body {
           background-image: url("images/overlay.png"), -moz-linear-gradient(45deg, #2B324F 15%, #2D9CD3 85%);
           background-image: url("images/overlay.png"), -webkit-linear-gradient(45deg, #2B324F 15%, #2D9CD3 85%);
            background-image: url("images/overlay.png"), -ms-linear-gradient(45deg, #2B324F 15%, #2D9CD3 85%);
            background-image: url("images/overlay.png"), linear-gradient(45deg, #2B324F 15%, #2D9CD3 85%);
        }
    </style>

    <?php } ?>
</body>

</html>

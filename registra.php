<?
$ip = $_SERVER['REMOTE_ADDR'];
$sel = mysql_query("SELECT * FROM contador WHERE ip = '$ip' and data = '".date("Y-m-d")."'") or die(mysql_error());
if(mysql_num_rows($sel) == 0){
   $insert = mysql_query("INSERT INTO contador (ip, cont, data) VALUES ('$ip','1','".date("Y-m-d")."')") or die(mysql_error());
}else{
   $r = mysql_fetch_array($sel);
   $contagem = $r["cont"];
   $contagem = $contagem + 1;
   $update = mysql_query("UPDATE contador SET cont = '$contagem' WHERE ip = '$ip' and data = '".date("Y-m-d")."'") or die(mysql_error());
}
$sel2 = mysql_query("SELECT * FROM contador") or die(mysql_error());
$visitas = mysql_num_rows($sel2);
while($b = mysql_fetch_array($sel2)){
  $views = $views + $b["cont"];
}
echo "<p align=\"center\">J&aacute; tivemos <b>$visitas</b> visitas e <br>
<b>$views</b> visualiza&ccedil;&otilde;es <br>
desde 23 de mar&ccedil;o de 2008!<br><br>Volte sempre!</p>";
?>
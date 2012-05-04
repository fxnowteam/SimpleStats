<style>
	body, input {
		font-family: Arial, Verdana;
		font-size: 11px;
	}
</style>
<?
mysql_connect("bm22.webservidor.net","chureba_paico","paico") or die(mysql_error());
mysql_select_db("chureba_wrdp3") or die(mysql_error());
echo "<form name=\"form\" method=\"post\" action=\"?reload=ok\">";
echo "Estat&iacute;sticas mensais: ";
echo "<input name=\"anomes\" type=\"type\" value=\"".date("Y")."-mm\"><input type=\"submit\" value=\"ok\">";
echo "</form>* aaaa: ano<br>mm: m&ecirc;s";

if($_GET["reload"] == ""){
	echo "<h3>Visitas hoje</h3>";
	$sel = mysql_query("SELECT * FROM contador WHERE data = '".date("Y-m-d")."'") or die(mysql_error());
	echo mysql_num_rows($sel)." visitas e ";
	while($a = mysql_fetch_array($sel)){ $views = $views + $a["cont"]; }
	echo $views." visualiza&ccedil;&otilde;es";
	$views = 0;

	echo "<h3>Visitas ontem</h3>";
	$diahoje = date("d");
	$diaontem = $diahoje - 1;
	if($diaontem == 0){
		if(date("m") == 3){
			$diaontem = 28;
		}elseif(date("m") == 1 or date("m") == 2 or date("m") == 4 or date("m") == 6 or date("m") == 9 or date("m") == 11){
			$diaontem = 31;
		}else{
			$diaontem = 30;
		}
		$mesontem = date("m") - 1;
		if($mesontem == 0){
			$mesontem = 12;
			$anoontem = date("Y") - 1;
		}else{
			$anoontem = date("Y");
		}
	}else{
		$mesontem = date("m");
		$anoontem = date("Y");
	}
	$dataontem = $anoontem."-".$mesontem."-".$diaontem;
	$sel2 = mysql_query("SELECT * FROM contador WHERE data = '$dataontem'") or die(mysql_error());
	echo mysql_num_rows($sel2)." visitas e ";
	while($b = mysql_fetch_array($sel2)){ $views = $views + $b["cont"]; }
	echo $views." visualiza&ccedil;&otilde;es";
	$views = 0;

	echo "<h3>Visitas este m&ecirc;s</h3>";
	$sel3 = mysql_query("SELECT * FROM contador WHERE data LIKE '%".date("Y-m")."%'") or die(mysql_error());
	echo mysql_num_rows($sel3)." visitas e ";
	while($c = mysql_fetch_array($sel3)){
		$views = $views + $c["cont"];
	}
	echo $views." visualiza&ccedil;&otilde;es";
	$views = 0;
}else{
	$anomes = $_POST["anomes"];
	echo "<h3>$anomes</h3>";
	$diacont = 0;
	while($diacont != 31){
		$diacont = $diacont + 1;
		$datastats = $anomes."-".$diacont;
		$sel3 = mysql_query("SELECT * FROM contador WHERE data = '$datastats'") or die(mysql_error());
		echo "<b>".$datastats.": </b><br>";
		$visitas_mes = $visitas_mes + mysql_num_rows($sel3);
		echo mysql_num_rows($sel3)." visitas e ";
		while($c = mysql_fetch_array($sel3)){
			$views = $views + $c["cont"];
		}
		$views_mes = $views_mes + $views;
		echo $views." visualiza&ccedil;&otilde;es<br>";
		$views = 0;
	}
	echo "<br><br><b>Visitas no m&ecirc;s: </b>$visitas_mes <br>
	<b>Visualiza&ccedil;&otilde;es no m&ecirc;s: </b>$views_mes";
}
mysql_close();
?>
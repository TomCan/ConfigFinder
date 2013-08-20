<?php

	set_time_limit(600);

	include("files.php");

	function IsURLOfType($u, $t) {

		foreach ($t["check"] as $c) {

			$ch = curl_init($u . $c['url']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);				
			curl_close($ch);

			if (preg_match($c['find'], $data)) return true;
			
		}
		
		
		
		return false;
		
	}

	function CheckURL($u, $tocheck) {
		
		global $transforms;
		
		$ret = array();
		
		foreach ($tocheck["files"] as $file => $match) {
			
			$p = explode("/", $file);
			$f = $p[count($p) - 1];
			$po = substr($file, 0, strlen($file) - strlen($f));
			$ff = explode(".", $f); 
			$e = $ff[count($ff) - 1];
			$fo = substr($f, 0, strlen($f) - strlen($e) - 1);
			
			$replace = array("{F}" => $f,"{FO}" => $fo, "{E}" => $e);
			
			foreach ($transforms as $t) {
				
				$out = array();
				
				$fn = urlencode(str_replace(array_keys($replace), array_values($replace), $t));
				$fn = str_replace(array_keys($replace), array_values($replace), $t);
				
				$ch = curl_init($u . $po . $fn);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$data = curl_exec($ch);
				$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				
				$out["url"] = $u . $po . $fn;
				$out["code"] = $code;
				$out["match"] = false;
				
				if ($code == 200) {
					if (preg_match($match, $data)) {
						$out["match"] = true;
					}
				}
			
				$ret[] = $out;
				
			}
			
		}
		
		return $ret;
		
	}

	if (isset($_POST["url"]) && $_POST["url"] != "") {
		
		$url = $_POST["url"];
		if (substr($url, -1, 1) == "/") $url = substr($url,0,-1);
		if (substr($url, 0, 7) != "http://") $url = "http://".$url;
		
		if ($_POST["type"] == "auto") {

			$autotype = "";			
			foreach ($sites as $key => $value) {
				
				echo "<br />Checking if $url is $key...";				
				if (IsURLOfType($url, $value)) {
					echo "Yes";
					$autotype = $key;
					break;
				} else {
					echo "No";
				}
			}
			
			if ($autotype == "") $autotype = "generic";
			
		} else {
			
			$autotype = $_POST["type"];
			
		}
		
		$ret = CheckURL($url, $sites[$autotype]);
		
		var_dump($ret);
		
	}


?>
<html>
	<body>
		<form method="post">
			<input type="text" name="url" />
			<select name="type">
				<option value="auto">autodiscover</option>
<?php
	foreach ($sites as $key => $value) {
?>
				<option value="<?php echo $key ?>"><?php echo $key ?></option>
<?php		
	}
?>				
			</select>
			<input type="submit" value="Check" />
		</form>
	</body>
</html>
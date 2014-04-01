<?php
// File path
$file = '/etc/hosts';
// Open file
$handle = fopen($file, 'r');
if ($handle) {
	// loop through file and create an array from each line of text
  while (!feof($handle)) {
       $lines[] = fgets($handle, 4096);
  }
  fclose($handle);
}

$trigger = false; // wait for localhost to show up in hosts file
// loop through the lines of text in file
foreach($lines as $key=>$val) {
	// explode the text on the tab separation
	$line = preg_split("/[\s,]+/", $val);
	$line = array_diff($line, array(""));

	if(is_array($line)) {
		if(strpos($line[0], '#') === false ) {
		} else if($trigger) {
			echo '<h3>' . implode($line, " ") . '</h3>';
		}

		if(strpos($line[0], '127.0.0.1') === false ) {
		} else {
			$trigger = true;
			echo '<a href="http://' . $line[1] . '" target="_blank">' . $line[1] . '</a><br />';
		}
	}
	// echo $val . "<br />";
}

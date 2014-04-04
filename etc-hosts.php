<?php
/**
 * This is a simple webpage that loops through the /etc/hosts file for navigation of projects
 * The file looks for a line that is starts with 127.0.0.1 before writing out links
 * Any line after the first link will search for '#', and use the text as a header
 *
 * Add this file to the root of your web projects folder
 *
 * Example hosts file
 *
 * ##
 * # Host Database
 * #
 * # localhost is used to configure the loopback interface
 * # when the system is booting.  Do not change this entry.
 * ##
 * 127.0.0.1   localhost
 * 255.255.255.255 broadcasthost
 * ::1             localhost
 * fe80::1%lo0 localhost
 *
 * # Project Type/Name
 * 127.0.0.1   local.projectname.com
 *
 */

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
?>
<html>
<head>
	<link href="/assets/css/bootstrap-3.1.0.min.css" rel="stylesheet" />
	<link href="/assets/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet" />
	<style>
	a {
		font-size: 20px;
	}
	</style>
</head>
<body>

	<div class="container">
		<h2>Local Hoster</h2>
		<a href="etc-hosts.php" class="btn btn-primary bt-lg"><i class="fa fa-th-list fa-lg"></i> Hosts</a>
		<a href="add-host.php" class="btn btn-success bt-lg"><i class="fa fa-plus fa-lg"></i> Add Host</a>
		<hr />
		<?php

		$trigger = false; // wait for localhost to show up in hosts file
		// loop through the lines of text in file
		foreach($lines as $key=>$val) {
			// explode the text on the spacing separation
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
		?>
	</div>
</body>
</html>
<?php
require('Classes/Hosts.class.php');
require('Classes/Vhosts.class.php');
require('Classes/Config.class.php');

$Hosts = new Hosts();
$hosts = $Hosts->findAllHosts();

$Vhosts = new Vhosts();
$vhosts = $Vhosts->findAllVhosts();

$projects = array();
foreach($vhosts as $key=>$values) {
	if(isset($values['ServerName']) ) {

		$ServerName = $values['ServerName'];

		if( isset($hosts[$ServerName] ) ) {
			$vhosts[$key]['ip'] = $hosts[$ServerName];
			$projects[$ServerName] = $vhosts[$key];
		}
	}
}

if(isset($_REQUEST['data']) ) {
	$Config = new Config();
	$data = $_REQUEST['data'];

	foreach($data as $key=>$value) {
		if($value === "yes") {
			$addProject = $projects[$key];
			$Config->addProject(array(
					'Name'=>$addProject['ServerName'],
					'DocumentRoot'=>$addProject['DocumentRoot'],
					'ServerName'=>$addProject['ServerName'],
				));
		}
	}

	$Config->save($Config->data);
}

?>

<form method="POST">
	<button class="btn btn-danger">Run Import</button>
	<table class="table">
		<thead>
			<tr>
				<th>Import</th>
				<th>ServerName</th>
				<th>IP</th>
				<th>DocumentRoot</th>
			</tr>
		</thead>
		<tbody>
	<?php
	foreach($projects as $key=>$values) {
	?>
		<tr>
			<td class="form-control">
				<label for="<?php echo $values['ServerName'] ?>Yes">Yes</label>
				<input type="radio" name="data[<?php echo $values['ServerName'] ?>]" value="yes" id="<?php echo $values['ServerName'] ?>Yes" />
				&nbsp;&nbsp;
				<label for="<?php echo $values['ServerName'] ?>No">No</label>
				<input checked type="radio" name="data[<?php echo $values['ServerName'] ?>]" value="no" id="<?php echo $values['ServerName'] ?>No" />
			</td>
			<td><?php echo $values['ServerName'] ?></td>
			<td><?php echo $values['ip'] ?></td>
			<td><?php echo $values['DocumentRoot'] ?></td>
		</tr>
	<?php } ?>
		</tbody>
	</table>
</form>
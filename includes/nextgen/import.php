<?php
require('Classes/Hosts.class.php');
require('Classes/Vhosts.class.php');

$Hosts = new Hosts();
$hosts = $Hosts->getAllHosts();

$Vhosts = new Vhosts();
$vhosts = $Vhosts->findAllVhosts();

foreach($vhosts as $key=>$values) {
	if(isset($values['ServerName']) ) {

		$ServerName = $values['ServerName'];

		if( isset($hosts[$ServerName] ) ) {
			$vhosts[$key]['ip'] = $hosts[$ServerName];
		}
	}
}
?>

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
foreach($vhosts as $values) {
?>
	<tr>
		<td class="form-control">
			<label for="<?php echo $values['ServerName'] ?>Yes">Yes</label>
			<input type="radio" name="data[project][<?php echo $values['ServerName'] ?>]" value="yes" id="<?php echo $values['ServerName'] ?>Yes" checked />
			&nbsp;&nbsp;
			<label for="<?php echo $values['ServerName'] ?>No">No</label>
			<input type="radio" name="data[project][<?php echo $values['ServerName'] ?>]" value="no" id="<?php echo $values['ServerName'] ?>No" />
		</td>
		<td><?php echo $values['ServerName'] ?></td>
		<td><?php echo $values['ip'] ?></td>
		<td><?php echo $values['DocumentRoot'] ?></td>
	</tr>
<?php } ?>
	</tbody>
</table>

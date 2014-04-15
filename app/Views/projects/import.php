<form method="POST">
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
	foreach($this->projects as $key=>$values) {
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
	<button class="btn btn-success">Run Import</button>
</form>
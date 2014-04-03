<table class="table table-condensed">
	<thead>
		<tr>
			<?php
			$keys = array('ServerName', 'Name');
			foreach($keys as $key) {
				$name = ucwords( str_replace('-', ' ', $key) );
				echo "<th>$name</th>";
			}?>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($Controller->projects as $project) { ?>
			<tr>
			<?php foreach($keys as $key) { ?>
				<td>
					<?php
						$output = $project[$key];
						if($key == "ServerName") {?>
							<h4><a href="<?php echo $output ?>"><?php echo $output ?></a></h4>
						<?php } else{
							echo $output;
						}
					?>
				</td>
			<?php }?>
			<td>
				<form method="POST">
					<a href="?action=edit&id=<?php echo $project['id']; ?>" class="btn btn-success"><i class="fa fa-edit fa-lg"></i> Edit</a>

					<input type="hidden" name="delete_project_id" value="<?php echo $project['id']; ?>" />
					<button class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i> Delete</button>
				</form>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
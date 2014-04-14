<table class="table table-condensed">
	<thead>
		<tr>
			<?php
			$keys = array('ServerName', 'ip', 'Name');
			foreach($keys as $key) {
				$name = ucwords( str_replace('-', ' ', $key) );
				echo "<th>$name</th>";
			}?>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($this->projects as $project) { ?>
			<tr>
			<?php foreach($keys as $key) { ?>
				<td>
					<?php
						$output = $project[$key];
						if($key == "ServerName") {?>
							<h4><a href="http://<?php echo $output ?>" target="_blank"><?php echo $output ?></a></h4>
						<?php } else{
							echo $output;
						}
					?>
				</td>
			<?php }?>
			<td>
				<form action="?controller=projects&action=delete" method="POST">
					<a href="?controller=projects&action=edit&id=<?php echo $project['id']; ?>" class="btn btn-success"><i class="fa fa-edit fa-lg"></i> Edit</a>
					<a href="?controller=projects&action=delete&id=<?php echo $project['id']; ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i> Delete</a>

					<!-- <input type="hidden" name="data[project][id]" value="<?php echo $project['id']; ?>" /> -->
					<!-- <button class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i> Delete</button> -->
				</form>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
<blockquote class="active">
	<p>Your projects</p>
</blockquote>
<table class="table">
	<thead>
		<tr>
			<?php foreach($tableKeys as $key) {
				$name = ucwords( str_replace('-', ' ', $key) );
				echo "<th>$name</th>";
			}?>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($projects as $project) { ?>
			<tr>
			<?php foreach($tableKeys as $key) {
				echo "<td>$project[$key]</td>";
			}?>
			<td><a href="projects.php?id=<?php echo $project['id']; ?>" class="btn btn-success">Edit</a></form></td>
			<td><form method="POST"><input type="hidden" name="delete_project_id" value="<?php echo $project['id']; ?>"><button class="btn btn-danger">Delete</button></form></td>
		</tr>
		<?php }?>
	</tbody>
</table>
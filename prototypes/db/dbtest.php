<?php 
include("sql_functions.php");

$name = "'Joan Francioni'";

$hours_entries = get_hours_all($name);

$schedule = get_hours($name);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Database Functionality Test</title>
		<script src="dbtest.js"></script>
		<style>
			table, th, td {
    			border: 1px solid black;
			}
		</style>
	</head>
	<body>
		<?php include("scheduleTable.php"); ?>
		<table>
			<tr>
				<th>Event</th>
				<th>Day</th>
				<th>Start</th>
				<th>End</th>
				<th>Expires</th>
			</tr>
			<?php foreach ($hours_entries as $entry) { ?>
				<tr>
					<td><?= $entry["Event"] ?></td>
					<td><?= $entry["Day"] ?></td>
					<td><?= $entry["Start"] ?></td>
					<td><?= $entry["End"] ?></td>
					<td><?= $entry["Expiration"] ?></td>
					<th>
						<input type="button" class="delete_button" value="Delete">
						<input type="hidden" value="<?= $entry["hours_ID"] ?>">
					</th>
				</tr>
			<?php } ?>
		</table>
		<input type="button" value="Add new entry" id="add_new">
		<form action="dbtest.php" method="POST">
			<input type="hidden" name="delete_list" id="submit_button" value="">
			<input type="hidden" name="add_list" value="">
			<input type="submit">
		</form>
	</body>
</html>
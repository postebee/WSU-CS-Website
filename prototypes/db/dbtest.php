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
		<table>
			<tr>
				<th></th>
				<?php
					$days = Array("Monday", "Tuesday");
					foreach ($days as $day) {
				?>
				
					<th><?= $day ?></th>
					
				<?php } ?>
			</tr>
			<?php
				$monday_events = Array();
				$tuesday_events = Array();
				$wednesday_events = Array();
				$thursday_events = Array();
				$friday_events = Array();
	
				foreach ($schedule as $event) {
					$event_entry = Array($event["Event"], $event["Length"] / 30);
					if ($event["Day"] == "Monday") {
						$monday_events[$event["Start"]] = $event_entry;
					}
				}
			
				$times = Array("8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00",
							   "11:30", "12:00", "12:30", "1:00", "1:30", "2:00");
				
				foreach($times as $time) {
			?>
					<tr>
						<td><?= $time ?></td>
						<?php if (isset($monday_events[$time])) { ?>
							<td rowspan="<?= $monday_events[$time][1] ?>">
								<?= $monday_events[$time][0] ?>
							</td>
						<?php } ?>
					</tr>
					
			<?php } ?>
		</table>
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
						<input type="hidden" value="<?= $entries["hours_ID"] ?>">
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
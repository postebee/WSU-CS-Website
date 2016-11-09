<table>
	<tr>
		<th></th>
		<?php
			$days = Array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
			$day_skips = Array();
			foreach ($days as $day) {
				$day_skips[$day] = 0;
		?>		
				<th><?= $day ?></th>
					
		<?php } ?>
	</tr>
	<?php
	$event_schedule = Array();
	foreach ($schedule as $event) {
		$event_entry = Array($event["Event"], $event["Length"] / 30);
		foreach ($days as $day) {
			if ($event["Day"] == $day) {
				if (!isset($event_schedule[$day])) {
					$event_schedule[$day] = Array();
				}
				$event_schedule[$day][$event["Start"]] = $event_entry;
			}
		}
	}			
	$times = Array("8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00",
				   "11:30", "12:00", "12:30", "1:00", "1:30", "2:00");			
	foreach($times as $time) {
	?>
		<tr>
			<td><?= $time ?></td>
			<?php 
			foreach ($days as $day) {
				if (isset($event_schedule[$day][$time])) { 
					$day_skips[$day] = $event_schedule[$day][$time][1] - 1;
			?>
				<td rowspan="<?= $event_schedule[$day][$time][1] ?>">
					<?= $event_schedule[$day][$time][0] ?>
				</td>
			<?php 
			} 
			else {
				if ($day_skips[$day] > 0) {
					$day_skips[$day]--;
				}
				else {
			?>
				<td></td>	
			<?php } } } ?>			
		</tr>
	<?php } ?>
</table>
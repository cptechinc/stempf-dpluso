<?php 
	include $config->paths->assets."classes/php-ical/vendor/autoload.php";
	use RRule\RRule;
	$schedules = get_current_taskschedules();

	foreach ($schedules as $schedule) {
		$rule = new RRule($schedule['repeatlogic']);
		if ($rule->occursAt(date('Y-m-d'))) {
			echo $schedule['id'] . " occurs today";
		}
	}
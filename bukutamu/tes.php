<?php
	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ H:i:s');
    $now_date = $datetime->format('Y\-m\-d\ ');

    echo $now
    ?>
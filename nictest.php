<?php

$noon = new DateTime(2-26-2018 12:00:00);
$now = new DateTime();

$interval = $noon->diff($now);
echo $interval->format('%i minutes');

?>

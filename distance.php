<?php
$original_date = "2009-09-29";

$time_original = strtotime($original_date);
$time_add      = $time_original + (3600*24); //add seconds of one day

$new_date      = date("Y-m-d", $time_add);

echo $new_date;
?>

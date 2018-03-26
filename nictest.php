<?php
require_once('connection.php');

function elapsed_recalc($event_id) {

  global $db;
	// Load in this event (n) and the one before it (n-1) and the one after (n+1)
	$changed_event_query = 'SELECT * from history WHERE event_id = '.$event_id;
	$changed_event = $db->query($changed_event_query)->fetch_all($resulttype = MYSQLI_ASSOC);
  print_r($changed_event);
  $student_id = $changed_event[0]['student_id'];
  $changed_event_id = $changed_event[0]['event_id'];
  $older_event_query = 'SELECT * from history WHERE student_id = '.$student_id.' AND event_id < '.$changed_event_id.' ORDER BY event_id DESC LIMIT 1';
  $older_event = $db->query($older_event_query)->fetch_all($resulttype = MYSQLI_ASSOC);
  $older_event_id = $older_event[0]['event_id'];
  $newer_event_query = 'SELECT * from history WHERE student_id = '.$student_id.' AND event_id > '.$changed_event_id.' ORDER BY event_id ASC LIMIT 1';
  $newer_event = $db->query($newer_event_query)->fetch_all($resulttype = MYSQLI_ASSOC);
  // Calculate diff between n and n+1, update n.elapsed
  $changed_event_datetime = new DateTime($changed_event[0]['timestamp']);
  $newer_event_datetime = new DateTime($newer_event[0]['timestamp']);
  $time_elapsed = round(($newer_event_datetime->getTimestamp()-$changed_event_datetime->getTimestamp())/60, 2);
  $query = "UPDATE history SET elapsed = '$time_elapsed' WHERE event_id = '$changed_event_id'";
  $db->query($query);
	// Calculate diff between n and n-1, update n-1.elapsed
  $older_event_datetime = new DateTime($older_event[0]['timestamp']);
  $time_elapsed = round(($changed_event_datetime->getTimestamp()-$older_event_datetime->getTimestamp())/60, 2);
  $query = "UPDATE history SET elapsed = '$time_elapsed' WHERE event_id = '$older_event_id'";
  $db->query($query);

}

elapsed_recalc(412);
?>

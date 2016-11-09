<?php

$db = new PDO("mysql:host=localhost;dbname=site_content", "root");

function get_hours($name) {
	global $db;
	$date = date("Y-m-d");
	return $db->query("SELECT Event, Day, TIME_FORMAT(Start, '%l:%i') AS Start, 
					   TIME_FORMAT(End, '%h:%i') AS End, 
					   TIMESTAMPDIFF(MINUTE, Start, End) as Length
					   FROM hours INNER JOIN staff 
					   WHERE name = $name AND $date < Expiration
					   ORDER BY Start;");
}

function get_hours_all($name) {
	global $db;
    return $db->query("SELECT *
        			   FROM hours INNER JOIN staff 
    				   WHERE name = $name;");
}

function delete_entries($table, $id_list) {
	global $db;
	$db->query("DELETE FROM $table WHERE $table_ID IN ($id_list);");
}

function insert_entries($table, $fields, $entries) {
	global $db;
	$entry_list = "($entries[0])";
	for ($i = 1; $i  < count($entries); $i++) {
		$entry_list .= ", ($entries[i])";
	}
	$db->query("INSERT INTO $table ($fields) VALUES $entry_list;");
}

?>
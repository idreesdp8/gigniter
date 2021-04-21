<?php 

$curdate = 'SELECT CURDATE()';
$query = $this->db->query($sql);
		echo $query->row();
// $date =  new DateTime;
echo json_encode($curdate);

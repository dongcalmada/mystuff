<?php
if (!isset($db)) {
	include 'db.php';
}
$sql = "SELECT * FROM notes ORDER BY date DESC";

$result = $db->query($sql);

?>
<div class="card">
	<!-- <img class="card-img-top" src="images/notes.png" alt="Notes"> -->
	<div class="card-body">
		<h2 class="card-title display-5">Notes</h2>
		<?php
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		echo "<div class='card'>";
		echo "<div class='card-body'>";
		echo "<div class='card-text'>" . $row['note'] . "</div>";
		echo "</div>";
		echo "</div>";
	}
?>
	</div>
</div>
<?php
if (!isset($db)) {
	include 'db.php';
}

$tags = getTags();

?>
<ul class="nav nav-tabs" role="tablist">
	<?php
		$ndx = 0;
		foreach ($tags as $tag) {
			if ($ndx == 0) {
				$active_attr = "active";
			} else {
				$active_attr = null;
			}
			?><li class='nav-item'><a class='nav-link <?php echo $active_attr;?>' href='<?php echo $tag;?>' role="tab" data-toggle="tab"><?php echo $tag;?></a></li>
			<?php
			$ndx++;
		}
	?>
</ul>

<div class="tab-content">
	<?php
	$ndx = 0;
	foreach ($tags as $tag) {
		if ($ndx == 0) {
			$active_attr = "fade in active";
		} else {
			$active_attr = null;
		}
		?><div role="tabpanel" class="tab-pane <?php echo $active_attr;?>" id="<?php echo substr($tag,1,strlen($tag));?>">
			<?php
			$sql = "SELECT count(*) as count FROM notes WHERE note LIKE '%" . $tag . "%' ORDER BY date DESC";
			$result = $db->query($sql);
			$rows = $result->fetchArray(SQLITE3_ASSOC);
			if ($rows['count'] > 0) {
				$sql = "SELECT * FROM notes WHERE note LIKE '%" . $tag . "%' ORDER BY date DESC";
				$result = $db->query($sql);
				?><div class="card">
					<div class="card-body">
						<h5 class="card-title">Notes</h5><?php 
				while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
					?><div class="card"><div class="card-body"><?php
					echo $row['note'];?></div></div>
					<?php
				}
				?>
					</div>
				</div>
				<?php
			}

			$sql = "SELECT count(*) AS count FROM accomplishments WHERE accomplishment LIKE '%" . $tag . "%' ORDER BY date DESC, accomplishment";
			$result = $db->query($sql);
			$rows = $result->fetchArray(SQLITE3_ASSOC);
			if ($rows['count'] > 0) {
				?><h5 class="display-5">Accomplishments</h5><?php
				$sql = "SELECT * FROM accomplishments WHERE accomplishment LIKE '%" . $tag . "%' ORDER BY date DESC, accomplishment";
				$result = $db->query($sql);
				while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
					?><div class="card"><div class="card-body"><?php
					echo "<b>" . $row['date'] . "</b>: " . $row['accomplishment'];?></div></div>
					<?php
				}
			}
			?>
		</div>
		<?php
		$ndx++;
	}
	?>
</div>

<?php
function getTags() {
	global $db;
	$tags = array();
	$sql = "SELECT note FROM notes";
	$result = $db->query($sql);
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		preg_match_all('/(\s#\w+)/',$row['note'],$matches);
		foreach ($matches[1] as $m) {
			$tags[] = trim($m);
		}
	}
	$sql = "SELECT accomplishment FROM accomplishments";
	$result = $db->query($sql);
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		preg_match_all('/(#\w+)/',$row['accomplishment'],$matches);
		foreach ($matches[1] as $m) {
			$tags[] = $m;
		}
	}

	sort($tags);
	$tags = array_unique($tags);
	return $tags;
}
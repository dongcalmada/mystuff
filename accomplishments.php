<?php
ini_set('display_errors',1);
include 'db.php';
include 'ref.php';

$homeurl = SITE_URL;

if (isset($_GET['month']) and isset($_GET['year'])) {
	$criteria = "WHERE month = '" . $_GET['month'] . "'";
	$caption = "Accomplishments for " . $months[$_GET['month']][1] . ' ' . $_GET['year'];
} else {
	$criteria = null;
	$caption = "Accomplishments";
}

$yearsandmonths = array();

$sql = "SELECT DISTINCT strftime('%Y',date) AS year FROM accomplishments ORDER BY year DESC";
$result = $db->query($sql);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
	$sql2 = "SELECT DISTINCT strftime('%m',date) AS month FROM accomplishments WHERE strftime('%Y',date) = '" . $row['year'] . "' ORDER BY month DESC";
	$result2 = $db->query($sql2);
	$months2 = array();
	while ($row2 = $result2->fetchArray(SQLITE3_ASSOC)) {
		$months2[] = $row2['month'];
	}; 
	$yearsandmonths[$row['year']] = $months2;
}

$links_html = "<div id='links' class='container'>";

$rowcolcounter = 1;


echo "<div class='container'>";
echo '<div class="card">
			<div class="card-body">
				<h2 class="card-title">Accomplishments</h2>';

foreach ($yearsandmonths as $year => $months3) {
	$links_html .= "<a href='" . $homeurl . "?year=$year'>$year</a>:&nbsp;&nbsp;";
	foreach ($months3 as $mo) {
		echo showData($mo,$months[$mo][1],$year);
		$links_html .= "<a href='" . $homeurl . "?year=$year&month=$mo'>" . $months[$mo][0] . "</a>&nbsp;&nbsp;";
	}
}
echo "</div></div></div>";
$links_html .= "</div>";
//echo $links_html;

function showData($month,$monthdesc,$year) {
	global $db;
	global $months;
	global $weekdays;
	$sql = "SELECT *, strftime('%m',date) as month, strftime('%Y',date) as year, strftime('%w',date) AS day, strftime('%d',date) as dom FROM accomplishments WHERE strftime('%m',date) = '" . $month . "' AND strftime('%Y',date) = '" . $year . "' ORDER BY date DESC, accomplishment";
	$result = $db->query($sql);

	$panelheading = $monthdesc . " " . $year;
	$html = 
		'<div class="card">
			<div class="card-body">
				<h4 class="card-title">' . $panelheading . '</h4>
				<table class="table-sm"><tbody>';

	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		$html .= '
			<tr>
			<th scope="row" style="white-space:nowrap;vertical-align:top">' . $row['dom'] . ' (' . substr($weekdays[$row['day']],0,3) . ')</th>
			<td>' . $row['accomplishment'] . '</td>
			</tr>
		';
	}

	$html .= '</tbody></table>
			</div></div>';
	return $html;
}

function genTagsLinks() {
	global $db;
	$tags = array();
	$sql = "SELECT note FROM notes";
	$result = $db->query($sql);
	while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
		preg_match_all('/(#\w+)/',$row['note'],$matches);
		foreach ($matches[1] as $m) {
			$tags[] = $m;
		}
	}
	sort($tags);
	$tags = array_unique($tags);
	$links_html = "<nav class='navbar navbar-toggleable-md navbar-light bg-faded'>";
  	$links_html .= "<ul class='navbar-nav navbar-light' style='overflow:hidden;margin:0;padding:0'>";
	foreach ($tags as $t) {
		$links_html .= "<li class='nav-item' style='float:left;margin:0;padding:0'><a class='nav-link' style='display:block;margin:0;padding:0' href=''>$t</a></li>";
	}
	$links_html .= "</ul></nav>";
	return $links_html;
}
?>

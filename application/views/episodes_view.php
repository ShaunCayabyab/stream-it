<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?> - StreamTV</title>
	</head>
	<body>
		<h2>Episodes of <?php echo $title; ?>:</h2>
		<table class='table' border='1'>
			<tr>
				<th>SEASON</th>
				<th>TITLE</th>
				<th>AIR DATE</th>
			</tr>
			<?php foreach($episodes as $episode){ ?>
				<tr>
					<td>
						<?php echo $episode->season; ?>
					</td>
					<td>
						<a href="<?php echo base_url() . "shows/" . $showID . "/episodes/" . $episode->episodeID; ?>"><?php echo $episode->title; ?></a>
					</td>
					<td>
						<?php echo $episode->airdate; ?>
					</td>
				</tr>
			<?php } ?>
		</table>
	</body>
</html>
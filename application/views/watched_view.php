<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Watched - StreamTV</title>
	</head>
	<body>
	<h2>Episodes of <?php echo $title; ?> watched</h2>
	<table class='table' border='1'>
		<tr>
			<th>TITLE</th>
			<th>DATE WATCHED</th>
		</tr>
		<?php foreach($episodes as $episode){ ?>
			<tr>
				<td><a href="<?php echo base_url() . "shows/" . $show_id . "/episodes/" . $episode->episodeID; ?>"><?php echo $episode->title; ?></a></td>
				<td><?php echo $episode->datewatched; ?></td>
			</tr>
		<?php } ?>
	</table>
	</body>
</html>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Queue - StreamTV</title>
	</head>
	<body>
		<table class="table" border='1'>
		<h1>QUEUE LIST</h1>
			<tr>
				<th>TITLE</th>
				<th>DATE QUEUED</th>
				<th>LIST WATCHED EPISODES</th>
			</tr>
			<?php foreach($queue as $queue_item){ ?>
				<tr>
					<td><?php echo $queue_item->title; ?></td>
					<td><?php echo $queue_item->datequeued; ?></td>
					<td><a href="<?php echo base_url() . "queue/" . $queue_item->showID; ?>">X</a></td>
				</tr>
			<?php } ?>
		</table>
	</body>
</html>
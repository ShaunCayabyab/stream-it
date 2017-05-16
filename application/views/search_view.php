<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $search; ?> - StreamTV</title>
	</head>
	<body>
		<h1>Search results for "<?php echo $search; ?>":</h1>
		<h2>SHOWS</h2>
		<ul>
			<?php foreach($shows as $show){ ?>
				<li>
					<a href="<?php echo base_url(); ?>shows/<?php echo $show->showID; ?>">
						<?php echo $show->title ?>
					</a>
				</li>
			<?php } ?>
		</ul>
		<br><br>
		<h2>ACTORS</h2>
		<ul>
			<?php foreach($actors as $actor){ ?>
				<li>
					<?php echo $actor->fname . " " . $actor->lname; ?>
				</li>
			<?php } ?>
		</ul>
	</body>
</html>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $info->title; ?> - StreamTV</title>
	</head>
	<body>
		<h2><?php echo $info->title; ?></h2>
		<p>
			<b>Show: </b><?php echo $info->show; ?><br />
			<b>Original Air Date: </b><?php echo $info->airdate; ?>
		</p>
		<?php if($logged){ ?>
			<a href="<?php echo base_url() . "watch/" . $show_id . "/" . $episode_id; ?>">Watch This Episode</a>
		<?php } ?>
		<h3>Main Cast:</h3>
		<ul>
			<?php foreach($main_cast as $actor){ ?>
				<li>
					<a href="<?php echo base_url() . 'actor/' . $actor->actID; ?>"><?php echo $actor->fname . " " . $actor->lname ?></a> as <?php echo $actor->role; ?>
				</li>
			<?php } ?>
		</ul>
		<h3>Episode Cast:</h3>
		<ul>
			<?php foreach($recurring_cast as $actor){ ?>
				<li>
					<a href="<?php echo base_url() . 'actor/' . $actor->actID; ?>"><?php echo $actor->fname . " " . $actor->lname ?></a> as <?php echo $actor->role; ?>
				</li>
			<?php } ?>
		</ul>
	</body>
</html>
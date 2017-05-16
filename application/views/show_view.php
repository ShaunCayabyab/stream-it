<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $show_info->title; ?> - StreamTV</title>
	</head>
	<body>
		<h2><?php echo $show_info->title; ?></h2>
		<p><b>Premiere Year:</b> <?php echo $show_info->premiere_year; ?><br>
		   <b>Network:</b> <?php echo $show_info->network; ?><br>
		   <b>Creator:</b> <?php echo $show_info->creator; ?><br>
		   <b>Category:</b> <?php echo $show_info->category; ?>
		</p>
		<a href="<?php echo base_url() . 'shows/' . $show_id . '/episodes'; ?>">See All Episodes</a>
		<?php if($logged){ ?>
			<br><a href="">Add show to queue</a>
		<?php } ?>
		<h3>Main Cast</h3>
		<ul>
			<?php foreach($main_cast as $actor){ ?>
				<li>
					<a href="<?php echo base_url();?>actor/<?php echo $actor->actID; ?>">
						<?php echo $actor->fname . " " . $actor->lname; ?></a> as <?php echo $actor->role; ?>
				</li>
			<?php } ?>
		</ul>
		<h3>Recurring Cast</h3>
		<ul>
			<?php foreach($recurring_cast as $actor){ ?>
				<li>
					<a href="<?php echo base_url();?>actor/<?php echo $actor->actID; ?>">
						<?php echo $actor->fname . " " . $actor->lname; ?></a> appeared in 
						<?php if($actor->episodes > 1){ echo $actor->episodes . " episodes"; }else{ echo $actor->episodes . " episode"; } ?>
						as <?php echo $actor->role; ?>
				</li>
			<?php } ?>
		</ul>
	</body>
</html>
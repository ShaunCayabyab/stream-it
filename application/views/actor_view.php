<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $name; ?> - StreamTV</title>
	</head>
	<body>
		<h1><?php echo $name; ?></h1>
		<h2>Main Roles</h2>
		<ul>
			<?php foreach($main_roles as $role){ ?>
				<li>
					<a href="<?php echo base_url() . "shows/" . $role->showID;?>"><?php echo $role->title;?></a> as <?php echo $role->role; ?>
				</li>
			<?php } ?>
		</ul>
		<h2>Recurring Roles</h2>
		<ul>
			<?php foreach($recurring_roles as $role){ ?>
				<li>
					<a href="<?php echo base_url() . "shows/" . $role->showID;?>"><?php echo $role->title;?></a> as <?php echo $role->role; ?>
				</li>
			<?php } ?>
		</ul>
	</body>
</html>
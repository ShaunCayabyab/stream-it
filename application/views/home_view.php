<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>StreamTV</title>
	</head>
	<body>
		<h1>STREAM TV</h1>
		<?php if(isset($_SESSION['username'])) { ?>
		<h2><a href="home/logout/">LOGOUT</a></h2>
		<h2><a href="<?php echo base_url() . "queue"; ?>">QUEUE</a></h2>
		<?php }else{ ?>
			<h2><a href="login/">LOGIN</a></h2>
		<?php } ?>

		<form action="post_proxy" method="post" name="search">
			<input id="search_query" type='text' placeholder="Search show or actor" name='search_query'>
			<input type="Submit" value="Search">
		</form>
	</body>
</html>
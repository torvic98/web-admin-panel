<?php
	if (!file_exists("./config/config.php")){
		header("Location: ./install.php");
	}
	require_once("./config/config.php");
	require_once("sql.php");
	require_once("secure.php");
	echo("<!--- Header begin -->"); 
?>
<html>

<?php require_once("head.php"); ?>

<body>

	<div id="header"> 
		<div class="logo"><a href="#">xHome &#8250;<span> Admin Panel</span></a></div>
		<a class="mobile" href="#"><i class="material-icons">menu</i></a>
	</div>

	<div id="container">
		
		<?php require_once("sidebar.php"); ?>
		
		<div class="content">
<?php echo("<!--- Header end -->"); ?>
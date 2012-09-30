<?php session_start();

	if(!isset($_SESSION['logged_in'])) {
		$_SESSION['curr_page'] = $_SERVER['PHP_SELF'];
		header("Location: /Andy/login_manager.php");
	}
?>
<html>
	<head>
		<title>ModelofNothing</title>
		<link rel='stylesheet' type="text/css" media='all' href="/styles/global.css" />
	</head>
	<body>
	</body>
</html>

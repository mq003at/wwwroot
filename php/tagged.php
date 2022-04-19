<?php
	session_start();
	require_once('header_path.php');
	if(!isset($_SESSION['typed_pin']) || $_SESSION['typed_pin'] != $_SESSION['pin']) {
		header("Location: index.php");
	} else {
			$nav = "LEIMANNUT";
		
?>
<!doctype html>
<html>
	<head>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="<?php echo $css;?>">
		<link rel="stylesheet" href="<?php echo $button_css;?>">
		<style>
			table {
				border-collapse: collapse;
				width: 80%;
				color: #BD1D1D;
				border-radius: 4px;
				margin-top: -19px;
				margin-left: 30px;
			}

			th,td{
				padding: 8px;
				text-align: left;
				cursor: pointer;
				transition: All 0.4s ease;
			}
			
			th{
				border-bottom: 1px solid #ddd;
				font-size: 20px;
				padding: 10px;
			}
			
			<!--tr:hover {background-color: #f5f5f5;}-->
			
			.lb {
				width: 63px;
				height: 35px;
				text-transform: uppercase;
				letter-spacing: 2.5px;
				font-weight: 500;
				background-color: red;
				border: none;
				border-radius: 45px;
				box-shadow: 4px 8px 0px rgba(0, 0, 0, 0.1);
				transition: all 0.2s ease 0s;
				cursor: pointer;
				outline: none;
			}
			 
			 .shadow { 
				color: white;
				font-size: 20px;
				position: absolute;
				margin-left: 237px;
				margin-top: 28px;
			 }
			 .shadow2 { 
				color: white;
				font-size: 20px;
			 }
			 
			 .lb:active {
				background-color: #FF7070;
				box-shadow: 0 5px #DFDBDB;
				transform: translateY(4px);
			 }
			 
			 .log_out {
				 width: 45px;
				 height: 31px;
				 background-color: red;
				 outline: none;
				 color: white;
				 font-size: 18px;
				 border-radius: 10px;
				 padding: 4px;
			 }
		</style>
	</head>
	<body>
		<br>
		
		<table align='left'>
			<tr>
				<th colspan='2'><label><?php echo $_SESSION['shop_name'];?></label></th>
			<tr>
			<tr>
				<th style='font-size: 18px; font-weight:bold;' colspan='2'>Kirjautunut sisään</th>
				<th><button onclick="parent.get_login();" class='lb shadow2'><i class="fas fa-sync"></i></button></th>
			</tr>
			<tbody id='login_user'>
			
			</tbody>
		</table>
		
		<script> 
			var shop_id = '<?php echo $_SESSION['shop_id'];?>'; 
		</script>
		<?php require_once('jsPack.php');?>
		<script src="../js/dateStamp.js"></script>
		<script>
			function out(key) {
				getDateStamp();
				getTimeStamp();
				getSecond();
				logOutEmployee(key);
			}
		</script>
	</body>
</html>
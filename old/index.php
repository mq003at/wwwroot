<!doctype>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<?php
	session_start();

	$logo_img = 'logo_1.png';
	require_once("php/logo.php");

	if(isset($_SESSION['typed_pin']) && $_SESSION['typed_pin'] == $_SESSION['pin']) {
		$pinAreaDisplay = "none"; 
		$optionAreaDisplay = "inline-block";
		?><script>window.open("php/management.php", "_top");</script><?php
	} else {
		?><script>$(window.parent.document).find("#logout_la").html("");</script><?php
	}
	
?>
<html>
	<head>
		<title>SPR Management Application</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="<?php echo $button_css;?>">
		<style>
			.button {
				background-color: #4CAF50; /* Green */
				border: none;
				color: white;
				padding: 5px 20px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				-webkit-transition-duration: 0.4s; /* Safari */
				transition-duration: 0.4s;
				cursor: pointer;
				border-radius: 4px;
			}
			
			.button {
				background-color: white; 
				color: black; 
				border: 2px solid #f44336;
			}

			.button:hover {
				background-color: #f44336;
				color: white;
			}

		</style>
	</head>	
	<body>
		<h2>Myymälä</h2>
		<div>
			<table id="place_option" align="center" style="table-layout: fixed" class="radioButtons collapseBorder">
				
			</table>
			<button type="button" class="button" id="place_confirm">Go</button>
		</div>
		
		
		<script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
		<script src="js/firebase_init.js"></script>
		<script>
			$(window.parent.document).find("#left_header").html("");
			$(document).ready(function() {
				$('#place_confirm').click(function() {
					var shop_data = $("input[type=radio][name=place]:checked").val();			
					var arr = shop_data.split("/");
					var shop_name = $('#' + arr[0]).text();
					$.post("php/setShopId.php", {"shop_id": arr[0], "pin": arr[1], 'shop_name': shop_name}, function(data) {
						window.open("php/management.php", "_top");
						parent.window.$('#right_div').find('#shop_name').html(shop_name);
					});
				});
			});
		
			window.onload = init;
			function init() {
				var ref = firebase.database().ref();
				var shop_data_ref = ref.child("shop_data");
				shop_data_ref.once("value", function(snap) {
					var val = snap.val();
					if(val != null) {
						Object.keys(val).forEach(function(key) {
							setRadioButton(val[key].name, key, val[key].pin);
						});
					}
				});
			}
			function setRadioButton(val, key, pin) {
				$("#place_option").append("<tr><td><label id='" + key + "'>" + val + "</label></td><td><input type='radio' name='place' value='" + key + "/" + pin + "'></td></tr>");
			}
		</script>
	</body>
</html>
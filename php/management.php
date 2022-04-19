<?php session_start();?>
<script> var shop_id = '<?php echo $_SESSION['shop_id'];?>'; </script>
<?php require_once('jsPack.php');?>
<script>
	function get_user() {
		$("#right_div").contents().find("#log_user").html('');
		authorised_id_ref.off();
		authorised_id_ref.orderByChild("actual_state").equalTo("in").on("child_added", function(snap) {
			var id = snap.key;
			appendName(id);
		});
		
		authorised_id_ref.on("child_changed", function(snap) {
			var id = snap.key;
			if(snap.val().actual_state == 'out') {
				$("#right_div").contents().find('#'+id).remove();
				$("#right_div").contents().find('#'+id).html();
			}
		});
		authorised_id_ref.on("child_removed", function(snap) {
			$("#right_div").contents().find('#'+snap.key).remove();
		});
	}
	
	function appendName(id) {
		employee_data_ref.on("child_added", function(snap_1) {
			ref.child(employee_data_path + snap_1.key + '/employees/').orderByChild("tag_id").equalTo(id).once('value', snap_2 => {
				var val = snap_2.val();
				
				if(val != null) {
					Object.keys(val).forEach(function(key) {
						var name = val[key].name;
						if(!$("#right_div").contents().find('#'+id).length)
							$("#right_div").contents().find("#log_user").append('<tr id="'+id+'"><td width="35%">' + name + '</td>' +
									'<td><button onclick="out(\'' + id + '\')" class="sun"><i class="fas fa-sign-out-alt employee"></i></button></td></tr>');
					});
					employee_data_ref.off("child_added");
				}
			});
		});
	}
	
		
</script>
<script>
	function get_login() {
		$("#left_div").contents().find("#login_user").html('');
		authorised_id_ref.off();
		authorised_id_ref.orderByChild("actual_state").equalTo("in").on("child_added", function(snap) {
			var id = snap.key;
			appendName(id);
		});
		
		authorised_id_ref.on("child_changed", function(snap) {
			var id = snap.key;
			if(snap.val().actual_state == 'out') {
				$("#left_div").contents().find('#'+id).remove();
				$("#left_div").contents().find('#'+id).html();
			}
		});
		authorised_id_ref.on("child_removed", function(snap) {
			$("#left_div").contents().find('#'+snap.key).remove();
		});
	}
	
	function appendName(id) {
		employee_data_ref.on("child_added", function(snap_1) {
			ref.child(employee_data_path + snap_1.key + '/employees/').orderByChild("tag_id").equalTo(id).once('value', snap_2 => {
				var val = snap_2.val();
				
				if(val != null) {
					Object.keys(val).forEach(function(key) {
						var name = val[key].name;
						if(!$("#left_div").contents().find('#'+id).length)
							$("#left_div").contents().find("#log_user").append('<tr id="'+id+'"><td width="35%">' + name + '</td>' +
									'<td><button onclick="out(\'' + id + '\')" class="sun"><i class="fas fa-sign-out-alt employee"></i></button></td></tr>');
					});
					employee_data_ref.off("child_added");
				}
			});
		});
	}
	
		
</script>
<?php
	if(!isset($_SESSION['shop_id'])) {
		header("Location: index.php"); 
	}
?><script></script><?php
	if(isset($_SESSION['typed_pin']) && $_SESSION['typed_pin'] == $_SESSION['pin']) {
		?><script>get_user();$('#shrink').click();</script><?php
	} 
	
?>
<html>
	<head>
		<title>Management Page</title>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			iframe {
				border: 0;
			}
			iframe#right_div {		
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(249, 36, 36, 0.8);
				text-align: center;		
			}


			body::-webkit-scrollbar {
				display: none;
			}
			
			body {
				overflow: hidden;
			}

			iframe {
				-webkit-transition: All 0.3s ease;
				-moz-transition: All 0.3s ease;
				-o-transition: All 0.3s ease;
			}	
	</style>
	</head>
	<body scrolling='no'>
	<?php 
			
			$nav = "TYÖNTEKIJÄT";
			require_once("header.php");
			//$logo_img = 'logo_2.png';
			//require_once("php/logo.php");
		?>

		<iframe id='left_div' frameborder="0" style="position:absolute;top:51px;left:0;width:75%;height:93%;" src='pinPage.php'></iframe>
		
		<iframe id='right_div' style="position:absolute;top:51px;left:70%;width:30%;height:100%;" src='right_frame.php' scrolling='yes' src='test1.php'>
		</iframe>
		
	
		
	<script>
		$('#shrink').click(function() {
			if($('#right_div').is(':visible')) {
				rightIframe_hide();
			} else {
				$('#left_div').css('width', '75%');
				$('#right_div').show();
			}
		});			
		
		function rightIframe_hide() {
			window.parent.$('#left_div').css('width', '100%');
			window.parent.$('#right_div').hide();
		}
	</script>
	</body>
</html>
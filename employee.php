<?php
	session_start();
	require_once('header_path.php');
	if(!isset($_SESSION['typed_pin']) || $_SESSION['typed_pin'] != $_SESSION['pin']) {
		header("Location: index.php");
	} else {
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $font;?>">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $css;?>">
		<link rel="stylesheet" href="<?php echo $button_css;?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			body::-webkit-scrollbar
			{
				display: none;
			}

			
			div#grp_btns {
				-webkit-transition: All 0.5s ease;
				-moz-transition: All 0.5s ease;
				-o-transition: All 0.5s ease;
			}
			
			#group_div {
				transition: all 0.2s ease 0s;
			}
		</style>
		
	</head>
	<body>
		<?php 
			$nav = "TYÖNTEKIJÄT";
			//require_once("header.php");
			//$logo_img = 'logo_2.png';
			//require_once("logo.php");
		?>
		<script> 
			$(window.parent.document).find("#left_header").append(" >> TYÖNTEKIJÄT");
		</script>
		<h2 style='margin-top: 51px;'>TYÖNTEKIJÄT</h2>
		<div class="container">

		  <!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-sm">

			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Vaihda Tagi</h4>
				</div>
				<div class="modal-body">
					<p id='newId_ntf' class='err_text'></p>
					<label>Uuden tagin ID</label>
					<input type="text" id="tag_id" size="30" autofocus class="centerText inputLine" placeholder="Tag Id">
				</div>
				<div class="modal-footer">
					<button type="button" id="cancelId" class="btn btn-danger btn-default pull-left"  style="background-color: #FC4848" data-dismiss="modal">
							Peruuta
					</button>
					<button type="button" id="change_id_confirm" class="btn btn-default">OK</button>
					<button type="button" id="change_id_confirm2" class="btn btn-default" data-dismiss="modal" style="display:none;"></button>				
				</div>
			  </div>
			</div>
		  </div>
		  
		  <!-- Modal -->
		  
		  <div class="modal fade" id="confirmModal" role="dialog">
			<div class="modal-dialog modal-sm">

			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
				  <p id="confirm_body" align="center" style="font-size: 16px"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-default pull-left"  style="background-color: #FC4848"data-dismiss="modal">Peruuta</button>
				  <button type="button" id="delete_button" class="btn btn-default" data-dismiss="modal" >OK</button>
				</div>
			  </div>
			</div>
		  </div>
		  
		  <div class="modal fade" id="addPerson" role="dialog">
			<div class="modal-dialog modal-sm">

			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Lisää henkilö</h4>
				</div>
				<div class="modal-body">
					<p id='err_ntf' class='err_text'></p>
					<table id="addPersonTable" class="center noBorder">
						<tr>
							<td class="smallTd">Nimi *</td>
							<td><input type="text" id="newPersonName" size="30" autofocus class="inputLine"></td>
						</tr>
						<tr>
							<td class="smallTd">Hetu</td>
							<td><input type="text" id="newPersonSSN" size="30" autofocus class="inputLine"></td>
						</tr>
						<tr>
							<td class="smallTd">Tagin ID *</td>
							<td><input type="text" id="newPersonId" size="30" autofocus class="inputLine"></td>
						</tr>
						<tr>
							<td class="smallTd">Ryhmä *</td>
							<td><select class='group_list' id='group_select'></select></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" id="addPersonClick" class="btn btn-default" onclick="addPerson();">OK</button>
					<button type="button" id="addPersonClick2" class="btn btn-default" data-dismiss="modal" style="display:none;"></button>
				</div>
			  </div>
			</div>
		  </div>
		  
		  <div class="modal fade" id="gn_edit" role="dialog">
			<div class="modal-dialog modal-sm">

			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Vaihda ryhmä</h4>
				</div>
				<div class="modal-body">
					<p id='gn_err' class='err_text'></p>
					<label>Uuden ryhmän nimi</label>
					<input type="text" id="group_name" size="30" autofocus class="centerText inputLine" placeholder="ryhmän nimi">
				</div>
				<div class="modal-footer">
					<button type="button" id="cancelId" class="btn btn-danger btn-default pull-left"  style="background-color: #FC4848" data-dismiss="modal">
							Peruuta
					</button>
					<button type="button" id="gn_edit_confirm" class="btn btn-default">OK</button>
					<button type="button" id="gn_edit_confirm2" class="btn btn-default" data-dismiss="modal" style="display:none;"></button>
				</div>
			  </div>
			</div>
		  </div>
		  
		  <div class="modal fade" id="addGroup" role="dialog">
			<div class="modal-dialog modal-sm">

			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Lisää ryhmä</h4>
				</div>
				<div class="modal-body">
					<p id='addGroup_err' class='err_text'></p>
					<table id="addGroupTable" class="center noBorder">
						<tr>
							<td class="smallTd">Nimi</td>
							<td><input type="text" id="new_group" size="30" autofocus class="inputLine"></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" id="addGroupClick" class="btn btn-default" onclick="addGroup();">OK</button>
					<button type="button" id="addGroupClick2" class="btn btn-default" data-dismiss="modal" style="display:none;"></button>
				</div>
			  </div>
			</div>
		  </div>
		  
		  <div class="modal fade" id="changeGroup" role="dialog">
			<div class="modal-dialog modal-sm">

			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Vaihda ryhmä</h4>
				</div>
				<div class="modal-body">
					<table id="addGroupTable" class="center noBorder">
						<tr>
							<td class="">Uusi ryhmä</td>
							<td><select class='group_list' id='change_group'></select></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" id="changeGroupClick" class="btn btn-default">OK</button>
					<button type="button" id="changeGroupClick2" class="btn btn-default" data-dismiss="modal" style="display:none;"></button>
				</div>
			  </div>
			</div>
		  </div>
		  
		</div>

		<div align='center' style='margin-top: 30px;' id='grp_btns'>
			<button id="addPersonBtt" type="button" class="dropbtn" data-toggle='modal' data-target='#addPerson' onclick="javascript:$('#err_ntf').html('');">Lisää henkilö</button>&emsp;&emsp;
			<button id="addGroupBtt" type="button" class="dropbtn" data-toggle='modal' data-target='#addGroup' 
					onclick="javascript:$('#addGroup_err').html('');">Lisää ryhmä</button>&emsp;&emsp;
			</div>
			<hr>
		<div id='group_div' align='center'></div>
					<div id='emp_data' style='margin-top: 35px;'></div>
					
		
		<table id="employee_table" class="center marginTopEmployee">
			<thead style='border-bottom: 1px solid #ddd;'>
				<!--<tr>
					<th colspan="4" class="noBorder">
					</th>
				</tr>-->
				
				<tr>
					<th>NIMI</th>
					<th>TAG-ID</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			
			<tbody id="table_body" class="table_body">
				
			</tbody>
		</table>
		
		
		
		
		
		<!--Virtual button-->
		<button type="button" id="confirmModalBut" data-toggle='modal' data-target='#confirmModal' style="display:none;"></button>
		<button type="button" id="gnModalClick" data-toggle='modal' data-target='#gn_edit' style="display:none;"></button>
		
		<!--script-->
		<script> 
			var shop_id = '<?php echo $_SESSION['shop_id'];?>'; 
			var m_group_id = ''; 
		</script>
		<?php require_once('jsPack.php');?>
		<script src="dateStamp.js"></script>
		<script src="active_script_1.js"></script>
		<script src="script_1.js"></script>
		<script>			
			$("#cancelId").click(function() {
				$("#tag_id").val("");
			});
			
			$("#addPersonBtt").click(function() {
				$("#addPersonTable").find("input")
					.each(function() {
						$(this).val("");
						$(this).css("border", "none");
						$(this).keypress(function(event) {
							
							if(event.which != 13)
								$(this).css("border", "none");
							
						});
					});
			});
			
			$("#addGroupBtt").click(function() {
				$("#new_group").val("");
				$("#new_group").css("border", "none");
				$("#new_group").keypress(function(event) {		
					if(event.which != 13)
						$(this).css("border", "none");
					
				});
			});
			
			$("#addPersonTable input").keypress(function(e) {
				if(e.keyCode == 13) {
					//addPerson();
					$("#addPersonClick").click();
				}
			});
			
			$("#tag_id").keypress(function(event) {
				$(this).css("border", "none");
				if(event.which == 13)
					$("#change_id_confirm").click();
			});
		</script>
		
	</body>
</html>
	<?php } ?>
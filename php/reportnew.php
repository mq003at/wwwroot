<?php
	session_start();
	require_once('header_path.php');
	if(!isset($_SESSION['typed_pin']) || $_SESSION['typed_pin'] != $_SESSION['pin']) {
		header("Location: ../index.php");
	} else {
			$nav = "RAPORTIT";
			//require_once("header.php");
			//require_once("logo.php");
		
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Report Management</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="<?php echo $css;?>">
		<link rel="stylesheet" href="<?php echo $button_css;?>">
		<xml>
			<x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>
			   <x:WorksheetOptions>
				  <x:Panes></x:Panes></x:WorksheetOptions>
			</x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook>
		</xml>
		
		
		<style>
			.buttona {
				background-color: #f44336; /* Green */
				border: 2px solid #f44336;
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

			.buttona:hover {
				background-color: #f44336;
				color: white;
			}
		</style>
	</head>
	<body>
		
		<h2 style="font-weight: bold; margin-top: 51px;">RAPORTIT</h2>
		<br>
		
		<div id="date_choosing" align="center">
			<table id="datepicker" style="background-color:#FFFFFF" border="0">
				<tr class="noBorder">
					<th>Aloitus pvm</th>
					
					<th>Päättymis pvm</th>
				</tr>
				<tr class="noBorder">
					<td><input type="text" id="datepicker_start"></td>
					
					<td><input type="text" id="datepicker_end"></td>
				</tr>
			</table>
		</div>
		
		<div id="person_choosing" style="display:none" align="center">
			<table id="person_list">
				
				<tbody id="personTableBody">
				
				</tbody>
			</table>
		</div>
		<br><button type="button" id="printabc" onclick="test2.html#raportit" style="display:none;">Create report</button>
		<hr>
		
		<div id="raportit" align="center">
			<h3>RAPORTIT</h3>
			<div id="printButton" style="display:none;">
				<a id='print_btn' type="button" onclick="download_csv();" class="buttona" value="Print PDF">Lataa</a>
			</div>
			
			<div id="byDate" align="center" >
			
			<table id="hour_date" style="display:none" class="marginTop width80">
				<thead>
					<tr>
						<!--<th style="width: 30%"></th>-->
						<th id="dateDuration" colspan="4"></th>
					</tr>
				<tr id='group_btn_tr'>
					<!--<th style="width: 30%"></th>-->
					<th id="group_btn" colspan="4"></th>
				</tr>
				<tr>
					<!--<th style="width: 30%"></th>-->
					<th id="group" colspan="4"></th>
				</tr>

				</thead>
				<tbody id="dateTableBody" class="marginTop width80">
				
				</tbody>
					
			</table>
		</div>
			
		</div>
		<a id="hiddenLink" href="#raportit"></a>
		<script> var shop_id = '<?php echo $_SESSION['shop_id'];?>' </script>
		<?php require_once('jsPack.php');?>
		<script src="../js/dateStamp.js"></script>
		<script src="../js/byDate_1.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
			$(window.parent.document).find("#left_header").append(" >> RAPORTIT");
			function printDiv(id) {
			   fnExcelReport();
			 }
		
			$(document).ready(function() {
				$( "#datepicker_start" ).datepicker();
				$( "#datepicker_end" ).datepicker();
				
				$("#datepicker_start").on("change", function(){
					$("#datepicker_end").val('');
				});
				
				$("#datepicker_end").on("change", function(){
					set_up_dates();
					if(start_date <= end_date)
						document.getElementById("dateDuration").innerHTML = start_day + "." + start_month + "." + start_year + " - " + end_day + "." + end_month + "." + end_year;
						$('#group').html('');
						getGroups();
				});
			} );
			
			
			function dateChanged() {
				var printButton = document.getElementById("printButton");
				printButton.style = "display: none";
				var hour_date = document.getElementById("hour_date");
				hour_date.style.display = "none";
			}
			
			$(document).ready(function() {
				var date_choosing = document.getElementById("date_choosing");
					var table = document.getElementById("data_display");
					var printButton = document.getElementById("printButton");
					var hour_date = document.getElementById("hour_date");
			});
		</script>
	</body>
</html>
	<?php } ?>
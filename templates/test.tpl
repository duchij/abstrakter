<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" type="text/css" href="css/layout.css" >

<!-- <link rel="stylesheet" type="text/css" href="js/src/fancyfields.css" > -->

<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>	
<script src="js/abstracter.js"></script>

<!-- <script src="js/jquery.js"></script>
<script src="js/src/fancyfields-1.2.min.js"></script> -->

</head>
<body>
<div id="wrapper">
		<div id="header">
			{include file="header.tpl"}
		
		</div>

<div id="content">
		<div id="content-left">
			{include file="main_menu.tpl"}
		</div>
	<div id="content-main" style="width:750px;">
			
			
			<div id="formular">
			<form name="form1" method='post' action="app.php">
			
				
				<div id="block" style="border:none;padding:0px;margin:0px">
				
				</table>
				
				
			</div>
			
			
		</form>
		</div>
	
	</div>
	<!-- <div id="content-right">
			 {include file="regbyuser.tpl"}<hr/>
 			{include file="avabkongres.tpl"}
		
		</div> -->
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
	
</div>


</body>

</html>
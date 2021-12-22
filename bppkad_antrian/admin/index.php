<?php 
	session_start();
	if (!isset($_SESSION["loket_client"])) {
		$_SESSION["loket_client"] = NULL;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<!-- <meta http-equiv="refresh" content="30"> -->
	    <title>Admin </title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
	    <link href="/situbondo/bppkad_antrian/dashboard.css" rel="stylesheet">
	    <link href="/situbondo/bppkad_antrian/css/bootstrap.min.css" rel="stylesheet">
	    <link href="assert/css/jumbotron-narrow.css" rel="stylesheet">
	    	    <link rel="stylesheet" href="/situbondo/bppkad_antrian/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
  	<body>
  		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
      	<a class="navbar-brand" href="/situbondo/bppkad_antrian/view/landingpage.php">Sistem Antrian BPPKAD Situbondo</a>
    </nav>
	<div class="card text-center">
  		<div class="card-header">	ADMIN CONTROL </div>
  			<div class="card-body">
    		<h4 class="card-title">Control Antrian yang Sedang berlangsung</h4>	
    			<div class="container">
				<button class="btn btn-small btn-danger try_queue" type="button" style="float:right;padding:20px;">Ulangi Panggilan &nbsp;<span class="glyphicon glyphicon-volume-up"></span>    
        		</button>
    	<form>
    		<div class="jumbotron">
	        <h1 class="next">
	        	<span class="glyphicon glyphicon-book"></span>
	        </h1>

        	<button type="button" class="btn btn-primary next_getway" >Next <span class="fa fa-chevron-circle-right"></span></button>
	      	</div>
    	</form>
    	<br/>
      	<footer class="footer">
        <p>&copy; Sistem Informasi Situbondo <?php echo date("Y");?></p>
      	</footer>
    </div>
  	</body>
  	<script type="text/javascript">
	$("document").ready(function()
	{

		// GET LAST COUNTER
	    $.post( "/situbondo/bppkad_antrian/apps/admin_getway.php", function( data ) {
			$(".next").html(data['next']);
		},"json");
		
	
	    // RESET 
		$(".next_getway").click(function(){
			var next_current = $(".next").text();
			$.post( "/situbondo/bppkad_antrian/apps/admin_getway.php", {"next_current": next_current}, function( data ) {
				$(".next").html(data['next']);
			},"json");
		});

		// GET NEXT COUNTER
		$(".next_queue").click(function()
		{
			var loket = $(".loket").val();
			if (loket==0) {
				$(".peringatan").show();
			}else{
				var data = {"loket" : loket};
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "/situbondo/bppkad_antrian/apps/antrian.php",//request
					data: data,
					success: function(data) {
						$(".jumbotron h1").html(data["next"]);
						if (data["idle"]=="TRUE") {
							$(".next_queue").hide();
							clearInterval(timerId_adik);
							adik_adudu(loket, data["next"]);
						}
					}
				});
				return false;
			}
			
		});

		var timerId=0;
		// ADUDU
		function adudu(loket, counter){
			timerId = setInterval(function() {
				 $.post("/situbondo/bppkad_antrian/apps/antrian_try_cek.php", { loket : loket, counter : counter }, function(msg){
					if(msg.huft == 2){
						$(".try_queue").show();
					}
				},'JSON');
			}, 1000);
		 }
		
		var timerId_adik=0;
		// ADIK_ADUDU
		function adik_adudu(loket, counter){
			timerId_adik = setInterval(function() {
				 $.post("/situbondo/bppkad_antrian/apps/antrian_cek.php", { loket : loket, counter : counter }, function(msg){
					if(msg.huft == 2){
						$(".next_queue").show();
					}
				},'JSON');
			}, 1000);
		}

		// TRY CALL
		$(".try_queue").click(function(){
			var loket = $(".loket").val();
			if (loket==0) {
	    		$(".peringatan").show();
			}else{
				var counter = $(".counter").text();
				$.post("/situbondo/bppkad_antrian/apps/antrian_try.php", { loket : loket, counter : counter }, function(msg){
					if(msg.huft == 0){
						$(".try_queue").hide();
						clearInterval(timerId);
						adudu(loket, counter);
					}
				},'JSON'); //request
				return false;
			}
		});	
	});
	</script>
</html>


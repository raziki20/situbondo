<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<!-- <meta http-equiv="refresh" content="10"> -->
	    <title>Admin </title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
	    <link href="/situbondo/bppkad_antrian/dashboard.css" rel="stylesheet">
	    <link href="/situbondo/bppkad_antrian/css/bootstrap.min.css" rel="stylesheet">
	    <link href="/assert/css/jumbotron-narrow.css" rel="stylesheet">
	    <link rel="stylesheet" href="/situbondo/bppkad_antrian/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
  	<body>
  		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
      	<a class="navbar-brand" href="/situbondo/bppkad_antrian/view/landingpage.php">Sistem Antrian BPPKAD Situbondo</a>
    	</nav>
	    <div class="card text-center">
  			<div class="card-header"> ADMIN SETTING </div>
  				<div class="card-body">
    			<h4 class="card-title">Tambah Loket</h4>	
    			<div class="container">
    	<form>
    		<div class="jumbotron">
	        <h1 class="counter">
	        	<span class="fa fa-university"></span>
	        </h1>
	      	</div>
        	<label for="exampleInputEmail1">Jumlah Loket</label>
    		<div class="alert alert-info alert-dismissible peringatan" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Info !</strong> Jumlah loket berhasil disave
			</div>
        	<input type="text" class="form-control loket" placeholder="Jumlah Loket">
        	<br/>
        	<label for="exampleInputEmail1">Reset Database</label>
        	<div class="reset_status">
			</div> 
        	<button type="button" class="btn btn-primary reset">Reset</button>
			<br/>
    	</form>
    	<br/>
      	<footer class="footer">
        <p>&copy; Sistem Informasi BPPKAD Situbondo <?php echo date("Y");?></p>
      	</footer>
    </div>
  	</body>

  	<script type="text/javascript">
	$("document").ready(function()
	{
		$('.peringatan').hide();

		// GET JUMLAH LOKET
	    $.post( "/situbondo/bppkad_antrian/apps/admin_server.php", function( data ) {
			$(".loket").val(data['jumlah_loket']);
		},"json");
		
		// NUMBER LOKET
	    $('form input').data('val',  $('form input').val() );
	    $('form input').change(function() {
	    	//set seassion or save
	    	var data = {"jmlloket": $(".loket").val()};
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "/situbondo/bppkad_antrian/apps/admin_server.php",//request
				data: data,
				success: function(data) {
					if (data["status"])
					{
						$('.peringatan').show();
					}
				}
			});
	    });
	    $('form input').keyup(function() {
	        if( $('form input').val() != $('form input').data('val') ){
	            $('form input').data('val',  $('form input').val() );
	            $(this).change();
	        }
	    });

	    // RESET 
		$(".reset").click(function(){
			$.post( "/situbondo/bppkad_antrian/apps/admin_reset.php", function( data ) {
			var alert = '<div class="alert alert-info alert-dismissible reset_status" role="alert">'+data['status']+'</div>';
			$(".reset_status").html(alert);
			},"json");
		});

	});
	</script>
</html>


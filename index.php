<?php include 'controller.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	<!-- DataTables CSS -->
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <title>Memcached CPanel</title>
  </head>
  <body>
    <div class="container">
      <div class="row">                
        <div class="col-sm-12">
		<a href="index.php"><h1 align="center">Memcached Cpanel</h1></a>
		  <?php
			if (isset($result) && !empty($result)) {
				echo $result;
			}
		  ?>
          <h4>Keys</h4>                    
          <hr>                                
			<table class="table" id="mainTable">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">Key</th>
				  <th scope="col">Actions</th>				  
				</tr>
			  </thead>
			  <tbody>
				<?php
				  if (isset($keys) && !empty($keys)) {
					foreach ($keys as $k => $v) {
				?>
						<tr>
						  <th scope="row"><?php echo $v; ?></th>						  
						  <td><a href="index.php?info=<?php echo $v; ?>"><button type="button" class="btn btn-primary">Get</button></a> <button type="button" class="btn btn-danger" onclick="borrar('<?php echo $v; ?>')">Delete</button></td>				  
						</tr>				
				<?php
					}
				  }
				?>
			  </tbody>
			</table>	
		  <br>
		  <h4>Key</h4>                    
		  <hr>		  			  
			<form class="form-inline" id="main-form">									
				<div class="form-group mb-2">
					<label for="key-form" class="sr-only">Key</label>
					<input type="text" class="form-control" id="key-form" value="" placeholder="Key">
				</div>
				&nbsp;				
				<button type="button" class="btn btn-primary" onclick="get_form()">Get</button>
				&nbsp;
				<button type="button" class="btn btn-danger" onclick="borrar_form()">Delete</button>					
			</form>		  
		  </div>
      </div>      
    </div>  
<?php if (isset($host) && isset($port)) {
	echo '<p align="right">'.$host.':'.$port.'</p>';
} ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/fontawesome.all.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>    
	<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#mainTable').DataTable();
		} );
		$( "#main-form" ).submit(function( event ) {
			get_form();
			event.preventDefault();
		});
		function borrar_form() {
			var r = confirm("Are you sure that you want to delete the key '"+$('#key-form').val()+"'?");
			if (r == true) {
				window.location.href = 'index.php?del='+$('#key-form').val();
			}
		}
		function get_form() {
			window.location.href = 'index.php?info='+$('#key-form').val();
		}
		function borrar(key) {						
			var r = confirm("Are you sure that you want to delete the key '"+key+"'?");
			if (r == true) {
				window.location.href = 'index.php?del='+key;
			}
		}
	</script>
  </body>
</html>
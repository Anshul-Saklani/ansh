<!DOCTYPE html>
<html>
<head>
<title>Title of main branch</title>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<body>
<script>
      $(document).ready(function(){
  
  
  function load_table(){
	  
	   $.ajax({
          url: "ajax.php",
          type : "POST",
          data : {table: "loaddata"},
          success: function(data) {
			  $("#table_data").html(data);
       //console.log(data);
		  
            
          }
		});
	  
  }
  
  load_table();
	  });

</script>
<form method = "post" id="add_form">
Name : <input type = "text" name = "name" id = "name" /><br><br>
Email : <input type = "text" name = "email" id = "email" /><br><br>
Phone : <input type = "text" name = "phone" id = "phone" /><br><br>
Gender : <input type = "text" name = "gender" id = "gender" /><br><br>
<input type = "submit" name = "add_user" id = "add_user" value = "Add User"/>
 

</form>

<div id="table_data"></div>

</body>
</html>

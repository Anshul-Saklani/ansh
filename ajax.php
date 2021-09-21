<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
      $(document).ready(function(){
  	  $(".edit").on("click",function(){                                                                                                                                                                                                                       

        var id = $(this).attr('rel');
		  //alert(id);
        $.ajax({
          url: "ajax.php",
          type : "POST",
          data : {id: id,edit: "edit"},
          success: function(data) {
      			  $("#add_form").html(data);

		  
            
          }
		});
  });
  });

</script>
<?php if(isset($_POST["table"])){ ?>
<table border="1">
<tr>
<td>Name</td>
<td> Email</td>
<td>Phone Number</td>
<td>gender</td>
<td>Edit</td>
<td>delete</td>
</tr>

<?php 
$conn = db_connection();
$sql = "Select * from user";
//$result->$conn->query($sql);
$result = mysqli_query($conn,$sql);

// Numeric array
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
   <tr>
   <td><?php echo $row ["name"]; ?></td>
   <td><?php echo $row ["email"]; ?></td>
   <td><?php echo $row ["phone"]; ?></td>
   <td><?php echo $row ["gender"]; ?></td>
   <td><a class = "edit" rel="<?php echo $row['id']; ?>" href="#">Edit</a></td>
   <td><a href="/test/assignment1.php?id=<?php echo $row["id"]; ?>&delete">delete</a></td>
   </tr>
<?php
}
?>
</table>
<?php
// Associative array
$conn->close();
} else {

if(isset($_POST["edit"])){
	$id = $_POST["id"];
		$conn = db_connection();
	$sql = "select * from user where id = '$id'";

	 $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$name = $row["name"];
	$email = $row["email"];
    $phone = $row["phone"];
    $gender = $row["gender"];
	$buttonText = "Update User";

?>
	


 
Name : <input type = "text" value = "<?php echo $name; ?>" name = "name" id = "name"/><br/><br/>
Email: <input type = "text" value = "<?php echo $email; ?>" name = "email" id = "email"/><br/><br/>
Phone: <input type = "text" value = "<?php echo $phone; ?>" name = "phone" id = "phone"/><br/><br/>
Gender: <input type = "radio" name = "gender" <?php if($gender == "Male"){ ?> checked <?php } ?> id = "gender" value="Male" />Male<input type = "radio" name = "gender" <?php if($gender == "Female"){ ?> checked <?php } ?> id = "gender" value = "Female" />Female<br/><br/> 
<input type = "submit" name = "add_user" id = "add_user" value="<?php echo $buttonText; ?>"/>
<input type="hidden" name="user_id" value="<?php echo $id; ?>" />

<?php
}
if(isset($_POST["add_user"])){
	$conn = db_connection();
	$name = $_POST["name"];
    $email = $_POST["email"];
	$phone = $_POST["phone"];
	$gender = $_POST["gender"]; 
	if($_POST["add_user"] == "Add User"){
	$sql = "Insert into user (name, email, phone, gender)
	values('$name', '$email', '$phone', '$gender')";
	
	if ($conn->query($sql) === TRUE){
	  echo "New record created successfully";
	}  else {
	   echo "Error: " . $sql . "<br>" . $conn->error;
	} 
	}  else if($_POST["add_user"] == "Update User"){
       $id = $_POST["user_id"];
        $sql = "update user set name = '$name', email = '$email', phone = '$phone', gender = '$gender' where id='$id'";
       mysqli_query($conn,$sql);

}
$conn->close();
	
}

if (isset($_GET["delete"])){
	$conn = db_connection();
	$id = $_GET["id"];
	$sql = "delete from user where id = '$id'";
	mysqli_query($conn,$sql);
}
}
function db_connection(){
$servername = "localhost";
  $username = "anshul";
  $password = "Admin@1234";
  $dbname = "Anshul";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  return $conn;
}
?> 
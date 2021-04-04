<!DOCTYPE>  
<html>  
<body> 
<?php
     $name = $_POST['name'];
     $email = $_POST['email'];

     $username = 'root';
     $hostname = 'localhost:3309';
     $password = 'peet2001@';
     $dbname = 'book';

     $conn = new mysqli($hostname,$username,$password,$dbname);

     if(mysqli_connect_error()){
          die('error');
     }
     else{
          echo "Database connected {$name}"." <br>";
     }

     $sql = "SELECT * FROM borrow WHERE borrow.id = '".$_POST['id']."'";
     $retval = mysqli_query($conn,$sql);

     $row = $retval->fetch_assoc();

     if ($retval === TRUE) {
          echo "User already exists User Name {$row['name']}";
     }

     else{
          $sql = "INSERT INTO borrow (name,mail) VALUES ('".$_POST['name']."','".$_POST['email']."')";
          $retval=mysqli_query($conn, $sql);

          if($retval === true){
               echo "user created id: ";
          }

          $sql2 = "SELECT * FROM borrow WHERE borrow.mail = '".$_POST['email']."'";
          $retval2 = mysqli_query($conn,$sql2);

          $row2 = $retval2->fetch_assoc();

          echo "{$row2['id']}";
     }
     
     mysqli_close($conn);
     
     
?>

</body>  
</html> 

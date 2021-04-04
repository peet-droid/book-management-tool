<!DOCTYPE>  
<html>  
<body> 
<?php

     $username = 'root';
     $hostname = 'localhost:3309';
     $password = 'peet2001@';
     $dbname = 'book';

     $conn = new mysqli($hostname,$username,$password,$dbname);

     if(mysqli_connect_error()){
          die('error');
     }
     else{
          echo "Database connected ".$_POST['ID']." <br>";
     }

     $sql = "SELECT * FROM borrow WHERE borrow.id = '".$_POST['ID']."'";
     $retval = mysqli_query($conn,$sql);

     $row = $retval->fetch_assoc();
     //echo "Welcome {$row['name']}";

     $return = $row['isubook'];

     if($return){
        $sql4 = "UPDATE book SET book.copies = book.copies+1 WHERE book.bid = '".$return."'";
        mysqli_query($conn,$sql4);
     }

     if (count($row) > 0) {
          echo "Welcome {$row['name']}";
     }

     else{
             echo "No User found with that id please create a account first";
             die();
     }       

     $sql2 = "SELECT * FROM book WHERE book.bname = '".$_POST['bname']."'";
     $retval2 = mysqli_query($conn,$sql2);
     $row2 = $retval2->fetch_assoc();

        if(count($row2) > 0 and $row2['copies'] > 0) {
                $sql3 = "UPDATE book SET book.copies = book.copies-1 WHERE book.bname = '".$_POST['bname']."'";
                $retval3 = mysqli_query($conn,$sql3);

                $sql5 = "UPDATE borrow SET borrow.isubook = ".$row2['bid']." WHERE borrow.id = '".$_POST['ID']."'";
                $retval5 = mysqli_query($conn,$sql5);
                
        }

        if($row2['copies'] == 0){
                echo "No copies left of".$row2['bname'];
        }


     
     mysqli_close($conn);
     
     
?>

</body>  
</html> 
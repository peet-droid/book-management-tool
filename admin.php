<html>  
<body> 
<?php
        $adminname = $_POST['name'];
        $adminemail = $_POST['mail'];
        $username = 'root';
        $hostname = 'localhost:3309';
        $password = 'peet2001@';
        $dbname = 'book';

        $conn = new mysqli($hostname,$username,$password,$dbname);

        if(mysqli_connect_error()){
                die('error');
        }
        else{
                echo "Database connected {$adminname}"." <br>";
        }

        $sql = "SELECT * FROM borrow WHERE borrow.id = 1";
        $retval = mysqli_query($conn,$sql);

        $row = $retval->fetch_assoc();

        if($row['name'] != $adminname or $row['mail'] != $adminemail){
                die('admin criteria not satisfied');
        }

        echo "Hello admin {$adminname}"." <br>";

        $sql2 = "SELECT * FROM book WHERE book.bname = '".$_POST['bname']."'";

        $retval2 = mysqli_query($conn,$sql2);

        $row2 = $retval2->fetch_assoc();


        if(count($row2) == 3){
                $sqladdcopie = "UPDATE book SET book.copies = book.copies+'".$_POST['copies']."' WHERE book.bname = '".$_POST['bname']."'";
                $retvalcopie = mysqli_query($conn,$sqladdcopie);
                if($retvalcopie === TRUE){
                        echo "Updated succesfully !";
                }
                else{
                        echo "Update failed :/";
                }
        }

        else{
                $sqladdbook = "INSERT INTO book (bname,copies) VALUES ('".$_POST['bname']."','".$_POST['copies']."')";
                $retvalcopie = mysqli_query($conn,$sqladdbook);
                if($retvalcopie === TRUE){
                        echo "Updated succesfully !";
                }
                else{
                        echo "new book failed :/";
                }
        }

        mysqli_close($conn);



?>

</body>  
</html> 
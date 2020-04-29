<?php

$firstname= $_POST['firstname'];
$lastname= $_POST['lastname'];
$status= $_POST['status'];
$subject= $_POST['subject'];




if(!empty($firstname) || !empty($lastname) || !empty($status) || !empty($subject))
 {
	 $host= "localhost";
	 $dbusername="root";
	 $dbpassword="password";
	 $dbname="school";
	 
	 //create connection
	 $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
	 if(mysqli_connect_error()){
		die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
		}else{
			$SELECT = "select contactID from contact Where contactID = ? Limit 1";
			$INSERT = "insert into contact (firstname,lastname,status,subject) values (?,?,?,?)";
			
			//prepare statement
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s",$username);
			$stmt->execute();
			$stmt->bind_result($username);
			$stmt->store_result();
			$rnum = $stmt->num_rows;
			
			if ($rnum==0){
				$stmt->close();
				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("ssss", $firstname, $lastname, $status, $subject);
				$stmt->execute();
                echo '<script>alert("Your message was sent successfully!")</script>';	
			}else{
                echo '<script>alert("Unable to send message. Please try again")</script>';	
			}
			$stmt->close();
			$conn->close();
			}
 }
 else{
	 echo "All fields are required.";
	 die();
 }
 ?>
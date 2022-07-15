<?php
     // Get Id request and database
     $postId = $_GET["Id"] ;
     // var_dump($postId);
     // die();
     $productName = $_GET["productName"] ;
     // var_dump($productName);
     // die();
     $regularPrice = $_GET["Price"] ;
     // var_dump($regularPrice);
     // die();
     $salePrice = $_GET["Price"] ;
     // var_dump($salePrice);
     // die();
     $categoryName = $_GET["categoryName"] ;
     // var_dump($categoryName);
     // die();
     $imageLink = $_GET["imageLink"] ;
     // var_dump($imageLink);
     // die();
     $productLink = $_GET["productLink"] ;
     // var_dump($productLink);
     // die();

     //Get data from database
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "dealcongnghe";

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Change character set to utf8 => Fix lỗi tiếng Việt
     $conn -> set_charset("utf8");

     // Check connection
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     $sql = "UPDATE product SET ProductName = '$productName', RegularPrice = $regularPrice, SalePrice = $salePrice, CategoryName = '$categoryName', ImageLink = '$imageLink' , ProductLink = '$productLink' WHERE Id = $postId";
     // echo $sql;
     // die();

     // Response result to client/user
     if ($conn->query($sql) === TRUE) {
          header("location:../client/managepost.html");
     } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
     }

     // Close connection to database
     $conn->close();
?>
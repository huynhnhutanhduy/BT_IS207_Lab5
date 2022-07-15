<?php

include 'product.php';

//Get data sent from client via POST
$action = $_GET["action"]; //create/update/delete/search

// Search for Ajax call
if($action == "searchAjax"){
     // Get keyword needs search request
     $keyword = $_GET["keyword"];

     // Call function searchAjax()
     searchAjax($keyword);
}
// Create for Ajax call
elseif($action == "createAjax"){
     // Get new information
     $post = new Post();
     $post->productName = $_GET["productName"] ;
     $post->regularPrice = $_GET["regularPrice"] ;
     $post->salePrice = $_GET["salePrice"] ;
     $post->categoryName = $_GET["categoryName"] ;
     $post->imageLink = $_GET["imageLink"] ;
     $post->productLink = $_GET["productLink"] ;

     // Call function createAjax()
     createAjax($post);
}
// Delete for Ajax call
elseif($action == "deleteAjax"){
     // Get Id needs delete request
     $postId = $_GET["Id"] ;

     // Call function deleteAjax()
     deleteAjax($postId);
}
// Update for Ajax call
elseif($action == "updateAjax"){
     // Get Id request
     $postId = $_GET["Id"] ;
     // New update information
     $newPost = new Post();
     $newPost->productName = $_GET["productName"] ;
     $newPost->regularPrice = $_GET["regularPrice"] ;
     $newPost->salePrice = $_GET["salePrice"] ;
     $newPost->categoryName = $_GET["categoryName"] ;
     $newPost->imageLink = $_GET["imageLink"] ;
     $newPost->productLink = $_GET["productLink"] ;

     // Call function updateAjax()
     updateAjax($postId, $newPost);
}
elseif($action == "manageAjax"){
     // Call function manageAjaz()
     manageAjax();
}

//Start of searchAjax
//Search product by name then return result as JSON
//Test string:
//Link test: http://localhost/dealcongnghe2/server/postcontroller?action=searchAjax&keyword=iphone
function searchAjax($keyword){
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

     $sql = "SELECT * FROM product WHERE productName LIKE '%$keyword%' ORDER BY Id ASC LIMIT 100";

     $result = $conn->query($sql);
     // var_dump($result);
     // die();

     //return result as JSON
     if ($result->num_rows > 0) {
          //Convert $result to json format
          $data = $result->fetch_all(MYSQLI_ASSOC);
          // var_dump($data);
          // die();
          echo json_encode($data);
     } else {
          // $dataString = "No result found";
          echo json_encode(["No result found"]);
     }
     
     //Close connection to database
     $conn->close();
}
// End of searchAjax

// Start of createAjax
// Create post
//Test string:
//Link test: http://localhost/dealcongnghe2/server/postcontroller?action=createAjax&productName=SamsungGalaxyS21Ultra5G&regularPrice=24600000&salePrice=24600000&categoryName=Phone&imageLink=https://cdn.cellphones.com.vn/media/catalog/product/cache/7/image/9df78eab33525d08d6e5fb8d27136e95/s/a/samsung-galaxy-s21-ultra-1_1.jpg&productLink=https://cellphones.com.vn/samsung-galaxy-s21-ultra.html
function createAjax($post){
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

     //câu query test từ localhost/phpmyadmin/ và đảm bảo câu query phải chạy được trong sql
     $sql = "INSERT INTO  product(ProductName, RegularPrice, SalePrice, CategoryName, ImageLink, ProductLink)
     VALUES('$post->productName', $post->regularPrice, $post->salePrice, '$post->categoryName', '$post->imageLink', '$post->productLink')";
     // echo $sql;
     // die();

     //3. Response result to client/user
     if ($conn->query($sql) === TRUE) {
          echo "Product has been successfully created <br>";
     } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
     }

     //Close connection to database
     $conn->close();
}
// End of createAjax

// Start of deleteAjax
// Delete post by id
// Link test: http://localhost/dealcongnghe2/server/postcontroller?action=deleteAjax&Id=1
function deleteAjax($postId){
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
     
     // sql to delete a record
     $sql = "DELETE FROM product WHERE Id = $postId" ;
     
     if ($conn->query($sql) === TRUE) {
       echo "Product with Id $postId has been successfully deleted from database ";
     } else {
       echo "Error deleting record: " . $conn->error;
     }

     //Close connection to database
     $conn->close();
}
// End of deleteAjax

// Start of updateAjax
// Update post by id
// Link test: http://localhost/dealcongnghe2/server/postcontroller?action=updateAjax&Id=39&productName=Iphone12&regularPrice=25000000&salePrice=25000000&categoryName=Phone&imageLink=https://cdn.cellphones.com.vn/media/catalog/product/cache/7/image/9df78eab33525d08d6e5fb8d27136e95/i/p/iphone-12_2__3.jpg&productLink=https://cellphones.com.vn/iphone-12.html
function updateAjax($postId, $newPost){
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

     //câu query test từ localhost/phpmyadmin/ và đảm bảo câu query phải chạy được trong sql
     $sql = "UPDATE product SET ProductName = '$newPost->productName', RegularPrice = $newPost->regularPrice, SalePrice = $newPost->salePrice, CategoryName = '$newPost->categoryName', ImageLink = '$newPost->imageLink' , ProductLink = '$newPost->productLink' WHERE Id = $postId";
     // echo $sql;
     // die();

     //3. Response result to client/user
     if ($conn->query($sql) === TRUE) {
          echo "Update successfull";
     } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
     }

     //Close connection to database
     $conn->close();
}
// End of updateAjax

// Start of manageAjax
// Manage post
// Link test: http://localhost/dealcongnghe2/server/postcontroller?action=manageAjax
function manageAjax(){
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

     $sql = "SELECT * FROM product ORDER BY Id ASC";
     $result = $conn->query($sql);

     // return result as JSON
     if ($result->num_rows > 0) {
          //Convert $result to json format
          $data = $result->fetch_all(MYSQLI_ASSOC);
          // var_dump($data);
          // die();
          echo json_encode($data);
     } else {
          // echo "{resul:\" No result found\"}";
          echo json_encode(["No result found"]);
     }

     //Close connection to database
     $conn->close();
}

?>
<?php
  $ID = $_GET["Id"];
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

  $sql = "SELECT * FROM product WHERE Id= $ID";

  $result = $conn->query($sql);
  
  $rs = $result->fetch_assoc();

  // if ($result->num_rows == 1) {
  //   // output data of each row
    
  // } else {
  //   echo "0 results";
  // }

  //close connection 
  $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DealCongNghe.Com</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- FontAwsome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <!-- Google Fonts -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto"
    />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
      body {
        font-family: "Roboto";
      }

      #left-sidebar,
      #main-content {
        height: 500px;
        border: 1px solid red;
        margin-bottom: 50px;
      }

      #footer {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#navbar-collapse"
            aria-expanded="false"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">DealCongNghe.Com</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="createpost.html">Đăng Tin</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="managepost.html">Quản Lý Tin Đăng</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </nav>

    <!-- Place your code at here! -->
    <div id="main">
      <div class="container">
        <h1 style="text-align: center;">Chỉnh Sửa Sản Phẩm</h1>
        <div id="txtStatus"></div>
        <br>
        <form action="../server/update.php" method="GET">
          <div class="form-group">
            <label for="txtId">ID <sup style="color:red;" title="Xem phần chú thích để biết thêm chi tiết"> (*) </sup> </label>
            <input type="text" class="form-control" id="txtId" name="Id" value="<?php echo $rs['Id'];?>"/>
          </div>
          <div class="form-group">
            <label for="txtProductName">Tên sản phẩm</label>
            <input
              type="text"
              class="form-control"
              id="txtProductName"
              name="productName"
              value="<?php echo $rs['ProductName'];?>"
            />
          </div>
          <div class="form-group">
            <label for="txtPrice">Giá bán</label>
            <input
              type="text"
              class="form-control"
              id="txtPrice"
              name="Price"
              value="<?php echo $rs['SalePrice'];?>"
            />
          </div>
          <div class="form-group">
            <label for="txtCategory">Loại</label>
            <input
              type="text"
              class="form-control"
              id="txtCategory"
              name="categoryName"
              value="<?php echo $rs['CategoryName'];?>"
            />
          </div>
          <div class="form-group">
            <label for="txtImageLink">Link hình ảnh</label>
            <input
              type="text"
              class="form-control"
              id="txtImageLink"
              name="imageLink"
              value="<?php echo $rs['ImageLink'];?>"
            />
          </div>
          <div class="form-group">
            <label for="txtProductLink">Link sản phẩm</label>
            <input
              type="text"
              class="form-control"
              id="txtProductLink"
              name="productLink"
              value="<?php echo $rs['ProductLink'];?>"
            />
          </div>
          <div class="input-group-btn">
            <button class="btn btn-danger" type="submit">
              Chỉnh sửa
            </button>
            <p style="font-size: 13.5px; margin-top:10px">Chú thích: Nội dung có dấu <sup style="color:red;">(*)</sup> phải giữ nguyên không được sửa!</p>
          </div>
        </form>
        
        <br />
      </div>
    </div>

    <!-- Footer -->
    <div id="footer">
      <div class="container">
        <p>All rights reserved by DealCongNghe.Com</p>
      </div>
    </div>

    <!-- DO NOT REMOVE THE 2 LINES -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

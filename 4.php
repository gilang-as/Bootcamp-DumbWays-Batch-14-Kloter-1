<?php
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$databaseHost = 'localhost';
$databaseName = 'dealer_motor';
$databaseUsername = 'root';
$databasePassword = '';

$connect = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

function Insert($table, $data){
    global $connect;
    //print_r($data);
    $fields = array_keys( $data );  
    $values = array_map( array($connect, 'real_escape_string'), array_values( $data ) );
    //echo "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');";
    //exit;  
    mysqli_query($connect, "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');") or die( mysqli_error($connect) );
    }
function Update($table_name, $form_data, $where_clause=''){   
        global $connect;
        $whereSQL = '';
        if(!empty($where_clause))
        {
            if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
            {
                $whereSQL = " WHERE ".$where_clause;
            } else
            {
                $whereSQL = " ".trim($where_clause);
            }
        }
        $sql = "UPDATE ".$table_name." SET ";
    
        $sets = array();
        foreach($form_data as $column => $value)
        {
             $sets[] = "`".$column."` = '".$value."'";
        }
        $sql .= implode(', ', $sets);
    
        $sql .= $whereSQL;
             
        return mysqli_query($connect,$sql);
    }
function Delete($table_name, $where_clause=''){   
        global $connect;
        $whereSQL = '';
        if(!empty($where_clause))
        {
            if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
            {
                $whereSQL = " WHERE ".$where_clause;
            } else
            {
                $whereSQL = " ".trim($where_clause);
            }
        }
        $sql = "DELETE FROM ".$table_name.$whereSQL;
         
        return mysqli_query($connect,$sql);
    }  

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEALER MOTORCYCLE</title>
    <style>
        body {
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        .header {
            background-color: #f1f1f1;
            padding: 30px;
            text-align: center;
            font-size: 35px;
        }

        .column {
            float: left;
            padding: 10px;
        }

        .column.side {
            width: 25%;
        }

        .column.middle {
            width: 50%;
        }

        .column.side2 {
            width: 75%;
        }

        .column.full {
            width: 100%;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
        }

        .page-title {
            border-top: #fff solid 2px;
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
        }

        @media (max-width: 600px) {

            .column.side,
            .column.middle {
                width: 100%;
            }
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #4CAF50;
        }


        input[type=text],
        input[type=number],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        @media screen and (max-width: 600px) {

            .col-25,
            .col-75,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .center {
            text-align: center;
        }

        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        div.gallery {
            border: 1px solid #ccc;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }

        * {
            box-sizing: border-box;
        }

        .responsive {
            padding: 0 6px;
            float: left;
            width: 24.99999%;
        }

        @media only screen and (max-width: 700px) {
            .responsive {
                width: 49.99999%;
                margin: 6px 0;
            }
        }

        @media only screen and (max-width: 500px) {
            .responsive {
                width: 100%;
            }
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        @font-face {
            font-family: 'Material Icons';
            font-style: normal;
            font-weight: 400;
            src: url(tambahan/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .product-detail {
            border-collapse: collapse;
            width: 100%;
        }

        .product-detail>th,
        td {
            text-align: left;
            padding: 8px;
        }

        .product-detail>tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        .button1 {
            background-color: #4CAF50;
        }

        .button2 {
            background-color: #008CBA;
        }

        .button3 {
            background-color: #f44336;
        }

        .button4 {
            background-color: #e7e7e7;
            color: black;
        }

        .button5 {
            background-color: #555555;
        }

    </style>
</head>

<body>

    <ul>
        <li style="width:20%;"><a href="?page=home"><i class="material-icons">home</i><br>HOME</a></li>
        <li style="width:20%;"><a href="?page=customers"><i class="material-icons">group</i><br>CUSTOMERS</a></li>
        <li style="width:20%;"><a href="?page=products"><i class="material-icons">store</i><br>PRODUCTS</a></li>
        <li style="width:20%;"><a href="?page=brands"><i class="material-icons">stars</i><br>BRANDS</a></li>
        <li style="width:20%;"><a href="?page=transactions"><i class="material-icons">shopping_cart</i><br>TRANSACTION</a></li>
    </ul>

    <div style="padding:20px;margin-bottom:50px;">
        <div class="header">
            <h2>DEALER MOTORCYCLE</h2>
        </div>
        <?php
        if($_GET['page']=='home' || !isset($_GET['page'])){ 
            if($_GET['action']=="buy" && !empty($_POST['id']) && !empty($_POST['customer'])) {

                $data1=array(
                    "motorcycle_id"  => $_POST['id'],
                    "customer_id"  => $_POST['customer'],
                    "date" => date('Y-m-d H:i:s', time())
                );
                print_r($data);
                $query='UPDATE motorcycle_tb SET stock = stock - 1 WHERE id = "'.$_POST['id'].'"';
                mysqli_query($connect,$query);
                Insert("buy_tb",$data1);
            }
            ?>
        <div class="page-title">
            <p>HOME</p>
        </div>
        <div class="row">
            <div class="column full" style="background-color:#bbb;">
                <?php
                          $quotes_qry="SELECT * FROM motorcycle_tb ORDER BY id DESC";
                          $data=mysqli_query($connect,$quotes_qry);
                          $no=1;
                          while($row=mysqli_fetch_array($data)){ 
                      ?>
                <div class="responsive">
                    <button id="myBtn<?=$row["id"];?>">
                        <div class="gallery">
                            <a>
                                <img src="tambahan/upload/<?=$row["image"];?>" alt="Cinque Terre" width="600" height="400">
                            </a>
                            <div class="desc"><?=$row["name"];?></div>
                        </div>
                    </button>
                </div>

                <!-- The Modal -->
                <div id="myModal<?=$row["id"];?>" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="row">
                            <div class="column side">
                                <img src="tambahan/upload/<?=$row["image"];?>" alt="Cinque Terre" width="100%">
                            </div>
                            <div class="column middle">
                                <table class="product-detail">
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td><?=$row['name']?></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>:</td>
                                        <td><?=$row['brand_id']?></td>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <td>:</td>
                                        <td><?=$row['color']?></td>
                                    </tr>
                                    <tr>
                                        <td>Specification</td>
                                        <td>:</td>
                                        <td><?=$row['specification']?></td>
                                    </tr>
                                    <tr>
                                        <td>Stock</td>
                                        <td>:</td>
                                        <td><?=$row['stock']?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="column side">
                                <form method="POST" action="4.php?page=home&action=buy">
                                    <input type="hidden" name="id" value="<?=$row["id"] ;?>">
                                    <label for="customer">Customer</label>
                                    <select id="customer" name="customer">
                                        <?php
                                        $quotes_qry="SELECT * FROM customer_tb ORDER BY id DESC";
                                        $a=mysqli_query($connect,$quotes_qry);
                                        while($sd=mysqli_fetch_array($a)){ 
                                    ?>
                                        <option value="<?=$sd['id'];?>"><?=$sd['name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <button class="button" style="width:100%">BUY</button>
                                </form>
                                <a class="button button3 cancel<?=$row["id"];?>" style="width:100%">CANCEL</a>
                            </div>
                        </div>
                    </div>

                </div>
                <script>
                    var modal<?= $row["id"]; ?> = document.getElementById("myModal<?=$row["id"];?>");

                    var btn<?= $row["id"]; ?> = document.getElementById("myBtn<?=$row["id"];?>");

                    var span<?= $row["id"]; ?> = document.getElementsByClassName("cancel<?=$row["id"];?>")[0];

                    btn<?= $row["id"]; ?> .onclick = function() {
                        modal<?= $row["id"]; ?>.style.display = "block";
                    }

                    span<?= $row["id"]; ?> .onclick = function() {
                        modal<?= $row["id"]; ?>.style.display = "none";
                    }

                    window.onclick = function(event) {
                        if (event.target == modal<?= $row["id"]; ?> ) {
                            modal<?= $row["id"]; ?>.style.display = "none";
                        }
                    }
                </script>
                <?php } ?>

                <!--
                <div class="center">
                    <div class="pagination" style="margin-top:50px">
                        <a href="#">&laquo;</a>
                        <a href="#">1</a>
                        <a href="#" class="active">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
                -->
            </div>
        </div>
        <?php
            }elseif($_GET['page']=='customers'){
            if($_GET['action']=="add" && !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone'])) {

                $data=array(
                    "name"  => $_POST['name'],
                    "address"  => $_POST['address'],
                    "phone"  => $_POST['phone']
                );
                //print_r($data);
                Insert("customer_tb",$data);
            }elseif($_GET['action']=="update" && !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone'])) {
                $data=array(
                    "name"  => $_POST['name'],
                    "address"  => $_POST['address'],
                    "phone"  => $_POST['phone']
                );
                //print_r($data);
                Update("customer_tb",$data,"WHERE id = '".$_POST['id']."'");
            }elseif($_GET['action']=="delete" && !empty($_GET['id'])) {
                Delete("customer_tb","WHERE id = '".$_GET['id']."'");
            }
        ?>
        <div class="page-title">
            <p>CUSTOMERS</p>
        </div>
        <div class="row">
            <div class="column side">
                <div class="container">
                    <?php
                        if($_GET['action']=="update" && !empty($_GET['id'])){ 
                            $quotes_qry="SELECT * FROM customer_tb WHERE id='".$_GET["id"]."'";
                            $data=mysqli_fetch_array(mysqli_query($connect,$quotes_qry));
                    ?>
                    <form method="POST" action="4.php?page=customers&action=update">
                        <input type="hidden" name="id" value="<?=$data["id"] ;?>">
                        <?php }else { ?>
                        <form method="POST" action="4.php?page=customers&action=add">
                            <?php } ?>
                            <div class="row">
                                <div class="col-25">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="name" name="name" placeholder="Name.." value="<?=$data["name"] ;?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="address">Address</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="address" name="address" placeholder="Address.." style="height:200px" required><?=$data["address"] ;?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="col-75">
                                    <input type="number" id="phone" name="phone" placeholder="Phone.." value="<?=$data["phone"] ;?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" value="Submit">
                            </div>
                        </form>
                </div>
            </div>
            <div class="column side2">
                <div class="container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        <?php
                          $quotes_qry="SELECT * FROM customer_tb ORDER BY id DESC";
                          $data=mysqli_query($connect,$quotes_qry);
                          $no=1;
                          while($row=mysqli_fetch_array($data)){ 
                      ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['address'];?></td>
                            <td><?=$row['phone'];?></td>
                            <td>
                                <a href="?page=customers&action=update&id=<?=$row['id'];?>">Update</a>
                                <a href="?page=customers&action=delete&id=<?=$row['id'];?>">Delete</a>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </table>
                    <!--
                    <div class="center">
                        <div class="pagination">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a href="#" class="active">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <?php
            }elseif($_GET['page']=='products'){
            if($_GET['action']=="add" && !empty($_POST['name']) && !empty($_POST['brand_id']) && !empty($_POST['image'])) {

                $data=array(
                    "name"  => $_POST['name'],
                    "brand_id"  => $_POST['brand_id'],
                    "image"  => $_POST['image'],
                    "color"  => $_POST['color'],
                    "specification"  => $_POST['specification'],
                    "stock"  => $_POST['stock']
                );
                //print_r($data);
                Insert("motorcycle_tb",$data);
            }elseif($_GET['action']=="update" && !empty($_POST['name']) && !empty($_POST['brand_id']) && !empty($_POST['image'])) {
                $data=array(
                    "name"  => $_POST['name'],
                    "brand_id"  => $_POST['brand_id'],
                    "image"  => $_POST['image'],
                    "color"  => $_POST['color'],
                    "specification"  => $_POST['specification'],
                    "stock"  => $_POST['stock']
                );
                //print_r($data);
                Update("motorcycle_tb",$data,"WHERE id = '".$_POST['id']."'");
            }elseif($_GET['action']=="delete" && !empty($_GET['id'])) {
                Delete("motorcycle_tb","WHERE id = '".$_GET['id']."'");
            }
        ?>
        <div class="page-title">
            <p>PRODUCT</p>
        </div>
        <div class="row">
            <div class="column side">
                <div class="container">
                    <?php
                        if($_GET['action']=="update" && !empty($_GET['id'])){ 
                            $quotes_qry="SELECT * FROM motorcycle_tb WHERE id='".$_GET["id"]."'";
                            $data=mysqli_fetch_array(mysqli_query($connect,$quotes_qry));
                    ?>
                    <form method="POST" action="4.php?page=products&action=update">
                        <input type="hidden" name="id" value="<?=$data["id"] ;?>">
                        <?php }else { ?>
                        <form method="POST" action="4.php?page=products&action=add">
                            <?php } ?>
                            <div class="row">
                                <div class="col-25">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="name" name="name" placeholder="Name.." value="<?=$data["name"] ;?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="brand">Brand</label>
                                </div>
                                <div class="col-75">
                                    <select id="brand_id" name="brand_id">
                                        <?php
                                        $quotes_qry="SELECT * FROM brand_tb ORDER BY id DESC";
                                        $a=mysqli_query($connect,$quotes_qry);
                                        while($row=mysqli_fetch_array($a)){ 
                                    ?>
                                        <option <?php if($row['id'] == $data["brand_id"]){echo "selected";} ?> value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="image">Image</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="image" name="image" placeholder="Image.." value="<?=$data["image"] ;?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="color">Color</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="color" name="color" placeholder="Color.." value="<?=$data["color"] ;?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="specification">Specification</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="specification" name="specification" placeholder="Specification.." style="height:200px" required><?=$data["specification"] ;?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="stock">Stock</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="stock" name="stock" placeholder="Stock.." value="<?=$data["stock"] ;?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" value="Submit">
                            </div>
                        </form>
                </div>
            </div>
            <div class="column side2">
                <div class="container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Color</th>
                            <th>Specification</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        <?php
                          $quotes_qry="SELECT motorcycle_tb.*, brand_tb.name as brand FROM motorcycle_tb INNER JOIN brand_tb ON motorcycle_tb.brand_id = brand_tb.id ORDER BY id DESC";
                          $data=mysqli_query($connect,$quotes_qry);
                          $no=1;
                          while($row=mysqli_fetch_array($data)){ 
                      ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['brand'];?></td>
                            <td><?=$row['color'];?></td>
                            <td><?=$row['specification'];?></td>
                            <td><?=$row['stock'];?></td>
                            <td><a>
                                    <img src="tambahan/upload/<?=$row["image"];?>" alt="Cinque Terre" width="100">
                                </a></td>
                            <td>
                                <a href="?page=products&action=update&id=<?=$row['id'];?>">Update</a>
                                <a href="?page=products&action=delete&id=<?=$row['id'];?>">Delete</a>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </table>
                    <!--
                    <div class="center">
                        <div class="pagination">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a href="#" class="active">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <?php
            }elseif($_GET['page']=='brands'){
            if($_GET['action']=="add" && !empty($_POST['name'])) {

                $data=array(
                    "name"  => $_POST['name']
                );
                //print_r($data);
                Insert("brand_tb",$data);
            }elseif($_GET['action']=="update" && !empty($_POST['name'])) {
                $data=array(
                    "name"  => $_POST['name']
                );
                //print_r($data);
                Update("brand_tb",$data,"WHERE id = '".$_POST['id']."'");
            }elseif($_GET['action']=="delete" && !empty($_GET['id'])) {
                Delete("brand_tb","WHERE id = '".$_GET['id']."'");
            }
        ?>
        <div class="page-title">
            <p>BRANDS</p>
        </div>
        <div class="row">
            <div class="column side">
                <div class="container">
                    <?php
                        if($_GET['action']=="update" && !empty($_GET['id'])){ 
                            $quotes_qry="SELECT * FROM brand_tb WHERE id='".$_GET["id"]."'";
                            $data=mysqli_fetch_array(mysqli_query($connect,$quotes_qry));
                    ?>
                    <form method="POST" action="4.php?page=brands&action=update">
                        <input type="hidden" name="id" value="<?=$data["id"] ;?>">
                        <?php }else { ?>
                        <form method="POST" action="4.php?page=brands&action=add">
                            <?php } ?>
                            <div class="row">
                                <div class="col-25">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="name" name="name" placeholder="Name.." value="<?=$data["name"] ;?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" value="Submit">
                            </div>
                        </form>
                </div>
            </div>
            <div class="column side2">
                <div class="container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                          $quotes_qry="SELECT * FROM brand_tb ORDER BY id DESC";
                          $data=mysqli_query($connect,$quotes_qry);
                          $no=1;
                          while($row=mysqli_fetch_array($data)){ 
                      ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['name'];?></td>
                            <td>
                                <a href="?page=brands&action=update&id=<?=$row['id'];?>">Update</a>
                                <a href="?page=brands&action=delete&id=<?=$row['id'];?>">Delete</a>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </table>
                    <!--
                    <div class="center">
                        <div class="pagination">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a href="#" class="active">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <?php }elseif($_GET['page']=='transactions'){
        if($_GET['action']=="delete" && !empty($_GET['id'])) {
            Delete("buy_tb","WHERE id = '".$_GET['id']."'");
        }    
        ?>
        <div class="page-title">
            <p>TRANSACTIONS</p>
        </div>
        <div class="row">
            <div class="column full">
                <div class="container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Motorcycle</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <?php
                          $quotes_qry="SELECT buy_tb.*, motorcycle_tb.name as motorcycle, customer_tb.name as customer FROM buy_tb INNER JOIN motorcycle_tb on buy_tb.motorcycle_id = motorcycle_tb.id INNER JOIN customer_tb on buy_tb.customer_id = customer_tb.id";
                          $data=mysqli_query($connect,$quotes_qry);
                          $no=1;
                          while($row=mysqli_fetch_array($data)){ 
                      ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$row['customer'];?></td>
                            <td><?=$row['motorcycle'];?></td>
                            <td><?=$row['date'];?></td>
                            <td>
                                <a href="?page=transactions&action=delete&id=<?=$row['id'];?>">Delete</a>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </table>
                    <!--
                    <div class="center">
                        <div class="pagination">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a href="#" class="active">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="footer">
            <p>Made with <i style="color:red;" class="material-icons">mood</i> by Gilang Adi S since 2K20</p>
        </div>
    </div>

</body>

</html>
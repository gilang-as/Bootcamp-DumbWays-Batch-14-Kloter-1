<?php
$mysqli = new mysqli("localhost","root","","count");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

if(isset($_POST["id"])){
    $query='UPDATE tb_caleg SET earned_vote = earned_vote + 1 WHERE id = "'.$_POST['id'].'"';
    mysqli_query($mysqli,$query);
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>VOTE</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
</head>

<body cz-shortcut-listen="true">

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">QUICK COUNT</h1>
        <p class="lead"></p>
    </div>

    <div class="container">
        <?php
        $caleg = mysqli_query($mysqli, "SELECT * from tb_caleg");
        foreach ($caleg as $row){
        ?>
        <form class="card-deck mb-3 text-center" method="POST">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal"><?= $row["name"];?></h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title"><small class="text-muted"> Memperoleh Suara : </small> <?= $row["earned_vote"];?> </h1>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $row["id"];?>">
            <button type="submit" class="col-md-12 card mb-4 shadow-sm btn btn-lg btn-block btn-outline-primary">
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h3>TAMBAH</h3>
                <p class="lead">Klik Untuk Memilih</p>
            </div>
            </button>
        </form>
        <?php 
        }
        ?>
        
    </div>


    <style>
        .tb_button {
            padding: 1px;
            cursor: pointer;
            border-right: 1px solid #8b8b8b;
            border-left: 1px solid #FFF;
            border-bottom: 1px solid #fff;
        }

        .tb_button.hover {
            borer: 2px outset #def;
            background-color: #f8f8f8 !important;
        }

        .ws_toolbar {
            z-index: 100000
        }

        .ws_toolbar .ws_tb_btn {
            cursor: pointer;
            border: 1px solid #555;
            padding: 3px
        }

        .tb_highlight {
            background-color: yellow
        }

        .tb_hide {
            visibility: hidden
        }

        .ws_toolbar img {
            padding: 2px;
            margin: 0px
        }
    </style>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
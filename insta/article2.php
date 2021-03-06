<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- META -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dl-type-galerie</title>
    <!-- CSS -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./css/bootstrap-reboot.min.css" type="text/css">    
    <link rel="stylesheet" href="./css/bootstrap-grid.min.css" type="text/css">
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">
    <!-- Fontawsome -->
    <link rel="stylesheet" href="./css/fa-brands.css" type="text/css">
    <link rel="stylesheet" href="./css/fa-regular.css" type="text/css">
    <link rel="stylesheet" href="./css/fa-regular.css" type="text/css">
    <link rel="stylesheet" href="./css/fontawesome-all.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="./css/custom.css" type="text/css">
    
</head>
<body>
    <div class="container">
        <!-- NAV BAR -->
        <?php
if(file_exists('inc/navbar.inc.php')){
    include('./inc/navbar.inc.php');
}
?>
        <!-- CARROUSEL -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="" alt="Third slide">
                </div>
            </div>
        </div>
        <!--ALERT -->
        <div class="col-md-12">
        <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Title news!</h4>
  <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Praesent Vulputate Nibh A Odio Venenatis, Ut Lacinia Lacus Vulputate. Donec Sollicitudin, Nisi Eu Lobortis </p>
  <hr>
  <p class="mb-0">Autor + <i>Date</i></p>
</div>
            </div>
        <!-- LISTE DES 5 DERNIERS ARTISTES INSCRITS -->
 <!--     <h1 class="area"> Last Post: </h1> -->
        <div class="container d-flex justify-content-end pl-3" id="article">
        <?php
        require("core/ContentManager.php");
        $cm = new ContentManager();
        echo $cm->getArtworklist();
        ?>
    </div>
    <div class="container d-flex justify-content-end pl-3">
 
    <!-- JS -->
<script>
            setInterval(function(){
                $("#article").load('/insta/views/articles');
            } ,1000);
        </script>
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/popper.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/custom.js"></script>
</body>

</html>
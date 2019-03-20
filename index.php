<!DOCTYPE html>
<?php 
ob_start();
include_once("includes/bootstrap.php");
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASEURL?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASEURL?>css/style.css" rel="stylesheet">

  </head>

  <body>
    <?php
        Helper::sectionYield("navigation");
      ?>



    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <!-- Blog Entries Column -->
        <?php 
          include_once("includes/layouts/blogs.php");
//          Helper::sectionYield("blogs");
          
        include_once("includes/layouts/sidebar.php");
        
//             Helper::sectionYield("sidebar");
          ?>


      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
   <?php 
      Helper::sectionYield("footer");
      ?>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo BASEURL?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo BASEURL?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

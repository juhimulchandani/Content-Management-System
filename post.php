<?php
include_once("includes/bootstrap.php");
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASEURL ;?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASEURL ;?>css/style.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    
    <?php
      Helper::sectionYield("navigation");
      ?>
    <div class="clearfix"></div>
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">
         <?php
          if(isset($_GET['post_id'])){
          $post_id = $_GET['post_id'];
          $db = new Database();
          $connection = $db->getConnection();
          $post = new Posts($connection);
          $post->readPost($post_id);
?>
          <!-- Title -->
          <h1 class="mt-4"><?php echo $post->getPostTitle(); ?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="#"><?php echo $post->getPostAuthor(); ?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p><span>Posted on <?php echo $post->getPostDate(); ?></span>
          <?php
                   $tags = $post->getPostTags();
                   $tag = explode(",", $tags);
                   for($j=0; $j<count($tag); $j++) {
                       $tag[$j] = trim($tag[$j]);
                      echo<<<TAG
<a href="#" class="btn btn-primary float-right mr-sm-1">{$tag[$j]}</a>
TAG;
                   } ?>
          </p>

          <hr>

          <!-- Preview Image -->
          <img class="img-fluid rounded" src="<?php echo BASEURL . "images/". $post->getPostImage(); ?>" alt="">

          <hr>
              <?php echo $post->getPostBody(); ?>
          <!-- Post Content -->
          <?php
                   }
                   ?>

          <hr>

          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>

          <!-- Single Comment -->
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div>

          <!-- Comment with nested comments -->
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Commenter Name</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Commenter Name</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

            </div>
          </div>

        </div>

        <!-- Sidebar Widgets Column -->
        <?php
                   Helper::sectionYield("sidebar");
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
    <script src="<?php echo BASEURL ;?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo BASEURL ;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
            
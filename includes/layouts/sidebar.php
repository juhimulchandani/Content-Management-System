        <div class="col-md-4">
                  <?php
            if(!Session::isSessionStart()){
            ?>
            <!--LOGIN FORM-->
            <div class="card my-4">
                <h5 class="card-header">Login</h5>
                <div class="card-body">
                    <form action="<?php echo BASEURL."routing"?>" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <input type="submit" class="btn btn-primary" name="login" id="login" value="Login">
                    </form>
                </div>
            </div>
            <!--LOGIN FORM-->
            <?php
            }
            ?>

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
             <form action="<?php echo BASEURL?>" method="POST">
              <div class="input-group">
                <input type="text" name="keywords" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button name="search" class="btn btn-secondary" type="submit">Go!</button>
                </span>
              </div>
              </form>
            </div>
          </div>
          <?php 
            $db=new Database();
            $connection = $db->getConnection();
            $categories=new Categories($connection);
            $result=$categories->readAllCategories();
            $categories_count=count($result);
            ?>
          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                   <?php
                      for($i=0;$i<$categories_count;$i=$i+2){
                          echo<<<CAT
                          <li>
                      <a href="http://localhost/oop-blog/category/{$result[$i]['category_id']}">{$result[$i]['category_name']}</a>
                    </li>
CAT;
                      }
                      ?>
                    
                   
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <?php
                      for($i=1;$i<$categories_count;$i=$i+2){
                          echo<<<CAT
                          <li>
                      <a href="http://localhost/oop-blog/category/{$result[$i]['category_id']}">{$result[$i]['category_name']}</a>
                    </li>
CAT;
                      }
                      ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div>

        </div>
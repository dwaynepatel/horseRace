    <?php if($_SESSION['username']){ ?>

             <div class="jumbotron">
             <div class="centerme text-center">

                    <p>You are logged in as <?=$_SESSION['username']?>
             <a class="btn btn-primary btn-lg" href="#" role="button" disabled>API testing</a>
             <a class="btn btn-primary btn-lg" href="#" role="button" disabled>Scrape testing</a>
             <a class="btn btn-primary btn-lg" href=" select.php" role="button" >Select Race (API & Scrape)</a>    
             <a class="btn btn-primary btn-lg" href="?logout=1" role="button">Logout</a></p>
            </div>

        <?php } else { ?>


<div class="wrapper">
    <form class="form-signin" name="login" action="" method="post">
      <h2 class="form-signin-heading">Please login</h2>
     Username:  <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
     Password: <input type="password" class="form-control" name="password" placeholder="Password" required=""/>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
  </div>
    <?php } ?>

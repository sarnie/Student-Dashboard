<?php require "inc/header.php";?>
<div class="container login-page w-height">
  <div class="row">
    <div class="col-xs-12">
      <p class="login-logo"><img src="img/login_logo.png" alt="Silvershore Login" /></p>
      <div class="login-form sha">
        <h2>Login</h2>
        <form role="form" method="post" action="inc/gateway.php">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Username">
          </div>
          <div class="form-group <?php if(isset($_GET['wrong'])){ echo 'has-error'; }?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <?php if(isset($_GET['wrong'])){?>
                <label class="control-label">Wrong Password!</label>
           <?php } ?>
          </div>
          <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require "inc/footer.php";?>

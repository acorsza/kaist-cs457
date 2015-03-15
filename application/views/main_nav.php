<body onload="main();">

    <!-- HEADER -->
    <script>
        function validateForm() {
            var x = document.forms["login"]["name","password"].value;
            if (x==null || x=="") {
                alert("Email and/or passoword cannot be empty");
                return false;
            }
        }
    </script>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Daejeon Hub!</a>
        </div>
        

        <div class="navbar-collapse collapse">
            <font color="red" style="margin-left: 185px; position: relative; float:left; margin-top: 15px;"><?php echo validation_errors(); ?></font>
            <form class="navbar-form navbar-right" name="login" action="verifyLogin" onsubmit="return validateForm()" method="post">
              <div class="form-group">
                <input type="text" placeholder="Email" class="form-control" id="email" name="email">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control"  id="passowrd" name="password">
              </div>
              <button type="submit" class="btn btn-success" name="submit">Login</button>
              <a href='verifyLogin/conn_fb' class="btn btn-info menu" name="fb_login">Login with Facebook</a>
          </form>
          
        </div><!--/.navbar-collapse -->
      </div>
    </div>
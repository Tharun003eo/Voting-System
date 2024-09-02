<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container" style="padding-top: 150px;">
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4" style="border: 2px solid gray; padding: 50px;">
        <div class="page-header">
          <h2>Authentication</h2>
        </div>
        <?php
        // Display error message if error parameter is set
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "empty") {
            echo '<p class="text-danger">Username or password cannot be empty.</p>';
          } else if ($_GET['error'] == "invalid") {
            echo '<p class="text-danger">Invalid username or password.</p>';
          }
        }
        ?>
        <form action="authentication.php" method="POST">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="adminUserName" class="form-control" placeholder="Enter Admin's Username" required>
            <br>
            <label>Password</label>
            <input type="password" name="adminPassword" class="form-control" placeholder="Enter Admin's Password" required>
            <br>
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </form>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

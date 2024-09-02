<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voting Panel</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
  <style>
    .headerFont {
      font-family: 'Ubuntu', sans-serif;
      font-size: 24px;
    }
    .subFont {
      font-family: 'Raleway', sans-serif;
      font-size: 14px;
    }
    .specialHead {
      font-family: 'Oswald', sans-serif;
    }
    .normalFont {
      font-family: 'Roboto Condensed', sans-serif;
    }
  </style>
</head>
<body>
  <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </div> <!-- end of container -->
    </nav>
    <div class="container" style="padding:100px;">
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray;">
          <div class="page-header">
            <h2 class="specialHead">Prove Your Authenticity of Being a Correct Voter.</h2>
          </div>
          <?php
          if (isset($_GET['error'])) {
              $voterID = $_GET['error'];
              echo '<div class="alert alert-danger" role="alert">Voter with ID <strong>' . $voterID . '</strong> has already voted.</div>';
          }
          ?>
          <form action="process_form.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Voter's Name :</label><br>
              <input type="text" name="voterName" pattern="[A-Za-z]{6,}" title="Enter Your Full Name" placeholder="Enter Your Full Name" class="form-control" required/><br>
              <label>Voter's Registered Email ID :</label><br>
              <input type="text" name="voterEmail" placeholder="Enter Your Email ID" class="form-control"/><br>
              <label>Voter's Card No. :</label><br>
              <input id="id1" type="text" name="voterID" pattern="[A-Za-z]{3}[0-9]{7}" placeholder="Enter Your Voter Unique ID (e.g., TAU1234567)" class="form-control" required/><br>
              <br>
              <div class="form-group">
                <label for="photo">Enter your voterID card image:</label>
                <input type="file" name="photo" id="photo" accept="image/*" required><br><br>
              </div>
              <hr>
              <button type="submit" name="submit" class="btn btn-primary"><strong>Submit</strong></button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

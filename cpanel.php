<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control Panel</title>

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

    .progress-bar-DMK {
      background-color: #FFA500;
    }

    .progress-bar-TVK {
      background-color: #0000FF;
    }

    .progress-bar-ADMK {
      background-color: #006400;
    }

    .progress-bar-NTK {
      background-color: #FF0000;
    }

    .progress-bar-Nota {
      background-color: #000000;
    }

    .progress-bar {
      transition: width 1s ease-in-out;
    }

    /* Style for candidate images */
    .candidate-image {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
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
        <a href="admin.php" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
      </div>

      <div class="collapse navbar-collapse" id="example-nav-collapse">
        <ul class="nav navbar-nav">
          <li><a href="nomination.html"><span class="subFont"><strong>Nomination's List</strong></span></a></li>
          <li><a href="voters_status.php"><span class="subFont"><strong>Number of voters</strong></span></a></li>
        </ul>

        <span class="normalFont"><a href="index.html" class="btn btn-success navbar-right navbar-btn"><strong>Sign Out</strong></a></span>
      </div>
    </div>
  </nav>

  <div class="container" style="padding: 50px;">
    <div class="row">
      <div class="col-sm-12" style="border: 2px solid gray; padding: 20px;">

        <div class="page-header">
          <h2 class="specialHead">Election Results</h2>
        </div>

        <div class="col-sm-12">
          <?php
          require 'config.php';

          $candidates = array(
            'stalin' => array('name' => 'DMK', 'image' => 'stalin.jpg'),
            'vijay' => array('name' => 'TVK', 'image' => 'vijay.jpg'),
            'Edappadi Palanisamy' => array('name' => 'ADMK', 'image' => 'EPS.jpg'),
            'seeman' => array('name' => 'NTK', 'image' => 'seeman.jpg'),
            'Nota' => array('name' => 'NOTA', 'image' => 'nota.jpg') // Added None of the Above
          );

          $conn = mysqli_connect($hostname, $username, $password, $database);
          if (!$conn) {
            echo "Error While Connecting.";
          } else {
            foreach ($candidates as $key => $candidate) {
              // Handle 'None of the Above' key
              $dbKey = ($key === 'None of the Above') ? 'NOTA' : $key;
              
              $sql = "SELECT COUNT(*) as votes FROM tbl_votes WHERE candidate='$dbKey'";
              $result = mysqli_query($conn, $sql);

              if ($row = mysqli_fetch_assoc($result)) {
                $votes = $row['votes'] ?? 0;

                // Define the progress bar class based on candidate
                $progressClass = "progress-bar-{$key}";

                echo "<strong><img src='images/{$candidate['image']}' class='candidate-image'>{$candidate['name']}</strong><br>";
                echo "
                  <div class='progress'>
                    <div class='progress-bar $progressClass' role='progressbar' aria-valuenow='$votes' aria-valuemin='0' aria-valuemax='100' style='width: $votes%'>
                      <span class='sr-only'>{$candidate['name']}</span>
                    </div>
                  </div>
                  <p class='normalFont'>Votes: $votes</p>
                ";
              }
            }
          }
          ?>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

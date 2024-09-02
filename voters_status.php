<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voters Status</title>
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 20px;
      text-align: center;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 40px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
      font-size: 32px;
      margin-bottom: 20px;
    }

    p {
      color: #666;
      font-size: 18px;
      line-height: 1.6;
    }

    .btn {
      display: inline-block;
      background-color: #337ab7;
      color: #fff;
      font-size: 16px;
      padding: 10px 20px;
      border-radius: 4px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #337ab7;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Voters Status</h1>
    <?php
    // Include your database connection
    require 'config.php';

    // Query to get the total number of voters
    $sqlTotalVoters = "SELECT COUNT(*) as total_voters FROM tbl_aadhar";
    $resultTotalVoters = mysqli_query($conn, $sqlTotalVoters);
    $rowTotalVoters = mysqli_fetch_assoc($resultTotalVoters);
    $totalVoters = $rowTotalVoters['total_voters'];

    // Query to get the number of votes cast
    $sqlVotesCast = "SELECT COUNT(*) as votes_cast FROM tbl_votes";
    $resultVotesCast = mysqli_query($conn, $sqlVotesCast);
    $rowVotesCast = mysqli_fetch_assoc($resultVotesCast);
    $votesCast = $rowVotesCast['votes_cast'];

    $remainingVoters = $totalVoters - $votesCast;

    echo "<p>Total Voters: $totalVoters</p>";
    echo "<p>Votes Cast: $votesCast</p>";
    echo "<p>Remaining Voters: $remainingVoters</p>";
    ?>
    <a href="cpanel.php" class="btn">Back</a>
  </div>
</body>
</html>

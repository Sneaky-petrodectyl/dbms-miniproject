<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="./home.php">Home</a></li>
      <li><a href="./profile.php">Profile</a></li>
      <li><a href="#">Item Lobby</a></li>
      <li><a href="#">Battles</a></li>
      <li><a href="#">About</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3>DBMS MINI PROJECT</h3>
  <p>A simple UI to interface tuples of dummy Fortnite:Battle Royale database</p>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fortnite";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $killQuery= "SELECT username,sum(kills) AS kills FROM battle_stats, player WHERE battle_stats.player_id = player.player_id Group by battle_stats.player_id ORDER BY kills desc";
    $kill = mysqli_query($conn,$killQuery);
    echo '<div class = "split left">';
    echo "<h3>Players who got most kills</h3>";
    if ($kill->num_rows > 0) {
      echo ' <table class ="table table-hover" style="width:75%"><tr> <th>Username</th> <th>Kills</th> </tr> ';
      while($row = $kill->fetch_assoc()) {
        echo "<tr> <td>".$row["username"]."</td> <td>".$row["kills"]."</td> </tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

     $purchaseQuery= "SELECT username,count(cosmetic_purchases.player_id) AS purchase FROM cosmetic_purchases, player WHERE cosmetic_purchases.player_id = player.player_id Group by cosmetic_purchases.player_id ORDER BY purchase DESC";
    $purchase = mysqli_query($conn,$purchaseQuery);
    echo "<h3>Players who purchased most items</h3>";
    if ($purchase->num_rows > 0) {
      echo ' <table class ="table table-hover" style="width:75%"><tr> <th>Username</th> <th>Kills</th> </tr> ';
      while($row = $purchase->fetch_assoc()) {
        echo "<tr> <td>".$row["username"]."</td> <td>".$row["purchase"]."</td> </tr>";
      }
      echo "</table></div>";
    } else {
      echo "0 results</div>";
    }

    $matchQuery = "SELECT username,count(battle_stats.player_id) AS matches FROM battle_stats, player WHERE battle_stats.player_id = player.player_id Group by battle_stats.player_id ORDER BY kills desc";
    $match = mysqli_query($conn,$matchQuery);
    echo '<div class = "split right">';
    echo "<h3>Players who played most matches</h3>";
    if ($match->num_rows > 0) {
      echo ' <table class ="table table-hover" style="width:75%"><tr> <th>Username</th> <th>Matches</th> </tr> ';
      while($row = $match->fetch_assoc()) {
        echo "<tr> <td>".$row["username"]."</td> <td>".$row["matches"]."</td> </tr>";
      }
      echo "</table></div>";
    } else {
      echo "0 results</div>";
    }


  ?>
</div>

</body>
</html>
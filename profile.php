<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

    
  <div class="container" style="background-color: #ddd; padding: 20px">
    
    <form action="./profile.php" method="post">
      <h3>Enter player's username...</h3>
      <input type="text" name="username" style="height:40px;width:600px">
      <input type="submit" class="btn btn-success" name="SubmitButton" style="width: 100px; height: 40px">
    </form>
  </div>

  <div class="container" padding = 20px;>

    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "fortnite";

      $conn = new mysqli($servername, $username, $password, $dbname);

      $mapGender = "CASE WHEN gender = 0 THEN 'Male' WHEN gender = 1 THEN 'Female' WHEN gender = 2 THEN 'Others' ELSE 'Dont want to mention' END AS gender";

      $mapItemType = "CASE WHEN item_type = 0 THEN 'Emote' WHEN item_type = 1 THEN 'Backbling' WHEN item_type = 2 THEN 'Glider' ELSE 'Skin' END AS item_type";

      if(isset($_POST['SubmitButton'])){
          
        $input = $_POST['username']; 
        
        echo "<br><h3> Hello ".$input."! here goes your fornite stats</h3><br>";
        
        $pidQuery = "SELECT player_id FROM player WHERE username = '".$input."'";
        $pid = mysqli_query($conn,$pidQuery);
        $pid = $pid->fetch_assoc();
        $pid = $pid["player_id"];

        $playerQuery = "SELECT username,name,age,".$mapGender." FROM player where username = '".$input."'";
        $player = mysqli_query($conn,$playerQuery);

        if ($player->num_rows > 0) {
          echo ' <table class ="table table-striped table-hover"><tr> <th>Username</th> <th>Name</th> <th>Age</th> <th>Gender</th></tr> ';
          while($row = $player->fetch_assoc()) {
            echo "<tr> <td>".$row["username"]."</td> <td>".$row["name"]."</td> <td>".$row["age"]."</td> <td>".$row["gender"]."</td> </tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }

        $statsQuery = "SELECT COUNT(battle_stats.match_id) AS matches, SUM(kills) AS kills,SUM(kills)/COUNT(battle_stats.match_id) AS kd, stats AS score, COUNT(battle.winner_id) AS wins FROM battle_stats, battle WHERE battle_stats.player_id IN ( SELECT player_id FROM player WHERE username = '".$input."' ) AND battle_stats.match_id = battle.match_id";
        $stats = mysqli_query($conn,$statsQuery);

        if ($stats->num_rows > 0) {
          echo ' <table class ="table table-striped table-hover"><tr> <th>Matches</th> <th>Kills</th> <th>K/D</th> <th>Score</th> <th>Wins</th> </tr> ';
          while($row = $stats->fetch_assoc()) {
            echo "<tr> <td>".$row["matches"]."</td> <td>".$row["kills"]."</td> <td>".$row["kd"]."</td> <td>".$row["score"]."</td> <td>".$row["wins"]."</td> </tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }

        $itemsQuery = "SELECT item_name, ".$mapItemType." FROM cosmetic_item where item_id IN (SELECT item_id FROM cosmetic_purchases WHERE player_id = ".$pid.")";
        $items = mysqli_query($conn,$itemsQuery);

        if ($items->num_rows > 0) {
          echo ' <table class ="table table-striped table-hover" style ="width : 50%; float : left;" ><tr> <th>Items</th> <th>Type</th> </tr> ';
          while($row = $items->fetch_assoc()) {
            echo "<tr> <td>".$row["item_name"]."</td> <td>".$row["item_type"]."</td> </tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }

        $friendQuery = "SELECT username FROM player WHERE player_id IN(SELECT friend_id FROM friends WHERE player_id = ".$pid.")";
        $friend = mysqli_query($conn, $friendQuery);

        if ($friend->num_rows > 0) {
          echo ' <table class ="table table-striped table-hover" style ="width : 50%;" ><tr> <th>Friends</th> ';
          while($row = $friend->fetch_assoc()) {
            echo "<tr> <td>".$row["username"]."</td> </tr>";
          }
          echo "</table>";
        } else {
          echo "0 results";
        } 
        
        

      }
    ?>
  </div>

</body>
</html>
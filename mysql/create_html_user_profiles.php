<!--Author: Steve Yang -->
<!--Log:  -->
<!DOCTYPE HTML>
<html>
<head>
<style>
#profiles {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#profiles td, #profiles th {
    border: 1px solid #ddd;
    padding: 8px;
}

#profiles tr:nth-child(even){background-color: #f2f2f2;}

#profiles tr:hover {background-color: #ddd;}

#profiles th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}


</style>
</head>

<body>
<div style="overflow-x:auto;">

<table id="profiles">

<?php
  require('connect.php');

  $connection = init_db();


  $profiles = retrieve_user_profiles_all($connection);

  # print ("# of records = ". count($profiles). "\n");


  $row_num = 1;

  foreach ($profiles as $profile ) {

   # print column name only once
   if ($row_num == 2 ) {
      # print_r (array_keys($profile) );
      echo "<tr>\n";
      foreach( array_keys($profile) as $key1 => $col ){
	  echo "<th>".$col."</th>\n";
        }
      echo "</tr>\n";
    }

   $row_num = $row_num + 1;


    echo "<tr>\n";
      foreach ($profile as $key => $value ){
	  echo "<td>".$value."</td>\n";
        }
    echo "</tr>\n";
   }

  mysqli_close($connection);

?>



</table>
</div>

</body>
</html>

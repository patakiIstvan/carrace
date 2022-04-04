<?php
//readData(sql, opcionális lista a kiirandó array keyeről) beolvas egy query-t az adatbázisban
// modifyData(sql) modosít az adatbázisban

function OpenCon()
 {
 $dbhost = "127.0.0.1:3306"; // <- Ez szerintem jó
 $dbuser = "root";
 $dbpass = "";
 $db = "carrace";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 return $conn;
 }

function readData($sql, $resName = []){
    $conn = OpenCon();
   
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {

       if (count($resName) > 0){
$a = [];
while($row = $result->fetch_assoc()) {
    $objects = [];
    foreach ($resName as $column){
    $objects[] = [$column => $row[$column]];
  }
  $a[] = $objects;
}
    return $a;
}

return $result;

   } else {
     return "0 results";
   }
   $conn->close();
}

function modifyData($sql){
    $conn = OpenCon();
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();
}
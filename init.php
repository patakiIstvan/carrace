<?php

require_once "Racecar.php";
require_once "Race.php";

// storing serialised instances
function storeCars($carInstances){
  $carInstances = serialize($carInstances);
  $carFile = fopen("cardata.ser", "wb") or die("Unable to open file!");
  fwrite($carFile, $carInstances);
  fclose($carFile);
}

if( isset($_POST['functionname']) ) { 
    $aResult = array();
    $aResult['cars'] = Array();
    
    switch($_POST['functionname']) {

      // MAKECARS (or remove them)
       case 'makeCars': // MAKECAR =======================================
         //megadott számú kocsi instance legyárzása
          for ($i = 0; $i < $_POST['carNum']; $i++) {
            $car = new Racecar();
            Race::setCars( $car);
         }
         // megfelelő adatok kinyerése az instancekből
         $cars = Race::getCars();
          foreach ($cars as $car){
            $a = [];
            $a["placement"] = $car->getPlacement();
            $a["color"] = $car->getColor();
            $a["lap"] = $car->getLap();
            $a["maxLap"] = $car->getNumber_of_laps();
            $a["distance"] = $car->getDist();
            $aResult['cars'][] = $a;
          }
          storeCars(Race::getCars());
          break;
         case 'moveCars': // MOVECAR =======================================
          $myfile = fopen("cardata.ser", "r");
          $cars = fread($myfile,filesize("cardata.ser"));
          fclose($myfile);
          $cars = unserialize($cars);
            foreach ($cars as $car){
               $a = [];
               $car->move();
               $a['placemenet'] = $car->getPlacement();
               $a["maxLap"] = $car->getNumber_of_laps();
               $a['distance'] = $car->getDist();
               $aResult['cars'][] = $a;
            }
            storeCars($cars);
            break;
       default:
          $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
          break;
   }

   echo json_encode($aResult);
   }
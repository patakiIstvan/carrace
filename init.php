<?php

require_once "Racecar.php";

$cars = [];



if( isset($_POST['functionname']) ) { 
    $aResult = array();
    
    switch($_POST['functionname']) {

      // MAKECARS (or remove them)
       case 'makeCars': // MAKECAR =======================================
          $aResult['result'] = "succes";
         //megadott számú kocsi instance legyárzása
          for ($i = 0; $i < $_POST['carNum']; $i++) {
            $car = new Racecar();
            $cars[] = $car;
         }
         // megfelelő adatok kinyerése az instancekből
          $aResult['cars'] = Array();
          foreach ($cars as $car){
            $a = [];
            $a["placement"] = $car->getPlacement();
            $a["color"] = $car->getColor();
            $a["lap"] = $car->getLap();
            $a["maxLap"] = $car->getNumber_of_laps();
            $a["distance"] = $car->getDist();
            $aResult['cars'][] = $a;
          }
          break;

       default:
          $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
          break;
   }

   echo json_encode($aResult);
   }
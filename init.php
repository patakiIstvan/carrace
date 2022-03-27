<?php

require_once "Racecar.php";
require_once "Race.php";



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
          break;
         case 'moveCars':
          $cars = Race::getCars();
            foreach ($cars as $car){
               $a = [];
               $car->move();
               $a['distance'] = $car->getDist();
               $aResult['cars'][] = $a;
            }
           //$aResult["cars"] = Race::getCars();
            break;
       default:
          $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
          break;
   }

   echo json_encode($aResult);
   }
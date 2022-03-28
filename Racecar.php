<?php
require_once "Race.php";

class Racecar extends Race{
 private $current_lap;
 private $speed;
 private $color;
 private $placement;
 private $distance;
 private $colors = ["red","black","yellow","blue"];

 public function __construct(){
     $this->placement =  ++self::$number_of_cars;
     $this->color = $this->colors[($this->placement-1)%count($this->colors)];
     $this->speed = 0;
     $this->distance = 0;
     $this->current_lap = 1;
 }

 // gets and sets (tudom, a magic methodokat kéne itt használni)
 public function getColor(){
    return $this->color;
}
public function setColor($color){
    $this->color = $color;
}
 public function getLap(){
     return $this->current_lap;
 }
 public function setLap($lap){
     $this->current_lap = $lap;
 }
 public function getSpeed(){
    return $this->speed;
}
public function setSpeed(){
    $this->speed = rand(20,35)/10;
}
public function getPlacement(){
    return $this->placement;
}
public function getDist(){
    return $this->distance;
}
public function setDist($dist){
    $this->distance = $dist;
}
// real function
public function move(){
    $this->setSpeed();
    $this->setDist($this->getDist()+$this->getSpeed());
}
}


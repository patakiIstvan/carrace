<?php
require_once "Race.php";

class Racecar extends Race{
 private $speed;
 private $color;
 private $placement;
 private $distance;
 private $race_time;
 private $won_race;
 private $colors = ["red","black","yellow","blue"];

 public function __construct(){
     $this->placement =  ++self::$number_of_cars;
     $this->color = $this->colors[($this->placement-1)%count($this->colors)];
     $this->speed = 0;
     $this->distance = 0;
     $this->race_time = 0;
     $this->won_race = false;
 }

 // gets and sets (tudom, a magic methodokat kéne itt használni)
 public function getColor(){
    return $this->color;
}
public function setColor($color){
    $this->color = $color;
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
public function getTime(){
    return $this->race_time;
}
public function setTime($time){
    $this->race_time = $time;
}
public function getWon(){
    return $this->won_race;
}
public function setWon($won){
    $this->won_race = $won;
}
// real function
public function move(){
    $this->setSpeed();
    $wouldmove = $this->getDist()+$this->getSpeed();
    if ($this->getDist() < 100){
        if ($wouldmove<100){
            $this->setDist($wouldmove);
            $this->setTime($this->getTime()+1);
            } else {
            // Idő lineáris extrapolációja
                $moveLeft = 100-$this->getDist();
                $moveWouldLeft = $wouldmove-$this->getDist();
                $percentage = $moveLeft/$moveWouldLeft;
                $this->setTime(round(($this->getTime()+1*$percentage)*1000)/1000);
                $this->setDist(100);
                $this->setWon(true);
        } 
    } else {
        $this->setWon(false);
}
}
}
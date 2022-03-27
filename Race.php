<?php

class Race{
    protected static $raceStarted = false;
    protected static $number_of_cars = 0;
    protected static $number_of_laps = 3;
    private static $cars = [];

    public static function toggleStarted(){
        self::$raceStarted = !self::$raceStarted;
    }
    public static function getNumber_of_laps(){
        return self::$number_of_laps;
    }
    public static function setNumber_of_laps($laps){
        self::$number_of_laps = $laps;
    }
    public static function getNumber_of_cars(){
        return self::$number_of_cars;
    }

    public static function getCars(){
        return self::$cars;
    }

    public static function setCars($car){
        self::$cars[] = $car;
    }
}
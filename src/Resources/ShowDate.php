<?php
namespace App\Resources;

use DateTime;
//use Config\builder\Querybuilder;


class ShowDate{

    private $startDate;

    private $endDate;


    public function getDates(){

        $oDate = new DateTime();
        $this->startDate = $oDate->format("Y-m-d");
        $oDate->modify("+3 months");
        $this->endDate = $oDate->format("Y-m-d");
    }

    public function getStartdate(){
        return $this->startDate;
    }

    public function getEndDate(){
        return $this->endDate;
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function lastDayMonth(string $date)
    {
        $oDate = new DateTime($date);
        $oDate->modify('last day of this month');

        if($oDate->format('D') == 'Sat'){
            $oDate->modify('-1 day');
        }
        if($oDate->format('D') == 'Sat'){
            $oDate->modify('-2 day');
        }
        return $oDate->format('Y-m-d');
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function firstDayMonth(string $date){
        $oDate = new DateTime($date);
        $oDate->modify('first day of this month');

        if($oDate->format('D') == 'Sat'){
            $oDate->modify('+2 day');
        }
        if($oDate->format('D') == 'Sat'){
            $oDate->modify('+1 day');
        }
        return $oDate->format('Y-m-d');
    }

    public function arrayDates(){

        $oStartDate = new DateTime($this->startDate);
        $oEndDate = new DateTime($this->endDate);

        $day = 86400; // Day in seconds
        $format = 'Y-m-d'; // Output format (see PHP date funciton)
        $sTime = strtotime($oStartDate->format('Y-m-d')); // Start as time
        $eTime = strtotime($oEndDate->format('Y-m-d')); // End as time
        $numDays = round(($eTime - $sTime) / $day) + 1;
        $days = array();

        for ($d = 0; $d < $numDays; $d++) {
            $days[] = date($format, ($sTime + ($d * $day)));
        }
        return $days;
    }
}

<?php
namespace App\Resources;

use DateTime;
use http\QueryString;

class GenerateDates{

    private $startDate;

    private $endDate;

    public function getStartdate(){
        return $this->startDate;
    }

    public function getEndDate(){
        return $this->endDate;
    }

    /**
     * maak de eerste en laatste datum aan
     */
    public function getDates(){

        $oDate = new DateTime();
        $this->startDate = $oDate->format("Y-m-d");
        $oDate->modify("+3 months");
        $this->endDate = $oDate->format("Y-m-d");
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     *
     * Zoek de laatste werkdag van de maand
     */
    public function lastDayMonth(string $date): String
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
     *
     * Zoek de eerste werkdag van de maand
     */
    public function firstDayMonth(string $date): String
    {
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

    /**
     * @return array
     * @throws \Exception
     *
     * Maak een array van data
     */
    public function arrayDates(): array
    {
        $oStartDate = new DateTime($this->startDate);
        $oEndDate = new DateTime($this->endDate);

        $day = 86400;
        $format = 'Y-m-d';
        $sTime = strtotime($oStartDate->format('Y-m-d'));
        $eTime = strtotime($oEndDate->format('Y-m-d'));
        $numDays = round(($eTime - $sTime) / $day) + 1;
        $days = array();

        for ($d = 0; $d < $numDays; $d++) {
            $days[] = date($format, ($sTime + ($d * $day)));
        }
        return $days;
    }
}

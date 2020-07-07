<?php
namespace App\Planning;

use DateTime;
use App\Resources\ShowDate;

class MakePlanning{

    private $aActivities;

    private $aDates;

    private $aPlanning;

    public function setActivities(array $aValue){
        $this->aActivities = $aValue;
    }

    public function setDate(array $dates){
        $this->aDates = $dates;
    }

    /**
     * Maak de array
     */
    public function make()
    {
        $oShowDate = new ShowDate();
        $oShowDate->getDates();

        $aDay = [];
        $i = 0;
        foreach($oShowDate->arrayDates() as $date){

            $oDate = new DateTime($date);
            $aDay[$i]['datum'] = $oDate->format('Y-m-d');
            $aDay[$i]['werkzaamheden'] = "";
            $duration = 0;

            foreach($this->aActivities as $activity){
                $when = explode(',', $activity["when"]);


                if(in_array($oDate->format('l'), $when) == true){

                    $aDay[$i]['werkzaamheden'] = $activity["activity"];

                    $duration = $duration + $activity["duration"];
                }

                if($oShowDate->firstDayMonth($date) == $oDate->format('Y-m-d') && $activity["when"] == 'first day month'){

                    $aDay[$i]['werkzaamheden'] = strlen($aDay[$i]['werkzaamheden']) > 0 ? $aDay[$i]['werkzaamheden'].", ".$activity["activity"] : $activity["activity"] ;

                    $duration = $duration + $activity["duration"];
                }

                if($oShowDate->lastDayMonth($date) == $oDate->format('Y-m-d') && $activity["when"] == 'last day month'){

                    $aDay[$i]['werkzaamheden'] = strlen($aDay[$i]['werkzaamheden']) > 0 ? $aDay[$i]['werkzaamheden'].", ".$activity["activity"] : $activity["activity"] ;

                    $duration = $duration + $activity["duration"];
                }
                $aDay[$i]['duur'] = date('H:i', mktime(0,$duration));
            }
            $i++;
        }
        $this->aPlanning = $aDay;
    }

    public function getPlanning(){
        return $this->aPlanning;
    }
}

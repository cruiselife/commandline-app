<?php
namespace App\CSV;

use DateTime;
use App\Resources\ShowDate;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\writer;
use League\Csv\ArrayIterator;


class Makecsv{

    private $aInputArray;

    private $sFilename;

    private $aHeaders;

    public function setInputArray(array $aValue){
        $this->aInputArray = $aValue;
    }

    public function setFileName(string $sValue){
        $this->sFilename = $sValue;
    }

    public function CSV()
    {
        $this->header();

        $writer = Writer::createFromPath('csvfiles/'.$this->sFilename.'.csv', 'w+');
        $writer->insertOne($this->aHeaders);
        $writer->insertAll($this->aInputArray); //using an array

    }

    private function header(){
        $this->aHeaders = array_keys($this->aInputArray[0]);
    }





}

<?php
namespace App\CSV;

use DateTime;
use App\Resources\GenerateDates;
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

    /**
     * @throws \League\Csv\CannotInsertRecord
     *
     * Maak csv bestand en sla het op
     */
    public function CSV()
    {
        $this->getHeader();

        $writer = Writer::createFromPath('csvfiles/'.$this->sFilename.'.csv', 'w+');
        $writer->setDelimiter(';');
        $writer->insertOne($this->aHeaders);
        $writer->insertAll($this->aInputArray);

    }

    /**
     * Maak de header(koppen) voor het csv
     */
    private function getHeader(){
        $this->aHeaders = array_keys($this->aInputArray[0]);
    }
}
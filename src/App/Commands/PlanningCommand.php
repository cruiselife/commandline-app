<?php
namespace Console\App\Commands;

use App\Planning\MakePlanning;
use App\Resources\ShowDate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\CSV\Makecsv;
use Exception;
use DateTime;
//use Config\builder\Querybuilder;


class PlanningCommand extends Command
{
    private $activity = [
                            0=>[
                                "activity"=>'Stofzuigen',
                                "when"=>'Tuesday,Thursday',
                                'duration'=>21
                            ],
                            1=>[
                                "activity"=>'ramen_lappen',
                                "when"=>'last day month',
                                'duration'=>35
                            ],
                            2=>[
                                "activity"=>'koelkast_schoonmaken',
                                "when"=>'first day month',
                                'duration'=>50
                            ]
                        ];

    private $aDates;

    protected function configure()
    {
        $this->setName('make-planning')
            ->setDescription('Maak planning')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('username', InputArgument::OPTIONAL, 'Pass the username.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      //  $query = new Querybuilder();




        try{

            if(isset($this->activity) && is_array($this->activity)){

                //Haal de data op
                $oShowDate = new ShowDate();
                $oShowDate->getDates();
                $this->aDates = $oShowDate->arrayDates();

                // Maak de planning
                $oPlanning = new MakePlanning();
                $oPlanning->setDate($this->aDates);
                $oPlanning->setActivities($this->activity);
                $oPlanning->Make();
                $aPlanning = $oPlanning->getPlanning();

                // maak het csv bestand
                $oDate = new DateTime();

                $oMakecsv = new Makecsv();
                $oMakecsv->setInputArray($aPlanning);
                $oMakecsv->setFileName("planning_".$oDate->format('d-m-Y'));
                $oMakecsv->CSV(); // CSV files wordt gegenereerd in csvfiles/planning.csv

                //  $output->writeln(sprintf('Hello World!, %s', $input->getArgument('username')));

                $output->writeln(sprintf('CSV bestand is aangemaakt %s', ''));

            }else{
                throw new Exception('Er is geen array aangemaakt');
            }
            return 0;
        }catch(Exception $e){
            echo $e->getMessage();
            return 0;
        }
    }
}
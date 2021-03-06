<?php
namespace Console\App\Commands;

use App\Planning\MakePlanning;
use App\Resources\GenerateDates;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\CSV\Makecsv;
use Exception;
use DateTime;
use Config\builder\Querybuilder;


class PlanningCommand extends Command
{
    private $aActivity;

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
        // Haal de activiteiten op uit de database
        $query = new Querybuilder();
        $this->aActivity = $query->selectAll('activities');

        try{

            if(isset($this->aActivity) && is_array($this->aActivity)){

                //Maak de data (tijd) op voor 3 maanden
                $oShowDate = new GenerateDates();
                $oShowDate->getDates();
                $this->aDates = $oShowDate->arrayDates();

                // Maak de planning
                $oPlanning = new MakePlanning();
                $oPlanning->setDate($this->aDates);
                $oPlanning->setActivities($this->aActivity);
                $oPlanning->Make();
                $aPlanning = $oPlanning->getPlanning();

                // maak het csv bestand
                $oDate = new DateTime();

                $oMakecsv = new Makecsv();
                $oMakecsv->setInputArray($aPlanning);
                $oMakecsv->setFileName("planning_".$oDate->format('d-m-Y'));
                $oMakecsv->CSV(); // CSV files wordt gegenereerd in csvfiles/planning_.'met een datum'.csv

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
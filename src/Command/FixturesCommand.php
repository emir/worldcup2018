<?php

namespace Euro2016\Command;

use DateTime;
use DateTimeZone;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;

class FixturesCommand extends Command
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    public $timezone;

    /**
     * FixturesCommand constructor.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    protected function configure()
    {
        $this
            ->setName('fixtures')
            ->setDescription('Fixtures')
            ->addArgument(
                'status',
                InputArgument::OPTIONAL,
                'TODAY, FINISHED, ALL are valid options.'
            )
        ;
    }

    protected function fetch()
    {
        $request = $this->client->get('http://api.football-data.org/v1/soccerseasons/424/fixtures', [
            'headers' => [
                'X-AUTH-TOKEN' => '53e6bee2dade46858d67b06f85972363'
            ]
        ]);

        return json_decode($request->getBody()->getContents());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $status = strtoupper($input->getArgument('status'));

        if(!$status) {
            $status = 'TODAY';
        }

        $data = $this->fetch();

        foreach ($data->fixtures as $fixture) {
            if($status == 'ALL') {
                $match_date = new DateTime($fixture->date);
                $match_date->setTimezone( new DateTimeZone($this->timezone));

                $output->writeln("($fixture->status <comment>{$match_date->format('M, d - H:i')}</comment>) <info>{$fixture->homeTeamName} {$fixture->result->goalsHomeTeam} - {$fixture->awayTeamName} {$fixture->result->goalsAwayTeam}</info>");
            }

            if($status == 'FINISHED') {
                if($fixture->status == 'FINISHED') {
                    $match_date = new DateTime($fixture->date);
                    $match_date->setTimezone( new DateTimeZone($this->timezone));

                    $output->writeln("$fixture->status <comment>{$match_date->format('M, d - H:i')}:</comment> <info>{$fixture->homeTeamName} {$fixture->result->goalsHomeTeam} - {$fixture->awayTeamName} {$fixture->result->goalsAwayTeam}</info>");
                }
            }

            if($status == 'TODAY') {
                $today = new DateTime();
                $today->setTimezone(new DateTimeZone($this->timezone));

                $match_date = new DateTime($fixture->date);
                $match_date->setTimezone(new DateTimeZone($this->timezone));

                $interval = $today->diff($match_date);

                if($interval->days == 0) {
                    $output->writeln("($fixture->status <comment>{$match_date->format('M, d - H:i')}</comment>) <info>{$fixture->homeTeamName} {$fixture->result->goalsHomeTeam} - {$fixture->awayTeamName} {$fixture->result->goalsAwayTeam}</info>");
                }
            }
        }
    }
}

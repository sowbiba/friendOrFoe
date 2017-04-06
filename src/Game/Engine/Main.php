<?php

namespace Hackathon\Game;

use Hackathon\Game\Engine;
use Hackathon\Game\Result;
use Hackathon\Game\Display;

/**
 * Class Main
 * @package Hackathon\Game
 */
class Main
{
    private $contenders = array();

    public function __construct()
    {
        $this->contenders = $this->searchContenders();
    }

    /**
     * This function executes the project
     * - We generate the matchs (a vs b)
     * - Initialize the Display class
     * - Play match one at a time and update Display with the restul
     */
    public function execute()
    {
        $matchs = $this->generateMatchs();

        $display = new Display($this->contenders);
        foreach ($matchs as $match) {
            $playerA = $match['a'];
            $playerA->setSide('a');

            $playerB = $match['b'];
            $playerB->setSide('b');

            $result = new Result($playerA->getName(), $playerB->getName());
            $playerA->updateResult($result);
            $playerB->updateResult($result);

            $engine = new Engine();
            $maxRound = $engine->maxRound;
            for ($i = 1; $i <= $maxRound; $i++) {
                $roundResult = $engine->playOneRound($playerA, $playerB);
                $result = $result->update($roundResult);
                $playerA->updateResult($result);
                $playerB->updateResult($result);
            }
            $display->pushResult($result->getStats());
        }

        $display->generateHTML();
    }

    /**
     * @return array
     * This function generates all the matchs
     * - the array gives the combinaison of all the possible match.
     */
    private function generateMatchs()
    {
        $matchs = array();
        $contenders = $this->contenders;
        $len = count($contenders);

        for ($i = 0; $i <= $len; $i++) {
            for ($j = $i + 1; $j < $len; $j++) {
                $playerA = "Hackathon\\PlayerIA\\" . $contenders[$i] . 'Player';
                $playerB = "Hackathon\\PlayerIA\\" . $contenders[$j] . 'Player';
                $matchs[] = array('a' => new $playerA, 'b' => new $playerB);
            }
        }

        return $matchs;
    }

    /**
     * @return array
     *
     * This function returns the list of the contenders
     */
    public function getContenders()
    {
        return $this->contenders;
    }

    /**
     * @return array
     *
     * This function list all the implementation of the abstract Player Class
     */
    private function searchContenders()
    {
        $files = scandir(__DIR__.'/../PlayerIA/', SCANDIR_SORT_ASCENDING);
        $contenders = array();

        foreach ($files as $file) {
            $end = substr($file, -10);
            if (($end === "Player.php") && ($file !== "Player.php")) {
                $contenders[] = substr($file, 0, -10);
            }
        }

        return $contenders;
    }
}

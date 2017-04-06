<?php

/**
 * DONT TOUCH
 */
namespace Hackathon\Game;

/**
 * Class Result
 * @package Hackathon\Game
 */
class Result
{
    private $playerAScores = array();
    private $playerAChoices = array();
    private $playerBScores = array();
    private $playerBChoices = array();
    private $playerAName;
    private $playerBName;
    private $nbRound = 0;

    /**
     * Result constructor.
     * @param $playerAName
     * @param $playerBName
     */
    public function __construct($playerAName, $playerBName)
    {
        $this->playerAName = $playerAName;
        $this->playerBName = $playerBName;
    }

    /**
     * @param $result
     * This function push the different score and choice on an array for each player
     *   and increment the number of round.
     */
    public function update($result)
    {
        $this->playerAScores[] = $result['a']['score'];
        $this->playerAChoices[] = $result['a']['choice'];

        $this->playerBScores[] = $result['b']['score'];
        $this->playerBChoices[] = $result['b']['choice'];

        $this->nbRound++;

        return $this;
    }

    /**
     * @return string
     * This function returns the stats in a string
     */
    public function getPrettyStats()
    {
        $stats = $this->getStats();

        $resultA = sprintf("%s has %s points with %s friend and %s foe",
                                $stats['a']['name'],
                                $stats['a']['score'],
                                $stats['a']['friend'],
                                $stats['a']['foe']);

        $resultB = sprintf("%s has %s points with %s friend and %s foe",
                                $stats['b']['name'],
                                $stats['b']['score'],
                                $stats['b']['friend'],
                                $stats['b']['foe']);

        return $resultA . "\t" . $resultB . PHP_EOL;
    }

    /**
     * @return array
     * This function analyse all the arrays and construct an array with all the results
     */
    public function getStats()
    {
        // Init value for PlayerA
        $scoreA = 0;
        $nbFriendA = 0;
        $nbFoeA = 0;

        // Stats for PlayerA - Score
        $scoresA = $this->getScoresFor('a');
        foreach ($scoresA as $score) {
            $scoreA += $score;
        }

        // Stats for PlayerA - Choice
        $choicesA = $this->getChoicesFor('a');
        foreach ($choicesA as $choice) {
            if ($choice === 'friend') {
                $nbFriendA++;
            }
            if ($choice === 'foe') {
                $nbFoeA++;
            }
        }

        // Init value for PlayerB
        $scoreB = 0;
        $nbFriendB = 0;
        $nbFoeB = 0;

        // Stats for PlayerB - Score
        $scoresB = $this->getScoresFor('b');
        foreach ($scoresB as $score) {
            $scoreB += $score;
        }

        // Stats for PlayerB - Choice
        $choicesB = $this->getChoicesFor('b');
        foreach ($choicesB as $choice) {
            if ($choice === 'friend') {
                $nbFriendB++;
            }
            if ($choice === 'foe') {
                $nbFoeB++;
            }
        }

        return array('a' => array('name' => $this->playerAName,
                                  'friend' => $nbFriendA,
                                  'foe' => $nbFoeA,
                                  'score' => $scoreA),

                     'b' => array('name' => $this->playerBName,
                                  'friend' => $nbFriendB,
                                  'foe' => $nbFoeB,
                                  'score' => $scoreB));
    }

    /**
     * @param $playerSide
     * @return mixed
     *
     * This function gives the stats for one Player ('a' or 'b')
     */
    public function getStatsFor($playerSide)
    {
        $stats = $this->getStats();

        if (strtolower($playerSide) !== "a" && strtolower($playerSide) !== "b") {
            throw new \BadMethodCallException("We except the letter 'A' or 'B'");
        }

        return $stats[strtolower($playerSide)];
    }

    /**
     * @return int
     *
     * This function returns the number of round
     */
    public function getNbRound()
    {
        return $this->nbRound;
    }

    /**
     * @param $playerSide
     * @return mixed
     *
     * This function returns the array of score for one Player ('a' or 'b')
     */
    public function getScoresFor($playerSide)
    {
        if (strtoupper($playerSide) !== "A" && strtoupper($playerSide) !== "B") {
            throw new \BadMethodCallException("We except the letter 'A' or 'B'");
        }
        $side = 'player'.strtoupper($playerSide).'Scores';

        return $this->$side;
    }

    /**
     * @param $playerSide
     * @return int
     *
     * This function returns the last score for one Player ('a' or 'b')
     */
    public function getLastScoreFor($playerSide)
    {
        if (strtoupper($playerSide) !== "A" && strtoupper($playerSide) !== "B") {
            throw new \BadMethodCallException("We except the letter 'A' or 'B'");
        }

        $scores = $this->getScoresFor($playerSide);
        $lastIndex = count($scores) - 1;

        if ($lastIndex < 0) {
            return 0;
        }

        return $scores[$lastIndex];
    }

    /**
     * @param $playerSide
     * @return mixed
     *
     * This function returns the array of choice for one Player ('a' or 'b')
     */
    public function getChoicesFor($playerSide)
    {
        if (strtoupper($playerSide) !== "A" && strtoupper($playerSide) !== "B") {
            throw new \BadMethodCallException("We except the letter 'A' or 'B'");
        }
        $side = 'player'.strtoupper($playerSide).'Choices';

        return $this->$side;
    }

    /**
     * @param $playerSide
     * @return mixed
     *
     * This function returns the last choice for one Player ('a' or 'b')
     */
    public function getLastChoiceFor($playerSide)
    {
        if (strtoupper($playerSide) !== "A" && strtoupper($playerSide) !== "B") {
            throw new \BadMethodCallException("We except the letter 'A' or 'B'");
        }

        $choices = $this->getChoicesFor($playerSide);
        $lastIndex = count($choices) - 1;

        if ($lastIndex < 0) {
            return 0;
        }

        return $choices[$lastIndex];
    }
};

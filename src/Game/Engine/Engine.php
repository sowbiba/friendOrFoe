<?php

namespace Hackathon\Game;

use Hackathon\PlayerIA\Player;

/**
 * Class Engine
 * @package Hackathon\Game
 *
 * This class is the game engine.
 * We set the maximum round of a match in the this class
 */
class Engine
{
    // The maximum round plays in a match
    public $maxRound = 1000;

    // Set it to true, if you want to display infos into the console
    public $consoleOutput = false;

    /**
     * @param Player $playerA
     * @param Player $playerB
     * @return array
     *
     * This function plays one round.
     * - First, we take the choice of each Player
     * - Then, we check if it is possible to use it
     * - At the end, we return the score
     */
    public function playOneRound(Player $playerA, Player $playerB)
    {
        $choiceA = $playerA->getChoice();
        $choiceB = $playerB->getChoice();

        if ($choiceA !== 'friend' && $choiceA !== 'foe') {
            throw new \InvalidArgumentException("$playerA->getName() || Cheater: you can reply 'friend' or 'foe'");
        }

        if ($choiceB !== 'friend' && $choiceB !== 'foe') {
            throw new \InvalidArgumentException("$playerB->getName() || Cheater: you can reply 'friend' or 'foe'");
        }

        $matrix['friend']['friend'] = array('a' => 3, 'b' => 3);
        $matrix['foe']['friend'] = array('a' => 5, 'b' => 0);
        $matrix['friend']['foe'] = array('a' => 0, 'b' => 5);
        $matrix['foe']['foe'] = array('a' => 1, 'b' => 1);

        $scoreA = $matrix[$choiceA][$choiceB]['a'];
        $scoreB = $matrix[$choiceA][$choiceB]['b'];

        if ($this->consoleOutput) {
            echo $playerA->getName(), " plays ", $choiceA, " \t ", $playerB->getName(), " plays ", $choiceB, PHP_EOL, "\t",
                "Score A : $scoreA \t Score B : $scoreB", PHP_EOL;
        }

        return array('a' => array('choice' => $choiceA,
                                  'score' => $scoreA),
                     'b' => array('choice' => $choiceB,
                                  'score' => $scoreB));
    }
};

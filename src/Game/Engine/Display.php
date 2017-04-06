<?php

namespace Hackathon\Game;

/**
 * Class Display
 * @package Hackathon\Game
 *
 * This class stores all the results and can generate a html report from the fight
 */
class Display
{
    private $results;
    private $contenders;

    /**
     * Display constructor.
     * @param $contenders
     *
     * The constructor initialize the private property $contenders and fix the score for each one to 0
     */
    public function __construct($contenders)
    {
        $keys = $contenders;
        $values = array_fill(0, count($contenders), 0);

        $this->contenders = array_combine($keys, $values);
    }

    /**
     * @param $result
     *
     * This function push a new Result of a match between two contenders
     */
    public function pushResult($result)
    {
        $this->results[] = $result;
    }

    /**
     * This function generates a HTML files with all the values
     */
    public function generateHTML()
    {
        $head = <<<EOHEAD
<html>
<body>
<table style="border:1px">
<tr>
    <td><strong>Player A</strong></td>
    <td>Score</td>
    <td>Friend</td>
    <td>Foe</td>
    <td><strong>Player B</strong></td>
    <td>Score</td>
    <td>Friend</td>
    <td>Foe</td>
</tr>
EOHEAD;

        $resultsByMatch = "<tr>";
        foreach ($this->results as $result) {
            $playerA = $result['a'];
            $resultsByMatch .= '<td>'.$playerA['name'].'</td>'.PHP_EOL.'<td>'.$playerA['score'].'</td>'.PHP_EOL;
            $resultsByMatch .= '<td>'.$playerA['friend'].'</td>'.PHP_EOL.'<td>'.$playerA['foe'].'</td>'.PHP_EOL;
            $this->contenders[$playerA['name']] = $this->contenders[$playerA['name']] + $playerA['score'];

            $playerB = $result['b'];
            $resultsByMatch .= '<td>'.$playerB['name'].'</td>'.PHP_EOL.'<td>'.$playerB['score'].'</td>'.PHP_EOL;
            $resultsByMatch .= '<td>'.$playerB['friend'].'</td>'.PHP_EOL.'<td>'.$playerB['foe'].'</td>'.PHP_EOL;
            $this->contenders[$playerB['name']] = $this->contenders[$playerB['name']] + $playerB['score'];

            $resultsByMatch .= '</tr>';
        }
        $resultsByMatch .= '</table><br /><br /><br />';


        $resultsByPlayer = "<table>";
        arsort($this->contenders);
        $total = 0;
        foreach ($this->contenders as $contenderName => $contenderScore) {
            $total += $contenderScore;
            $resultsByPlayer .= '<tr><td>'.$contenderName.'</td><td>'. $contenderScore .'</td></tr>'. PHP_EOL;
        }


        $resultsByPlayer .= '<tr><td><strong>Total</strong></td><td><strong>'. $total .'</strong></td></tr>'. PHP_EOL;
        $resultsByPlayer .= "</table>";


        $footer = <<<EOFOOTER
</body>
</html>
EOFOOTER;


        $fp = fopen('index.html', 'w');
        fwrite($fp, $head);
        fwrite($fp, $resultsByMatch);
        fwrite($fp, $resultsByPlayer);
        fwrite($fp, $footer);
        fclose($fp);
    }
};

<?php
namespace Hackathon\Tests;

use Hackathon\Game\Result;
use Hackathon\Game\Main;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider classNameProvider
     */
    public function testPlop($contender)
    {
        $className = "Hackathon\\PlayerIA\\" . $contender . 'Player';
        $a = new $className;
        $this->assertEquals($contender, $a->getName());
    }

    /**
     * @dataProvider classNameProvider
     */
    public function testFirstChoice($contender)
    {
        $className = "Hackathon\\PlayerIA\\" . $contender . 'Player';
        $a = new $className;
        $result = new Result($a->getName(), $a->getName());
        $a->updateResult($result);
        $choice = $a->getChoice();
        $isItFoeOrFriend = (($choice === 'foe') || ($choice === 'friend'));
        $this->assertTrue($isItFoeOrFriend);
    }

    /**
     * @dataProvider classNameProvider
     */
    public function testChoices($contender)
    {
        $className = "Hackathon\\PlayerIA\\" . $contender . 'Player';
        $a = new $className;

        $this->assertEquals($a->friendChoice(), 'friend');
        $this->assertEquals($a->foeChoice(), 'foe');
    }

    public function classNameProvider()
    {
        $main = new Main();
        $mainContenders = $main->getContenders();
        $contenders = array($mainContenders);

        return $contenders;
    }

    /** Je vérifie que vous ne modifiez pas les fichiers BANDE de COQUINOUX */
    public function testFiles()
    {
        $gameFileName = __DIR__.'/../Game/Engine/Display.php';
        $this->assertEquals(md5_file($gameFileName), 'ce31d479c3713ec763e76a386ab00479');

        $gameFileName = __DIR__.'/../Game/Engine/Engine.php';
        $this->assertEquals(md5_file($gameFileName), '88e73b4f0a3c427dbc1c59dd6d200492');

        $gameFileName = __DIR__.'/../Game/Engine/Main.php';
        $this->assertEquals(md5_file($gameFileName), '0f9a7023df66a1e2173b71cb1520ac3f');

        $gameFileName = __DIR__.'/../Game/Engine/Result.php';
        $this->assertEquals(md5_file($gameFileName), '424861e8cf115164f0d0ecdb8b175fe1');

        $gameFileName = __DIR__.'/../Game/PlayerIA/Player.php';
        $this->assertEquals(md5_file($gameFileName), '85985fcc68177bf80dc98b4332ced9a5');

        $gameFileName = __DIR__.'/../../EntryPoint.php';
        $this->assertEquals(md5_file($gameFileName), '938e58cdb274399bdd340071e2415bdd');
    }
}

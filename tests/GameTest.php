<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonReponse;

class GameTest extends TestCase{
	public $tools;
    public $win;
    public $draw;
    public $loose;
    public $lastIndex;
    public $firstIndex;
    //init value
    function __construct() {
        $this->tools = config('global.GAME.TOOLS');
        $this->win = config('global.GAME.WIN');
        $this->draw = config('global.GAME.DRAW');
        $this->loose = config('global.GAME.LOOSE');
        $this->firstIndex = config('global.GAME.FIRST_INDEX');
        $this->lastIndex = config('global.GAME.LAST_INDEX');
    }
    public function testSimple(){
    	$this->assertTrue(true);
    }
    /**
     * test player vs computer
     * @return [type] [description]
     */
	public function testGame(){
		$this->visit('/game');			
		$this->seePageis('/game');
		$uri = '/game/play';
		$method = 'POST';
		$player = 0;
		$parameters = array('intToolIdx' => $player);
        $response = $this->call($method, $uri, $parameters);
        $content = json_decode($response->getContent(),true);
        echo $rtRs = $content["rs"];
        echo $computer = $content["rp"];

        if($player > $computer){
            $rs = $this->win;
        }
        else{
            $rs = $this->loose;
        }
        //first-end case
        if($player==$this->lastIndex && $computer==$this->firstIndex){
            $rs = $this->loose;
        }
        if($player==$this->firstIndex && $computer==$this->lastIndex){
            $rs = $this->win;
        }

        //$response = $this->call($method, $uri, $parameters, $cookies, $files, $server, $content);
		//$this->assertRedirectedToAction('GameController@play');
        //$this->assertEquals('Hello World', $response->getContent());
	}

	/**
	 * test computer vs computer
	 */
	public function testCVSC(){
		$this->visit('/cvsc')			
			->seePageis('/cvsc');
		$uri = '/game/playCVSC';
		$method = 'POST';
		$parameters = array('intToolIdx' => 0);
        $response = $this->call($method, $uri, $parameters);
        $content = json_decode($response->getContent(),true);
        echo $rs = $content["rs"];
        echo $rp = $content["rp"];
	}
}

?>
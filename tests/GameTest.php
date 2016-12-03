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
        $const = [
            //for game
            'GAME' => [
                'TOOLS' => array('rock', 'paper', 'scissors'),
                'LAST_INDEX' => 2,
                'FIRST_INDEX' => 0,
                'WIN' => 1,
                'DRAW' => 0,
                'LOOSE' => -1
            ]
            
        ];
        $this->tools = $const['GAME']['TOOLS'];
        $this->win = $const['GAME']['WIN'];
        $this->draw = $const['GAME']['DRAW'];
        $this->loose = $const['GAME']['LOOSE'];
        $this->firstIndex = $const['GAME']['FIRST_INDEX'];
        $this->lastIndex = $const['GAME']['LAST_INDEX'];
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
		//case rock
		$player = 0;
		$parameters = array('intToolIdx' => $player);
        $response = $this->call($method, $uri, $parameters);
        $content = json_decode($response->getContent(),true);
        echo $rtRs = $content["rs"];
        echo $computer = $content["rp"];
        $rs = "";
        if($player == $computer){
            $rs = $this->draw;
        }
        else{
            //normal case
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
        }

        //$response = $this->call($method, $uri, $parameters, $cookies, $files, $server, $content);
		//$this->assertRedirectedToAction('GameController@play');
        $this->assertEquals($rtRs, $rs);
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
        /*echo $rs = $content["rs"];
        echo $rp = $content["rp"];*/
	}
}

?>
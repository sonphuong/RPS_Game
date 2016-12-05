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


    //draw case
    public function testCase00(){
    	$player = 0; 
    	$computer = 0;
    	$rs = $this->compare($player,$computer);
        $this->assertEquals(0, $rs);
    }


    //loose case
    public function testCase01(){
    	$player = 0; 
    	$computer = 1;
    	$rs = $this->compare($player,$computer);
        $this->assertEquals(-1, $rs);

    }


    //win case    
    public function testCase02(){
    	$player = 0; 
    	$computer = 2;
    	$rs = $this->compare($player,$computer);
        $this->assertEquals(1, $rs);

    }


    //win case
    public function testCase10(){
    	$player = 1; 
    	$computer = 0;
    	$rs = $this->compare($player,$computer);
        $this->assertEquals(1, $rs);

    }


    //loose case
    public function testCase12(){
    	$player = 1; 
    	$computer = 2;
    	$rs = $this->compare($player,$computer);
        $this->assertEquals(-1, $rs);
    }


    //win case
    public function testCase21(){
    	$player = 2; 
    	$computer = 1;
    	$rs = $this->compare($player,$computer);
        $this->assertEquals(1, $rs);
    }


    //loose
    public function testCase20(){
    	$player = 2; 
    	$computer = 0;
    	$rs = $this->compare($player,$computer);
        $this->assertEquals(-1, $rs);
    }


    /**
     * test player vs computer
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
        $rtRs = $content["rs"];
        $computer = $content["rp"];
        $rs = $this->compare($player,$computer);
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
        $rtRs = $content["rs"];
        $com1 = $content["com1"];
        $com2 = $content["com2"];
        $rs = $this->compare($com1,$com2);
        $this->assertEquals($rtRs, $rs);
	}

    /**
     * compare 1st param to 2nd param
     * @param  $player
     * @param  $computer
     * @return [int] 0: draw case, 1: win case, -1: loose case
     */
    public function compare($player,$computer){
        $rs = "";
        if($player === $computer){
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
            if($player === $this->lastIndex && $computer === $this->firstIndex){
                $rs = $this->loose;
            }
            if($player === $this->firstIndex && $computer === $this->lastIndex){
                $rs = $this->win;
            }
        }
        return $rs;
    }
}

?>
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
class GameController extends Controller
{
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
    
    /**
     * when user choose an icon and ajax request will be sent to play function
     * play function select a random options from rps to return to client
     * @return  
     * 0: equal
     * -1: you lose
     * 1: you win 
    **/ 
    public function play(Request $request){
        $player = $request->input('intToolIdx'); 
        $computer = array_rand($this->tools); //get index
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
        return response()->json([
            'rs' => $rs,
            'rp' => $computer
        ]);
    }
    /**
     * computer vs computer
     * 
    **/
    public function playCVSC(){
        $com1 = array_rand($this->tools); //get index
        $com2 = array_rand($this->tools); //get index
        $rs = "";
        if($com1 == $com2){
            $rs = $this->draw;
        }
        else{
            //normal case
            if($com1 > $com2){
                $rs = $this->win;
            }
            else{
                $rs = $this->loose;
            }
            //first-end case
            if($com1==$this->lastIndex && $com2==$this->firstIndex){
                $rs = $this->loose;
            }
            if($com1==$this->firstIndex && $com2==$this->lastIndex){
                $rs = $this->win;
            }
        }
        return response()->json([
            'rs' => $rs,
            'com1' => $com1,
            'com2' => $com2
        ]);
    }
}

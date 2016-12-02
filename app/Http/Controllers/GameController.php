<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
class GameController extends Controller
{
    const LAST_INDEX = 2;
    const FIRST_INDEX = 0;
    const WIN = 1;
    const EQUAL = 0;
    const LOOSE = -1;
    const TOOLS = array('rock', 'paper', 'scissors');
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
        $computer = array_rand(self::TOOLS); //get index
        $rs = "";
        if($player == $computer){
            $rs = self::EQUAL;
        }
        else{
            //normal case
            if($player > $computer){
                $rs = self::WIN;
            }
            else{
                $rs = self::LOOSE;
            }
            //first-end case
            if($player==self::LAST_INDEX && $computer==self::FIRST_INDEX){
                $rs = self::LOOSE;
            }
            if($player==self::FIRST_INDEX && $computer==self::LAST_INDEX){
                $rs = self::WIN;
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
        $com1 = array_rand(self::TOOLS); //get index
        $com2 = array_rand(self::TOOLS); //get index
        $rs = "";
        if($com1 == $com2){
            $rs = self::EQUAL;
        }
        else{
            //normal case
            if($com1 > $com2){
                $rs = self::WIN;
            }
            else{
                $rs = self::LOOSE;
            }
            //first-end case
            if($com1==self::LAST_INDEX && $com2==self::FIRST_INDEX){
                $rs = self::LOOSE;
            }
            if($com1==self::FIRST_INDEX && $com2==self::LAST_INDEX){
                $rs = self::WIN;
            }
        }
        return response()->json([
            'rs' => $rs,
            'com1' => $com1,
            'com2' => $com2
        ]);
    }
}

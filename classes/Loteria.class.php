<?php

class Loteria{

    private $qtdDezenas;
    private $result;
    private $totalGames;
    private $games;
    public $arrayNumbers;

    public function __construct($qtdDezenas, $totalGames){
        $this->setQtdDezenas($qtdDezenas);
        $this->setTotalGames($totalGames);
    }

	function getQtdDezenas() { 
 		return $this->qtdDezenas; 
	} 

	function setQtdDezenas($qtdDezenas) {  
        if($qtdDezenas >= 6 && $qtdDezenas <=10){
        $this->qtdDezenas = $qtdDezenas; 
        }
	} 

	function getResult() { 
 		return $this->result; 
	} 

	function setResult($result) {  
		$this->result = $result; 
	} 

	function getTotalGames() { 
 		return $this->totalGames; 
	} 

	function setTotalGames($totalGames) {  
		$this->totalGames = $totalGames; 
	} 

	function getGames() { 
 		return $this->games; 
	} 

	function setGames($games) {  
		$this->games = $games; 
    } 

    private function createNumbers(){
        $numbers = [];
        for($i=1; $i <=60; $i++){
            array_push($numbers,$i);
        }
        return $numbers;
    }
    
    private function makeGame(){
        $numbers= $this->createNumbers();

        $game = array_rand(array_flip($numbers), $this->getQtdDezenas());
        
        sort($game);

        return $game;
    }

    public function generateGames(){
        $games = [];
        for($i = 0; $i < $this->getTotalGames(); $i++){
            $games[$i]['numbers'] = $this->makeGame();
        }

        $this->setGames($games);
    }

    public function draw(){
        $numbers = $this->createNumbers();
        $result = [];

        for($i = 0; $i < 6; $i++){
            $numberSelected = array_rand($numbers,1);
            if(!array_search($numberSelected, $result)){
                array_push($result, $numberSelected);
            }
        }

        sort($result);

        $this->setResult($result);
    }

    public function lotteryResult(){
        $this->generateGames();
        $this->draw();
        $games = $this->getGames();
        
        $result = $this->getResult();

        for($i=0;$i<sizeof($games);$i++){
           $games[$i]['hits'] = 0;

        foreach($result as $k => $v){
            if(array_search($v, $games[$i]['numbers'])){
                $games[$i]['hits'] += 1; 
            }
        }

       }
       echo json_encode(['result' => $result, 'games'=>$games]);
    }

    
}
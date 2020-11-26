<?php

require_once('classes/Loteria.class.php');

$data = json_decode(file_get_contents("php://input"), true);

$Loteria = new Loteria($data['qtdDezenas'], $data['totalGames']);
echo $Loteria->lotteryResult();
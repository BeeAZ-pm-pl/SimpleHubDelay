<?php

namespace BeeAZZ\SimpleHubDelay;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use BeeAZZ\SimpleHubDelay\Main;

class UpdateTask extends Task{
 
 private $main;
 private $name;
  
 public function __construct(Main $main, $name){
  $this->main = $main;
  $this->playerName = $name;
 }
 public function onRun(): void{
  $player =  $this->main->getServer()->getPlayerExact($this->playerName);
  $player->teleport($this->main->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
  $player->sendMessage($this->main->getConfig()->get("message-success"));
 }
}

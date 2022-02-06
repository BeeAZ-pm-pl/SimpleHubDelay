<?php

namespace SimpleHubDelay;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender};

class Main extends PluginBase implements Listener{
  
  public function onEnable(): void{
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
   $this->saveDefaultConfig();
  }

  public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args): bool{
  switch($cmd->getName()){
    case "hub":
  if(!$sender instanceof Player){
    $sender->sendMessage("Please Use Command In Game");
    return true;
  }
  if($sender->hasPermission("hub.command")){
  $message = str_replace("{SECOND}", $this->getConfig()->get("delay"), $this->getConfig()->get("message"));
  $sender->sendMessage($message);
  $this->getScheduler()->scheduleDelayedTask(new UpdateTask($this, $sender->getName()), 20 * $this->getConfig()->get("delay"));
  }
  }
  return true;
  }
}

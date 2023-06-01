<?php
declare(strict_types=1);

namespace BeeAZZ\SimpleHubDelay;

use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	public function onEnable() : void{
		$this->saveDefaultConfig();
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if($command->getName() == "hub"){
			if(!$sender instanceof Player){
				$sender->sendMessage($this->getConfig()->get("message-useingame"));
				return true;
			}
			if($sender->hasPermission("simplehubdelay.command")){
				$message = str_replace("{SECONDS}", $this->getConfig()->get("delay"), $this->getConfig()->get("message-delay"));
				$sender->sendMessage($message);
				$this->getScheduler()->scheduleDelayedTask(new UpdateTask($this, $sender), 20 * (int)$this->getConfig()->get("delay"));
			}
		}
		return true;
	}
}

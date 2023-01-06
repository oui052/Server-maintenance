<?php

namespace _oui053\ServerMaintaince;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use _oui053\ServerMaintaince\Task\Task_10_min;
use _oui053\ServerMaintaince\Task\Task_1_min;
use _oui053\ServerMaintaince\Task\Task_30_min;
use _oui053\ServerMaintaince\Task\Task_5_min;
use _oui053\ServerMaintaince\Task\Task_15_min;
                                                                                                          
class Main extends PluginBase{
    public function onEnable():void{
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender , Command $command , string $lable ,array $args ):bool{
        if ($command->getName() == "serverm_30_min"){

            $tickspersecond = $this->getServer()->getTicksPerSecondAverage();
            $this->getScheduler()->scheduleDelayedTask(new Task_1_min(), 29*60*$tickspersecond);    //1min
            $this->getScheduler()->scheduleDelayedTask(new Task_5_min(), 25*60*$tickspersecond);    //10min
            $this->getScheduler()->scheduleDelayedTask(new Task_10_min(), 20*60*$tickspersecond);   //10min
            $this->getScheduler()->scheduleDelayedTask(new Task_15_min(), 15*60*$tickspersecond);   //15min
            $this->getScheduler()->scheduleTask(new Task_30_min());                                 //30min
            return true;
        }
        if ($command->getName() == "serverm_stop"){
            $this->getScheduler()->cancelAllTasks();
            foreach($this->getServer()->getWorldManager()->getWorlds() as $world){
                $world->save();
            }
            $this->getServer()->broadcastTitle("Maintaince interrupted!", "by " . TextFormat::DARK_RED . $sender->getName(), -1, -1, -1, Server::getInstance()->getOnlinePlayers());
            $this->getServer()->getLogger()->info("Maintaince interrupted! by " . TextFormat::DARK_RED . $sender->getName());
            return true;
        }
        return true;
    }
}
<?php

namespace _oui053\ServerMaintaince\Task;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class Task_1_min extends Task{
    public function onRun():void{
        Server::getInstance()->broadcastTitle("The Server will go down in 60 seconds.", "from now on it isn't interrupteble anymore!", -1, -1, -1, Server::getInstance()->getOnlinePlayers());
        Server::getInstance()->getLogger()->warning("The Server will go down in 60 seconds.");
        sleep(60);
        Server::getInstance()->shutdown();
    }
}
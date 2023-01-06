<?php

namespace _oui053\ServerMaintaince\Task;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class Task_15_min extends Task
{
    public function onRun():void
    {
        Server::getInstance()->getLogger()->warning("The Server will go down in 15 minutes.");
        Server::getInstance()->broadcastTitle("Server will go down in 15 minutes.", "", -1, -1, -1, Server::getInstance()->getOnlinePlayers());
    }
}
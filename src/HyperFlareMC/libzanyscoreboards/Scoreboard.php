<?php

declare(strict_types=1);

namespace HyperFlareMC\libzanyscoreboards;

use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\Player;
use pocketmine\utils\MainLogger;

class Scoreboard{

    /**
     * @var array
     */
    public $scoreboards;

    public function sendToPlayer(Player $player, string $objectiveName, string $displayName) : void{
        if(isset($this->scoreboards[$player->getName()])){
            $this->removeFromPlayer($player);
        }
        $pk = new SetDisplayObjectivePacket();
        $pk->displaySlot = "sidebar";
        $pk->objectiveName = $objectiveName;
        $pk->displayName = $displayName;
        $pk->criteriaName = "dummy";
        $pk->sortOrder = 0;
        $player->sendDataPacket($pk);
        $this->scoreboards[$player->getName()] = $player->getName();
    }

    public function removeFromPlayer(Player $player) : void{
        $objectiveName = $this->getObjectiveName($player);
        $pk = new RemoveObjectivePacket();
        $pk->objectiveName = $objectiveName;
        $player->sendDataPacket($pk);
        unset($this->scoreboards[$player->getName()]);
    }

    public function addLine(Player $player, int $line, string $message) : void{
        if(!isset($this->scoreboards[$player->getName()])){
            MainLogger::$logger->info("Can't set a score to a player that has no scoreboard!");
            return;
        }
        if($line > 15 || $line < 1){
            MainLogger::$logger->info("Score value must be between 1 and 15, invalid $line given");
            return;
        }
        $objectiveName = $this->getObjectiveName($player);
        $entry = new ScorePacketEntry();
        $entry->objectiveName = $objectiveName;
        $entry->type = $entry::TYPE_FAKE_PLAYER;
        $entry->customName = $message;
        $entry->score = $line;
        $entry->scoreboardId = $line;
        $pk = new SetScorePacket();
        $pk->type = $pk::TYPE_CHANGE;
        $pk->entries[] = $entry;
        $player->sendDataPacket($pk);
    }

    public function getObjectiveName(Player $player) : ?string{
        return $this->scoreboards[$player->getName()] ?? null;
    }

}
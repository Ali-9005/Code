<?php

namespace code\Events;

use code\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class ChatEvent implements Listener {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onChat(PlayerChatEvent $event) {
        $player = $event->getPlayer();
        $message = $event->getMessage();
        $code = $this->plugin->getConfig()->get("code");
        $name = $player->getName();
        $uniq = uniqid();

            if($message === $code) {
                $this->plugin->getServer()->broadcastMessage("§c$name §ahe/she got it");
                $this->plugin->getConfig()->set("code", $uniq);
                $this->plugin->getConfig()->save();
        }
    }
}
<?php

namespace code\Commands;

use code\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class CodeCommands extends PluginCommand {

    private $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("code", $plugin);
        $this->plugin = $plugin;
        $this->setDescription("Code Commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player) {
            $prefix = $this->plugin->prefix;
            if(!isset($args[0])) {
                $sender->sendMessage("$prefix Error, /code help");
            }

            if(isset($args[0])) {
                switch ($args[0]){
                    case "help":
                        $sender->sendMessage("§7=-=-=-=-=-=-=-=-=-§8[ §6Code §8]§7-=-=-=-=-=-=-=-=-=");
                        $sender->sendMessage("$prefix §a/code §bsetcode §e[code] §4NOTE: you can't use space but you can use _");
                        $sender->sendMessage("$prefix §a/code clear");
                        $sender->sendMessage("$prefix §a/code start");
                        $sender->sendMessage("$prefix §a/code about");
                        $sender->sendMessage("§7=-=-=-=-=-=-=-=-=-§8[ §6Code §8]§7-=-=-=-=-=-=-=-=-=");
                        break;
                    case "setcode":
                        if($sender->hasPermission("code.setcode")) {

                            if (!isset($args[1])) {
                                $sender->sendMessage("$prefix §a/code §bsetcode §e[code]");
                            } else {
                                $this->plugin->getConfig()->set("code", $args[1]);
                                $this->plugin->getConfig()->save();

                                $sender->sendMessage("$prefix §aDone , Code Set To §c$args[1]");
                            }
                        }
                        break;
                    case "clear";
                    if($sender->hasPermission("code.clear")) {
                        $null = uniqid();
                        $this->plugin->getConfig()->set("code", $null);
                        $this->plugin->getConfig()->save();

                        $sender->sendMessage("$prefix §aDone..");
                    }
                        break;
                    case "start":
                        if($sender->hasPermission("code.start")) {
                            $code = $this->plugin->getConfig()->get("code");
                            $this->plugin->getServer()->broadcastMessage("$prefix §athe code is §b$code");
                            break;
                        }
                }
            }
        }
    }
}
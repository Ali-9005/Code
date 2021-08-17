<?php

namespace code;

use code\Commands\CodeCommands;
use code\Events\ChatEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public $prefix = "§8[ §6Code §8]";
    public $config;

    public $stage = "WAITING";

    public function onEnable()
    {
        $this->getLogger()->info("Plugin Enabled By xImTaiG_");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $data = [
            "code" => "thing",
        ];

        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, $data);
        $this->config->save();

        $this->getServer()->getCommandMap()->register("code", new CodeCommands($this));
        $this->getServer()->getPluginManager()->registerEvents(new ChatEvent($this), $this);

    }
}
<?php

namespace Terpz710;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;

class JoinTitle extends PluginBase implements Listener {

    /** @var Config */
    private $config;

    public function onEnable() : void {
        $this->getLogger()->info("JoinTitle has been enabled.");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();
    }

    public function onDisable() : void {
        $this->getLogger()->info("JoinTitle has been disabled.");
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $welcomeTitle = $this->config->get("title");
        $welcomeSubtitle = $this->config->get("subtitle");
        $titleDuration = $this->config->get("title_duration", 5); // Default duration is 5 seconds if not specified

        // Send the join title and subtitle to the player with specified duration
        $player->sendTitle($welcomeTitle, $welcomeSubtitle, 0, $titleDuration * 20, 0); // Title duration is in ticks (20 ticks = 1 second)
    }
}

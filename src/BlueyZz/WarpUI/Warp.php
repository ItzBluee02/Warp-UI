<?php

/**Plugin By BlueyZz
 * subrek
 */

namespace BlueyZz\WarpUI\Warp;

use pocketmine\player\Player;
use pocketmine\Server;

use pocketmine\world\world;
use pocketmine\world\Position;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\events\Listener;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use BlueyZz\WarpUI\FormAPI\SimpleForm;

class Warp extends PluginBase implements Listener {
    
    public $warp;
    public $i;
    
    public function onEnable(): void{
        $this->SaveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("blueyzz.yml");
        $this->blueyzz = new Config($this->getDataFoler(). "blueyzz.yml",Config::YAML);
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        switch($cmd->getName()){
            case "wui":
                if($sender instanceof Player) {
                    $this->wui($sender);
                }else{
                    $sender->sendMessage("Gunakan Command Ini Di Ingame")
                }
            break;
        }
        return true;
        }
        
        public function wui(Player $sender){
          $kon = new SimpleForm(function(Player, $sender, $data){
              if($dats == null){
                  return true;
              }
              $x = $this->blueyzz->get(strtolower($data))["x"];
              $y = $this->blueyzz->get(strtolower($data))["y"];
              $z = $this->blueyzz->get(strtolower($fata))["z"];
              $world = $this->blueyzz->get($data)["world"];
              $sender->sendMessage($this->blueyzz->get($data)["msg"]);
              $this->getServer()->getPluginManager()->loadWorld($world);
              $sender->teleport(new Position(floatval($x), floatval($y), floatval($z), $this->getServer->getWorldManager->getWorldByName($world)));
          });
          for($i = 0;$i <= 25;$i++){
              if($this->blueyzz->exists($i)){
                  $kon->addButton($this->blueyzz->get(strtolower($i))["Nama"],0,"texture\ui\icon_trailer");
              }
          }
          
          $kon->setTitle($this->getConfig->get("Title"));
          $kon->setContent($this->getConfig->get("Content"));
          $kon->sendToPlayer($sender);
    }
}


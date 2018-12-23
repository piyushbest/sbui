<?php

namespace PiyushBest\SkyBlock;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\{command\ConsoleCommandSender, Server, Player, utils\TextFormat};
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getLogger()->Info("§bSkyBlockGUI - Enabled!");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "sbui":
			case "is":
			case "sb":
			$this->mainForm($player);
        }
        return true;
    }
	
	public function mainForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createSimpleForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				if(isset($data[0])){
					switch($data[0]){	
                        case 0:
                                                break;
						
						case 1:
							$command = "sb auto";
							$this->getServer()->getCommandMap()->dispatch($player, $command);
						break;
						
						case 2:
							$command = "sb create";
							$this->getServer()->getCommandMap()->dispatch($player, $command);
						break;
              
                        case 3:
							$this->addForm($player);
						break;
							
						case 4;
							$this->removeForm($player);
						break;
							
						case 5;
							$this->homeForm($player);
						break;
							
						case 6;:
							$this->warpForm($player);
						break;
							
						case 7:
							$this->giveForm($player);
						break;
							
						case 8;
							$command = "spawn";
							$this->getServer()->getCommandMap()->dispatch($player, $command);
							
                        case 9;
							$command = "is setspawn";
							$this->getServer()->getCommandMap()->dispatch($player, $command);
						break;
					}
				}
			});
			$form->setTitle("§l§b♦§a SkyBlock §b♦");
			$form->addButton("§aFind an Island");
            $form->addButton("§dcreate Island");			
            $form->addButton("§7Add a helper");	
			$form->addButton("§9Remove a helper ");
			$form->addButton("§eBack to Your Island");
			$form->addButton("§6Teleport to an Island");
			$form->addButton("§2Give Island to a player");
			$form->addButton("§cBack to spawn");
			$form->addButton("§bset island spawn");
			$form->sendToPlayer($player);
		}
	}
	
	public function addForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->Ten = $data[0];
					$this->getServer()->getCommandMap()->dispatch($player, "sb addhelper " . $this->Ten);
				}
			});
			$form->setTitle("Thêm Người Vào Đảo Của Bạn");
			$form->addInput("Nhập Tên Người Chơi Muốn Thêm");
			$form->sendToPlayer($player);
		}
	}
	
	public function removeForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->Ten = $data[0];
					$this->getServer()->getCommandMap()->dispatch($player, "sb removehelper " . $this->Ten);
				}
			});
			$form->setTitle("Xóa Người Ra Khỏi Đảo Của Bạn");
			$form->addInput("Nhập Tên Người Chơi Muốn Xóa");
			$form->sendToPlayer($player);
		}
	}

	public function homeForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->Home = $data[0];
					$this->getServer()->getCommandMap()->dispatch($player, "sb home " . $this->Home);
				}
			});
			$form->setTitle("Về Đảo Của Bạn");
			$form->addInput("Nhập Số Đảo Bạn Muốn về ( ví dụ 1 , 2 ,3 ) ");
			$form->sendToPlayer($player);
		}
	}
		
	public function warpForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->idDao = $data[0];
					$this->getServer()->getCommandMap()->dispatch($player, "sb warp " . $this->idDao);
				}
			});
			$form->setTitle("Dịch Chuyển Đến Hòn Đảo Nào Đó");
			$form->addInput("Nhập Theo Địa Chỉ X;Y");
			$form->sendToPlayer($player);
		}
	}

	public function giveForm($player){
		if($player instanceof Player){
			$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $formapi->createCustomForm(function (Player $event, array $data){
				$player = $event->getPlayer();
				$result = $data[0];
				if($result != null){
					$this->Ten = $data[0];
					$this->getServer()->getCommandMap()->dispatch($player, "sb give " . $this->Ten);
				}
			});
			$form->setTitle("Chuyển Quyền Sở Hữu Đảo");
			$form->addInput("Nhập Tên Người Muốn Chuyển");
			$form->sendToPlayer($player);
		}
	}
}

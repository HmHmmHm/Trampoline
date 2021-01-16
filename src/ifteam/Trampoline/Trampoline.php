<?php

namespace ifteam\Trampoline;

use pocketmine\block\Block;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\level\particle\DustParticle;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;

class Trampoline extends PluginBase implements Listener{
    public $fallen = [];

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();

        if($player == null) return;
        if($player->getLevel() == null) return;

        // under
        $x = ( int ) round($player->x - 0.5);
        $y = ( int ) round($player->y - 1);
        $z = ( int ) round($player->z - 0.5);

        $id = $player->getLevel()->getBlockIdAt($x, $y, $z);
        $data = $player->getLevel()->getBlockDataAt($x, $y, $z);

        if($id == 35 and $data == 5){
            $this->fallenQueue($player);
            //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 3, 0 );
            $player->setMotion(new Vector3(0, 3, 0));
            $this->particle($player);
        }elseif($id == 35 and $data == 4){
            $this->fallenQueue($player);
            //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 1, 0 );
            $player->setMotion(new Vector3(0, 1, 0));
            $this->particle($player);
        }elseif($id == 35 and $data == 10){
            $this->fallenQueue($player);
            //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 5, 0 );
            $player->setMotion(new Vector3(0, 5, 0));
            $this->particle($player);
        }elseif($id == Block::DIAMOND_BLOCK){
            $x = -\sin($player->yaw / 180 * M_PI) * \cos($player->pitch / 180 * M_PI);
            $y = -\sin($player->pitch / 180 * M_PI);
            $z = \cos($player->yaw / 180 * M_PI) * \cos($player->pitch / 180 * M_PI);
            $this->fallenQueue($player);
            //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), $x * 3, $y * 3, $z * 3 );
            $player->setMotion(new Vector3($x * 3, $y * 3, $z * 3));
            $this->particle($player);
        }else{
            // right
            $x = ( int ) round($player->x - 1.5);
            $y = ( int ) round($player->y);
            $z = ( int ) round($player->z - 0.5);

            $id = $player->getLevel()->getBlockIdAt($x, $y, $z);
            $data = $player->getLevel()->getBlockDataAt($x, $y, $z);

            if($id == 35 and $data == 5){
                $this->fallenQueue($player);
                //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), + 3, 0, 0 );
                $player->setMotion(new Vector3(3, 0, 0));
                $this->particle($player);
            }elseif($id == 35 and $data == 4){
                $this->fallenQueue($player);
                //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), + 1, 0, 0 );
                $player->setMotion(new Vector3(1, 0, 0));
                $this->particle($player);
            }elseif($id == 35 and $data == 10){
                $this->fallenQueue($player);
                //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), + 5, 0, 0 );
                $player->setMotion(new Vector3(5, 0, 0));
                $this->particle($player);
            }else{
                // left
                $x = ( int ) round($player->x + 0.5);
                $y = ( int ) round($player->y);
                $z = ( int ) round($player->z - 0.5);

                $id = $player->getLevel()->getBlockIdAt($x, $y, $z);
                $data = $player->getLevel()->getBlockDataAt($x, $y, $z);

                if($id == 35 and $data == 5){
                    $this->fallenQueue($player);
                    //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), - 3, 0, 0 );
                    $player->setMotion(new Vector3(-3, 0, 0));
                    $this->particle($player);
                }elseif($id == 35 and $data == 4){
                    $this->fallenQueue($player);
                    //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), - 1, 0, 0 );
                    $player->setMotion(new Vector3(-1, 0, 0));
                    $this->particle($player);
                }elseif($id == 35 and $data == 10){
                    $this->fallenQueue($player);
                    //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), - 5, 0, 0 );
                    $player->setMotion(new Vector3(-5, 0, 0));
                    $this->particle($player);
                }else{
                    // north
                    $x = ( int ) round($player->x - 0.5);
                    $y = ( int ) round($player->y);
                    $z = ( int ) round($player->z - 1.5);

                    $id = $player->getLevel()->getBlockIdAt($x, $y, $z);
                    $data = $player->getLevel()->getBlockDataAt($x, $y, $z);

                    if($id == 35 and $data == 5){
                        $this->fallenQueue($player);
                        //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 0, + 3 );
                        $player->setMotion(new Vector3(0, 0, +3));
                        $this->particle($player);
                    }elseif($id == 35 and $data == 4){
                        $this->fallenQueue($player);
                        //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 0, + 1 );
                        $player->setMotion(new Vector3(0, 0, 1));
                        $this->particle($player);
                    }elseif($id == 35 and $data == 10){
                        $this->fallenQueue($player);
                        //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 0, + 5 );
                        $player->setMotion(new Vector3(0, 0, 5));
                        $this->particle($player);
                    }else{
                        // north
                        $x = ( int ) round($player->x - 0.5);
                        $y = ( int ) round($player->y);
                        $z = ( int ) round($player->z + 0.5);

                        $id = $player->getLevel()->getBlockIdAt($x, $y, $z);
                        $data = $player->getLevel()->getBlockDataAt($x, $y, $z);

                        if($id == 35 and $data == 5){
                            $this->fallenQueue($player);
                            //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 0, - 3 );
                            $player->setMotion(new Vector3(0, 0, -3));
                            $this->particle($player);
                        }elseif($id == 35 and $data == 4){
                            $this->fallenQueue($player);
                            //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 0, - 1 );
                            $player->setMotion(new Vector3(0, 0, -1));
                            $this->particle($player);
                        }elseif($id == 35 and $data == 10){
                            $this->fallenQueue($player);
                            //$player->getLevel()->addEntityMotion ( $player->chunk->getX(), $player->chunk->getZ(),  $player->getId (), 0, 0, - 5 );
                            $player->setMotion(new Vector3(0, 0, -5));
                            $this->particle($player);
                        }
                    }
                }
            }
        }
    }

    public function particle(Player $player){
        $pos = $player->add(0, 2, 0);
        $player->getLevel()->addParticle(new DustParticle ($pos->setComponents($pos->x + 0.4, $pos->y, $pos->z), 188, 32, 255, 255));
        $player->getLevel()->addParticle(new DustParticle ($pos->setComponents($pos->x, $pos->y, $pos->z + 0.4), 188, 32, 255, 255));
        $player->getLevel()->addParticle(new DustParticle ($pos->setComponents($pos->x - 0.6, $pos->y, $pos->z), 188, 32, 255, 255));
        $player->getLevel()->addParticle(new DustParticle ($pos->setComponents($pos->x, $pos->y, $pos->z - 0.6), 188, 32, 255, 255));
        $player->getLevel()->addParticle(new DustParticle ($pos->setComponents($pos->x + 0.4, $pos->y, $pos->z + 0.4), 188, 32, 255, 255));
    }

    public function preventFlyKick(PlayerKickEvent $event){
        if($event->getReason() == $this->getServer()->getLanguage()->translateString("kick.reason.cheat", ["%ability.flight"])) $event->setCancelled();
    }

    public function fallenQueue(Player $player){
        /*
        if ($player == null) return;
        if (isset ($this->fallen [$player->getName()])) {
            $this->fallen [$player->getName()]++;
        } else {
            $this->fallen [$player->getName()] = 1;
        }
        //$this->getServer()->getScheduler()->scheduleDelayedTask(new fallenTimeOutTask ($this, $player->getName()), 100);
        */
    }

    public function fallenTimeOut($name){
        if(isset ($this->fallen [$name])) $this->fallen [$name]--;
    }

    public function fallenDamagePrevent(EntityDamageEvent $event){
        if($event->getCause() == EntityDamageEvent::CAUSE_FALL){
            if($event->getEntity() instanceof Player){
                $event->setCancelled();
            }
        }
    }
}

?>
<?php 
class Message 
{
    public function displayStatusMessage($objects) {
        foreach ($objects as $object) {
            echo $object->getName() . "のヒットポイントは" . $object->getHitPoint() . "/" . $object::MAX_HITPOINT . "だ！<br>";    
        }
        echo "<br>";
    }

    public function displayAttackMessage($objects, $targets) {
        foreach($objects as $object) {
            if(get_class($object) == "WhiteMage") {
                $attackResult = $object->doAttackWhiteMage($objects, $targets);
            } else {
                $attackResult = $object->doAttack($targets);
            }
            $attackResult = false;
        }
        echo "<br>";
    }
}
?>
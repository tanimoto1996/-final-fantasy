<?php
// 死んでいるかどうかを確認する
function isFinish($objects)
{
    $deathCut = 0;
    foreach ($objects as $object) {
        if ($object->getHitPoint() > 0) {
            return false;
        }
        $deathCut++;
    }

    if ($deathCut == count($objects)) {
        return true;
    }
}

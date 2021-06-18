<?php
class WhiteMage extends Human {
    const MAX_HITPOINT = 80;
    private $hitPoint = self::MAX_HITPOINT;
    private $attackPoint = 10;
    private $intelligence = 30;

    public function __construct($name) {
        parent::__construct($name, $this->hitPoint, $this->attackPoint, $this->intelligence);
    }

    public function doAttackWhiteMage($members, $enemies) {
        // 自分のHPが0以上か、敵のHPが0以上かなどをチェックするメソッドを用意。
        if (!$this->isEnableAttack($enemies)) {
            return false;
        }

        // 回復量をランダムにする
        $intelligence = rand(5, $this->intelligence);

        if(rand(1, 2) === 1) {
            // ターゲットの決定
            $member = $this->selectTarget($members);
            echo "「" . $this->getName() . "」のスキル発動！<br>";
            echo "ヒール！<br>";
            echo "「" . $member->getName() . "」" . "に" . $intelligence . "回復した！<br><br>";
            $member->recoveryDamage($intelligence, $member);
        } else {
            // ターゲットの決定
            $enemy = $this->selectTarget($enemies);
            parent::doAttack($enemies);
        }
    }
}
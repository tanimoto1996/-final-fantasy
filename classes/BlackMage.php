<?php
class BlackMage extends Human {
    const MAX_HITPOINT = 80;
    private $hitPoint = self::MAX_HITPOINT;
    private $attackPoint = 10;
    private $intelligence = 30;

    public function __construct($name) {
        parent::__construct($name, $this->hitPoint, $this->attackPoint, $this->intelligence);
    }

    public function doAttack($enemies) {

        // 自分のHPが0以上か、敵のHPが0以上かなどをチェックするメソッドを用意。
        if (!$this->isEnableAttack($enemies)) {
            return false;
        }
        // ターゲットの決定
        $enemy = $this->selectTarget($enemies);

        $intelligence = rand(5, $this->intelligence);
        
        if(rand(1, 2) === 1) {
            echo "「" . $this->getName() . "」のスキル発動！<br>";
            echo "マダンテ！<br>";
            echo "「" . $enemy->getName() . "」" . "に" . $intelligence . "ダメージを与えた！<br>";
            $enemy->tookDamage($intelligence);
        } else {
            parent::doAttack($enemies);
        }
        return true;
    }
}
<?php
// 人間クラスを継承している
class Brave extends Human
{
    // 人間クラスのもの
    // const MAX_HITPOINT = 100;
    // public $name;
    // public $hitPoint = 100;
    // public $attackPoint = 20;
    // doAttack();
    // tookDamage();

    const MAX_HITPOINT = 120;
    private $hitPoint = self::MAX_HITPOINT;
    private $attackPoint = 30;

    private static $instance;

    private function __construct($name)
    { //コンストラクタをprivateに
        parent::__construct($name, $this->hitPoint, $this->attackPoint);
    }

    // シングルトンで常にインスタンスは一つしか生成しない
    public static function getInstance($name)
    {
        if (empty(self::$instance)) {
            self::$instance = new Brave($name);
        }

        return self::$instance;
    }


    // オーバーライド（継承しているクラスで使われているメソッドを書き換えることができる）
    public function doAttack($enemies)
    {
        // 自分のHPが0以上か、敵のHPが0以上かなどをチェックするメソッドを用意。
        if (!$this->isEnableAttack($enemies)) {
            return false;
        }
        // ターゲットの決定
        $enemy = $this->selectTarget($enemies);

        $attackPoint = rand(5, $this->attackPoint);

        if (rand(1, 3) === 1) {
            // スキル発動
            echo "「" . $this->getName() . "」のスキル発動！<br>";
            echo "ぜんりょくぎり！<br>";
            echo "「" . $enemy->getName() . "」" . "に" . $attackPoint * 1.5 . "ダメージを与えた！<br><br>";
            $enemy->tookDamage($attackPoint * 1.5);
        } else {
            // 親クラスのdoAttackメソッドを呼ぶ
            parent::doAttack($enemies);
        }
        return true;
    }
}

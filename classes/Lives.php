<?php
class Lives
{
    private $name;
    private $hitPoint;
    private $attackPoint;
    private $intelligence;

    public function __construct($name, $hitPoint = 50, $attackPoint = 10, $intelligence = 0)
    {
        $this->name = $name;
        $this->hitPoint = $hitPoint;
        $this->attackPoint = $attackPoint;
        $this->intelligence = $intelligence;
    }


    // アクセサーメソッド

    // 名前を取得するメソッド（ゲッター）
    public function getName()
    {
        return $this->name;
    }

    // 現在HPを取得するメソッド（ゲッター）
    public function getHitPoint()
    {
        $result = $this->hitPoint;
        if ($result < 0) {
            $result = 0;
        }
        return $result;
    }

    // 現在HPを設定するメソッド（セッター）
    public function tookDamage($damage)
    {
        $this->hitPoint -= $damage;
        // HPが0未満にならないための処理
        if ($this->hitPoint < 0) {
            $this->hitPoint = 0;
        }
    }

    // 現在HPを設定するメソッド（セッター）
    public function recoveryDamage($heal, $target)
    {
        $this->hitPoint += $heal;
        // 最大値を超えて回復しない
        if ($this->hitPoint > $target::MAX_HITPOINT) {
            $this->hitPoint = $target::MAX_HITPOINT;
        }
    }
    //  攻撃するメソッド
    public function doAttack($targets)
    {
        if (!$this->isEnableAttack($targets)) {
            return false;
        }
        // ターゲットの決定
        $target = $this->selectTarget($targets);

        // 攻撃力をランダムにする
        $attackPoint = rand(5, $this->attackPoint);

        echo "『" . $this->name . "』の攻撃！<br>";
        echo "【" . $target->getName() . "】に " . $attackPoint . " のダメージ！<br><br>";
        $target->tookDamage($attackPoint);
        return true;
    }

    //  攻撃ができるかどうかチェック
    public function isEnableAttack($targets)
    {
        // チェック１：自信のHPが0以上かどうか
        if ($this->hitPoint <= 0) {
            return false;
        }
        // チェック２：敵が全員HP0以下かどうか
        $isAllDie = true;
        foreach ($targets as $target) {
            if ($target->getHitPoint() > 0) {
                $isAllDie = false;
            }
        }
        if ($isAllDie) {
            return false;
        }

        // チェックを抜けた場合、攻撃可能
        return true;
    }

    // ターゲットを決めるメソッド
    public function selectTarget($targets)
    {
        $target = $targets[rand(0, count($targets) - 1)];
        // 敵のHPが0以下の場合再度ターゲットを決める
        while ($target->getHitPoint() <= 0) {
            $target = $targets[rand(0, count($targets) - 1)];
        }
        return $target;
    }
}

<?php

$playerName = $_GET["name"];

// オートローダー（指定したフォルダのクラスを自動で呼び出してくれる）
require_once("./lib/Loader.php");
// 定数をまとめるファイル
require_once("./lib/Utility.php");

// オートロード
$loader = new Loader();
$loader->regDirectory(__DIR__ . '/classes');
$loader->regDirectory(__DIR__ . '/classes/contants');
$loader->register();

$members = array();
$members[] = Brave::getInstance($playerName);
$members[] = new WhiteMage(CharacterName::YUNA);
$members[] = new BlackMage(CharacterName::RULU);

$enemies = array();
$enemies[] = new Enemy(EnemyName::GOBLINS, 30);
$enemies[] = new Enemy(EnemyName::BOMB, 25);
$enemies[] = new Enemy(EnemyName::MORBOL, 30);

$turn = 1;
$isFinishFlg = false;

$messageObj = new Message;

while (!$isFinishFlg) {
    echo "*** $turn ターン目 ***<br>";
    // 仲間のステータス表示
    $messageObj->displayStatusMessage($members);
    // 敵のステータス表示
    $messageObj->displayStatusMessage($enemies);

    // 仲間の攻撃
    $messageObj->displayAttackMessage($members, $enemies);
    // 敵の攻撃
    $messageObj->displayAttackMessage($enemies, $members);

    // 主人公側が死んでいるかどうかの判定
    $isFinishFlg = isFinish($members);
    if($isFinishFlg) {
        $message = "GameOver...<br><br>";
        break;
    } 

    // 敵側が死んでいるかどうかの判定
    $isFinishFlg = isFinish($enemies);
    if($isFinishFlg) {
        $message = "主人公側の勝利！";
        break;
    }

    $turn++;
}

echo "★★★ 戦闘終了 ★★★<br>";
$messageObj->displayStatusMessage($members);
$messageObj->displayStatusMessage($enemies);

echo $message;

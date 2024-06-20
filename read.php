<?php 

// データまとめ用の空文字変数

$array =[];


// ファイルを開く（読み取り専用）
$file = fopen('data/data.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgets()で1行ずつ取得→$lineに格納
if ($file) {
  while ($line = fgets($file)) {
     $array[]=[
      "bookTitle" => explode(" ",$line)[0],
      "label01" => explode(" ",$line)[1],
      "label01_point" => explode(" ",$line)[2],
      "label02" => explode(" ",$line)[3],
      "label02_point" => explode(" ",$line)[4],
      "label03" => explode(" ",$line)[5],
      "label03_point" => explode(" ",$line)[6],
      "label04" => explode(" ",$line)[7],
            "label04_point" => explode(" ",$line)[8],
      "label05" => explode(" ",$line)[9],
       "label05_point" => explode(" ",$line)[10],

    ];

    // $array[]= $line;
  }
}

// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

// echo '<pre>';
// var_dump($array);
// echo '</pre>';

// exit();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" type="text/css" href="main.css" />
    <title>Document</title>
</head>
<body>
    <div class="main">

     <div class="input_area"> 
     <h1>作品感想チャート</h1>   
     <form action="create.php" method="POST">
  
    作品名: <input type="text" name="bookTitle">
<br>
  <br>
  <div>
    label01: <input type="text" name="label01">
    →評価：<input type="number" name="label01_point">
  </div>
  <div>
    label02: <input type="text" name="label02">
    →評価：<input type="number" name="label02_point">
  </div>
  <div>
    label03: <input type="text" name="label03">
    →評価：<input type="number" name="label03_point">
  </div>
  <div>
    label03: <input type="text" name="label03">
    →評価：<input type="number" name="label03_point">
  </div>
  <div>
    label04: <input type="text" name="label04">
    →評価：<input type="number" name="label04_point">
  </div> 
<div>
    label05: <input type="text" name="label05">
    →評価：<input type="number" name="label05_point">
  </div>
  <button id="send">送信</button>
</form></div>
    <div class="canvas_container"><canvas id="myRadarChart" width="200" height="200"></canvas></div>
</div>
<script>
const array = <?= json_encode($array)?>;
    
var ctx = document.getElementById("myRadarChart");
    var myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            //データの各項目のラベル(上から時計回り)
            labels: [array[array.length-1].label01, array[array.length-1].label02, array[array.length-1].label03, array[array.length-1].label04, array[array.length-1].label05],
            //データ設定
            datasets: [
                {
                    //グラフのデータ(上から時計回り)
                    data: [array[array.length-1].label01_point, array[array.length-1].label02_point, array[array.length-1].label03_point, array[array.length-1].label04_point, array[array.length-1].label05_point],
                    //グラフ全体のラベル
                    label: array[array.length-1].bookTitle,
                    //背景色
                    backgroundColor: "rgba(255,0,0,0.5)",
                    //線の終端を四角にするか丸めるかの設定。デフォルトは四角(butt)。
                    borderCapStyle: "butt",
                    //線の色
                    borderColor: "rgba(255,255,0,1)",
                    //線を破線にする
                    borderDash: [],
                    //破線のオフセット(基準点からの距離)
                    borderDashOffset: 0.0,
                    //線と線が交わる箇所のスタイル。初期値は'miter'
                    borderJoinStyle: 'miter',
                    //線の幅。ピクセル単位で指定。初期値は3。
                    borderWidth: 3,
                    //グラフを塗りつぶすかどうか。初期値はtrue。falseにすると枠線だけのグラフになります。
                    fill: true,
                    //複数のグラフを重ねて描画する際の重なりを設定する。z-indexみたいなもの。初期値は0。
                    order: 0,
                    //0より大きい値にすると「ベジェ曲線」という数式で曲線のグラフになります。初期値は0。
                    lineTension: 0
                }
            ]
        },
        options: {
            scales: {
                r: {
                    //グラフの最小値・最大値
                    min: 0,
                    max: 100,
                    //背景色
                    backgroundColor: 'snow',
                    //グリッドライン
                    grid: {
                        color: 'pink',
                    },
                    //アングルライン
                    angleLines: {
                        color: 'green',
                    },
                    //各項目のラベル
                    pointLabels: {
                        color: 'blue',
                    },
                },
            },
        }, 
    });</script>


</body>
</html>
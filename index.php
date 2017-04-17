<?php
session_start();

require("./setting.php");

$mysqli = GetMysqli();

// レコードの取得、設問の取得
$query = "select Q,S,A,B,C,D,E,F from testtable;";
$questList = GetQueryResult($query);
$questArray = array();
while ($row = $questList->fetch_assoc()) {
    $questArray[] = array(
        'No' => $row['Q'],
        'Select' => $row['S'],
        'A'=>$row['A'],
        'B'=>$row['B'],
        'C'=>$row['C'],
        'D'=>$row['D'],
        'E'=>$row['E'],
        'F'=>$row['F']
    );
}

//特性変数
$a = 0;
$b = 0;
$c = 0;
$d = 0;
$e = 0;
$f = 0;

// テーブル出力関数（全部これがやってくれる
function printTable() {
    global $questArray;
    global $a, $b, $c, $d, $e, $f;

//    echo '<table border="1" cellpadding="0" cellspacing="0" width="50%">';
//    echo '<tr><th>No</th><th width="13%">A</th><th width="13%">B</th><th width="13%">C</th><th width="13%">D</th><th width="13%">E</th><th width="13%">F</th></tr>';
//    echo '<tr>';

    //設問作成部分
    $maxCols = 6;
    $cols = 0;
    $lastNo = $questArray[0]['No'];
    echo '<table><tr><td>' . $lastNo . '</td></tr><tr><td><select>';

    foreach ($questArray as $r) {

        // 同じなら列を増やす
        if ($lastNo != $r['No']) {

            //足りない列を埋める
            for (;$cols < $maxCols; $cols++) printNullCell();
            $cols = 0;
            $lastNo = $r['No'];
            echo '</tr><tr><td align="center">' . $lastNo . '</td>';
        }
        echo '<td onclick="clickMyRadiobutton()" align="center">';
        echo '<input type="radio" id="gl'.$lastNo.$r['Select'].'" name="g'.$lastNo.'" value="'.$r['Select'].'" ';

        // POSTで選択状態が
        if ($r['Select'] == $_POST["g".$lastNo]) {
            echo 'checked="true" ';

            $a += $r["A"];
            $b += $r["B"];
            $c += $r["C"];
            $d += $r["D"];
            $e += $r["E"];
            $f += $r["F"];
        }
        echo '/></td>';
        $cols++;
    }

    //最終行の足りない列を埋める
    for (;$cols < $maxCols; $cols++) printNullCell();

    echo '</tr>';
    echo '</table>';
}

function printNullCell() {
    echo '<td style="background-color: slategray"> </td>';
}
?>

<html>
<head>
    <title>認知特性テスト支援ツール</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
</head>
<body>
<?php
if ($a+$b+$c+$d+$e+$f != 0) {
    echo '<canvas id="canvas"></canvas>';
    echo "視覚・写真：" . $a . "<br />視覚・三次元：" . $b . "<br />言語・映像：" . $c . "<br />言語・抽象：" . $d . "<br .>聴覚・言語：" . $e . "<br />聴覚・音：" . $f;
}
?>
<br />
<br />
<form action="index.php" method="post">
    <?php printTable(); ?>
    <input type="submit" />
</form>
<br />

<script type="text/javascript">
    <!--
    function inputCheck($name) {
        if (document.getElementById($name).value == null || document.getElementById($name).value == "") {
            confirm("にゅうりょくして");
            return false;
        }
    }
    function clickMyRadiobutton() {
        var rb = event.currentTarget.firstChild;
        rb.checked = true;
    }
    var radarChartData = {
       labels: ["視覚・写真", "視覚・三次元", "言語・映像", "言語・抽象", "聴覚・言語", "聴覚・音"],
       datasets: [
           {
               fillColor: "rgba(244,250,130,0.7",
               strokeColor: "#111111",
               pointColor: "#111111",
               pointStrokeColor: "#fff",
               data: [<?php echo $a.",".$b.",".$c.",".$d.",".$e.",".$f ?>]
           }
       ]
    };
    window.onload = function(){
        window.myRadar = new Chart(document.getElementById("canvas").getContext("2d")).Radar(radarChartData, {
            responsive: true,
            scaleOverride : true,
            scaleSteps : 5,
            scaleStartValue : 0,
            scaleStepWidth : 10
        });
    };
    //-->
</script>
</body>
</html>

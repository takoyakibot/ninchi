<!DOCTYPE html>
<html lang="ja">
<head>
    <title>Chart.js TEST</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>Chart.jsのテスト</h1>

<div style="height">
    <canvas id="radar-chart" height="450" width="600"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<!-- もしくは<script src="Chart.min.js"></script> -->
<script>
    var radarChartData = {
        labels: ["HP", "MP", "知力", "腹筋力", "食事力", "魔力", "ハンドボール投げ"],
        datasets: [
            {
                label: "私",
                fillColor : /*"#f2dae8"*/"rgba(242,218,232,0.6)",
                strokeColor : /*"#dd9cb4"*/"rgba(221,156,180,0.6)",
                pointColor : /*"#dd9cb4"*/"rgba(221,156,180,0.6)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : /*"#dd9cb4"*/"rgba(221,156,180,0.6)",
                data : [100,32,80,95,80,10,50]
            },
            {
                label: "彼",
                fillColor : /*"#afd0ef"*/"rgba(175,208,239,0.6)",
                strokeColor : /*"#8fb7dd"*/"rgba(143,183,221,0.6)",
                pointColor : /*"#8fb7dd"*/"rgba(143,183,221,0.6)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : /*"#8fb7dd"*/"rgba(143,183,221,0.6)",
                data : [35,62,42,40,37,67,70]
            }
        ]
    };
    window.onload = function(){
        window.myRadar = new Chart(document.getElementById("radar-chart").getContext("2d")).Radar(radarChartData, {
            responsive: true
        });
    }
</script>
</body>
</html>

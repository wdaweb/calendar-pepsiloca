<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
<style>
/* bootstrap內有預設 */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    text-align:center;
}
table{
    /* width:400px;
    height:400px; */
    border-collapse:collapse;
}

table td{
    border: 1px solid gray;
    padding:5px;
    text-align:center;    
}

.wrapper{
    display:flex;
    max-width:1000px;
    flex-wrap:wrap;  
}

.calender{
    width:25%;
    padding:30px;
}

.calender td{
    height:35px;
}

</style>
</head>

<body>
<?php
// /* 日期設定 */
// $month = ($_GET['m'] ? $_GET['m'] : date('m'));
// $year = ($_GET['year'] ? $_GET['year'] : date('Y'));


$year=date("Y");
$m=date("m");
// $d=date("d");

if(isset($_GET["m"])){
    $m=$_GET["m"];    
}


?>

<?php

// 上下月/年判斷
if(($m-1)>0){
    $lastmonth=$m-1;
    $lastyear=$year;   
}else{
    $lastmonth=12;
    $lastyear=$year-1;
}

if(($m+1)<=12){
    $nextmonth=$m+1;
    $nextyear=$year;
}else{
    $nextmonth=1;
    $nextyear=$year+1;
}
?>

<!-- 上個月 -->
<a href="index.php?m=<?=$lastmonth;?>&year<?$lastyear;?>">上一個月(<?=$lastmonth;?><?$lastyear;?>)</a> ｜
<span>本月(<?=$m;?>)</span> ｜
<!-- 下個月 -->
<a href="index.php?m=<?=$nextmonth;?>&year<?$nextyear;?>">下一個月(<?=$nextmonth;?><?$nextyear;?>)</a>





<!-- <a href="index.php?m=<?=$m-1;?>">上一個月(<?=$m-1;?>)</a> ｜
<span>本月(<?=$m;?>)</span> ｜
<a href="index.php?m=<?=$m+1;?>">下一個月(<?=$m+1;?>)</a> -->





<!-- // date_default_timezone_set('Asia/Taipei');
 // $thisyear=year("y",strtotime($firstDay)); 
?> -->
<div>年份：<?=$year;?></div>

<!-- 針對月份間的表格排版調整 -->
<div class="calender">   
<table>
<!-- 自動產生月份 ＝為echo的意思 -->
<!-- 和日期合併格子 再看如何分開 -->
<tr><td colspan="7">月份:<?=$m;?></td></tr>
<tr>
    <td>日</td>
    <td>一</td>
    <td>二</td>
    <td>三</td>
    <td>四</td>
    <td>五</td>
    <td>六</td>
</tr>
<?php
// 年份.月份使用變數 讓其自動產生
$firstDay= "$year-$m-01";


// 指定的日期為禮拜幾 要給完整的時間序 (因爲從週日（0）開始,所以一號在第四格 前面的格子就印空白)
$firstDayWeek=date("w",strtotime($firstDay));
// echo "第一天星期：" .$firstDayWeek. "<br>";

// 找出當月總共有幾天 要給完整的時間序（只要當月任一天都可）
$monthDays=date("t",strtotime($firstDay));
// echo "總共：" . $monthDays . "天";


for($i=0;$i<6;$i++){
    echo "<tr>";
    for($j=0;$j<7;$j++){
        // 判斷從第一列哪一格開始印 星期還沒開始的地方印空白
        if($i==0 && $j<$firstDayWeek){
            echo "<td>";
            echo "</td>";
        // 星期開始 日期開始印
        }else{
            echo "<td>";
            // 日期要從數字1開始印 (原本第四格印會從4開始：第幾格印從幾號開始)
            $num=$i*7+$j+1-$firstDayWeek;
            // 如果日期小於等於總天數 就印出
            if($num<=$monthDays){
               echo $num; 
            }   
            // }else{
            //     // 全行空白 撐起最後一格空間 但建議不要用 要控制格子尺寸
            //     echo "　";
            // }
            echo "</td>";
        }
    
       
    }

    echo "</tr>";  
}




?>
</table>
</div>     
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
<style>
/* bootstrap內有預設 */
body{
    margin:0;
    padding:0;
    box-sizing:border-box;
    text-align:center;
    position:relative;
    font-family: 'Verdana','微軟正黑' , sans-serif;
    color:#ff8282;
    /* color:#CD5360; */
    background:#f6dacf;

}

table{
    width:500px;
    height:500px;
    margin:50px 100px;
    border-collapse:collapse;
    text-align:center;
    background:white;
    border-radius:20px;
    /* box-shadow: 0 3 10px; */
}

table td{
    /* border: 1px solid white;
    border-radius:20px; */

    padding:5px;
    text-align:center;
        
}

.weekend{
    color:#6c648b;
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
    font-family: 'Nunito', sans-serif;
    font-size:20px;
    
}

.title{
    color:#E52A6F;
    font-family: 'Nunito', sans-serif;
    font-size:50px;
}

table td:first-child , 
table td:last-child{
    color:#6c648b;
}

</style>

<?php
if (!empty($_GET['month'])) {
    $m = $_GET['month'];
 } else {
    $m = date("m");
 }
 
 if (!empty($_GET['year'])) {
    $year = $_GET['year'];
 } else {
    $year = date("Y");
 }

// $year=date("Y");
// $m=date("m");
// $d=date("d");

//上下個月
if(isset($_GET["m"])){
    $m=$_GET["m"];    
}else{
    //這個月
    $m=date("m");
}


// $today=date("Y-m-d");
// $todayDays=date("d");
// $start="$year-$m-01";
// $startDay=date("w",strtotime($start));
// $days=date("t",strtotime($start));
// $endDay=date("w",strtotime($year-$m-$days));

// echo $today;

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

<div class="title"><?=$year;?></div>

<!-- 上個月 -->
<a href="0425-12.all.calender.php?m=<?=$lastmonth;?>&year=<?=$lastyear;?>">上一個月(<?=$lastmonth;?>)</a> ｜

<span>本月(<?=$m;?>)</span> ｜

<!-- 下個月 -->
<a href="0425-12.all.calender.php?m=<?=$nextmonth;?>&year=<?=$nextyear;?>">下一個月(<?=$nextmonth;?>)</a>


<!-- 針對月份間的表格排版調整 -->
<div class="calender">   
<table>
<!-- 自動產生月份 ＝為echo的意思 -->
<!-- 和日期合併格子 再看如何分開 -->
<div class="title">
<tr><td colspan="7">月份:<?=$m;?></td></tr>
</div>

<tr>
    <td class="weekend">日</td>
    <td>一</td>
    <td>二</td>
    <td>三</td>
    <td>四</td>
    <td>五</td>
    <td class="weekend">六</td>
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
            echo "</td>";
        }
    
       
    }

    echo "</tr>";  
}




?>

</table>
</div> 
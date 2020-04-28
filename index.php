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
    font-family: 'Verdana','微軟正黑' , sans-serif;
    font-weight:bold;
    text-shadow: 0px 1px 4px #ccc9c9;
    color:#418eaa;
    background:url("https://imgur.com/g30bPb8.jpg");
    background-attachment:fixed;
}

table{
    width:500px;
    height:600px;
    /* position:absolute; */
    border-collapse:collapse;
    text-align:center;
    background:rgba(189,230,244,0.7);
    border-radius:25px;
    box-shadow: 0px 10px 20px #caa799;
    animation: demo4_box 10s linear infinite;
}

@keyframes demo4_box{
        0%{
         box-shadow:0px 0px 1rem 1px #e7c1b2,0px 0px 1rem 1px #e7c1b2, inset 0px 0px  1px #e7c1b2;
        }   
        
        50%{
         box-shadow:0px 0px 1rem 3px white,0px 0px 1rem 3px white, inset 0px 0px 1rem 1px white;    
        }
        
        100%{
         box-shadow:0px 0px 1rem 1px #e7c1b2,0px 0px 1rem 1px #e7c1b2, inset 0px 0px  1px #e7c1b2;    
        }

    }

table td{
    padding:5px;
    text-align:center;    
}


.calender{
    position:absolute;
    padding:30px;
    top:10%;
    left:30%;
}

.btn1{
    display:inline-block;
    position:absolute;
    top:125px;
    left:120px;

}
.btn2{
    display:inline-block;
    position:absolute;
    top:125px;
    left:405px;
} */


.calender td{
    height:35px;
}

.title{
    color:#E52A6F;
    font-family: 'Nunito', sans-serif;
    font-size:50px;
    position:relative;
    text-align:center;
    top:0px;
}

.mm{
    color:#E52A6F;
    font-size:30px;
    position:absolute;
    top:120px;
    left:250px;
}

table td:first-child , 
table td:last-child{
    color:#ff8282;
        
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


//上下個月
if(isset($_GET["m"])){
    $m=$_GET["m"];    
}else{
    //這個月
    $m=date("m");
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



<!-- 針對月份間的表格排版調整 -->
<div class="calender">   
    <div class="title"><?=$year;?></div>
<table>
<!-- 自動產生月份 ＝為echo的意思 -->
    <div>
    <tr><div class="mm" colspan="7"><?=$m;?>月</div></tr>

        <div class="btn1">
        <!-- 上個月 -->
        <a href="index.php?m=<?=$lastmonth;?>&year=<?=$lastyear;?>"><img src="https://i.imgur.com/Qi0uwPt.png"></a> 
        </div>


        <div class="btn2">
        <!-- 下個月 -->
        <a href="index.php?m=<?=$nextmonth;?>&year=<?=$nextyear;?>"><img src="https://i.imgur.com/85trdo9.png"></a>
        
        
    </div>


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


// 找出當月總共有幾天 要給完整的時間序（只要當月任一天都可）
$monthDays=date("t",strtotime($firstDay));



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
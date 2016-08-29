<?php
session_start();
$time = $_SESSION['time'];
$cpuutil = $_SESSION['cpu'];
$inscount = $_SESSION['inscount'];
$insid = $_SESSION['insid'];
$count = count($time);
//Include the code
require_once 'phplot/phplot.php';

//Define the object
$plot = new PHPlot(800,600);

//Define the data
$data = array(array());
for($i=0;$i<$count;$i++)
{
    $data[$i][0] = $time[$i];
    for($j=1;$j<=$inscount;$j++)
    {
        $data[$i][$j] = $cpuutil[$j-1][$i];
    }
}
$plot->SetDataValues($data);
$plot->SetTitle("CPU Utilization");
$plot->SetXTitle("Time Period");
$plot->SetYTitle("CPU Utilization \n (in percentage)");
$plot->SetYDataLabelPos('plotin');
$plot->SetDrawXDataLabelLines('true');
$plot->SetLegend($insid);
//Turn off X axis ticks and labels because they get in the way:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

//Draw it
$plot->DrawGraph(); 
?>"
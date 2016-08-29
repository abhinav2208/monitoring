<?php
header ('content-type: image/jpeg');
session_start();
$time = $_SESSION['time'];
$cpuutil = $_SESSION['cpu'];
$count = count($cpuutil);
$iid = $_SESSION['iid'];
//Include the code
require_once 'phplot/phplot.php';

//Define the object
$plot = new PHPlot(1000,600);
//define the data
$example_data = array();
for($i=0;$i<$count;$i++)
{$example_data[] = array($time[$i], $cpuutil[$i]);}
$plot->SetDataValues($example_data);
$plot->SetTitle("CPU Utilization for InstaneID $iid");
$plot->SetXTitle("Time Period");
$plot->SetYTitle("CPU Utilization \n (in percentage)");
$plot->SetYDataLabelPos('plotin');
$plot->SetDrawXDataLabelLines('true');
//Turn off X axis ticks and labels because they get in the way:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

//Draw it
$plot->DrawGraph(); 
?>"
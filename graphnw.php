<?php
session_start();
$time = $_SESSION['time'];
$nwin = $_SESSION['nwin'];
$nwout = $_SESSION['nwout'];
$iid = $_SESSION['iid'];
$arr = array('N/W in', 'N/W out');
$count = count($nwin);
//Include the code
require_once 'phplot/phplot.php';

//Define the object
$plot = new PHPlot(1000,600);

//Define some data
$example_data = array();
for($i=0;$i<$count;$i++)
{$example_data[] = array($time[$i], $nwin[$i], $nwout[$i]);}
$plot->SetDataValues($example_data);

$plot->SetTitle("N/w In/Out for InstanceID $iid");
$plot->SetXTitle("Time Period");
$plot->SetYTitle("N/w IN/OUT \n (in bytes)");
$plot->SetYDataLabelPos('plotin');
$plot->SetLegend($arr);
//Turn off X axis ticks and labels because they get in the way:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

//Draw it
$plot->DrawGraph();
?>"
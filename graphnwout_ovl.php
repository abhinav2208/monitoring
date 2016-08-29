<?php
session_start();
$time = $_SESSION['time1'];
$nwout = $_SESSION['nwout'];
$inscount = $_SESSION['inscount1'];
$insid = $_SESSION['insid1'];
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
        $data[$i][$j] = $nwout[$j-1][$i];
    }
}
$plot->SetDataValues($data);
$plot->SetTitle("Network OUT");
$plot->SetXTitle("Time Period");
$plot->SetYTitle("N/W OUT \n (in bytes)");
$plot->SetYDataLabelPos('plotin');
$plot->SetDrawXDataLabelLines('true');
$plot->SetLegend($insid);
//Turn off X axis ticks and labels because they get in the way:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

//Draw it
$plot->DrawGraph(); 
?>
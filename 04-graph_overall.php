<?php include('inc/head.php'); ?>

<body>
<!--Header start --!> <?php
    session_start();
    $name = $_SESSION['name'];
    $priv = $_SESSION['priv'];
    ?>
    <header class="clearfix">
    <div class="user left clearfix">
        <div class="avatar"><img src="images/logo.png" alt="user"></div>
        <p><?php echo("$name");?><br/><span><?php echo"$priv"; ?></span></p>
        <a href="00-login.php" class="logout" onclick="return confirm('Are You sure to logout?');">
        <i class="fa fa-power-off"></i></a>
    </div>
    <div class="search right clearfix">
        <a href="#" class="options"><i class="fa fa-cog"></i></a>
        <a href="01-customers.php" class="options">
                <i class="fa fa-home"></i></a>
    </div>
    </header>
    <div id="wrapper" class="clearfix expand"> <!--Header End--!> 

<!--Menu start --!>        <nav class="left eqh">
    <a class="menu-btn open">
        <div class="ham">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </a>
    <a class="mobile-menu">MENU</a>
    <ul class="menu">
        <li class="active"><a><span><i class="fa fa-pie-chart"></i></span><p>Statistics</p></a></li>
        <li><a href="02-02-instances.php"><span><i class="fa fa-list"></i></span><p>Quick Show Instances</p></a></li>
    </ul>
    <div class="bottom">
        <a class="info-btn"><i class="fa fa-info"></i></a>
        <div class="info right">
            <h4>CUSTOMERS DETAILS</h4>
<?php
include('dbconfig.php');
function decryptIt( $q ) 
        {
            $cryptKey  = 'asbp7dnrn1521';
            $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
            return( $qDecoded );
        }
$decrypted = $_POST['aid'];
$count1=0;
$authqry = $mysqli->query("SELECT InstanceID,Status from instances where AccID=\"$decrypted\"");
$count = $authqry->num_rows;
while($row=$authqry->fetch_assoc())
{
    if($row['Status']=='RUNNING')
    $count1++;
}
?>
            <p>CUSTOMER ID : <?php echo($_SESSION['aid']); ?><br/>Customer Name : <?php echo($_SESSION['cname']);?><br />Secret Key : <?php echo($_SESSION['skey']);?>
            <br />Access Key : <?php echo ($_SESSION['akey']);?><br/>Total No of Instances : <?php echo($_SESSION['count']); ?><br />RUNNING :<?php echo ($_SESSION['count1']);?>
            <br/>STOPPED :<?php echo ($_SESSION['count2']);?></p>
        </div>
    </div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br/><br /><br />
</nav>  <!--Menu end--!> 
        <div id="content" class="right">

            <div class="breadcrumbs clearfix">
                <ul class="breadcrumbs left">
                    <form method="post"><li>From Date</li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li><input style="color: black;" name="fdate" type="date" placeholder="YYYY-MM-DD" />
                    <li>To Date</li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li><input style="color: black;" name="tdate" type="date" placeholder="YYYY-MM-DD" />
                    <input type="hidden" name="aid" value="<?php echo($_POST['aid']); ?>" />
                    <input type="submit" name="sbt" value="VIEW GRAPH" /></form></li></form>
                </ul>
            </div>
            <center><table><tr>
<?php
if(isset($_SESSION))
{
    include('dbconfig.php');
if(!empty($_POST['fdate']))
{
    if(isset($_POST['sbt']))
    {
        $fdate = $_POST['fdate'];
        $tdate = $_POST['tdate']; $tdate++;
        $qry = $mysqli->query("select i.InstanceID FROM instances i where i.AccID=\"$decrypted\"");
        $count = $qry->num_rows;
        $result = array(); $i=0;
        $rset = array();$countr = array(); $time = array(); $countr[-1] = 0;
        while($row=$qry->fetch_array())
        {
            $qry1 = $mysqli->query("SELECT c.TimeStamp,c.CPU_util from cpu_util c where c.TimeStamp > \"$fdate\" AND c.TimeStamp < \"$tdate\" AND c.InstanceID=\"$row[0]\"");
            $countr[$i] = $qry1->num_rows; $k = 0;
            while($row=$qry1->fetch_array())
            {$result[] = array($row[0],$row[1]);
            if($countr[$i]>$countr[$i-1])
            {$time[$k]= $row[0];} $k++;}
            $rset[$i] = $result;
            $result = ""; $i++;
        }
        $qry2 = $mysqli->query("SELECT DISTINCT c.InstanceID from cpu_util c JOIN instances i on (i.InstanceID=c.InstanceID) JOIN accountdetails a on (a.AccID=i.AccID) WHERE a.AccID=\"$decrypted\";");
        $count1 = $qry2->num_rows; $insid = array();
        while($row=$qry2->fetch_array())
        $insid[] = $row[0];
        $cpuutil = array(); $max = max($countr); $temp = array(); 
        for($i=0;$i<$count1;$i++)
            {for($j=0;$j<$max;$j++)
                {$temp[$j] = $rset[$i][$j][1]; error_reporting(0);}
        $cpuutil[$i] = $temp;}
        $_SESSION['time'] = $time;
        $_SESSION['cpu'] = $cpuutil;
        $_SESSION['inscount'] = $count1;
        $_SESSION['insid'] = $insid;
        echo "<td><img src=\"graphcpu_ovl.php\" /></td></tr>";
        $i = 0; 
        $qry = $mysqli->query("select i.InstanceID FROM instances i where i.AccID=\"$decrypted\"");
        while($row=$qry->fetch_array())
        {
            $qry1 = $mysqli->query("SELECT n.TimeStamp,n.NWin,n.NWout from networkdetails n where n.TimeStamp > \"$fdate\" AND n.TimeStamp < \"$tdate\" AND n.InstanceID=\"$row[0]\"");
            $countr[$i] = $qry1->num_rows;
            while($row=$qry1->fetch_array())
            {$result[] = array($row[0],$row[1],$row[2]);}
            $rset[$i] = $result;
            $result = ""; $i++;
        }
        $qry2 = $mysqli->query("SELECT DISTINCT n.InstanceID from networkdetails n JOIN instances i on (n.InstanceID=i.InstanceID) JOIN accountdetails a on (a.AccID=i.AccID) WHERE a.AccID=\"$decrypted\";");
        $count2 = $qry2->num_rows; $insid1 = array();
        while($row=$qry->fetch_array())
        $insid1[] = $row[0];
        $nwin = array(); $max = max($countr); $temp1 = array(); $time = array(); $temp2 = array(); $nwout = array();
        for($i=0;$i<$count2;$i++)
            {for($j=0;$j<$max;$j++)
                {$temp1[$j] = $rset[$i][$j][1];
                $temp2[$j] = $rset[$i][$j][2];
                $time[$j] = $rset[$i][$j][0];}
        $nwin[$i] = $temp1;
        $nwout[$i] = $temp2;}
        $_SESSION['time1'] = $time;
        $_SESSION['nwin'] = $nwin;
        echo "<br>";
        $_SESSION['nwout'] = $nwout;
        $_SESSION['inscount1'] = $count2;
        $_SESSION['insid1'] = $insid1;
        echo "<tr><td><img src=\"graphnwin_ovl.php\" /></td></tr><tr><td><img src=\"graphnwout_ovl.php\" /></td></tr>";
        /*$authqry = "SELECT n.NWin,n.NWout from networkdetails n where n.TimeStamp LIKE \"$date1%\" AND n.InstanceID=\"$decrypted\"";
        $rs = mysql_query($authqry);
        $count = mysql_num_rows($rs);
        $nwin = array(); $nwout = array();
        for($i=0;$i<$count;$i++)
        {
            $row=$authqry->fetch_array());
            $nwin[$i] = $row[0];
            $nwout[$i] = $row[1];
        }
        $_SESSION['nwin'] = $nwin;
        $_SESSION['nwout'] = $nwout;
        echo "<td><img src=\"graphnw.php\" /></td>";*/
    }
}
}
else
header("location:errorpage.html");
?>
 </table></center>
        </div>

      <footer>     
            <div class="container">
                <p>Copyright<i class="fa fa-copyright"></i>Team Computers Pvt. Ltd.</p>
                <p style="color: gray;">Developed by<a href="http://www.facebook.com/abhinavsinha9">Abhinav Sinha</a></p>
                            </div>
        </footer>

    </div>

    <?php include('inc/footer.php'); ?>

</body>
</html>
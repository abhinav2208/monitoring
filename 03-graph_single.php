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
            <h4>INSTANCE DETAILS</h4>
<?php
include('dbconfig.php');
function decryptIt( $q ) 
        {
            $cryptKey  = 'teamabhinav';
            $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
            return( $qDecoded );
        }
$key = $_POST['iid']; $decrypted = decryptIt( $key );
$authqry = $mysqli->query("SELECT * from instances where InstanceID=\"$decrypted\"");
$row=$authqry->fetch_assoc();
?>
            <p>Instance ID : <?php echo($row['InstanceID']); ?><br/>Instance Type : <?php echo($row['Type']);?><br />Zone : <?php echo($row['Zone']);?>
            <br />Status : <?php echo ($row['Status']);?><br/>Company IP : <?php echo($row['CompanyIP']); ?><br />Private IP :<?php echo ($row['PrivateIP']);?>
            </p>
        </div>
    </div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
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
                     <input type="hidden" name="iid" value="<?php echo($_POST['iid']); ?>" />
                     <input type="submit" name="sbt" value="VIEW GRAPH"/></li></form>
                </ul>
            </div>
            <table><tr>
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
        /*$date1 = $fdate[2].'/'.$fdate[1];
        $date2 = $tdate[2].'/'.$tdate[1];
        $authqry = "SELECT SSID from cpu_util where TimeStamp LIKE \"$date1\" LIMIT 1";
        $rs = mysql_query($authqry);
        $row=$authqry->fetch_assoc();
        $temp1 = $row[0];
        $authqry = "SELECT SSID from networkdetails where TimeStamp LIKE \"$date2\" LIMIT 1";
        $rs = mysql_query($authqry);
        $row=$authqry->fetch_assoc();
        $temp2 = $row[0];   */
        $authqry = $mysqli->query("SELECT c.TimeStamp,c.CPU_util from cpu_util c where c.TimeStamp > \"$fdate\" AND c.TimeStamp < \"$tdate\" AND c.InstanceID=\"$decrypted\"");
        $count = $authqry->num_rows;
        $time = array(); $cpuutil = array();
        for($i=0;$i<$count;$i++)
        {
            $row=$authqry->fetch_array();
            $time[$i] = $row[0];
            $cpuutil[$i] = $row[1];
        }
        $_SESSION['time'] = $time;
        $_SESSION['cpu'] = $cpuutil;
        echo "<center><img src=\"graphcpu.php\" /></center></tr>";
        $authqry = $mysqli->query("SELECT n.TimeStamp,n.NWin,n.NWout from networkdetails n where n.TimeStamp > \"$fdate\" AND n.TimeStamp < \"$tdate\" AND n.InstanceID=\"$decrypted\"");
        $count = $authqry->num_rows;
        $nwin = array(); $nwout = array(); $timen = array();
        for($i=0;$i<$count;$i++)
        {
            $row=$authqry->fetch_array();
            $timen = $row[0];
            $nwin[$i] = $row[1];
            $nwout[$i] = $row[2];
        }
        $_SESSION['timen'] = $timen;
        $_SESSION['nwin'] = $nwin;
        $_SESSION['nwout'] = $nwout;
        $_SESSION['iid'] = $decrypted;
        
        echo "<tr><center><img src=\"graphnw.php\" /</center>";
    }
}
}
else
header("location:errorpage.html");
?>
        </tr></table>
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
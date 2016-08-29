<?php include('inc/head.html'); ?>

<body>
<!--Header start --!> <?php
    session_start();
    $name = $_SESSION['name'];
    $priv = $_SESSION['priv'];
    $id = $_SESSION['id'];
    $email = $_SESSION['email']; ?>
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
        <li class="active"><a><span><i class="fa fa-list"></i></span><p>Instances</p></a></li>
        <li><a href="02-02-instances.php"><span><i class="fa fa-pie-chart"></i></span><p>Quick Show Instances</p></a></li>
    </ul>
    <div class="bottom">
        <a class="info-btn"><i class="fa fa-info"></i></a>
        <div class="info right">
            <h4>CUSTOMER DETAILS</h4>
<?php
include('dbconfig.php');
function decryptIt( $q ) 
        {
            $cryptKey  = 'asbp7dnrn1521';
            $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
            return( $qDecoded );
        }
$key = $_POST['aid']; $decrypted = decryptIt( $key );
$count1=0;
$authqry = $mysqli->query("SELECT InstanceID,Status from instances where AccID=\"$decrypted\"");
$count = $authqry->num_rows;
while($row=$authqry->fetch_array())
{
    if($row['Status']=='RUNNING')
    $count1++;
}
?>
            <p>CUSTOMER ID : <?php echo"$decrypted"; ?><br/>Customer Name : <?php echo($_POST['cname']);?><br />Secret Key : <?php echo($_POST['skey']);?>
            <br />Access Key : <?php echo ($_POST['akey']);?><br/>Total No of Instances : <?php echo"$count"; ?><br />RUNNING :<?php echo "$count1";?>
            <br/>STOPPED :<?php echo ($count-$count1);?></p>
        </div>
    </div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</nav>  <!--Menu end--!> 
        <div id="content" class="right">

            <div class="breadcrumbs clearfix">
                <ul class="breadcrumbs left">
                    <li><a href="#">AMAZON WEB SERVICES</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>INSTANCES LIST</li>
                </ul>
            </div>

            <div class="tables clearfix">
                <table class="datatable adm-table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Instance ID<span class="order"></span></th>
                            <th>Type<span class="order"></span></th>
                            <th>Zone<span class="order"></span></th>
                            <th>Status<span class="order"></span></th>
                            <th>Company IP<span class="order"></span></th>
                            <th>Private IP<span class="order"></span></th>
                            <th>Statistics<span class="order"></span></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
if(isset($_SESSION['name']))
{
    function encryptIt( $q ) 
        {
            $cryptKey  = 'teamabhinav';
            $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
            return( $qEncoded );
        }
    $authqry = $mysqli->query("SELECT i.InstanceID,i.Type,i.Zone,i.Status,i.CompanyIP,i.PrivateIP from INSTANCES i where i.AccID=\"$decrypted\"");
    $count = $authqry->num_rows;
    while($row = $authqry->fetch_array())
        { 
            echo "<tr>";
            for($i=0;$i<=5;$i++)
                {
                    echo "<td>$row[$i]</td>";
                }
            $encrypted = encryptIt($row[0]);
            echo "<td><form action=\"03-graph_single.php\" method=\"post\"><input type=\"hidden\" name=\"iid\" value=\"$encrypted\"/>
            <input type=\"submit\" value=\"View Graph\"/></form></td></tr>";
        }   
    echo "</tbody></table><center><form action=\"04-graph_overall.php\" method=\"post\"><input type=\"hidden\" name=\"aid\" value=\"$decrypted\"/>
            <input type=\"submit\" style=\"background-color : burlywood\" value=\"View Overall Graph\"/></form></center>";
$_SESSION['cname'] = $_POST['cname']; $_SESSION['skey'] = $_POST['skey']; $_SESSION['akey'] = $_POST['akey']; $_SESSION['aid'] = $decrypted;
$_SESSION['count'] = $count; $_SESSION['count1'] = $count1; $_SESSION['count2'] = $count-$count1;
}
//else
//header('location:errorpage.html');         
?>                      
             </div>

        </div>
         <footer>     
            <div class="container">
                <p>Copyright<i class="fa fa-copyright"></i>Team Computers Pvt. Ltd.</p>
                <p style="color: gray;">Developed by<a href="http://www.facebook.com/abhinavsinha9">Abhinav Sinha</a></p>
                            </div>
        </footer>
    </div>
    <?php include('inc/footer.html'); ?>

</body>
</html>
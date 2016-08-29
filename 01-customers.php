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
        <li class="active"><a><span><i class="fa fa-list"></i></span><p>Customers List</p></a></li>
        <li><a href="02-02-instances.php"><span><i class="fa fa-pie-chart"></i></span><p>Quick Show Instances</p></a></li>
    </ul>
    <div class="bottom">
        <a class="info-btn"><i class="fa fa-info"></i></a>
        <div class="info right">
            <h4>ADMIN DETAILS</h4>
            <p>ADMIN ID : <?php echo($id); ?><br/>Admin Name : <?php echo($name);?><br/>Email ID : <?php echo($email); ?></p>
        </div>
    </div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</nav>  <!--Menu end--!> 

        <div id="content" class="right">

            <div class="breadcrumbs clearfix">
                <ul class="breadcrumbs left">
                    <li><a href="#">AMAZON WEB SERVICES</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Customers List</li>
                </ul>
            </div>

            <div class="tables clearfix">
                <table class="datatable adm-table">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Customer ID<span class="order"></span></th>
                            <th>Customer Name<span class="order"></span></th>
                            <th>Secret Key<span class="order"></span></th>
                            <th>Access Key<span class="order"></span></th>
                            <th>Instances<span class="order"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                
                        
<?php
if(isset($_SESSION)&&($priv=='ADMIN'||$priv=='admin'))
{
    function encryptIt( $q ) 
        {
            $cryptKey  = 'asbp7dnrn1521';
            $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
            return( $qEncoded );
        }
    include('dbconfig.php'); 
    $authqry = $mysqli->query("SELECT * from ACCOUNTDETAILS");
    while($row = $authqry->fetch_assoc())
        { 
            echo "<tr>";
            foreach($row as $key=>$value)
                {
                    echo "<td>$value</td>";
                }
                    $encrypted = encryptIt( $row['AccID'] );
                    $cname = $row['AccName']; $skey = $row['SecretKey']; $akey = $row['AccessKey'];
                    echo "<td><form action=\"02-instances.php\" method=\"post\"><input type=\"hidden\" name=\"aid\" value=\"$encrypted\"/><input type=\"submit\" value=\"Show Instances\"/><input type=\"hidden\" name=\"cname\" value=\"$cname\"/>
                    <input type=\"hidden\" name=\"skey\" value=\"$skey\"/><input type=\"hidden\" name=\"akey\" value=\"$akey\"/></form></td>";
            echo "</tr>";
        }
}
else
header("location:errorpage.html");
?>                      
                            

                    </tbody>
                </table>
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
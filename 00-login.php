<?php include('inc/head.html'); ?>

<body class="full">

    <div class="fake-table">
        <div class="fake-table-cell">
            <div id="login">
                <div class="top left clearfix">
                    <div class="logo left"><img src="images/logo.png" alt="logo"></div>
                    <p>TEAM CLOUD AWS<br><span>LOGIN PAGE</span></p>
                </div>
                <form method="post" class="clearfix">
                    <div class="fields">
                        <fieldset>
                            <input type="text" name="aid" placeholder="LOGIN">
                            <span><i class="fa fa-user"></i></span>
                        </fieldset>
                        <fieldset>
                            <input type="password" name="pwd" placeholder="PASSWORD">
                            <span><i class="fa fa-key"></i></span>
                        </fieldset>
                        <input type="submit" name="sbt" value="OK">
                    </div>
                    <div class="bottom clearfix">
                        
                        <a href="00-01-forgot-password.html" class="forgot right">FORGOT PASSWORD?</a>
                    </div>
                </form>            
<?php
session_start();
if(isset($_SESSION))
{
    echo "Logout Successful! Relogin to continue";
}
if(isset($_POST['sbt']))
    {
$uname = $_POST['aid'];
$pwd = $_POST['pwd'];

include('dbconfig.php'); 
$authqry = $mysqli->query("SELECT LoginID, Name, Privilege, EmailID from LOGINMASTER WHERE LoginID = '$uname' AND Password = '$pwd'");

    if($row = $authqry->fetch_assoc())
        {
            $_SESSION['name'] = $row['Name'];
            $_SESSION['priv'] = $row['Privilege'];
            $_SESSION['id'] = $row['LoginID'];
            $_SESSION['email'] = $row['EmailID'];
            if($row['Privilege']=='ADMIN'||$row['Privilege']=='admin')
            {
                header("location:01-customers.php");
            }
            elseif($row['Privilege']=='CUSTOMER'||$row['Privilege']=='customer')
            {
                header("location:bridge.php?aid=$uname");
            }
        }   
    else
        {
            echo "<h3 style = \"text-color : red\">Invalid Admin ID / Password !!! Try again.</h3>";
        }
    }
?>
<?php include('inc/footer.html'); ?>
                </div>
        </div>
</div>
</body>
</html>
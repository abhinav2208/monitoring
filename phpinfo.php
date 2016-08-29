<form><input name="date" type="date"/><input type="submit" name="sbt" /></form> 
 <?php
if(isset($_GET['sbt']))
{$a = $_GET['date'];
++$a;
    echo ($a++);
echo "ka bey bhosdi";}
//phpinfo();
?>

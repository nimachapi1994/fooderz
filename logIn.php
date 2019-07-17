<?php
/**
 * Created by PhpStorm.
 * User: unixname
 * Date: 7/21/18
 * Time: 4:16 PM
 */
?>
<?php
    include "DBconnect.php";
    if(isset($_POST['sub']))
    {
        $phone = $_POST['phone'];
        $password = md5($_POST['pass']);
        $query = "INSERT INTO customers(phone, password) VALUES('$phone', '$password')";
        mysqli_query($connection, $query);

    }
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <table>
        <tr>
            <td>phone: </td>
            <td><input type="text" name="phone" id="phone"></td>
        </tr>
        <tr>
            <td>password: </td>
            <td><input type="password" name="pass" id="pass"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="sub" id="sub" value="send"></td>
        </tr>
    </table>
</form>
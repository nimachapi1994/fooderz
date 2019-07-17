<?php
// var_dump($_POST);
// die();
session_start();
if (!isset($_SESSION['phone'])) 
{
    die();

}
try
{
    require_once '../DataBase/PDO/DBconnect/DBconnect.php';
    $sql     = "SELECT cus_ID, address FROM customers WHERE phone=:phone";
    $stmt    = $db->
    prepare($sql);
    $bindArr = array
        (
        ":phone" => $_SESSION['phone'],
        );
    $stmt->execute($bindArr);
    $address = json_decode($stmt->fetch()['address'], 1);
    $errInfo = $stmt->errorInfo();
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
// var_dump($address);
// die();
if (!empty($_POST['addrAll']) && !empty($_POST['addrLabel']) && !empty($_POST['addrSpan']))
{
    $address[] = array('addrLabel' => $_POST['addrLabel'], 'addrSpan' => $_POST['addrSpan'], 'addrAll' => $_POST['addrAll']);
    try
    {
        require_once '../DataBase/PDO/DBconnect/DBconnect.php';
        $sql     = "update customers set address=:address WHERE phone=:phone";
        $stmt    = $db->prepare($sql);
        $bindArr = array
            (
            ":phone"   => $_SESSION['phone'],
            ":address" => json_encode($address),
        );
        $stmt->execute($bindArr);
        $errInfo = $stmt->errorInfo();
    }
    catch (Exception $e)
    {
        $err = $e->getMessage();
    }

}
if (!empty($address))
{
    foreach ($address as $k => $v)
    {
        ?>
<div class="address">
    <svg class="icon" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 0c-4.198 0-8 3.403-8 7.602 0 6.243 6.377 6.903 8 16.398 1.623-9.495 8-10.155 8-16.398 0-4.199-3.801-7.602-8-7.602zm0 11c-1.657 0-3-1.343-3-3s1.342-3 3-3 3 1.343 3 3-1.343 3-3 3z">
        </path>
    </svg>
    <div class="addr" style="display: inline-block;">
        <b class="label">
            خانه
        </b>
        <div class="text">
            <?php echo $v['addrAll'] ?>
        </div>
    </div>
</div>
<?php
}}?>
<script>
    $('.checkout-box .address').click(function(){
        $('.checkout-box .address').removeClass("selected");
        $(this).addClass("selected");
        // $(this).children('.text').html();
    })
</script>
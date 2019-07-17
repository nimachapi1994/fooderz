<?php
session_start();
// var_dump($_POST);
// die();
try
{
    require_once '../DataBase/PDO/DBconnect/DBconnect.php';
    $sql     = "SELECT cus_ID, favorite_restaurants FROM customers WHERE phone=:phone";
    $stmt    = $db->prepare($sql);
    $bindArr = array
        (
        ":phone" => $_SESSION['phone'],
    );
    $stmt->execute($bindArr);
    $fav_res = json_decode($stmt->fetch()['favorite_restaurants'], 1);
    $errInfo = $stmt->errorInfo();
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
if (isset($_POST['add']) && !in_array($_POST['add'], $fav_res))
{
    $fav_res[] = $_POST['add'];
}
elseif (isset($_POST['del']))
{
    $delID = $_POST['del'];
    $delID = array_search($delID, $fav_res);
    if ($delID !== null)
    {
        unset($fav_res[$delID]);
    }
}
try
{
    require_once '../DataBase/PDO/DBconnect/DBconnect.php';
    $sql     = "update customers set favorite_restaurants=:favorite_restaurants WHERE phone=:phone";
    $stmt    = $db->prepare($sql);
    $bindArr = array
        (
        ":phone"                => $_SESSION['phone'],
        ":favorite_restaurants" => json_encode($fav_res),
    );
    $stmt->execute($bindArr);
    $errInfo = $stmt->errorInfo();
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
try
{
    require_once '../DataBase/PDO/DBconnect/DBconnect.php';
    $sql = "SELECT providerName, prv_ID FROM provider WHERE ";
    if (!empty($fav_res))
    {
        foreach ($fav_res as $k => $v)
        {
            $sql .= "prv_ID = $v or ";
        }
        $sql = rtrim($sql, 'or ');
        // echo $sql;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $errInfo = $stmt->errorInfo();
    }
}
catch (Exception $e)
{
    $err = $e->getMessage();
}
// var_dump($fav_res);
if (!empty($fav_res)) {
while ($row = $stmt->fetch())
{
    // var_dump($row);
    ?>
<div class="item">
                            <div class="assets">
                                <div class="dislike_r">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 455.111 455.111">
                                        <circle style="fill:#E24C4B;" cx="227.556" cy="227.556" r="227.556"/>
                                        <path style="fill:#D1403F;" d="M455.111,227.556c0,125.156-102.4,227.556-227.556,227.556c-72.533,0-136.533-32.711-177.778-85.333  c38.4,31.289,88.178,49.778,142.222,49.778c125.156,0,227.556-102.4,227.556-227.556c0-54.044-18.489-103.822-49.778-142.222  C422.4,91.022,455.111,155.022,455.111,227.556z"/>
                                        <path style="fill:#FFFFFF;" d="M331.378,331.378c-8.533,8.533-22.756,8.533-31.289,0l-72.533-72.533l-72.533,72.533  c-8.533,8.533-22.756,8.533-31.289,0c-8.533-8.533-8.533-22.756,0-31.289l72.533-72.533l-72.533-72.533  c-8.533-8.533-8.533-22.756,0-31.289c8.533-8.533,22.756-8.533,31.289,0l72.533,72.533l72.533-72.533  c8.533-8.533,22.756-8.533,31.289,0c8.533,8.533,8.533,22.756,0,31.289l-72.533,72.533l72.533,72.533  C339.911,308.622,339.911,322.844,331.378,331.378z"/>
                                    </svg>
                                </div>
                                <input type="text" name="prv_ID" id="prv_ID" value="<?php echo $row['prv_ID'] ?>" hidden >
                                <div class="liked_logo"><img src="images/blog1.jpg" alt="" /></div>
                                <div class="name"><?php echo $row['providerName'] ?></div>
                            </div>
                        </div>
<?php }}?>
<script>
                $('.dislike_r').click(function(){
                    // console.log($(this).parent().children("#prv_ID").val())
                    $.post('favorite_ajax.php', {del: $(this).parent().children("#prv_ID").val()}, function(data)
                    {
                        $("#item_ajax").html(data);
                    });
                });
</script>
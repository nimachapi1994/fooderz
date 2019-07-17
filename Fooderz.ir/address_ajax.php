<h2 class="text-center tab-title">
    آدرس های من
</h2>
<div class="text-center">
    <button class="add-address" data-target="#address-modal" data-toggle="modal">
        + افزودن آدرس جدید
    </button>
</div>
<?php
session_start();
// var_dump($_POST['editID']);
// die();
try
{
    require_once '../DataBase/PDO/DBconnect/DBconnect.php';
    $sql     = "SELECT cus_ID, address FROM customers WHERE phone=:phone";
    $stmt    = $db->prepare($sql);
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
    if (!empty($_POST['editID']))
    {
        $editID           = $_POST['editID'];
        $address[$editID] = array('addrLabel' => $_POST['addrLabel'], 'addrSpan' => $_POST['addrSpan'], 'addrAll' => $_POST['addrAll']);
    }
    else
    {
        $address[] = array('addrLabel' => $_POST['addrLabel'], 'addrSpan' => $_POST['addrSpan'], 'addrAll' => $_POST['addrAll']);
    }
}
elseif (isset($_POST['addressID']))
{
    $addressID = $_POST['addressID'];
    unset($address[$addressID]);
}
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
foreach ($address as $k => $v)
{
    ?>
<div class="address text-center">
    <h3 class="address-label">
        <?php echo $v['addrLabel'] ?>
    </h3>
    <h4 class="region">
        <?php echo $v['addrSpan'] ?>
    </h4>
    <p class="full-address">
        <?php echo $v['addrAll'] ?>
    </p>
    <input type="text" class="addressID" value="<?php echo $k ?>" hidden>
    <svg class="delete" viewbox="0 0 455.111 455.111" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>
            حذف آدرس
        </title>
        <circle cx="227.556" cy="227.556" r="227.556" style="fill:#E24C4B;">
        </circle>
        <path d="M455.111,227.556c0,125.156-102.4,227.556-227.556,227.556c-72.533,0-136.533-32.711-177.778-85.333  c38.4,31.289,88.178,49.778,142.222,49.778c125.156,0,227.556-102.4,227.556-227.556c0-54.044-18.489-103.822-49.778-142.222  C422.4,91.022,455.111,155.022,455.111,227.556z" style="fill:#D1403F;">
        </path>
        <path d="M331.378,331.378c-8.533,8.533-22.756,8.533-31.289,0l-72.533-72.533l-72.533,72.533  c-8.533,8.533-22.756,8.533-31.289,0c-8.533-8.533-8.533-22.756,0-31.289l72.533-72.533l-72.533-72.533  c-8.533-8.533-8.533-22.756,0-31.289c8.533-8.533,22.756-8.533,31.289,0l72.533,72.533l72.533-72.533  c8.533-8.533,22.756-8.533,31.289,0c8.533,8.533,8.533,22.756,0,31.289l-72.533,72.533l72.533,72.533  C339.911,308.622,339.911,322.844,331.378,331.378z" style="fill:#FFFFFF;">
        </path>
    </svg>
    <svg class="edit" data-target="#address-modal" data-toggle="modal" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <title>
            ویرایش
        </title>
        <path d="M7.127 22.564l-7.126 1.436 1.438-7.125 5.688 5.689zm-4.274-7.104l5.688 5.689 15.46-15.46-5.689-5.689-15.459 15.46z">
        </path>
    </svg>
    <svg class="background" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M24 22.586l-2.823-2.823c.526-.792.836-1.74.836-2.763 0-2.762-2.238-5-5-5s-5 2.238-5 5 2.238 5 5 5c1.016 0 1.957-.307 2.746-.827l2.827 2.827 1.414-1.414zm-9.987-5.586c0-1.654 1.346-3 3-3s3 1.346 3 3-1.346 3-3 3-3-1.346-3-3zm-4 0l.002-.034-3.015 2.175v-13.068l4-2.886v10.247c.508-.854 1.189-1.591 2-2.161v-8.086l4 2.886v3.927h.013c.336 0 .664.032.987.078v-4.007l4-2.479v8.504c1.188 1.208 1.936 2.844 2 4.653v-16.749l-6.455 4-5.545-4-5.545 4-6.455-4v18l6.455 4 3.91-2.82c-.226-.687-.352-1.419-.352-2.18zm-4.013 2.365l-4-2.479v-13.294l4 2.479v13.294z">
        </path>
    </svg>
</div>
<?php
}
?>
<script>
    $('.delete').click(function() {
                // console.log($(this).parent().children('.addressID').val())
                $.post('address_ajax.php', { addressID: $(this).parent().children('.addressID').val()}, function(data, sts) {
                    $('#addresses .info').html(data)
                });
            });
    $('.edit').click(function() {
                    $('#editID').val($(this).parent().children('.addressID').val())
                // console.log($(this).parent().children('.addressID').val())
                // $.post('address_ajax.php', { addressEditID: $(this).parent().children('.addressID').val()}, function(data, sts) {
                //     $('#addresses .info').html(data)
                // });
				var parent = $(this).parent();
				var label = parent[0].childNodes[1].innerHTML;
				var region = parent[0].childNodes[3].innerHTML;
				var full_address = parent[0].childNodes[5].innerHTML;
				$('#address-labell').val(label);
				$('#address-regionn').val(region);
				$('#full-adresss').val(full_address);
            });
    $('.add-address').click(function(){
        $('#editID').val('');
    });
</script>
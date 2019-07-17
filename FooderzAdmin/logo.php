<?php include('Shared/Top.php') ?>
<br />
<br />
<br />
<br />

<div class="container text-center">
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-3">
            <br />
            <br />
            <br />
            <div class="form-group">
                <input type="file"class="form-control" id="btnGetLogo"/>
                <br />

                <br />
                <button class="btn btn-success">ثبت و ذخیره</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table-bordered" style="width:300px;height:300px" id="divgetimg">
                <button type="button" class="btn btn-danger" id="btnClearImg" >&times;</button>
                <img src="" width="300" height="300" id="img" />

            </div>
        </div>
    </div>
</div>
<hr />
<br /><br /><br /><br />
<div class="container text-center">
    <h3 style="margin:auto;font-family:Tahoma">لوگو های قبلی</h3><br />
    <div class="col-md-2">

    </div>
    <div class="col-md-4">
        <div style="border:medium;border-style:ridge;border-color:aliceblue">
            <img width="300" height="300" id="img1"/>
            <br />
            <div class="checkbox text-center">
                <label id="lblSelectThisLogo">انتخاب</label><br>
                <input type="checkbox"class="text-center"id="chkbSelectLogo" />

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div style="border:medium;border-style:ridge;border-color:aliceblue">
            <img width="300" height="300" id="img1" />
            <br />
            <div class="checkbox text-center">
                <label id="lblSelectThisLogo">انتخاب</label><br>
                <input type="checkbox"class="text-center"id="chkbSelectLogo" />

            </div>
        </div>
    </div>
    <div class="col-md-2">

    </div>
</div><br /><br /><br /><br />
<script>
    chkbSelectLogo.onchange = () => {
        if (chkbSelectLogo.checked == true) {
            lblSelectThisLogo.innerHTML = 'انتخاب شده'
            lblSelectThisLogo.style.color = 'green'
        } else {
            lblSelectThisLogo.innerHTML = 'انتخاب '
            lblSelectThisLogo.style.color = 'black'
        }

    }

</script>
<script>
    $(document).html(()=>{$(divgetimg).hide()})
    btnGetLogo.onchange = () => {
        $(divgetimg).show(500);
        var data = new FileReader();
        data.readAsDataURL(btnGetLogo.files[0])
        data.onloadend = (ex) => (img.src = ex.target.result);
    }
    btnClearImg.onclick = () => {
        $(divgetimg).hide(500);
        img.src = ''
        btnGetLogo.files[0] = ''
        btnGetLogo.src = ''
        btnGetLogo.value = ''


    }
</script>
<?php include('Shared/Bottom.php') ?>

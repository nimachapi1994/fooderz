<?php include('../Shared/Top.php') ?>

<script type="text/javascript"src="../Plugins/ckeditor/ckeditor.js"></script>
<div class="container text-center"style="margin: :auto;width: 40%">
<br>
    <div class="form-group">
        <select class="form-control">
            <option>انتخاب صفحه</option>

        </select>

    </div>

</div>
<br><hr>
<div class="container text-center"style="margin: :auto;width: 70%;height: 100%">
    <br>
   <textarea id="ck"style="line-height: 100cm"></textarea>
<button class="btn btn-success">ثبت و ذخیره اطلاعات</button>
</div>
<script>
    CKEDITOR.replace(ck);
    // CKEDITOR.replace('ck', { filebrowserImageUploadUrl: '/Editor/Upload' })
</script>
<?php include('../Shared/Bottom.php') ?>

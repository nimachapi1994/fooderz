<?php
function foodCount($fc)
{
	$zero_num = (4 - strlen($fc));
	for ($i = 0; $i < $zero_num; $i++)
	{
		$fc = "0" . $fc;
	}
	return $fc;
}
echo foodCount(24);
?>
<?php $i = 0;
foreach ($giftRow as $k => $v)
{
	$id_num = foodCount($i);
	?>
<br style="clear:both;">
    <div class="each_cat_box fadeIn" id="box_num1">
        <button class="fooderz_btn food-cat-close" type="button">
            ×
        </button>
        <input class="food-input category_title width85_767" id="cat_food1" name="cat_food1" placeholder="نام سرمنو (مثلا کباب ها)" type="text" value="<?php echo $k ?>">
            <button class="add_food_btn" type="button">
                <svg aria-hidden="true" class="svg-inline--fa fa-plus-circle fa-w-16" data-fa-i2svg="" data-icon="plus-circle" data-prefix="fas" role="img" viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" fill="currentColor">
                    </path>
                </svg>
                <!-- <i class="fas fa-plus-circle"></i> -->
                افزودن غذا
            </button>
            <?php
foreach ($v as $k1 =>$v1)
	{
		?>
            <div class="food-box fadeIn" id="food<?php echo $id_num ?>" name="food<?php echo $id_num ?>">
                <button class="fooderz_btn food-close" type="button">
                    ×
                </button>
                <div class="row">
                    <div class="col-sm-4 img-box">
                        <div class="image js--image-preview" id="upload<?php echo $id_num ?>">
                            <img alt="" class="food_img_uploaded" id="img<?php echo $id_num ?>" src="">
                                <label class="upload" for="upload-photo">
                                    آپلود تصویر
                                </label>
                                <input accept="image/*" class="upload_btn image-upload" id="upload<?php echo $id_num ?>" name="upload<?php echo $id_num ?>" placeholder="آپلود تصویر" type="file"/>
                            </img>
                        </div>
                    </div>
                    <div class="col-sm-8 details">
                        <input class="food-input food-name" name="ffood<?php echo $id_num ?>" placeholder="نام غذا" type="text" value="<?php echo $k1 ?>">
                            <input class="food-input desc" name="tfood<?php echo $id_num ?>" placeholder="توضیحات کوتاه" type="text">
                                <input class="food-input food-price" name="gfood<?php echo $id_num ?>" placeholder="قیمت" type="text"/>
                            </input>
                        </input>
                    </div>
                </div>
            </div>
            <?php
$i++;
	}?>
        </input>
    </div>
    <?php
}?>
</br>
//slkdjf slkdjf lksdj flskdj
<?php $i = 0;
foreach ($giftRow as $k => $v)
{
	$id_num = foodCount($i);
	?>
        <div class="each_cat_box fadeIn" id="box_num1">
            <button class="fooderz_btn food-cat-close" type="button">
                ×
            </button>
            <input value="<?php echo $k ?>" class="food-input category_title width85_767" id="cat_food1" name="cat_food1" placeholder="نام سرمنو (مثلا کباب ها)" type="text">
                <button class="add_food_btn" type="button">
                    <svg aria-hidden="true" class="svg-inline--fa fa-plus-circle fa-w-16" data-fa-i2svg="" data-icon="plus-circle" data-prefix="fas" role="img" viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z" fill="currentColor">
                        </path>
                    </svg>
                    <!-- <i class="fas fa-plus-circle"></i> -->
                    افزودن غذا
                </button>
                <?php
foreach ($v as $k1 =>
            $v1)
	{
		?>
                <div class="food-box fadeIn" id="food<?php echo $id_num ?>" name="food<?php echo $id_num ?>">
                    <button class="fooderz_btn food-close" type="button">
                        ×
                    </button>
                    <div class="row">
                        <div class="col-sm-4 img-box">
                            <div class="image js--image-preview" id="upload<?php echo $id_num ?>">
                                <img alt="" class="food_img_uploaded" id="img<?php echo $id_num ?>" src="">
                                    <label class="upload" for="upload-photo">
                                        آپلود تصویر
                                    </label>
                                    <input accept="image/*" class="upload_btn image-upload" id="upload<?php echo $id_num ?>" name="upload<?php echo $id_num ?>" placeholder="آپلود تصویر" type="file"/>
                                </img>
                            </div>
                        </div>
                        <div class="col-sm-8 details">
                            <input class="food-input food-name" name="ffood<?php echo $id_num ?>" placeholder="نام غذا" type="text">
                                <input class="food-input desc" name="tfood<?php echo $id_num ?>" placeholder="توضیحات کوتاه" type="text">
                                    <input class="food-input food-price" name="gfood<?php echo $id_num ?>" placeholder="قیمت" type="text"/>
                                </input>
                            </input>
                        </div>
                    </div>
                </div>
            <?php 
        } ?>
            </input>
        </div>
    </br>
    <?php } ?>
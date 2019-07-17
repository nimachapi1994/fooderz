<html>
<head>

<meta charset="utf-8">
<title>پنل مدیریت فودرز</title>
<link type="text/css" rel="stylesheet" href="../style.css">
<script type="text/javascript" src="../jquery.min.js"></script>
<script type="text/javascript" src="../jquery.flot.js"></script>
<script type="text/javascript" src="../doc.js"></script>


    <link type="text/css" rel="stylesheet" href="../Css/bootstrap.css">
    <script type="text/javascript" src="../Js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../Js/bootstrap.js"></script>



<body style="font-family: Tahoma">

<div class="body_style">
	<div class="menu">
    <a href="../index.php"><img src="../image/AdminLogo.png" style="width:180px;height: 50px"> </a>
    </div>
	<div class="nav">
    	<ul>
        	<li class="active">
            	<div class="fix">
                    <span class="ico"><img src="../image/ico1.png"></span>
                    <span class="value">مدیریت</span>
                </div>
             </li>
<!--			 <li>-->
<!--            	<div class="fix">-->
<!--                    <span class="ico"><img src="../image/ico2.png"></span>-->
<!--                    <span class="value">بخش تنطیمات سایت</span>-->
<!--                </div>-->
<!--                <ul>-->
<!---->
<!--					<li><a href="../WebPagesSetting/SitePages.php">صفحات متنی</a></li>-->
<!---->
<!---->
<!--                    -->
<!--                </ul>-->
<!--            </li>-->
            <li>
            	<div class="fix">
                    <span class="ico"><img src="../image/ico2.png"></span>
                    <span class="value">مشتریان</span>
                </div>
                <ul>
                	<li><a href="../Customers/CustomerList.php">لیست مشتریان</a></li>
               <li><a href="../Customers/CustomerListFirstBuy.php">لیست اولین خرید مشتریان</a></li>
                </ul>
            </li>
			 <li>
            <div class="fix">
                <span class="ico"><img src="../image/ico3.png"></span>
                <span class="value">خرید ها</span>
            </div>
                <ul>
                	<li><a href="../BuyReport/BuyReport.php">گزاراشات خرید</a></li>
            
                </ul>
            </li>
			 <li>
            	<div class="fix">
                    <span class="ico"><img src="../image/ico2.png"></span>
                    <span class="value">ارائه دهندگان</span>
                </div>
                <ul>
                	<li><a href="../Providers/ProviderNotConfirm.php" style="color:chocolate;font-size:small"> ارائه دهندگان تایید نشده</a></li>
					                	<li><a href="../Providers/ProviderConfirm.php" style="color:black;font-size:small"> ارائه دهندگان تایید شده</a></li>


                  
                </ul>
            </li>
            <li>
            <div class="fix">
                <span class="ico"><img src="../image/ico3.png"></span>
                <span class="value">مدیریت مالی</span>
            </div>
                <ul>

                    <li><a href="../financial/financial.php">گزارش واریزی و درآمد ما</a></li>
                
                </ul>
            </li>
              <li>
            <div class="fix">
                <span class="ico"><img src="../image/car_scania.png"width="50"height="25"></span>
                <span class="value"style="padding-right: 5%">عمده فروش </span>
            </div>
                <ul>

                    <li><a href="../Suppliers/NewSupp.php">اضافه کردن +</a></li>
  <li><a href="../Suppliers/ShowAllSupps.php"">مشاهده لیست عمده فروش ها</a></li>
                
                </ul>
            </li>
            <li>
            <div class="fix">
                 <span class="ico"><img src="../image/ico5.png"></span>
                <span class="value">پیام ها</span>
            </div>
                <ul>
                	<li><a href="../CommentNotConfirm/Comment.php">کامنت <span style="color: darkred">تایید نشده</span> مشتری بعد از خرید</a></li>
                    <li><a href="../Msg/Msg.php">تیکت های ارسالی</a></li>
                </ul>
            </li>
            <?php

            include "../../DataBase/PDO/DBconnect/DBconnect.php";

            try
            {
                $dateNow=date('m-d');
                $query='select * from customers where Gift=:val;select * from provider where Gift=:val';
                $stmt10=$db->prepare($query);
                $arrCustomer=[":val"=>0];
                $stmt10->execute($arrCustomer);
                $errinfo=$stmt10->errorInfo();
                $cusCount=0;
                $prvCount=0;
                while ($count=$stmt10->fetch())
                {
                    if ((substr($count["bornDate"],-5)==$dateNow)) $cusCount++;
                }
                $stmt10->nextRowset();
                while ($count=$stmt10->fetch())
                {
                    if ((substr($count["bornDate"],-5)==$dateNow)) $prvCount++;
                }
            }
            catch (Exception $ex)
            {
                $err=$ex->getMessage();
            }
            // try
            // {
            //     $queryP='select * from provider where Gift=:val';
            //     $stmt122=$db->prepare($queryP);
            //     $arrprovider=[":val"=>0];
            //     $stmt122->execute($arrprovider);
            //     $errinfo=$stmt122->errorInfo();
            // }catch (Exception $ex)
            // {
            //     $err=$ex->getMessage();
            // }
            // $cus= $stmt22->rowCount();
            // $pro=$stmt122->rowCount();
            ?>


              <li>
                <div class="fix">
                    <span class="ico"><img src="../image/flower.png" width="25"height="30"></span>
                    <a  href="../Gift/Gift.php"><span class="value"style="color: white">ارسال هدیه <small style=";margin: auto;padding-right: 5px">
                            <span style="color: #3eadff;font-size: medium;font-family: Tahoma;border-radius: 40%;width: 20.1%"> <?php
                                echo ($cusCount+$prvCount) .'+';


                                ?> </span>
                        </small></span></a>
                </div>

            </li>
        </ul>
    </div>
    
    <div class="content">
    
    
      

    

<!--
	<h2>نمونه فیلد ها</h2>
    <textarea name="name" class="fild" style="width:400px; height:100px;"></textarea><br>
    <input type="text" class="fild" name=""><br>
    <button class="btn" type="submit" name="submit" value="submit">نمونه گزینه</button>
    <button class="btn b1" type="submit" name="submit" value="submit">نمونه گزینه</button>
    <button class="btn b2" type="submit" name="submit" value="submit">نمونه گزینه</button>
    <button class="btn b3" type="submit" name="submit" value="submit">نمونه گزینه</button>
    <button class="btn b4" type="submit" name="submit" value="submit">نمونه گزینه</button>
    <button class="btn b5" type="submit" name="submit" value="submit">نمونه گزینه</button>
-->
	

	</div>

    
</div>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>returants info</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#msg1').hide();
            //if (fullName.value != '' && email.value != '' && message.value != '')
            {
                $("#sub").click(function () {
                    $.post("validate.php", $('#theForm').serialize(),
                        function (ex) {
                            //if (ex == 'پیام شما با موفقیت ارسال شد!!!') document.getElementById("divCm").className = "alert alert-success";
                            $(msg1).show();
                            $(msg1).html(ex);
                        });
                });
            }
        });
        prvArr=Array(`--نوع ارایه خدمات--`, 'رستوران', 'کافی شاپ', 'پزندگی', 'کله پزی');
        resArr=Array('--نوع رستوران--', 'ایرانی', 'فرنگی', 'دریایی', 'فست فود', 'چینی', 'غیره');
        function t()
        {
            let prvkey=document.getElementById('provType').value;
            let resKey=document.getElementById('resType').value;
            if (prvkey == "--نوع ارایه خدمات--")
            {
                document.getElementById('prvErr').innerHTML='لطفا نوع خدمات خود را انتخاب کنید!';
                document.getElementById('resType').hidden=true;

            }
            else
            {
                document.getElementById('prvErr').innerHTML=null;
                if (prvkey != "رستوران")
                {
                    document.getElementById('resType').hidden=true;
                }
                else
                {
                    if (resKey == "--نوع رستوران--")
                    {
                        document.getElementById('resErr').innerHTML='لطفا نوع رستوران را انتخاب کنید!';
                    }
                        document.getElementById('resType').removeAttribute('hidden');
                    document.getElementById('resType').innerHTML=null;
                    for (let i=0; i<resArr.length; i++)
                    {

                        document.getElementById('resType').innerHTML+="<option value='" + resArr[i] + "'>" + resArr[i] + "</option>";
                    }
                }
            }


        }

        function regFunc(myPattern, myId, msgId, err)
        {
            let valueId=document.getElementById(myId).value;
            if (valueId == '')
            {
                document.getElementById(msgId).innerHTML='تکمیل این فیلد اجباری است';
                document.getElementById(myId).style.borderColor='red';
            }
            else if (myPattern.test(valueId))
            {
                document.getElementById(msgId).innerHTML='ok';
                document.getElementById(myId).style.borderColor='black';
            }
            else
            {
                document.getElementById(msgId).innerHTML=err;
                document.getElementById(myId).style.borderColor='red';
            }
        }

        function regExec()
        {
            let arr=
                [
                    [/^[0-9]$/, 'resName', 'msg', 'ارور'],
                    [/^[a-z]$/, 'mngrName', 'msg1', 'ارور ۱'],
                ];
            for (let i=0; i<arr.length; i++)
            {
                let j=0;
                regFunc(arr[i][j], arr[i][++j], arr[i][++j], arr[i][++j]);
            }
        }
    </script>
</head>
<body>
<form id="theForm" name="theForm" method="post">
    <table>
        <tr>
            <td><input type="text" name="resName" id="resName" placeholder="resName"
                       onblur="regFunc(/./, 'resName', 'resNameErr', 'شماره تلفن اشتباه است!')"></td>
            <td><p id="resNameErr"></p></td>
        </tr>
        <tr>
            <td><input type="text" name="mngrName" id="mngrName" placeholder="mngrName"
                       onblur="regFunc(/./, 'mngrName', 'mngrNameErr', 'شماره تلفن اشتباه است!')"></td>
            <td><p id="mngrNameErr"></p></td>
        </tr>
        <tr>
            <td>
                <select name="city" id="city">
                    <option>shiraz</option>
                </select>
            </td>
            <td></td>
        </tr>
        <tr>
            <td><input type="text" name="address" id="address" placeholder="address"></td>
        </tr>
        <tr>
            <td><input type="text" name="phone" id="phone" placeholder="phone"
                       onblur="regFunc(/^0[0-9]{10}$/, 'phone', 'phoneErr', 'شماره تلفن اشتباه است!')"></td>
            <td><p id="phoneErr"></p></td>
        </tr>
        <tr>
            <td><input type="text" name="mobile" id="mobile" placeholder="mobile"
                       onblur="regFunc(/^09[0-9]{9}$/, 'mobile', 'mobileErr', 'شماره تلفن اشتباه است!')"></td>
            <td><p id="mobileErr"></p></td>
        </tr>
        <tr>
            <td>
                <select name="provType" id="provType" onchange="t()">
                    <script>
                        for (let i=0; i<prvArr.length; i++)
                        {
                            document.write("<option value='"+prvArr[i]+"'>" + prvArr[i] + "</option>");
                        }
                    </script>
                </select>
            </td>
            <td><p id="prvErr"></p></td>
        </tr>
        <tr>
            <td>
                <select name="resType" id="resType" hidden="hidden" onclick="resErr.innerHTML=''">
                    <script>

                    </script>
                </select>
            </td>
            <td><p id="resErr"></p></td>

        </tr>
        <tr>
            <td>
                <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td><input type="button" name="sub" value="submit" id="sub"></td>
        </tr>
    </table>
    <br>
    <p id="msg1">s</p>

</form>

</body>
</html>

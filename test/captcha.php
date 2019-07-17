<title>demo.php</title>
    <body style="background-color:#ddd; ">

    <?php
    create_image();
    display();
    /***** definition of functions *****/
    function display()
    {
        ?>

        <div style="text-align:center;">
            <h3>TYPE THE TEXT YOU SEE IN THE IMAGE</h3>
            <b>This is just to check if you are a robot</b>

            <div style="display:block;margin-bottom:20px;margin-top:20px;">
                <img src="image.png">
            </div>
            //div1 ends
        </div>                          //div2 ends

    <?php
    }

    function  create_image()
    {
        $image = imagecreatetruecolor(200, 50);
        imagepng($image, "image.png");
    }

    ?>
    </body>

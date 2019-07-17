$(document).ready(function() {
	 $('.ajaxCall').change(function ()
    {
        $('.main-grid').html('<img src="ajax_loading.gif">');
        $.post('restaurant-list-ajax.php',
            $('.ajaxCall').serialize()
            , function (ex)
            {
                $('.main-grid').html(ex);
                // alert('sdf');
                // document.write(ex);
                // console.log($('.ajaxCall').serialize());
            })
    });
    $('document').ready(function ()
    {
        $('.main-grid').html('<div class="text-center"><img id="grid-page-loading" src="ajax_loading.gif"></div>');
        $.post('restaurant-list-ajax.php',
            $('.ajaxCall').serialize()
            , function (ex)
            {
                $('.main-grid').html(ex);
                // alert('sdf');
                // document.write(ex);
                // console.log($('.ajaxCall').serialize());
            })
    });
    
    $(document).ready(function ()
    {
        $('div.search input.mahalle').click(function ()
        {
            $('#mahalle_ajax_box').css('display', 'block')
        })
        //close this box when clicking outside of that
        var mouse_is_inside=false;
        $('.ajax_box').hover(function ()
        {
            mouse_is_inside=true;
        }, function ()
        {
            mouse_is_inside=false;
        });
        $("body").mouseup(function ()
        {
            if (!mouse_is_inside) $('.ajax_box').css('display', 'none');
        });

        //mahalle input live search
        $('#mahalle_ajax_box li').each(function ()
        {
            $(this).attr('data-search-term', $(this).text().toLowerCase());
        });
        $('input.mahalle').on('keyup', function ()
        {
            var searchTerm=$(this).val().toLowerCase();
            $('#mahalle_ajax_box li').each(function ()
            {
                if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length>0 || searchTerm.length<1)
                {
                    $(this).show();
                } else
                {
                    $(this).hide();
                }
            });
        });
        //print selected mahalle in input box
        $('#mahalle_ajax_box li').click(function (e)
        {
            var input_val=$(e.target).text();
            $('input.mahalle').val(input_val);
        });

        $('.eshantion-svg').hover(function ()
        {
            var tl=new TimelineMax();
            tl
                .fromTo(this, .5, {rotation: 0}, {rotation: 360})
        })
    })
	
	$('.like').click(function(){
		alert("sdc")
	})
	
	$('.right-sidebar .see_filters button').click(function(){
		var height = $('.right-sidebar').css("height");
		if(height === "43px"){
			$('.right-sidebar').css("height", "auto");
			$(this).html("- فیلتر ها ")
		}else {
			$('.right-sidebar').animate({height: "43px"}, 400);
			$(this).html("+ فیلتر ها ")
		}
	});
});
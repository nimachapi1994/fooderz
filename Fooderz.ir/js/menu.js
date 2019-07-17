$(document).ready(function() {
	$(window).scroll(function() {
        if ($(this).scrollTop() >= 70) {
            $('#filters').addClass("fixed")
        } else if ($(this).scrollTop() < 70) {
            $('#filters').removeClass("fixed")
        }
    });
	
	
	var all_food_count = $('.food-box .food-name').length;
	for (var i=0; i<all_food_count; i++){
		var this_food = $('.food-box .food-name')[i];
		$(this_food).attr("id","a"+i+"");
	}
	
	
	var inners = [];
    // alert(Object.keys(ord).length)
    // ord={};
    // alert()
    if (getCookie("order") != '' && Object.keys(JSON.parse(getCookie("order"))).length > 0 && JSON.parse(getCookie("order"))['details']['prv_ID'] == $("#prv_ID").val()) 
    {
    var ord = JSON.parse(getCookie("order"))['purchase']
    var ord2 = getCookie("order")
    var sum = 0
    // setCookie("order", '', 234);
    $(".cart-details .empty-cart").css("display", "none");
    $(".cart-details .products").css("display", "block");
    $(".first-factor.full_width.text-right.fadeIn.second").css("display", "table")
    $("#sabte_sefaresh").css("display", "block");
	var cart_total = [];
    console.log(ord)
    for (var i = 0; i < Object.keys(ord).length; i++) 
    {
		cart_total.push(ord[i].count);
        $('.cart-details .products').append('<div class="food-row fadeIn"><div class="name">' + ord[i]['name'] + '</div><div class="count text-center">' + ord[i]['count'] + '</div><div class="price text-left"><strong class="tomato">' + ord[i]['price'] + '</strong></div></div>');
		sum+=(ord[i]['price']*1)
		inners.push(ord[i]['name'])
    }
    $("#total_food_price, #total_pay").html(sum);
	//cart_total = cart_total.reduce((a, b) => a + b, 0);
	//$('#cart-icon .number').html(cart_total);
    }
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 0) {
            $('.pages_header').addClass("fixed_header");
            $('#main_navbar').addClass("fixed_navbar");
            if (screen.width >= 992) {
                $('.cart-details').addClass("fixed_pos");
            }
        } else if ($(this).scrollTop() <= 0) {
            $('.pages_header').removeClass("fixed_header");
            $('#main_navbar').removeClass("fixed_navbar");
            if (screen.width >= 992) {
                $('.cart-details').removeClass("fixed_pos");
            }
        }
    });
    $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({
            scrollTop: $(this.hash).offset().top
        }, 1000);
    });
    
    $().UItoTop({
        easingType: 'easeOutQuart'
    });
    $('.rules-box').prepend("<i class='fa fa-book'></i>")
    // tabs functions
    $('#comments-view-tab').click(function() {
        $('.menu_row').css('display', 'none');
        $('#comments-view').css('display', 'block');
    });
    $('#menu-view-tab').click(function() {
        $('.menu_row').css('display', 'none');
        $('#menu-view').css('display', 'block');
    });
    $('#other_info-tab').click(function() {
        $('.menu_row').css('display', 'none');
        $('#other_info-view').css('display', 'block');
    });
    $('.grid-page-tab').click(function() {
        $('.grid-page-tab').removeClass("active");
        $(this).addClass("active");
    });
    // adding food by selection in cart
    var cart_tl = new TimelineMax()
	var my_basket_obj = {
		food_id: [],
		food_count: [],
		food_price:[],
		food_name:[],
	}
    $('.add-btn').click(function() {
        parent = $(this).parent();
        var chldren = parent.children();
        var value = parseInt(chldren[1].innerHTML);
        value_plus_1 = value + 1;
        chldren[1].innerHTML = value_plus_1;
       
        parents = $(this).parents();
        var food_name = parents[1].childNodes[1].innerHTML;
		var food_id = $(parents[1].childNodes[1]).attr("id");
        var food_price = parents[1].childNodes[5].childNodes[1].innerHTML;
        var food_count = value_plus_1;
        //
		inners.splice(0, food_name);
		
		var food_index = my_basket_obj.food_id.indexOf(food_id)
		if(food_index !== -1){
			my_basket_obj.food_id[food_index] = food_id; 
			my_basket_obj.food_count[food_index] = food_count; 
			my_basket_obj.food_price[food_index] = food_price; 
			my_basket_obj.food_name[food_index] = food_name;
		}else if(food_index === -1) {
			my_basket_obj.food_id.push(food_id);
			my_basket_obj.food_count.push(food_count);
			my_basket_obj.food_price.push(food_price);
			my_basket_obj.food_name.push(food_name);
		}
		
		
		// cart icon sum value update
        var cart_status = $('#cart-icon .number')[0].innerHTML;
		cart_status = my_basket_obj.food_count.reduce((a, b) => a + b, 0);
        $('#cart-icon .number')[0].innerHTML = cart_status;
        /*cart_tl.to('#cart-icon .number', 0.2, {
            backgroundColor: "yellow"
        }).to('#cart-icon .number', 0.2, {
            backgroundColor: "red"
        });*/
        //
		
		var total_price = [];
		for (var i=0; i<my_basket_obj.food_id.length; i++){
			var single_food_total = parseFloat(my_basket_obj.food_count[i])*parseFloat(my_basket_obj.food_price[i]);
			total_price.push(single_food_total);
		}
		total_price = total_price.reduce((a, b) => a + b, 0);
		
        $('#total_food_price').html(total_price);
        $('#total_pay').html(total_price);
        $('.cart-details .empty-cart').css('display', 'none');
        $('#food-row-title, #sabte_sefaresh').css('display', 'block');
        $('.cart-details .first-factor').css('display', 'table');
		$('.cart-details .products').css("display","block");
		// fill cart details box
		$('.cart-details .products').html('');
		for (var i=0; i<my_basket_obj.food_id.length; i++){
			$('.cart-details .products').append('<div class="food-row">'+'\n'+
				'<div class="name text-right">' + my_basket_obj.food_name[i] + '</div>'+'\n'+
				'<div class="count text-center">' + my_basket_obj.food_count[i] + '</div>'+'\n'+
				'<div class="price text-left"><strong class="tomato">' + my_basket_obj.food_price[i] + '</strong></div>'+'\n'+
			'</div>');
		}
        /*cookie js*/
        var name = $('.cart-details .food-row .name');
        var count = $('.cart-details .food-row .count');
        var price = $('.cart-details .food-row .price');
        console.log(price[1])
        var name_length = name.length;
        var order = {}
        order['purchase'] = {}
        order['details'] = {prv_ID: $("#prv_ID").val()}
        for (var i = 0; i < name_length; i++) {
            // order['purchase'][i] = {};
            order['purchase'][i]['id'] = food_id;
            order['purchase'][i]['name'] = name[i].innerHTML;
            order['purchase'][i]['count'] = count[i].innerHTML;
            order['purchase'][i]['price'] = price[i].innerHTML;
        }
        setCookie("order", JSON.stringify(order), 365);
        console.log(getCookie("order"))
        // if(JSON.parse(getCookie("order"))['details']['prv_ID'] != $("#prv_ID").val())
        // {
        //     setCookie("order", '', 1)
        // }
        console.log(my_basket_obj)
    });
    $('.minus-btn').click(function() {
        parent = $(this).parent();
        var chldren = parent.children();
        var value = parseInt(chldren[1].innerHTML);
        value_minus_1 = value - 1;
		if (value == 0) {
			value_minus_1 = 0;
		}
        chldren[1].innerHTML = value_minus_1;
        parents = $(this).parents();
        var food_name = parents[1].childNodes[1].innerHTML;
		var food_id = $(parents[1].childNodes[1]).attr("id");
        var food_price = parents[1].childNodes[5].childNodes[1].innerHTML;
        var food_count = value_minus_1;
		
		
		
        if (value <= 0 || value ==1) {
            $(this).prop("disabled", true);
            chldren[1].innerHTML = 0;
			
			var food_index = my_basket_obj.food_id.indexOf(food_id)
			my_basket_obj.food_id.splice(food_index, 1);
			my_basket_obj.food_count.splice(food_index, 1);
			my_basket_obj.food_price.splice(food_index, 1);
			my_basket_obj.food_name.splice(food_index, 1);
        }else if (value >1){
			var food_index = my_basket_obj.food_id.indexOf(food_id)
			my_basket_obj.food_id[food_index] = food_id; 
			my_basket_obj.food_count[food_index] = food_count; 
			my_basket_obj.food_price[food_index] = food_price; 
			my_basket_obj.food_name[food_index] = food_name;
		}
		
		
		// cart icon sum value update
        var cart_status = $('#cart-icon .number')[0].innerHTML;
		cart_status = my_basket_obj.food_count.reduce((a, b) => a + b, 0);
        $('#cart-icon .number')[0].innerHTML = cart_status;
        /*cart_tl.to('#cart-icon .number', 0.2, {
            backgroundColor: "yellow"
        }).to('#cart-icon .number', 0.2, {
            backgroundColor: "red"
        });*/
        //
		
		var total_price = [];
		for (var i=0; i<my_basket_obj.food_id.length; i++){
			var single_food_total = parseFloat(my_basket_obj.food_count[i])*parseFloat(my_basket_obj.food_price[i]);
			total_price.push(single_food_total);
		}
		total_price = total_price.reduce((a, b) => a + b, 0);
		
        $('#total_food_price').html(total_price)
        $('#total_pay').html(total_price);
		// fill cart details box
		$('.cart-details .products').html('');
		for (var i=0; i<my_basket_obj.food_id.length; i++){
			$('.cart-details .products').append('<div class="food-row">'+'\n'+
				'<div class="name text-right">' + my_basket_obj.food_name[i] + '</div>'+'\n'+
				'<div class="count text-center">' + my_basket_obj.food_count[i] + '</div>'+'\n'+
				'<div class="price text-left"><strong class="tomato">' + my_basket_obj.food_price[i] + '</strong></div>'+'\n'+
			'</div>');
		}
        //cookie js
        var name = $('.cart-details .food-row .name');
        var count = $('.cart-details .food-row .count');
        var price = $('.cart-details .food-row .price .tomato');
        var name_length = name.length;
        var order = {}
        order['purchase'] = {}
        order['details'] = {prv_ID: $("#prv_ID").val()}
        for (var i = 0; i <= name_length; i++) {
            order['purchase'][i] = {};
            // order['purchase'][i]['id'] = food_id;
            order['purchase'][i]['name'] = name[i].innerHTML;
            order['purchase'][i]['count'] = count[i].innerHTML;
            order['purchase'][i]['price'] = price[i].innerHTML;
        }
        setCookie("order", JSON.stringify(order), 365);
        // if(JSON.parse(getCookie("order"))['details']['prv_ID'] != $("#prv_ID").val())
        // {
        //     setCookie("order", '', 1)
        // }
    });
    $('.add-btn').click(function() {
        parent = $(this).parent();
        var chldren = parent.children();
        var value = parseInt(chldren[1].innerHTML);
        if (value <= 0) {
            $('.minus-btn').prop("disabled", true);
            chldren[1].innerHTML = 0;
        } else {
            $('.minus-btn').prop("disabled", false);
        }
    });
	
	$('.filter_carousel').owlCarousel({
        loop: false,
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
			375: {
                items: 3,
                nav: false
            },
            480: {
                items: 4,
                nav: false
            },
            1000: {
                items: 6,
                nav: true,
            }
        }
    });
	$('.filter_carousel .owl-next , .filter_carousel .owl-prev').html('<svg id="chevron-right" viewBox="0 0 24 24"><path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z"/></svg>');
	
	// smooth scroll on food filters
	$('.filter_carousel a').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
	});
});

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
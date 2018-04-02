<?php

error_reporting(0);

if ( !isset($_SESSION) ) session_start();

function cart_recount()
{
    $sub_total = 0;

    if (isset($_SESSION['cart'])) {

        foreach ($_SESSION['cart'] as $index => $item) {
            $quantity = $item['quantity'];
            $price = $item['price'];
            $discount = $item['discount'];

            $discounted_price = format_price($price + $discount);
            if ($discount > 0) $discounted_price = format_price($price * (1 - $discount / 100));
            if ($discounted_price < 0 && $price == 0) $discounted_price = 0; // discount must not make an item cost negative

            $sub_total += format_price($discounted_price) * $quantity;
        }

        // move last items last, but keep the indexes! important!!!
        foreach ($_SESSION['cart'] as $index => $item) {
            if (in_array('last', explode(' ', $item['type']))) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'][$index] = $item;
            }
        }


        $_SESSION['sub_total'] = format_price($sub_total); // 0.00 format
    }
}

function format_price($price)
{
    if ($price == 0) return '0.00';

    $price = preg_replace("/\.\d+$/", "", (string)$price*100);
    return preg_replace("/^(.+)(\d\d)$/", "\\1.\\2", $price);
}

function render_price($price)
{
    $formated = '';
    if ($price < 0)
    {
        $formated .= '-';
        $price *= (-1);
    }

    $formated .= '$' . format_price($price);

    return $formated;
}


//flag to switch between the small (used before) and a medium (currently used) button
$mediumButton = true;

cart_recount();



if ($_GET['action'] == 'add')
{

    $sku = $_GET['sku'];

    $quantity = $_GET['quantity'];

    $addingProduct = $_GET['product'];
    $sku_base = $addingProduct['sku_base'];
    $title = $addingProduct['options'][$sku]['title'];
    $description = $addingProduct['options'][$sku]['description'];
    $option = $addingProduct['options'][$sku]['option'];
    $price = $addingProduct['options'][$sku]['price'];


    if ($title == '') $title = $addingProduct['title'];
    if ($description == '') $description = $addingProduct['description'];
    if ($price == '') $price = $addingProduct['price'];

    if ($option)
        if ($description) $description .= ' - ' . $option;
        else $description = $option;

    $delayed = '';

    $currentCartItems = $_SESSION['cart'];
    reset($currentItems);
    while ( list($cartIndex,$cartItems) = each($currentCartItems) ) {

        if ( $cartItems['sku'] == $sku ) {
            $foundIndex = $cartIndex;
            break;
        }
    }

    if ( $foundIndex ) {
        // increase quantity
        $_SESSION['cart'][$foundIndex]['quantity'] = $_SESSION['cart'][$foundIndex]['quantity'] + 1;
    } else {

        $_SESSION['cart'][] = array(
            'sku' => $sku,
            'sku_base' => $sku_base,
            'title' => $title,
            'description' => $description,
            'option' => $option,
            'quantity' => $quantity,
            'price' => $price,
            'discount' => $discount,
            'texte' => $texte,
            'delayed' => $delayed,
        );

    }


    $_SESSION['last_added'] = array(
        'sku' => $sku,
        'title' => $title,
    );

    cart_recount();

    ob_clean();

    echo 'added ';

    exit;
}


if ($_GET['action'] == 'view')
{
    ob_clean();

    $i = 0;
    foreach($_SESSION['cart'] as $index => $item)
    {
        $sku = $item['sku'];
        $title = $item['title'];
        $description = $item['description'];
        $option = $item['option'];
        $price = $item['price'];
        $discount = $item['discount'];
        $quantity = $item['quantity'];

        if ($discount > 0) $price = format_price($price * (100 - $discount) / 100);
        else $price = format_price($price + $discount);

        $cost = format_price($quantity * $price);

        $short_title = $title;

        if ($description) $short_title .= " - $description";

        $short_title_len = strlen($short_title);
        $short_title = substr($short_title, 0, 80);
        if ($short_title_len > 80) $short_title .= '...';

        if ($i++ == 0) $item_class = 'item-first';
        else $item_class = '';

        echo "
				<div class='item item$index $item_class'>
					<div class='cost'>$$cost</div>
					<div class='price'>$$price</div>
					<div class='quantity'>$quantity x </div>
					<div class='remove'><img rel='$index' src='/images/cart_buttons/remove.png'></div>
					<div class='title'>$short_title</div>
				</div>
			";
    }


    cart_recount();
    $total = $_SESSION['sub_total'];

    echo "
			<div class='total'>
				<div class='total-cost'>$<span id='total-cost-value'>$total</span> USD</div>
				<div>TOTAL:</div>
			</div>
		";


    exit;
}


if ($_GET['action'] == 'remove')
{
    $index = $_GET['index'];

    unset($_SESSION['cart'][$index]);

    // remove promotions
    foreach($_SESSION['cart'] as $i => $item)
    {
        if ( isset($item['promotion']) ) {
            unset($_SESSION['cart'][$i]);
            unset($_SESSION['coupon_form']);
        }
    }

    cart_recount();
    $total = $_SESSION['sub_total'];

    ob_clean();
    echo $total;

    exit;
}




if ($_GET['action'] == 'more')
{
    ob_clean();
    $index = $_GET['index'];
    foreach($_SESSION['cart'] as $i => $item)
    {
        if ( $i == $index ) {
            $quantity = $item['quantity'] + 1;
            $_SESSION['cart'][$index]['quantity'] = $quantity;
            $ajaxRetun = $i;
            $ajaxRetun .= ":".$quantity;
            $ajaxRetun .= ":".format_price($quantity*$_SESSION['cart'][$index]['price']);
        }
    }


    cart_recount();
    $total = $_SESSION['sub_total'];
    $ajaxRetun .= ":".$total;

    /*
    echo "
        <div class='total'>
            <div class='total-cost'>$<span id='total-cost-value'>$total</span> USD</div>
            <div>TOTAL:</div>
        </div>
    ";
    */
    echo $ajaxRetun;


    exit;
}



if ($_GET['action'] == 'less')
{
    ob_clean();
    $index = $_GET['index'];
    foreach($_SESSION['cart'] as $i => $item)
    {

        if ( $i == $index ) {
            $ajaxRetun = $i;
            $quantity = $item['quantity'] - 1;
            if ( $quantity <= 0 ) {
                unset( $_SESSION['cart'][$index]);
                $ajaxRetun .= ":". 0;
            }
            else {
                $_SESSION['cart'][$index]['quantity'] = $quantity;
                $ajaxRetun .= ":". $quantity;
            }
            $ajaxRetun .= ":".format_price($quantity*$_SESSION['cart'][$index]['price']);
        }
    }


    cart_recount();
    $total = $_SESSION['sub_total'];
    $ajaxRetun .= ":".$total;

    /*
    echo "
        <div class='total'>
            <div class='total-cost'>$<span id='total-cost-value'>$total</span> USD</div>
            <div>TOTAL:</div>
        </div>
    ";
    */
    echo $ajaxRetun;


    exit;
}





$tokens['total'] = $_SESSION['sub_total'];

?>


<style type="text/css">
    .cart
    {
        float: right;
        width: 900px;
    }
    .cart .cart-wrapper
    {
        position: absolute;
        z-index: 1000;
        width: 900px;
        height: 0px;
    }
    .cart #view-cart
    {
        cursor: pointer;
    }


    .list
    {
        float: right;
        width: 0px;
        min-height: 0px;

        overflow: hidden;

        background-color: #3f3a37;

        -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
        filter: alpha(opacity=90);
        -moz-opacity:0.9;
        -khtml-opacity: 0.9;
        opacity: 0.9;
    }


    .list .list-items
    {
        padding-top: 50px;
        font-size: 16px;
    }
    .list .list-items .item
    {
        padding: 6px 0px 6px;
        margin: 0px 20px;

        border-bottom: solid #4c4c4c 1px;

        width: 860px;
        color: #fff;

        white-space: nowrap;
        overflow: hidden;
    }
    .list .list-items .item-first
    {
        border-top: solid #4c4c4c 1px;
    }
    .list .list-items .remove
    {
        float: left;
        padding: 2px 20px 0px 0px;
        cursor: pointer;
    }
    .list .list-items .remove img
    {
        cursor: pointer;
    }
    .list .list-items .title
    {
        padding-top: 2px;
    }
    .list .list-items .quantity
    {
        float: right;
        padding-right: 6px;
    }
    .list .list-items .price
    {
        float: right;
        padding-right: 10px;
        width: 70px;
        text-align: right;
        font-size: 16px;
    }
    .list .list-items .cost
    {
        float: right;
        width: 70px;
        text-align: right;
    }

    .list .total
    {
        clear: both;
        margin: 70px 20px 10px;
        padding-top: 5px;
        width: 860px;

        border-top: solid #4c4c4c 2px;
        color: #fff;
    }
    .list .total .total-cost
    {
        float: right;
    }
    .list .buttons
    {
        clear: both;
        padding: 20px;
        width: 860px;
        text-align: right;
    }
    .list .buttons a
    {
        color: #fff;
        text-decoration: none;
        white-space: nowrap;
    }


    .viewcart-bg
    {
        display: none;
        position: fixed;
        _position: absolute; /* hack for internet explorer 6*/
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background: #000;
        z-index: 900;
    }
</style>


<script>
    $(document).ready(function()
    {
        cart_open = false;

        viewcart_bg = jQuery("<div class='viewcart-bg'></div>");
        viewcart_bg.appendTo(document.body);
        viewcart_bg.css({ "opacity": 0 });
        viewcart_bg.click(function() { close_cart(); });



        add_to_cart = function(sku, quantity)
        {
            if (!sku) return;
            quantity = quantity || 1;

            $.get('?action=add&sku='+sku+'&quantity='+quantity, function()
            {
                $.get('?action=view', function(response)
                {
                    $('.list-items').html(response);

                    $('.remove img').click(function()
                    {
                        var index = $(this).attr('rel');
                        $.get('?action=remove&index='+index, function(total_cost_value)
                        {
                            $('.item'+index).fadeOut(300, function()
                            {
                                $('#total-cost-value').html(total_cost_value);
                            });
                        });
                    });


                    open_cart();
                    //$('body').scrollTo('.thumbs', 500);
                });
            });
        }


        open_cart = function()
        {
            if (!cart_open)
            {
                $(document).scrollTo($('body'), 500);

                $('.list').stop().animate({'width': '900px', 'min-height': '200px'}, function() { cart_open = true; });

                <?php if ( $mediumButton ) { ?>
                $('#view-cart').attr('src', '/images/cart_buttons/hide_cart_medium.png');
                <?php } else { ?>
                $('#view-cart').attr('src', '/images/cart_buttons/hide_cart_btn_small.png');
                <?php } ?>
                viewcart_bg.show();
            }
        }

        close_cart = function()
        {
            if (cart_open)
            {
                $('.list').stop().animate({'width': '0px', 'min-height': '0px'}, function() { cart_open = false; });
                <?php if ( $mediumButton ) { ?>
                $('#view-cart').attr('src', '/images/cart_buttons/view_cart_medium.png');
                <?php } else { ?>
                $('#view-cart').attr('src', '/images/cart_buttons/view_cart_btn_small.png');
                <?php } ?>

                viewcart_bg.hide();
            }
        }

        $('#view-cart').click(function()
        {
            if (cart_open)
                close_cart();
            else
                open_cart();
        });

        $('.remove img').click(function()
        {
            var index = $(this).attr('rel');
            $.get('./?action=remove&index='+index, function(total_cost_value)
            {
                $('.item'+index).fadeOut(300, function()
                {
                    $('#total-cost-value').html(total_cost_value);
                });
            });
        });



        $('.cart-addons-btn').click(function()
        {
            close_cart();
        });

    });
</script>


<div class='cart-wrapper'>


    <?php if ( $mediumButton ) { ?>
    <div style='float: right; width: 258px;'>
        <div style='width: 258px; text-align: right; position: absolute; z-index: 2000;margin-left: 0;'>
            <img id='view-cart' src='/images/cart_buttons/view_cart_medium.png'>
            <?php } else { ?>
            <div style='float: right; width: 200px;'>
                <div style='width: 165px; text-align: right; position: absolute; z-index: 2000;margin-left: 35px;'>
                    <img id='view-cart' src='/images/cart_buttons/view_cart_btn_small.png'>
                    <?php } ?>
                </div>
            </div>

            <div class='list'>
                <div class='list-items'>
                    <?php

                    $i = 0;

                    if (isset($_SESSION['cart']))
                        foreach($_SESSION['cart'] as $index => $item)
                        {
                            $title = $item['title'];
                            $description = $item['description'];
                            $option = $item['option'];
                            $quantity = $item['quantity'];
                            $price = $item['price'];
                            $discount = $item['discount'];

                            if ($discount > 0) $price = format_price($price * (100 - $discount) / 100);
                            else $price = format_price($price + $discount);

                            $cost = format_price($quantity * $price);


                            $short_title = $title;

                            if ($description) $short_title .= " - $description";
                            if ($option) $short_title .= " ($option)";

                            $short_title_len = strlen($short_title);
                            $short_title = substr($short_title, 0, 80);
                            if ($short_title_len > 80) $short_title .= '...';


                            $tokens['item']['index'][] = $index;
                            $tokens['item']['id'][] = 'item'.$index;
                            $tokens['item']['short_title'][] = $short_title;
                            $tokens['item']['quantity'][] = $quantity;
                            $tokens['item']['price'][] = $price;
                            $tokens['item']['cost'][] = $cost;

                            if ($i++ == 0)
                                $tokens['item']['class'][] = 'item-first';
                            ?>
                            <div class='item {item[id]} {item[class]}'>
                                <div class='cost'>${item[cost]}</div>
                                <div class='price'>${item[price]}</div>
                                <div class='quantity'>{item[quantity]} x </div>
                                <div class='remove'><img rel='{item[index]}' src='/images/cart_buttons/remove.png'></div>
                                <div class='title'>{item[short_title]}</div>
                            </div>
                            <?php
                        }
                    ?>

                    <div class='total'>
                        <div class='total-cost'>$<span id='total-cost-value'>{total}</span> USD</div>
                        <div>TOTAL:</div>
                    </div>
                </div>

                <div class='buttons'>
                    <a href='https://www.iskin.com/checkout/'><img src='cart/images/cart_checkout_btn.png'></a>
                </div>
            </div>

        </div>

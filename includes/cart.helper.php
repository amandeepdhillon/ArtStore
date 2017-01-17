<?php 
/*
* Calculates item's price based on base cost and selected options
* Note: if any matt is selected, the price is $10/painting
*/
function calcItemPrice($baseCost, $quantity, $frameCost, $glassCost, $mattID){
    $cost = ($baseCost + $frameCost + $glassCost) * $quantity;
    if($mattID != 35) {
        $cost += 10 * $quantity;
    }
    return $cost;
}

/*
* Calculates shipping price based on shipping type
* Standard: $25 per painting, $0 if subtotal is over $1500
* Express: $50 per painting, $0 if subtotal is over $2500
*/
function calcShipping($subtotal, $cartQuantity, $shippingType){
    if ($shippingType == "standard") {
        $rate = 25;
    } 
    else {
        $rate = 50;
    }
    $shipping = $cartQuantity * $rate;
    
    if (($shippingType == "standard" && $subtotal >= 1500) || ($shippingType == "express" && $subtotal >= 2500)) {
        $shipping = 0;
    }
    return $shipping;
}

?>
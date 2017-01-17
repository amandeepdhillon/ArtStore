$(function() {
/*
* Setting up listeners
*/

    // when painting details are changed, update
    $('div.item select').on("change", function(){
        updatePrice(this);
        updateSubtotal();
        updateTotal();
    });
    
    // when quantity of paintings is changed, update
    $('div.item input[type="number"]').on("change", function(){
        updatePrice(this);
        updateSubtotal();
        updateShipping();
        updateTotal();
    });
    
    // when shipping option is changed, update
    $('div.item input[type="radio"][name="shipping"]').on("change", function(){ 
       console.log("updating shipping");
       updateShipping();
       updateTotal();
    });
    
/*
* Helper functions below
*/


// UPDATE helper functions

/*
* Updates price of a single cart item
* var e: object that initiated the JS event
*/
    function updatePrice(e) {
        var parentID = $(e).parents("div.item").attr("id");
        
        var baseCost = parseFloat($('#' + parentID + ' span.painting.price').attr("data-price"));;
        var quantity = $('#' + parentID + ' input[name^=quantity]').val();
        var frameCost = parseFloat($('#' + parentID + ' select[name^=frame] option:selected').attr("data-price"));
        var glassCost = parseFloat($('#' + parentID + ' select[name^=glass] option:selected').attr("data-price"));
        var mattID = $('#' + parentID + ' select[name^=matt]').val();

        $("#" + parentID + " span.price").html(calcItemPrice(baseCost, quantity, frameCost, glassCost, mattID));
    }

/*
* Updates subtotal 
*/
    function updateSubtotal() {
        var subtotal = calcSubtotal();
        $("#subtotalPrice").html(subtotal);
    }

/* 
* Updates shipping
*/
    function updateShipping() {
        var shippingPrice = calcShipping(unformatMoney($("#subtotalPrice").html()) );
        $("#shippingPrice").html(shippingPrice);
    }

/*
* Updates cart total
*/
    function updateTotal(){
        var subtotal = unformatMoney( $("#subtotalPrice").html());
        var shippingPrice = unformatMoney( $("#shippingPrice").html());
        
       $("#totalPrice").html(formatMoney(subtotal + shippingPrice));
    }

// CALCULATE helper functions
/*
* Calculates price for a single cart item
*/
    function calcItemPrice(baseCost, quantity, frameCost, glassCost, mattID) {
        var cost = (baseCost + frameCost + glassCost) * quantity;
        if(mattID != 35) { cost += (10 * quantity);}
        return formatMoney(cost);
    }

/* 
* Calculates subtotal of all paintings in cart
*/
    function calcSubtotal () {
        var prices = $('div.item span.painting.price');
        var subtotal = 0;
        
        $.each(prices, function(index, value) {
           var price = unformatMoney(value.innerHTML);
           console.log("Price #" + index + ": " + price);
           subtotal = subtotal + price;
        })
       
        console.log("Page subtotal: " + subtotal);
        
        return formatMoney(subtotal);
    }
    
/*
* Calculates shipping price based on radio button and total subtotal cost
* Standard shipping is $25, free if subtotal is >=$1500
* Express shipping is $50, free if subtotal is >=$2500
*/
    function calcShipping(subtotal) {
        console.log("Subtotal: " + subtotal);
        
        var shipping = 0;
        var rate = 0;
        var shippingType = $('input:radio[name=shipping]:checked').val();
        
        console.log("Type: " + shippingType);
        
        if (shippingType == "standard") { rate = 25; } 
        else { rate = 50; }
        
        shipping = getCartQuantity() * rate;
        
        if ((shippingType == "standard" && subtotal >= 1500) || (shippingType == "express" && subtotal >= 2500)) {
            shipping = 0;
        }
        
        return formatMoney(shipping);
    }

// OTHER helper functions

/*
* Looks at all quantity inputs to calculate the number of paintings in cart
*/
    function getCartQuantity() {
        var count = 0;
        
        $.each($('input[name^=quantity]'), function(index, item) {
            count = count + parseInt(item.value);
        });
        
        return count;
    }
    
});

/*
* Converts a number into the format $?,???.00
*/
    function formatMoney(num) {
        return num.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
    }

/*
* Converts a money value in the form $?,???.00 to a regular number
*/
    function unformatMoney(money) {
        return parseFloat(money.replace(/[$,]/g, ""));
    }
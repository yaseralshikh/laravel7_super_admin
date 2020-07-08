$(document).ready(function () {
    //remove product btn
    $('body').on('click', '.remove-product-btn', function(e) {

        e.preventDefault();
        //$(document.body).append(form);

        var id = $(this).data('id');
        var url = $(this).data('url');
        var method = $(this).data('method');
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            method: method,
            type: 'post',
            url: url,
            data:{
                _token:token,
            },
            datatype:'json',
            success: function( data ) {
                console.log(data);
            },
            error: function(request) {
                console.log('Error Message : ' + request.responseJSON.message);
            }
        });

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

        //to calculate total price
        calculateTotal();

    });//end of remove product btn

    //change product quantity
    $('body').on('keyup change', '.product-quantity', function(e) {

        e.preventDefault();

        var quantity = Number($(this).val()); //2
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, '')); //150
        var unitTotalPrice = quantity * unitPrice ; //$(this).data('unitTotalPrice') ;

        //console.log(quantity,'*',unitPrice,'=',unitTotalPrice);

        var url = $(this).data('url');
        var method = $(this).data('method');
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            method: method,
            type: 'post',
            url: url,
            data:{
                _token:token,
                'qty': quantity,
                'unitTotalPrice': unitTotalPrice
            },
            datatype:'json',
            success: function(data) {
                console.log('Result :' + data);
                //$(this).closest('tr').find('.unitTotalPrice').html(data, 2);
                calculateTotal();
            },
            error: function(request) {
                console.log('Error Message : ' + request.responseJSON.message);
            }
        });

        $(this).closest('tr').find('.unitTotalPrice').html(quantity * unitPrice, 2);
        calculateTotal();

    });//end of product quantity change
    

    //print order
    $(document).on('click', '.print-btn', function() {

        $('#print-area').printThis({
            loadCSS: "direction: rtl;",
            importCSS: true,  
            //header: "<h1 class='text-center text-red'>test</h1>",
            footer: `
                    <h3 class="pr-5" style="direction: rtl;float: right;">امين الصندوق :</h3><br><br><hr>
                    <h3 class="pr-5" style="direction: rtl;float: right;">التوقيع :</h3><br><br><hr>
                    <h3 class="pr-5" style="direction: rtl;float: right;">ختم المؤسسة :</h3><br><br><hr>
            `
        });

    });//end of click function


    // add product to cart
    $(document).on('click', '.add_to_cart', function(e) {

        e.preventDefault();

        var url = $(this).data('url');

        $.ajax({
            method: 'get',
            type: 'post',
            url: url,
            datatype:'json',
            success: function(result) {
                console.log('Result :' + result.cart_quantity);
                $('.cart_quantity').html( result.cart_quantity, 2);
                window.location.reload() ;
            },
            error: function(request) {
                console.log('Error Message : ' + request.responseJSON.message);
            }
        });

    });

});//end of document ready

//calculate the total
function calculateTotal() {

    var price = 0;

    $('.order-list .unitTotalPrice').each(function(index) {
        
        price += parseFloat($(this).html().replace(/,/g, ''));

    });//end of product price

    var quantity = 0;

    $('.order-list .product-quantity').each(function(index) {
        
        quantity += parseFloat($(this).val().replace(/,/g, ''));
    });//end of product price

    $('.total-price').html( price, 2 );
    $('.products-quantity').html( quantity, 2);
    $('.cart_quantity').html( quantity, 2);

    //check if price > 0
    if (price > 0) {

        $('#add-order-form-btn').removeClass('disabled')

    } else {

        $('#add-order-form-btn').attr("disabled", true);
        $('#add-order-form-btn').addClass('disabled');


    }//end of else


}//end of calculate total


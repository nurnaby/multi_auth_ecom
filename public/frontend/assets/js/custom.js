$.ajaxSetup({
        headers: {
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('centent')
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    //product view start
function productView(id) {
    // alert($id);
    $.ajax({
        type: 'GET',
        url: '/product/view/modal/' + id,
        dataType: 'json',
        success: function(data) {
            // console.log(data); 
            $('#pname').text(data.product.product_name);
            // $('#pprice').text(data.product.selling_price);
            $('#pcategory').text(data.product.category.category_name);
            $('#pbarnd').text(data.product.barnd.brand_name);
            $('#pcode').text(data.product.product_code);
            $('#pimage').attr('src', '/' + data.product.product_thumbnail);
            $('#product_id').val(id);
            $('#qty').val(1);
            // product price 
            if (data.product.discount_price == null) {
                $('#pprice').text('');
                $('#oldprice').text('');
                $('#pprice').text(data.product.selling_price);
            } else {
                $('#pprice').text((data.product.selling_price) - (data.product.discount_price));
                $('#oldprice').text(data.product.selling_price);

            } //end else
            // stock option
            if (data.product.product_qty > 0) {
                $('#aviable').text('');
                $('#stockout').text('');
                $('#aviable').text('aviable');

            } else {
                $('#aviable').text('');
                $('#stockout').text('');
                $('#stockout').text('stockout');
            }
            //  stock option end 
            //size
            $('select[name="size"]').empty();
            $.each(data.size, function(key, value) {
                    $('select[name="size"]').append('<option value="' + value + '">' + value + '</optoin>')
                    if (data.size == "") {
                        $('#sizeArea').hide();
                    } else {
                        $('#sizeArea').show();
                    }
                }) //end size
                //color 
            $('select[name="color"]').empty();
            $.each(data.color, function(key, value) {
                $('select[name="color"]').append('<option value="' + value + '">' + value + '</option>')
                if (data.color == "") {
                    $('#colorArea').hide();
                } else {
                    $('#colorArea').show();
                }
            })


        }
    })
}
// product view end
// function test() {
//     alert();
// }

// function addToCart() {

//     var product_naem = $('#pname').text();
//     var id = $('#product_id').val();
//     var size = $('#size option:selected').text();
//     var color = $('#color option:selected').text();
//     var quantity = $('#qty').val();
//     // console.log(product_naem, id, size, color, quantity);
//     $.ajax({
//         type: "POST",
//         dataType: 'json',
//         data: {
//             product_naem: product_naem,
//             size: size,
//             color: color,
//             quantity: quantity
//         },
//         url: "/cart/data/store/" + id,
//         success: function(data) {
//             // $('#closeModal').click();
//             console.log(data);
//             //state message 
//             // const Toast = Swal.mixin({
//             //     toast: true,
//             //     position: 'top-end',
//             //     icon: 'success',
//             //     showConfirmButton: false,
//             //     timer: 3000
//             // })
//             // if ($.isEmptyObject(data.error)) {
//             //     Toast.
//             //     fire({
//             //         type: 'success',
//             //         title: data.success,
//             //     })
//             // } else {
//             //     Toast.
//             //     fire({
//             //         type: 'error',
//             //         title: data.error,
//             //     })

//             // }
//             //end message
//         }
//     })
// }
// add to cart start 
$(document).ready(function() {
    cartload()
        // cart item increment and decrement 
    $('.increment-btn').click(function(e) {
        e.preventDefault();
        var incre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

    $('.decrement-btn').click(function(e) {
        e.preventDefault();
        var decre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });
})

function cartload() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/load-cart-data',
        method: "GET",
        success: function(response) {
            $('.basket-item-count').html('');
            var parsed = jQuery.parseJSON(response)
            var value = parsed; //Single Data Viewing
            $('.basket-item-count').append($('<span class="pro-count blue">' + value['totalcart'] + '</span>'));
        }
    });
}

// add to cart 
$(document).ready(function() {
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();
        // alert("i am hear");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var quantity = $(this).closest('.product_data').find('.qty-input').val();
        var color = $(this).closest('.product_data').find('.p_color').val();
        var size = $(this).closest('.product_data').find('.p_size').val();
        // alert(size);

        $.ajax({
            url: "/add-to-cart",
            method: "POST",
            data: {
                'color': color,
                'size': size,
                'quantity': quantity,
                'product_id': product_id,
            },
            success: function(response) {
                $('#closeModal').click();
                // console.log(response);
                //state message 

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(response.error)) {
                    Toast.
                    fire({
                        type: 'success',
                        title: response.success,
                    })
                } else {
                    Toast.
                    fire({
                        type: 'error',
                        title: response.error,
                    })

                }
                cartload();


                //             //end message


                // alertify.set('notifier', 'position', 'top-right');
                // alertify.success(response.status);
            },
        });



    });


});

// mini Cart 
function miniCart() {
    $.ajax({
        type: 'get',
        url: '/product/mini/cart',
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            var miniCart = ""
            $.each(response.cart_data, function(key, value) {
                miniCart += `  <ul>

            <li>
                <div class="shopping-cart-img">
                    <a href="shop-product-right.html"><img alt="Nest"
                            src="" /></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="shop-product-right.html">${value.item_name}</a>
                    </h4>
                    <h4><span>1 ×
                        </span>40</h4>
                </div>
                <div class="shopping-cart-delete">
                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                </div>
            </li>
            


          


        </ul>
            
            `
            });
            $('#mini_cart').html(miniCart)
        }
    })
}


miniCart();

// $('#cart_fach').click(function(e) {
//     miniCart();
//     alert('hi');
// });



// Update Cart Data
$(document).ready(function() {

    $('.changeQuantity').click(function(e) {
        e.preventDefault();
        var thisClick = $(this);
        var quantity = $(this).closest(".cartpage").find('.qty-input').val();
        var product_id = $(this).closest(".cartpage").find('.product_id').val();

        var data = {
            '_token': $('input[name=_token]').val(),
            'quantity': quantity,
            'product_id': product_id,
        };

        $.ajax({
            url: '/update-to-cart',
            type: 'POST',
            data: data,
            success: function(response) {
                // window.location.reload();
                // console.log(response.subTotal)
                thisClick.closest(".cartpage").find('.cart_stotal_pric').text(response.subTotal);
                $('#totalajexCall').load(location.href + ' .totalpriceload')
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(response.error)) {
                    Toast.
                    fire({
                        type: 'success',
                        title: response.success,
                    })
                } else {
                    Toast.
                    fire({
                        type: 'error',
                        title: response.error,
                    })

                }

                // alertify.set('notifier', 'position', 'top-right');
                // alertify.success(response.status);
            }
        });
    });

});

// add to cart end
// Delete Cart Data
$(document).ready(function() {

    $('.delete_cart_data').click(function(e) {
        e.preventDefault();

        var product_id = $(this).closest(".cartpage").find('.product_id').val();
        // alert(product_id);
        var deleteArea = $(this);
        var data = {
            '_token': $('input[name=_token]').val(),
            "product_id": product_id,
        };

        // $(this).closest(".cartpage").remove();

        $.ajax({
            url: '/delete-from-cart',
            type: 'DELETE',
            data: data,
            success: function(response) {
                // window.location.reload();
                deleteArea.closest(".cartpage").remove();
                $('#totalajexCall').load(location.href + ' .totalpriceload')

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(response.error)) {
                    Toast.
                    fire({
                        type: 'success',
                        title: response.success,
                    })
                } else {
                    Toast.
                    fire({
                        type: 'error',
                        title: response.error,
                    })

                }

            }
        });
    });

});
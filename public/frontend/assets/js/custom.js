$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('centent')
    }
})

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
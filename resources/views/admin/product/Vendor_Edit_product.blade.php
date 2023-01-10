@extends('vendor.vendor_dashbord')
@section('vendor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">

        <!--breadcrumb-->

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">eCommerce</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit New Product</h5>
                <hr />
                <form action="{{ route('vendor.product.update') }}" id="myForm" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" name="id">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" name="product_name"
                                            id="inputProductTitle" placeholder="Enter product title"
                                            value="{{ $product->product_name }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product tage</label>
                                        <input type="text" name="product_tage" class="form-control" data-role="tagsinput"
                                            value="{{ $product->product_tage }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Size</label>
                                        <input type="text" name="product_size" class="form-control" data-role="tagsinput"
                                            value="{{ $product->product_size }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Color</label>
                                        <input type="text" name="product_color" class="form-control"
                                            data-role="tagsinput" value="{{ $product->product_color }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control" name="short_descp" id="inputProductDescription" rows="3">{{ $product->short_descp }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_descp">{{ $product->long_descp }}</textarea>
                                    </div>




                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice"
                                                value="{{ $product->selling_price }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="inputCompareatprice" value="{{ $product->discount_price }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" value="{{ $product->product_code }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty" class="form-control"
                                                id="inputStarPoints" value="{{ $product->product_qty }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select class="form-select" name="brand_id" id="inputProductType">
                                                <option></option>
                                                @foreach ($brand as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $product->brand_id ? 'selected' : '' }}>
                                                        {{ $item->brand_name }}</option>
                                                @endforeach



                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select class="form-select" name="category_id" id="inputVendor">
                                                <option></option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $product->category_id ? 'selected' : '' }}>
                                                        {{ $item->category_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product Sub Category</label>
                                            <select class="form-select" name="subcategory_id" id="inputVendor">
                                                @foreach ($SubCategory as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $product->subcategory_id ? 'selected' : '' }}>
                                                        {{ $item->subcategory_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            id="inlineCheckbox1" value="1"
                                                            {{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox1">Hot
                                                            Deals</label>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="feature" type="checkbox"
                                                            id="inlineCheckbox1" value="1"
                                                            {{ $product->feature == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox1">Featured
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="special_offer"
                                                            type="checkbox" id="inlineCheckbox1" value="1"
                                                            {{ $product->special_offer == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox1">Specila
                                                            Offer</label>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="special_deals"
                                                            type="checkbox" id="inlineCheckbox1" value="1"
                                                            {{ $product->special_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox1">Specilal
                                                            Deals</label>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary px-4"
                                                    value="Update Product" />


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- Mian Image Thambail update --}}
    <div class="page-content">
        <div class="card p-4">
            <h5 class="card-title">Main Image Thambail Upsate</h5>
            <hr />
            <form action="{{ route('vendor.product.main_img.update') }}" id="myForm" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="id">
                <input type="hidden" value="{{ $product->product_thumbnail }}" name="old_image">
                <div class="card-body">
                    <div class="form-group  mb-3">
                        <label for="formFile" class="form-label">Chose Thambail Image</label>
                        <input class="form-control" name="product_thumbnail" type="file" id="formFile">
                        @if ($errors->has('product_thumbnail'))
                            <div class="error text-danger">{{ $errors->first('product_thumbnail') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset($product->product_thumbnail) }}" style="height: 100px; width:100px"
                            alt="">
                    </div>

                </div>
                <div class="col-3">
                    <div class="d-grid">
                        <input type="submit" class="btn btn-primary px-4" value="Save Change" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Mian Image Thambail update --}}

    {{-- Multipal  Image update --}}
    <div class="page-content">
        <div class="card p-4">
            <h5 class="card-title">Main Image Thambail Upsate</h5>

            <div class="card-body">
                <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Image</th>
                            <th scope="col">Change Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('vendor.product.multi_image.update') }}" id="myForm" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @foreach ($multiImage as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                        <img src="{{ asset($item->photo_name) }}" style="height: 40px; wedith:40px"
                                            alt="">
                                    </td>
                                    <td class="form-group">
                                        <input type="file" class="form-gorup"
                                            name="multi_image[{{ $item->id }}]">
                                        @if ($errors->has('multi_image'))
                                            <div class="error text-danger">{{ $errors->first('multi_image') }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-primary px-4" value="Save Change" />
                                        <a href="{{ route('vendor.product.multi_img.delete', $item->id) }}"
                                            class="btn btn-danger" id="delete">Delete</a>

                                    </td>
                                </tr>
                            @endforeach

                        </form>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    {{-- 
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    brand_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                    product_qty: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_thumbnail: {
                        required: true,
                    },
                    short_descp: {
                        required: true,
                    },
                    multi_image: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please Enter  Product Name',
                    },
                    product_code: {
                        required: 'Please Enter  Product code',
                    },
                    brand_id: {
                        required: 'Please Enter brand',
                    },
                    category_id: {
                        required: 'Please Enter Product Category',
                    },
                    subcategory_id: {
                        required: 'Please Enter Product Subcategory',
                    },
                    product_qty: {
                        required: 'Please Enter Product Quantity',
                    },
                    selling_price: {
                        required: 'Please Enter Product price',
                    },
                    product_thumbnail: {
                        required: 'Please Enter Product Thambnail Image',
                    },
                    short_descp: {
                        required: 'Please Enter Short Description',
                    },
                    short_descp: {
                        required: 'Please Enter Image',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script> --}}


    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection

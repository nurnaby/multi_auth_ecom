<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" id="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                <figure class="border-radius-10">
                                    <img src="" id="pimage" alt="product image" />
                                </figure>
                            </div>
                            <!-- THUMBNAILS -->

                        </div>
                        <!-- End Gallery -->
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="product_data">

                            <div class="detail-info pr-30 pl-30">
                                {{-- <span class="stock-status out-stock"> Sale Off </span> --}}
                                <h5 class="title-detail"><a href="" id="pname" class="text-heading"></a></h5>
                                <br>
                                <div class="attr-detail attr-size mb-30" id="sizeArea">
                                    <strong class="mr-10" style="width:50px">Size: </strong>
                                    <select class="form-control unicase-form-control p_size" name="size"
                                        id="size">

                                    </select>
                                </div>
                                <div class="attr-detail attr-size mb-30" id="colorArea">
                                    <strong class="mr-10" style="width:50px">Color: </strong>
                                    <select class="form-control unicase-form-control p_color" name="color"
                                        id="color">


                                    </select>
                                </div>

                                <div class="clearfix product-price-cover" id="">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand" id="pprice">$</span>
                                        <span>

                                            <span class="old-price font-md ml-15" id="oldprice">$</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="qty" id="qty" class="qty-input"
                                            value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <input type="hidden" id="product_id" class="product_id" name="product_id">
                                        <button type="submit" class="button button-add-to-cart add-to-cart-btn"><i
                                                class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul>
                                                <li class="mb-5">Brand: <span class="text-brand"
                                                        id="pbarnd"></span>
                                                </li>
                                                <li class="mb-5">Category:<span class="text-brand " id="pcategory">
                                                    </span></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul>
                                                <li class="mb-5">Product Code: <span class="text-brand"
                                                        id="pcode"></span></li>
                                                <li class="mb-5">Stock:<span class="badge badge-poll badge-success"
                                                        id="aviable" style="background:green;color:white"></span><span
                                                        class="badge badge-poll badge-success" id="stockout"
                                                        style="background:red;color:white"></span></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

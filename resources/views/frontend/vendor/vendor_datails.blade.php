@extends('frontend.frontend_master')
@section('frontend')
@section('title')
    vendor details
@endsection
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Vendor Datails page <span></span> {{ $vendor->name }}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="archive-header-2 text-center pt-80 pb-50">
        <h1 class="display-2 mb-50">{{ $vendor->username }}</h1>

    </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($vendorProduct) }}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">



                @forelse ($vendorProduct as $item)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                        <img class="default-img" src="{{ asset($item->product_thumbnail) }}"
                                            alt="" />

                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                            class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                            class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                @php
                                    // $amount = $item->selling_price - $item->discount_price;
                                    $discount = ($item->selling_price * $item->discount_price) / 100;
                                @endphp
                                {{-- @php
                                $amount = $item->selling_price * $item->discount_price;
                                $discount = $item->selling_price - $item->selling_price * ($item->discount_price / 100);
                                // $amount = ($item->selling_price / 100) * $item->discount_price;
                                // $discount = $amount - $item->discount_price;
                            @endphp --}}
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($item->discount_price == null)
                                        <span class="new">NEW</span>
                                    @else
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
                                </div>
                                <h2><a
                                        href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                </h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                @if ($item->vendor_id == null)
                                    <div>
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">Owner</a></span>
                                    </div>
                                @else
                                    <div>
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
                                    </div>
                                @endif
                                <div class="product-card-bottom">
                                    @if ($item->discount_price == null)
                                        <div class="product-price">

                                            <span>${{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            @php
                                                $discount = $item->selling_price - $item->discount_price;
                                            @endphp
                                            <span>${{ $discount }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif

                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5 class="text-danger">No Product Found</h5>
                @endforelse

                <!--end product card-->
            </div>

            <!--product grid-->
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--End Deals-->
        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img src="{{ !empty($vendor->photo) ? url('upload/vendor_images/' . $vendor->photo) : url('upload/no_image.jpg') }}"
                        alt="" />
                </div>
                <div class="vendor-info">
                    <div class="product-category">
                        <span class="text-muted">{{ $vendor->vendor_join }}</span>
                    </div>
                    <h4 class="mb-5"><a href="vendor-details-1.html" class="text-heading">{{ $vendor->name }}</a>
                    </h4>
                    <div class="product-rate-cover mb-15">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: 90%">{{ $vendor->vendor_short_info }}</div>
                        </div>
                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                    </div>
                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading"></p>
                    </div>
                    <div class="follow-social mb-20">
                        <h6 class="mb-15">Follow Us</h6>
                        <ul class="social-network">
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg"
                                    alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span>
                            </li>
                            <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg"
                                    alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span>
                            </li>
                        </ul>
                        <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>


            <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                <img src="assets/imgs/banner/banner-11.png" alt="" />
                <div class="banner-text">
                    <span>Oganic</span>
                    <h4>
                        Save 17% <br />
                        on <span class="text-brand">Oganic</span><br />
                        Juice
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

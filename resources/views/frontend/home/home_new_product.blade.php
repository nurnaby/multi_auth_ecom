<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> News Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                        type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @foreach ($categoryies as $item)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category{{ $item->id }}"
                            type="button" role="tab" aria-controls="tab-two"
                            aria-selected="false">{{ $item->category_name }}</a>
                    </li>
                @endforeach


            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($products as $item)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
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
                                        <a aria-label="Compare" class="action-btn" data-bs-target="#quickViewModal"
                                            onclick="productView(this.id)" id="{{ $item->id }}"><i
                                                class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $item->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
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

                                            <a class="add add-to-cart-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal" id="{{ $item->id }}"
                                                onclick="productView(this.id)" href="javascript:void(0)"><i
                                                    class="fi-rs-shopping-cart mr-5 "></i>Adds
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->
            @foreach ($categoryies as $item)
                <div class="tab-pane fade" id="category{{ $item->id }}" role="tabpanel" aria-labelledby="tab-two">
                    <div class="row product-grid-4">
                        @php
                            $catwiseProduct = App\Models\product::where('category_id', $item->id)
                                ->orderBy('id', 'DESC')
                                ->get();
                        @endphp
                        @forelse ($catwiseProduct as $item)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">
                                                <img class="default-img" src="{{ asset($item->product_thumbnail) }}"
                                                    alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn"
                                                href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                    class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" id="{{ $item->id }}"
                                                onclick="productView(this.id)" data-bs-toggle="modal"
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
                                            <a
                                                href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
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
                                                        class="fi-rs-shopping-cart mr-5"></i>home product</a>
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
                    <!--End product-grid-4-->
                </div>
            @endforeach


            <!--En tab two-->



        </div>
        <!--End tab-content-->
    </div>
</section>

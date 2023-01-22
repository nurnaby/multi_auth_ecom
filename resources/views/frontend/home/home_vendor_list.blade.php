<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
        <h3 class="">All Our Vendor List </h3>
        <a class="show-all" href="{{ route('vendor.all') }}">
            All Vendors
            <i class="fi-rs-angle-right"></i>
        </a>
    </div>


    <div class="row vendor-grid">
        @forelse ($allvendor as $item)
            <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
                <div class="vendor-wrap mb-40">
                    <div class="vendor-img-action-wrap">
                        <div class="vendor-img">
                            <a href="vendor-details-1.html">
                                <img class="default-img"
                                    src="{{ !empty($item->photo) ? url('upload/vendor_images/' . $item->photo) : url('upload/no_image.jpg') }}"
                                    alt="" />
                            </a>
                        </div>
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="hot">Mall</span>
                        </div>
                    </div>
                    <div class="vendor-content-wrap">
                        <div class="d-flex justify-content-between align-items-end mb-30">
                            <div>
                                <div class="product-category">
                                    <span class="text-muted">{{ $item->vendor_join }}</span>
                                </div>
                                <h4 class="mb-5"><a href="vendor-details-1.html">{{ $item->username }}</a></h4>
                                @php
                                    $product = App\Models\product::where('vendor_id', $item->id)->get();
                                @endphp
                                <div class="product-rate-cover">

                                    <span class="font-small total-product">{{ count($product) }} products</span>
                                </div>
                            </div>

                        </div>
                        <div class="vendor-info mb-30">
                            <ul class="contact-infor text-muted">

                                <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call
                                        Us:</strong><span>{{ $item->phone }}</span></li>
                            </ul>
                        </div>
                        <a href="{{ route('vendor.details', $item->id) }}" class="btn btn-xs">Visit Store <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
        @empty
            <h6 class="text-denger">Vendor Nont Found</h6>
        @endforelse
    </div>
</div>

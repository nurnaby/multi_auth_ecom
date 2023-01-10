@extends('admin.admin_dashbord')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">All Product</li>
                        <h6 class="mr-5"><span class="badge rounded-pill bg-danger">{{ count($allProduct) }}</span></h6>


                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.product') }}" type="submit" class="btn btn-primary">Add Product</a>
                    {{-- <button type="button"  >Add Brand</button> --}}
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allProduct as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>

                                        <img src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height:40px "
                                            alt="">
                                    </td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->product_qty }}</td>
                                    <td>

                                        @if ($item->discount_price == null)
                                            <span class="badge rounded-pill bg-info">NO Discount</span>
                                        @else
                                            @php
                                                $amount = $item->selling_price * $item->discount_price;
                                                $discount = $amount / 100;
                                                
                                            @endphp
                                            <span class="badge rounded-pill bg-danger">{{ round($discount) }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @elseif($item->status == 0)
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif

                                    </td>


                                    <td>


                                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info"
                                            title="Edit-data"><i class="fa fa-pencil"></i></a>

                                        <a href="{{ route('delete.product', $item->id) }}" class="btn btn-danger"
                                            id="delete" title="deleta-data"><i class="fa fa-trash"></i></a>

                                        <a href="{{ route('delete.product', $item->id) }}" class="btn btn-warning"
                                            id="delete" title="Details"><i class="fa fa-eye"></i></a>


                                        @if ($item->status == 1)
                                            <a href="{{ route('product.inactive', $item->id) }}" class="btn btn-primary"
                                                title="Active"><i class="fa fa-thumbs-up"></i></a>
                                        @elseif($item->status == 0)
                                            <a href="{{ route('product.active', $item->id) }}" class="btn btn-primary"
                                                title="Inactive"><i class="fa fa-thumbs-down"></i></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Brand Name</th>
                                <th>Brand Image</th>


                                <th>
                                    Action
                                </th>
                            </tr>
                        </tfoot>


                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

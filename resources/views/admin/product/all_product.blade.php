@extends('admin.admin_dashbord')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
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
                                <th>Discription</th>
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
                                    <td>{{ $item->short_descp }}</td>
                                    <td>{{ $item->status }}</td>


                                    <td>
                                        @if ($item->status == 1)
                                            <a href="{{ url('brand/status/0') }}/{{ $item->id }}"
                                                class="btn btn-success">Active</a>
                                        @elseif($item->status == 0)
                                            <a href="{{ url('brand/status/1') }}/{{ $item->id }}"
                                                class="btn btn-warning">Inactive</a>
                                        @endif

                                        <a href="#" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('delete.brand', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
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

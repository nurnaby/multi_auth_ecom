@extends('admin.admin_dashbord')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" type="submit" class="btn btn-primary">Add Category</a>
                    {{-- <button type="button"  >Add Brand</button> --}}
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">DataTable Example</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorydata as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>

                                        <img src="{{ asset($item->category_image) }}" style="width: 70px; height:40px "
                                            alt="">
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <a href="{{ url('category/status/0') }}/{{ $item->id }}"
                                                class="btn btn-success">Active</a>
                                        @elseif($item->status == 0)
                                            <a href="{{ url('category/status/1') }}/{{ $item->id }}"
                                                class="btn btn-warning">Inactive</a>
                                        @endif

                                        <a href="{{ route('edit.category', $item->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('delete.category', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>


                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

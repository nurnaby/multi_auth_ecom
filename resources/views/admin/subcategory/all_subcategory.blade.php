@extends('admin.admin_dashbord')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Sub Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Sub Cateogry</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.subcategory') }}" type="submit" class="btn btn-primary">Add subCategory</a>
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
                                <th> Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategorydata as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item['category']['category_name'] }}</td>
                                    <td>{{ $item->subcategory_name }}</td>

                                    <td>
                                        @if ($item->status == 1)
                                            <a href="{{ url('subcategory/status/0') }}/{{ $item->id }}"
                                                class="btn btn-success">Active</a>
                                        @elseif($item->status == 0)
                                            <a href="{{ url('subcategory/status/1') }}/{{ $item->id }}"
                                                class="btn btn-warning">Inactive</a>
                                        @endif

                                        <a href="{{ route('edit.subcategory', $item->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ route('delete.subcategory', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Sl</th>
                                <th>Sub Category Name</th>
                                <th> Category Name</th>
                                <th>Action</th>
                            </tr>
                            </tr>
                        </tfoot>


                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

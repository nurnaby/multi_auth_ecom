@extends('admin.admin_dashbord')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vendor</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Active Vendor</li>
                    </ol>
                </nav>
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
                                <th>Shope Name</th>
                                <th> Vendor Username</th>
                                <th> Join Date</th>
                                <th> Vendor Eamil</th>
                                <th> Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activeVendor as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->vendor_join }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td><span class="btn btn-secondary">{{ $item->status }}</span></td>

                                    <td>


                                        <a href="{{ route('active.vendor.detail', $item->id) }}"
                                            class="btn btn-primary">Vendor
                                            Details</a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Shope Name</th>
                                <th> Vendor Username</th>
                                <th> Join Date</th>
                                <th> Vendor Eamil</th>
                                <th> Status</th>
                                <th>Action</th>


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

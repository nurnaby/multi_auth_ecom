@extends('admin.admin_dashbord')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Coupon</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('coupon.store') }}" id="myForm" method="post">
                                    @method('PUT')
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> Coupon Name</h6>
                                        </div>
                                        <div class=" form-group col-sm-9 text-secondary">

                                            <input type="text" class="form-control" name="coupon_name"
                                                placeholder="Enter Coupon Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> Coupon Discount(%)</h6>
                                        </div>
                                        <div class=" form-group col-sm-9 text-secondary">

                                            <input type="text" class="form-control" name="coupon_discount"
                                                placeholder="Enter Coupon discount">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> Coupon Validate date</h6>
                                        </div>
                                        <div class=" form-group col-sm-9 text-secondary">

                                            <input type="date" class="form-control" name="coupon_validity"
                                                placeholder="Enter Coupon validate"
                                                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>





                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Add Couppon" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    coupon_name: {
                        required: true,
                    },
                    coupon_discount: {
                        required: true,
                    },
                    coupon_validity: {
                        required: true,
                    },
                },
                messages: {
                    coupon_name: {
                        required: 'Please Enter Coupon Name',
                    },
                    coupon_discount: {
                        required: 'Please Enter Coupon discount',
                    },
                    coupon_validity: {
                        required: 'Please Enter Coupon Validaty date',
                    }
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
    </script>
@endsection

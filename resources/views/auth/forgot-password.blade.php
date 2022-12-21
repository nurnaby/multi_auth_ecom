@extends('frontend.frontend_master')
@section('frontend')
@section('title')
    Password Reset- Easy Shope Online Store
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> My Account
        </div>
    </div>
</div>
<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                <div class="row">
                    <div class="heading_s1">
                        <img class="border-radius-15" src="{{ asset('frontend/assets/imgs/page/reset_password.svg') }}"
                            alt="" />
                        <h2 class="mb-15 mt-15">Set new password</h2>
                        <p class="mb-30">Forgot your password? No problem. Just let us know your email address and we
                            will email you a password reset link that will allow you to choose a new one.</p>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email" name="email" id="email" required=""
                                            name="email" placeholder="Confirm you password *" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-heading btn-block hover-up"
                                            name="login">Email Password Reset Link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@extends('layouts.back.app')

@section('content')
<div class="app-content-area pt-0 ">
    <div class="bg-light pt-12 pb-21 "></div>
    <div class="container-fluid mt-n22 ">

        @if(Auth::check())
        @if(Auth::user()->role === 'Superadmin')
        <div class="row mb-8">
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="mb-4 mb-lg-0">
                    <h4 class="mb-1">Company Setting</h4>
                    <p class="mb-0 fs-5 text-muted">Company configuration settings </p>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                <!-- card -->
                <div class="card" id="edit">
                    <!-- card body -->
                    <div class="card-body">

                        <form id="companyForm" class="mb-5" enctype="multipart/form-data">
                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="company_logo" class="col-sm-4 col-form-label form-label">Company Logo</label>
                                <div class="col-md-8 col-12">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <img class="image" id="company-logo-img" alt="Company Logo">
                                        </div>
                                        <div class="file-upload btn btn-outline-white ms-4">
                                            <input type="file" name="company_logo" id="company_logo" class="file-input opacity-0">Upload Photo
                                        </div>
                                    </div>
                                    <span class="invalid-feedback d-block" role="alert" id="company_logo_error"></span>
                                </div>

                                <!-- label -->
                                <label for="company_email" class="col-sm-4 col-form-label form-label">Company email</label>
                                <div class="col-md-8 col-12 mb-3">
                                    <input type="email" id="company_email" name="company_email" class="form-control" placeholder="Enter company email">
                                    <span class="invalid-feedback d-block" role="alert" id="company_email_error"></span>
                                </div>

                                <!-- label -->
                                <label for="company_phone" class="col-sm-4 col-form-label form-label">Company phone</label>
                                <div class="col-md-8 col-12 mb-3">
                                    <input type="text" class="form-control" placeholder="Enter company phone" name="company_phone" id="company_phone">
                                    <span class="invalid-feedback d-block" role="alert" id="company_phone_error"></span>
                                </div>

                                <!-- label -->
                                <label for="company_address" class="col-sm-4 col-form-label form-label">Company address</label>
                                <div class="col-md-8 col-12">
                                    <input type="text" class="form-control" placeholder="Enter company address" name="company_address" id="company_address">
                                    <span class="invalid-feedback d-block" role="alert" id="company_address_error"></span>
                                </div>

                                <!-- button -->
                                <div class="offset-md-4 col-md-8 col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="company_button_text"> Save Changes </span>
                                        <span class="company_load_data d-none">Loading <i class="loader"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif


        <div class="row mb-8">
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="mb-4 mb-lg-0">
                    <h4 class="mb-1">Account Setting</h4>
                    <p class="mb-0 fs-5 text-muted">Account configuration settings </p>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                <!-- card -->
                <div class="card" id="edit">
                    <!-- card body -->
                    <div class="card-body">

                        <form class="mb-5" id="profile" enctype="multipart/form-data">
                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="account_profile" class="col-sm-4 col-form-label form-label">Avatar</label>
                                <div class="col-md-8 col-12 mb-4">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <img class="image avatar avatar-lg rounded-circle" id="account-profile-img" alt="Company Logo">
                                        </div>
                                        <div class="file-upload btn btn-outline-white ms-4">
                                            <input type="file" name="account_profile" id="account_profile" class="file-input opacity-0">Upload Photo
                                        </div>

                                    </div>
                                    <span class="invalid-feedback d-block" role="alert" id="account_profile_error"></span>
                                </div>

                                <div class="offset-md-4 col-md-8 col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="profile_button_text"> Save Changes </span>
                                        <span class="profile_load_data d-none">Loading <i class="loader"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>


                        <form class="mb-5" id="account">
                            <!-- row -->
                            <div class="mb-3 row">

                                <!-- label -->
                                <label for="account_username" class="col-sm-4 col-form-label form-label">New Username</label>
                                <div class="col-md-8 col-12 mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your username" id="account_username" name="account_username">
                                    <span class="invalid-feedback d-block" role="alert" id="account_username_error"></span>
                                </div>

                                <label for="account_address" class="col-sm-4 col-form-label form-label">Address</label>
                                <div class="col-md-8 col-12 mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your address" id="account_address" name="account_address" value="{{ Auth::check() ?  Auth::user()->address : ''  }}" disabled>
                                    <span class="invalid-feedback d-block" role="alert" id="account_address_error"></span>
                                </div>

                                <!-- label -->
                                <label for="account_email" class="col-sm-4 col-form-label form-label">New email</label>
                                <div class="col-md-8 col-12">
                                    <input type="email" class="form-control" placeholder="Enter your email address" id="account_email" name="account_email">
                                    <span class="invalid-feedback d-block" role="alert" id="account_email_error"></span>
                                </div>

                                <div class="offset-md-4 col-md-8 col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="account_button_text"> Save Changes </span>
                                        <span class="account_load_data d-none">Loading <i class="loader"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form id="account_password">
                            <!-- row -->
                            <div class="row">
                                <label for="currentPassword" class="col-sm-4 col-form-label form-label">Current password</label>
                                <div class="col-md-8 col-12 mb-3">
                                    <input type="password" class="form-control" placeholder="Enter Current password" id="currentPassword" name="currentPassword">
                                    <span class="invalid-feedback d-block" role="alert" id="currentPassword_error"></span>
                                </div>
                            </div>

                            <!-- row -->
                            <div class="mb-3 row">
                                <label for="currentNewPassword" class="col-sm-4 col-form-label form-label">New password</label>
                                <div class="col-md-8 col-12">
                                    <input type="password" class="form-control" placeholder="Enter New password" id="currentNewPassword" name="currentNewPassword">
                                    <span class="invalid-feedback d-block" role="alert" id="currentNewPassword_error"></span>
                                </div>
                            </div>

                            <!-- row -->
                            <div class="row align-items-center">
                                <label for="confirmNewpassword" class="col-sm-4 col-form-label form-label">Confirm new password</label>
                                <div class="col-md-8 col-12 mb-2 mb-lg-0">
                                    <input type="password" class="form-control" placeholder="Confirm new password" id="confirmNewpassword" name="confirmNewpassword">
                                    <span class="invalid-feedback d-block" role="alert" id="confirmNewpassword_error"></span>
                                </div>
                                <!-- list -->
                                <div class="offset-md-4 col-md-8 col-12 mt-4">
                                    <h6 class="mb-1">Password requirements:</h6>
                                    <p>Ensure that these requirements are met:</p>
                                    <ul>
                                        <li> Minimum 8 characters long the more, the better</li>
                                        <li>At least one lowercase character</li>
                                        <li>At least one uppercase character</li>
                                        <li>At least one number, symbol, or whitespace character
                                        </li>
                                    </ul>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="password_button_text"> Save Changes </span>
                                        <span class="password_load_data d-none">Loading <i class="loader"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Assuming the JSON data is embedded in the script
    let companySettingJson = '<?php echo json_encode($companySetting) ?>';
    let accountSettingJson = '<?php echo json_encode($accountSetting) ?>';
</script>
<script src="{{ route('secure.js', ['filename' => 'company']) }}"></script>
<script src="{{ route('secure.js', ['filename' => 'account']) }}"></script>
@endpush
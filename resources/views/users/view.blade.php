@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('users.index') !!}">{{trans('lang.user_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.user_details')}}</li>
            </ol>
        </div>

    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card card-block p-card">
                                    <div class="profile-box">
                                        <div class="profile-card rounded">
                                            <img src="https://staging.poolmate.siswebapp.com/images/default_user.png"
                                                alt="profile-bg"
                                                class="avatar-100 d-block mx-auto img-fluid mb-3  avatar-rounded user-image">
                                            <h3 class="font-600 text-white text-center user-name"></h3>
                                            <div class="font-600 text-white text-center mb-3 user-total-ratings"></div>
                                            <h3 class="font-600 text-white text-center mb-5 user-wallet"></h3>
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#addWalletModal"
                                                class="ml-3 mb-2 text-white add-wallate btn btn-sm btn-success"><i
                                                    class="fa fa-plus"></i>{{trans("lang.add_wallet_amount")}}</a>

                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-target="#addVehicleModel"
                                                class="ml-3 mb-2 text-white add-wallate btn btn-sm btn-success"><i
                                                    class="fa fa-plus"></i>{{trans("lang.add_vehicle")}}</a>

                                        </div>
                                        <div class="pro-content rounded">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-icon mr-3">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <p class="mb-0 eml user-email"></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-icon mr-3">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <p class="mb-0 user-phone"></p>
                                            </div>
                                            
                                        </div>
                                        <div class="personal-detail">
                                            <h3>{{trans('lang.travel_prefrences')}}</h3>
                                            <div class="prefrences-list"></div>
                                        </div>
                                        <div class="personal-detail">
                                            <h3>{{trans('lang.personal_information')}}</h3>
                                            <div class="user-dob mb-2"></div>
                                            <div class="user-gender mb-2"></div>
                                            <div class="user-bio mb-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-block card-stretch">
                                    <div class="card-header bg-white">
                                        <ul class="nav nav-pills mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link publish_ride_list active" data-toggle="pill"
                                                    href="#publish_ride_list"
                                                    role="tab">{{trans('lang.ride_published')}}</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link booked_ride_list" data-toggle="pill"
                                                    href="#booked_ride_list"
                                                    role="tab">{{trans('lang.ride_booked')}}</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link wallet_transactions" data-toggle="pill"
                                                    href="#wallet_transactions"
                                                    role="tab">{{trans('lang.wallet_transactions')}}</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link vehicle_list " data-toggle="pill"
                                                    href="#vehicle_list" role="tab">{{trans('lang.vehicle_list')}}</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="publish_ride_list" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                        id="publishRideTable">
                                                        <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col">{{trans('lang.booking_id')}}</th>
                                                                <th scope="col">{{trans('lang.pickup')}}</th>
                                                                <th scope="col">{{trans('lang.drop-off')}}</th>
                                                                <th scope="col">{{trans('lang.date')}}</th>
                                                                <th scope="col">{{trans('lang.ride_status')}}</th>
                                                                <!-- <th scope="col">{{trans('lang.amount')}}</th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="publish_ride_rows"></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="booked_ride_list" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                        id="bookedRideTable">
                                                        <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col">{{trans('lang.booking_id')}}</th>
                                                                <th scope="col">{{trans('lang.pickup')}}</th>
                                                                <th scope="col">{{trans('lang.drop-off')}}</th>
                                                                <th scope="col">{{trans('lang.date')}}</th>
                                                                <th scope="col">{{trans('lang.ride_status')}}</th>
                                                                <!--<th scope="col">{{trans('lang.amount')}}</th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="booked_ride_rows"></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="wallet_transactions" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                        id="transactionListTable">
                                                        <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col"> {{trans('lang.id')}}</th>
                                                                <th scope="col">{{trans('lang.payment_method')}}</th>
                                                                <th scope="col">{{trans('lang.txn_id')}}</th>
                                                                <th scope="col">{{trans('lang.date')}}</th>
                                                                <th scope="col">{{trans('lang.note')}}</th>
                                                                <th scope="col">{{trans('lang.total_amount')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="wallet_transactions_rows"></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="vehicle_list" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-valign-middle"
                                                        id="vehicleListTable">
                                                        <thead class="table-color-heading">
                                                            <tr class="text-secondary">
                                                                <th scope="col">{{trans('lang.car_number')}}</th>
                                                                <th scope="col">{{trans('lang.type')}}</th>
                                                                <th scope="col">{{trans('lang.brand')}}</th>
                                                                <th scope="col">{{trans('lang.model')}}</th>
                                                                <th scope="col">{{trans('lang.actions')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="vehicle_list_rows"></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 text-center btm-btn">
                <a href="{!! route('users.index') !!}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="addWalletModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.add_wallet_amount')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <div class="form-group row">

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
    trans('lang.amount')}}</label>
                                <div class="col-12">
                                    <div class="control-inner">
                                        <input type="number" name="amount" class="form-control topup_amount" id="amount">
                                        <span class="currentCurrency"></span>
                                        <div id="wallet_error" style="color:red"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
    trans('lang.note')}}</label>
                                <div class="col-12">
                                    <textarea name="note" class="form-control" id="note"></textarea>
                                </div>
                            </div>
                            <div class="form-group row width-100">

                                <div id="user_account_not_found_error" class="align-items-center" style="color:red">
                                </div>
                            </div>


                        </div>

                    </div>

                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add-wallet-btn">{{trans('lang.submit')}}</a>
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        {{trans('lang.close')}}</a>
                    </button>

                </div>

            </div>
        </div>

    </div>

</div>
<div class="modal fade" id="addVehicleModel" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.add_vehicle')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <div class="form-group row">

                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.vehicle_number')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <input type="text" class="form-control vehicle_number" name="vehicle_number" placeholder="{{trans('lang.vehicle_number_help')}}">
                                    <div class="add_car_number_error text-danger font-weight-bold"></div>
                                </div>
                            </div>
                           

                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.type')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <select id='vehicle_type' class="form-control" required>
                                        <option value="">{{trans('lang.vehicle_type_help')}}</option>
                                    </select>
                                    
                                    <div class="add_type_error text-danger font-weight-bold"></div>
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.brand')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <select id='vehicle_brand' class="form-control" required>
                                        <option value="">{{trans('lang.vehicle_brand_help')}}</option>
                                    </select>
                                    
                                    <div class="add_brand_error text-danger font-weight-bold"></div>
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.model')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <select id='vehicle_model' class="form-control" required>
                                        <option value="">{{trans('lang.vehicle_model_help')}}</option>
                                    </select>
                                    
                                    <div class="add_model_error text-danger font-weight-bold"></div>
                                </div>
                            </div>
                                                        @php
$colorArray = [
    'Red',
    'Black',
    'White',
    'Blue',
    'Green',
    'Orange',
    'Silver',
    'Gray',
    'Yellow',
    'Brown',
    'Gold',
    'Beige',
    'Purple'
];
                                                        @endphp
                                                        <div class="form-group row width-100">
                                                            <label class="col-7 control-label">{{trans('lang.vehicle_color')}}<span class="required-field"></span></label>
                                                            <div class="col-12">
                                                                <select name="vehicle_color" id="colorPicker" class="form-control vehicle_color">
                                                                    @foreach($colorArray as $color)
                                                                        <option value="{{$color}}">{{$color}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="add_color_error text-danger font-weight-bold"></div>
                                                            </div>
                                                        </div>
<div class="form-group row width-100">
    <label class="col-7 control-label">{{trans('lang.vehicle_registration_year')}}<span
            class="required-field"></span></label>
    <div class="col-12">
        <input type="text" class="form-control vehicle_registration_year"
            placeholder="{{trans('lang.vehicle_registration_year_help')}}">
        <div class="add_year_error text-danger font-weight-bold"></div>
    </div>

</div>
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.vehicle_images')}}</label>
                                <div class="col-12">
                                    <input type="file" class="form-control" onChange="handleFileSelect(event)" >
                                    <div class=" placeholder_img_thumb vehicle_image"></div>
                                </div>
                            </div>


                        </div>

                    </div>

                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add-vehicle-btn"
                        onclick="addUserVehicle()">{{trans('lang.submit')}}</a>
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        {{trans('lang.close')}}</a>
                    </button>

                </div>

            </div>
        </div>

    </div>

</div>
<div class="modal fade" id="editVehicleModel" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.edit_vehicle')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <div class="form-group row">
                            <input type="hidden" id="vehicle_id">
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.vehicle_number')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <input type="text" class="form-control edit_vehicle_number" name="vehicle_number" placeholder="{{trans('lang.vehicle_number_help')}}">
                                    <div class="add_car_number_error text-danger font-weight-bold"></div>
                                </div>
                            </div>
                           
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.type')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <select id='edit_vehicle_type' class="form-control" required>
                                        <option value="">{{trans('lang.vehicle_type_help')}}</option>
                                    </select>
                                    <div class="add_type_error text-danger font-weight-bold">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.brand')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <select id='edit_vehicle_brand' class="form-control" required>
                                        <option value="">{{trans('lang.vehicle_brand_help')}}</option>
                                    </select>
                                    <div class="add_brand_error text-danger font-weight-bold">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.model')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <select id='edit_vehicle_model' class="form-control" required>
                                        <option value="">{{trans('lang.vehicle_model_help')}}</option>
                                    </select>
                                    <div class="add_model_error text-danger font-weight-bold">
                                    </div>
                                </div>
                            </div>
                                                        @php
$colorArray = [
    'Red',
    'Black',
    'White',
    'Blue',
    'Green',
    'Orange',
    'Silver',
    'Gray',
    'Yellow',
    'Brown',
    'Gold',
    'Beige',
    'Purple'
];
                                                        @endphp
                                                        <div class="form-group row width-100">
                                                            <label class="col-7 control-label">{{trans('lang.vehicle_color')}}<span class="required-field"></span></label>
                                                            <div class="col-12">
                                                                <select name="vehicle_color" id="colorPicker" class="form-control edit_vehicle_color">
                                                                    @foreach($colorArray as $color)
                                                                        <option value="{{$color}}">{{$color}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="add_color_error text-danger font-weight-bold"></div>
                                                            </div>
                                                        </div>

                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.vehicle_registration_year')}}<span
                                        class="required-field"></span></label>
                                <div class="col-12">
                                    <input type="text" class="form-control edit_vehicle_registration_year"
                                        placeholder="{{trans('lang.vehicle_registration_year_help')}}">
                                    <div class="add_year_error text-danger font-weight-bold"></div>
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-7 control-label">{{trans('lang.vehicle_images')}}</label>
                                <div class="col-12">
                                    <input type="file" class="form-control" onChange="handleFileSelect(event)">
                                    <div class="placeholder_img_thumb vehicle_image"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="edit-vehicle-btn"
                        onclick="editUserVehicle()">{{trans('lang.submit')}}</a>
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        {{trans('lang.close')}}</a>
                    </button>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script>

    var id = "<?php echo $id; ?>";
    var database = firebase.firestore();
    var userRef = database.collection('users').doc(id);
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    var users_details = "{{trans('lang.users_details')}}";
    var notFound = "{{ trans('lang.doc_not_found') }}";
    var publishRideRef = database.collection('booking').where("createdBy", "==", id).orderBy('createdAt', 'desc');
    var bookedRideRef = database.collection('booking').orderBy('createdAt', 'desc');
    var walletRef = database.collection('wallet_transaction').where("userId", "==", id).orderBy('createdDate', 'desc');
    var vehicleRef = database.collection('user_vehicle_information').where("userId", "==", id);
    var photos=[];
    var new_added_photos = [];
    var new_added_photos_filename = [];
    var photosToDelete = [];
    var photosCount=0;
    var storage = firebase.storage();
    var storageRef = firebase.storage().ref('images');

    var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
    var decimal_degits = 0;
    var symbolAtRight = false;
    var currentCurrency = '';

    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        decimal_degits = currencyData.decimalDigits;
        if (currencyData.symbolAtRight) {
            symbolAtRight = true;
        }
        $('.currentCurrency').html(currentCurrency);
    });

    $(document).ready(function () {
        $('.user_menu').addClass('active');
        database.collection('vehicle_type').where('enable', '==', true).get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();

                $('#vehicle_type,#edit_vehicle_type').append($("<option></option>")
                    .attr("value", data.id)
                    .attr("data-name", data.name)
                    .attr("data-type", JSON.stringify(data))
                    .text(data.name));
            });
        });
        database.collection('vehicle_brand').where('enable', '==', true).get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();

                $('#vehicle_brand,#edit_vehicle_brand').append($("<option></option>")
                    .attr("value", data.id)
                    .attr("data-name", data.name)
                    .attr("data-brand", JSON.stringify(data))
                    .text(data.name));
            });
        });
        database.collection('vehicle_model').where('enable', '==', true).get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();

                $('#vehicle_model,#edit_vehicle_model').append($("<option></option>")
                    .attr("value", data.id)
                    .attr("data-name", data.name)
                    .attr("data-model", JSON.stringify(data))
                    .text(data.name));
            });
        })

        $('#vehicle_brand').on('change', function () {
            brandId = $(this).val();
            database.collection('vehicle_model').where('enable', '==', true).where('brandId', '==', brandId).get().then(async function (snapshots) {
                $('#vehicle_model,edit_vehicle_model').html('');
                snapshots.docs.forEach((listval) => {
                    var data = listval.data();

                    $('#vehicle_model,#edit_vehicle_model').append($("<option></option>")
                        .attr("value", data.id)
                        .attr("data-name", data.name)
                        .attr("data-model", JSON.stringify(data))
                        .text(data.name));
                });
            });
        });

        getPublishRideList();
    });

    $(document).on('click', '.publish_ride_list', function () {
        getPublishRideList();
    });

    $(document).on('click', '.booked_ride_list', function () {
        getBookedRideList();
    });
    $(document).on('click', '.vehicle_list', function () {
        getVehicleList();
    });
    $(document).on('click', '.wallet_transactions', function () {
        getWalletTransactions();
    });
    userRef.get().then(async function (snapshot) {
        let data = snapshot.data();

        $(".user-name").text(data.firstName + ' ' + data.lastName);
        $(".user-email").text(data.email);
        $(".user-phone").text(data.countryCode + data.phoneNumber);
        $(".user-dob").html('<strong>{{trans('lang.date_of_birth')}}</strong> : '+data.dateOfBirth);
        $(".user-gender").html('<strong>{{trans('lang.gender')}}</strong> : ' +data.gender);
        if(data.bio!='' && data.bio!=null){
            $('.user-bio').html('<strong>{{trans('lang.bio')}}</strong> : '+data.bio);
        }else{
             $('.user-bio').text('-')
        }
        var rating = 0;
        var reviewCount = 0;

        if (data.hasOwnProperty('reviewCount') && data.reviewCount && data.reviewCount != "0.0" && data.reviewCount != null && data.hasOwnProperty('reviewSum') && data.reviewSum && data.reviewSum != "0.0" && data.reviewSum != null) {

            rating = (parseFloat(data.reviewSum) / parseFloat(data.reviewCount));

            rating = (rating * 10) / 10;

            reviewCount = parseInt(data.reviewCount);
        }

        $('.user-total-ratings').html('<span class="badge badge-warning text-white dr-review"><i class="fa fa-star"></i>' + (rating).toFixed(1) + '</span>');

        var walletAmount = 0;
        if (data.hasOwnProperty('walletAmount') && data.walletAmount != null) {
            walletAmount = data.walletAmount;
        }
        if (symbolAtRight) {
            $(".user-wallet").text("{{trans('lang.wallet_Balance')}} : " + parseFloat(walletAmount).toFixed(decimal_degits) + currentCurrency);
        } else {
            $(".user-wallet").text("{{trans('lang.wallet_Balance')}} : " + currentCurrency + parseFloat(walletAmount).toFixed(decimal_degits));
        }
        if (data.profilePic != null && data.profilePic != '') {
            $(".user-image").attr('src', data.profilePic);
        }
        if (data.hasOwnProperty('travelPreference') && data.travelPreference != '' && data.travelPreference != null) {
            var html = '';
            html += '<ul>';
            if (data.travelPreference.chattiness != '') {
                if (data.travelPreference.chattiness == "I’m the quite type") {
                    var icon = "fa fa-minus-circle";
                } else {
                    var icon = 'mdi mdi-check-circle'
                }
                html += '<li><i class="' + icon + ' mr-2"></i>' + data.travelPreference.chattiness + '</li>';
            }
            if (data.travelPreference.music != '') {
                if (data.travelPreference.music == "Silence is golden") {
                    var icon = "fa fa-volume-off"
                } else {
                    var icon = 'fa fa-volume-up';
                }
                html += '<li><i class="' + icon + ' mr-2"></i> ' + data.travelPreference.music + '</li>';
            }
            if (data.travelPreference.pets != "") {
                if (data.travelPreference.pets == "I’d prefer not to travel with pet") {
                    var icon = 'fa fa-ban';
                } else {
                    var icon = 'fa fa-paw'
                }
                html += '<li><i class="' + icon + ' mr-2"></i> ' + data.travelPreference.pets + '</li>';
            }
            if (data.travelPreference.smoking != '') {
                if (data.travelPreference.smoking == "No smoking, Please") {
                    var icon = 'mdi mdi-smoking-off';
                }
                else {
                    var icon = 'mdi mdi-smoking';
                }
                html += '<li><i class="' + icon + ' mr-2"></i> ' + data.travelPreference.smoking + '</li>';
            }
            html += '</ul>';
            $('.prefrences-list').append(html);
        } else {
            $('.prefrences-list').append("{{trans('lang.no_prefrence_found')}}");
        }
    });



    function getPublishRideList() {

        $("#publish_ride_rows").html('');

        jQuery("#overlay").show();
        publishRideRef.get().then(async function (docSnapshot) {
            let html = '';
            html = await buildPublishRidesHtml(docSnapshot);
            if (html != '') {
                $("#publish_ride_rows").html(html);
            }

            var table = $('#publishRideTable').DataTable();

            table.destroy();

            table = $('#publishRideTable').DataTable({
                order: [],

                columnDefs: [
                    {
                        targets: 3,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },

                    { orderable: false, targets: [4] },
                ],
                order: [['3', 'desc']],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true

            });

            jQuery("#overlay").hide();

        });
    }


    async function buildPublishRidesHtml(snapshots) {
        var html = '';

        await Promise.all(snapshots.docs.map(async (listval) => {

            var val = listval.data();

            var getData = await getPublishRidesListData(val);
            html += getData;
        }));

        return html;
    }

    async function getPublishRidesListData(data) {

        var html = '';

        html += '<tr>';

        html += '<td><a href="/rides/show/' + data.id + '" target="_blank">' + data.id + '</a></td>';
        html += '<td>' + data.pickUpAddress + '</td>';
        html += '<td>' + data.dropAddress + '</td>';

        var date = data.createdAt.toDate().toDateString();
        var time = data.createdAt.toDate().toLocaleTimeString('en-US');

        html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';

        if (data.status == "placed") {
            var status = 'Placed';
            html += '<td><span class="badge badge-primary py-2 px-3">' + status + '</span></td>';
        } else if (data.status == "completed") {
            var status = 'Completed';
            html += '<td><span  class="badge badge-success py-2 px-3">' + status + '</span></td>';
        } else if (data.status == "onGoing") {
            var status = 'On Going';
            html += '<td><span  class="badge badge-info py-2 px-3">' + status + '</span></td>';
        }
        else if (data.status == "canceled") {
            var status = 'Cancelled';
            html += '<td><span  class="badge badge-danger py-2 px-3">' + status + '</span></td>';
        }
        else {
            html += '<td><span class="badge badge-warning py-2 px-3">' + data.status + '</span></td>';
        }

        html += '</tr>';

        return html;
    }

    function getBookedRideList() {

        $("#booked_ride_rows").html('');

        jQuery("#overlay").show();
        bookedRideRef.get().then(async function (docSnapshot) {
            let html = '';

            html = await buildBookedRideHtml(docSnapshot);
            if (html != '') {
                $("#booked_ride_rows").html(html);

            }

            var table = $('#bookedRideTable').DataTable();

            table.destroy();
          

            table = $('#bookedRideTable').DataTable({
                order: [],

                columnDefs: [
                    {
                        targets: 3,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    }, {
                        orderable: false,
                        targets: [4]
                    },
                ],
                order: [['3', 'desc']],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true

            });


            jQuery("#overlay").hide();

        });
    }

    async function buildBookedRideHtml(snapshots) {
        var html = '';
        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getBookedRidesListData(val);
            html += getData;
        }));
        return html;
    }

    async function getBookedRidesListData(val) {
        var html = '';
        await database.collection('booking/' + val.id + '/bookedUser').where('id', '==', id).get().then(async function (snapshot) {

            if (snapshot.docs.length > 0) {
                var data = snapshot.docs[0].data();


                html += '<tr>';

                html += '<td><a href="/rides/show/' + val.id  + '" target="_blank">' + val.id + '</a></td>';

                html += '<td>' + data.stopOver.start_address + '</td>';
                html += '<td>' + data.stopOver.end_address + '</td>';
                var date = '';
                var time = '';
                if (data.hasOwnProperty("createdAt")) {
                    try {
                        date = data.createdAt.toDate().toDateString();
                        time = data.createdAt.toDate().toLocaleTimeString('en-US');
                    } catch (err) {

                    }
                    html = html + '<td>' + date + ' ' + time + '</td>';
                } else {
                    html = html + '<td></td>';
                }


                if (val.status == "placed") {
                    html += '<td><span class="badge badge-primary py-2 px-3">' + val.status + '</span></td>';
                } else if (val.status == "completed") {
                    html += '<td><span  class="badge badge-success py-2 px-3">' + val.status + '</span></td>';
                } else {
                    html += '<td><span class="badge badge-warning py-2 px-3">' + val.status + '</span></td>';
                }

                html += '</tr>';



            }
        })
        return html;
    }

    async function getOrderDetails(orderData) {

        var amount = 0;
        var total_amount = 0;

        if (orderData.offerRate) {
            amount = parseFloat(orderData.offerRate);

        }
        if (orderData.finalRate) {
            amount = parseFloat(orderData.finalRate);

        }

        total_amount = amount;

        var discount_amount = 0;
        if (orderData.hasOwnProperty('coupon') && orderData.coupon.enable) {
            var data = orderData.coupon;

            if (data.type == "fix") {
                discount_amount = data.amount;
            } else {
                discount_amount = (data.amount * amount) / 100;
            }

            total_amount -= parseFloat(discount_amount);

        }


        if (orderData.hasOwnProperty('taxList') && orderData.taxList.length > 0) {
            var taxData = orderData.taxList;

            var tax_amount_total = 0;
            for (var i = 0; i < taxData.length; i++) {

                var data = taxData[i];

                if (data.enable) {

                    var tax_amount = data.tax;

                    if (data.type == "percentage") {

                        tax_amount = (data.tax * total_amount) / 100;
                    }

                    tax_amount_total += parseFloat(tax_amount);

                }
            }
            total_amount += parseFloat(tax_amount_total);


        }
        total_amount = total_amount.toFixed(decimal_degits);

        return total_amount;
    }

    function getWalletTransactions() {

        $("#wallet_transactions_rows").html('');

        jQuery("#overlay").show();

        walletRef.get().then(async function (docSnapshot) {

            let html = '';

            html = await buildWalletTransactionsHtml(docSnapshot);

            if (html != '') {
                $("#wallet_transactions_rows").html(html);

            }

            var table = $('#transactionListTable').DataTable();

            table.destroy();

            table =
                $('#transactionListTable').DataTable({
                    order: [],
                    columnDefs: [
                        {
                            targets: 3,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        { orderable: false, targets: 1 },
                    ],
                    order: [['3', 'desc']],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true

                });

            jQuery("#overlay").hide();

        });

    }

    async function buildWalletTransactionsHtml(snapshots) {
        var html = '';
        await Promise.all(snapshots.docs.map(async (listval) => {
            var val = listval.data();
            var getData = await getWalletTransactionsListData(val);
            html += getData;
        }));
        return html;
    }

    async function getWalletTransactionsListData(data) {

        let html = '';

        html += '<tr>';

        html += '<td>' + data.id.substring(0, 7) + '</td>';

        if (data.paymentType) {
            html += '<td><span class="badge badge-success py-2 px-3">' + ((data.paymentType).slice(0, 1)).toUpperCase() + (data.paymentType).substring(1) + '</span></td>';
        } else {
            html += '<td>-</td>';
        }

        html += '<td>' + data.transactionId + '</td>';

        if (data.hasOwnProperty("createdDate")) {
            date = data.createdDate.toDate().toDateString();
            time = data.createdDate.toDate().toLocaleTimeString('en-US');
            html = html + '<td class="dt-time"><span class="date">' + date + '</span><span class="time"> ' + time + '</span></td>';
        } else {
            html = html + '<td></td>';
        }

        html += '<td>' + data.note + '</td>';

        var amount = parseFloat(data.amount);

        if (symbolAtRight) {
            if (data.isCredit == false) {
                amount = Math.abs(amount);
                html += '<td><span style="color:red">(-' + amount.toFixed(decimal_degits) + currentCurrency + ')</span></td>';
            } else {
                html += '<td><span style="color:green">' + amount.toFixed(decimal_degits) + currentCurrency + '</sapn></td>';
            }
        } else {
            if (data.isCredit == false) {
                amount = Math.abs(amount);

                html += '<td><span style="color:red">(-' + currentCurrency + amount.toFixed(decimal_degits) + ')</span></td>';
            } else {
                html += '<td><span style="color:green">' + currentCurrency + amount.toFixed(decimal_degits) + '</sapn></td>';
            }
        }

        html += '</tr>';

        return html;
    }

    function getVehicleList() {
        $("#vehicle_list_rows").html('');

        jQuery("#overlay").show();

        vehicleRef.get().then(async function (docSnapshot) {

            let html = '';

            html = await buildVehicleListHtml(docSnapshot);

            if (html != '') {
                $("#vehicle_list_rows").html(html);

            }

            var table = $('#vehicleListTable').DataTable();

            table.destroy();

            table =
                $('#vehicleListTable').DataTable({
                    order: [],
                    columnDefs: [

                    ],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    },
                    responsive: true

                });

            jQuery("#overlay").hide();

        });

    }

    async function buildVehicleListHtml(snapshots) {
        var html = '';

        await Promise.all(snapshots.docs.map(async (listval) => {

            var val = listval.data();

            var getData = await getVehicleListData(val);
            html += getData;
        }));

        return html;
    }

    async function getVehicleListData(val) {
        var html = '';
        html = html + '<tr>';
        var id = val.id;

        html += '<td>' + val.licensePlatNumber + '</td>';
        html = html + '<td>' + val.vehicleType.name + '</td>';
        html = html + '<td>' + val.vehicleBrand.name + '</td>';
        html = html + '<td>' + val.vehicleModel.name + '</td>';
        html += '<td class="action-btn"><a href="javascript:void(0)" id="' + val.id + '" name="edit-vehicle"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="' + val.id + '" name="delete-vehicle"><i class="fa fa-trash"></i></a></td>';
        html += '</tr>';
        return html;

    }


    $("#add-wallet-btn").click(function () {
        var date = firebase.firestore.FieldValue.serverTimestamp();
        var amount = $('#amount').val();
        if (amount == '') {
            $('#wallet_error').text('{{trans("lang.add_wallet_amount_error")}}');
            return false;
        }
        var note = $('#note').val();

        database.collection('users').where('id', '==', id).get().then(async function (snapshot) {

            if (snapshot.docs.length > 0) {
                var data = snapshot.docs[0].data();

                var walletAmount = 0;

                if (data.hasOwnProperty('walletAmount') && !isNaN(data.walletAmount) && data.walletAmount != null) {
                    walletAmount = data.walletAmount;

                }
                var user_id = data.id;
                var newWalletAmount = parseFloat(walletAmount) + parseFloat(amount);

                database.collection('users').doc(id).update({
                    'walletAmount': newWalletAmount.toString()
                }).then(function (result) {
                    var tempId = database.collection("tmp").doc().id;
                    var transactionId = (new Date()).getTime();
                    database.collection('wallet_transaction').doc(tempId).set({
                        'amount': amount.toString(),
                        'createdDate': date,
                        'id': tempId,
                        'isCredit': true,
                        'note': note,
                        'paymentType': 'Wallet',
                        'transactionId': transactionId.toString(),
                        'userId': user_id,

                    }).then(async function (result) {
                        window.location.reload();

                    });
                })
            }
        });
    })
    async function addUserVehicle() {
        var date = firebase.firestore.FieldValue.serverTimestamp();
        var vehicleType = $('#vehicle_type').val();
        var vehicleBrand = $('#vehicle_brand').val();
        var vehicleModel = $('#vehicle_model').val();
        var vehicleYear = $('.vehicle_registration_year').val();
        var vehicleColor = $('.vehicle_color').val();
        var vehicleNumber = $('.vehicle_number').val();


        $('.error').html('');


        if (vehicleNumber == '') {
            $('.add_car_number_error').text('{{trans("lang.vehicle_number_help")}}');
            return false;

        } else if (vehicleBrand == '') {
            $('.add_brand_error').text('{{trans("lang.vehicle_brand_help")}}');
            return false;
        } else if (vehicleModel == '') {
            $('.add_model_error').text('{{trans("lang.vehicle_model_help")}}');
            return false;
        }
        else if (vehicleType == '') {
            $('.add_type_error').text('{{trans("lang.vehicle_type_help")}}');
            return false;
        }
        else if (vehicleColor == '') {
            $('.add_color_error').text('{{trans("lang.vehicle_color_help")}}');
            return false;
        }
        else if (vehicleYear == '') {
            $('.add_year_error').text('{{trans("lang.vehicle_registration_year_help")}}');
            return false;
        }
        var vehicleTypeData = JSON.parse($('#vehicle_type :selected').attr('data-type'));
        var vehicleBrandData = JSON.parse($('#vehicle_brand :selected').attr('data-brand'));
        var vehicleModelData = JSON.parse($('#vehicle_model :selected').attr('data-model'));


        var tempId = database.collection("tmp").doc().id;
       
        await storeImageData().then(async (IMG) => {
        database.collection('user_vehicle_information').doc(tempId).set({
            'licensePlatNumber': vehicleNumber,
            'vehicleBrand': vehicleBrandData,
            'vehicleColor': vehicleColor,
            'vehicleModel': vehicleModelData,
            'vehicleRegistrationYear': vehicleYear,
            'vehicleType': vehicleTypeData,
            'id': tempId,
            'userId': id,
            'vehicleImages':IMG
        }).then(async function (result) {
            window.location.reload();

        });
    });

    }
    $(document).on("click", "a[name='edit-vehicle']", function (e) {
        vehId = this.id;
        database.collection('user_vehicle_information').where('id', '==', vehId).get().then(async function (vehSnapshots) {

            vehicleData = vehSnapshots.docs[0].data();
            $('#vehicle_id').val(vehId);
            $('#edit_vehicle_type').val(vehicleData.vehicleType.id);
            $('#edit_vehicle_brand').val(vehicleData.vehicleBrand.id);
            $('#edit_vehicle_model').val(vehicleData.vehicleModel.id);
            $('.edit_vehicle_registration_year').val(vehicleData.vehicleRegistrationYear);
            $('.edit_vehicle_color').val(vehicleData.vehicleColor);
            $('.edit_vehicle_number').val(vehicleData.licensePlatNumber);
            if(vehicleData.hasOwnProperty('vehicleImages') && vehicleData.vehicleImages.length>0){
                photos= vehicleData.vehicleImages;
                $(".vehicle_image").html('');
                 photos.forEach((element, index) => {
                    $(".vehicle_image").append('<span class="image-item" id="photo_' + index + '"><span class="remove-btn" data-id="' + index + '" data-img="' + photos[index] + '" data-status="old"><i class="fa fa-remove"></i></span><img class="rounded" width="50px" id="" height="auto" src="' + photos[index] + '" onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'"></span>');
                })
            }else{
                 $(".vehicle_image").html('');
                photos='';
            }
            $('#editVehicleModel').modal('show');
        })

    })
    async function editUserVehicle() {
        var vehId = $('#vehicle_id').val();
        var vehicleType = $('#edit_vehicle_type').val();
        var vehicleBrand = $('#edit_vehicle_brand').val();
        var vehicleModel = $('#edit_vehicle_model').val();
        var vehicleYear = $('.edit_vehicle_registration_year').val();
        var vehicleColor = $('.edit_vehicle_color').val();
        var vehicleNumber = $('.edit_vehicle_number').val();


        $('.error').html('');


        if (vehicleNumber == '') {
            $('.add_car_number_error').text('{{trans("lang.vehicle_number_help")}}');
            return false;

        } else if (vehicleBrand == '') {
            $('.add_brand_error').text('{{trans("lang.vehicle_brand_help")}}');
            return false;
        } else if (vehicleModel == '') {
            $('.add_model_error').text('{{trans("lang.vehicle_model_help")}}');
            return false;
        }
        else if (vehicleType == '') {
            $('.add_type_error').text('{{trans("lang.vehicle_type_help")}}');
            return false;
        }
        else if (vehicleColor == '') {
            $('.add_color_error').text('{{trans("lang.vehicle_color_help")}}');
            return false;
        }
        else if (vehicleYear == '') {
            $('.add_year_error').text('{{trans("lang.vehicle_registration_year_help")}}');
            return false;
        }
        var vehicleTypeData = JSON.parse($('#edit_vehicle_type :selected').attr('data-type'));
        var vehicleBrandData = JSON.parse($('#edit_vehicle_brand :selected').attr('data-brand'));
        var vehicleModelData = JSON.parse($('#edit_vehicle_model :selected').attr('data-model'));
      await storeImageData().then(async (IMG) => {
        database.collection('user_vehicle_information').doc(vehId).update({
            'licensePlatNumber': vehicleNumber,
            'vehicleBrand': vehicleBrandData,
            'vehicleColor': vehicleColor,
            'vehicleModel': vehicleModelData,
            'vehicleRegistrationYear': vehicleYear,
            'vehicleType': vehicleTypeData,
            'vehicleImages':IMG
           
        }).then(async function (result) {
            window.location.reload();

        });
    })

    }
    $(document).on("click", "a[name='delete-vehicle']", function (e) {
        vehId = this.id;
        database.collection('user_vehicle_information').doc(vehId).delete().then(async function (result) {
            window.location.reload();
        });
    });
    
        function handleFileSelect(evt) {
            
            var f = evt.target.files[0];
            var reader = new FileReader();
            reader.onload = (function (theFile) {

                return function (e) {

                    var filePayload = e.target.result;
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')
                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    photosCount++;
                    photos_html = '<span class="image-item" id="photo_' + photosCount + '"><span class="remove-btn" data-id="' + photosCount + '" data-img="' + filePayload + '" data-status="new"><i class="fa fa-remove"></i></span><img class="rounded" width="50px" id="" height="auto" src="' + filePayload + '"></span>'
                    $(".vehicle_image").append(photos_html);
                    new_added_photos.push(filePayload);
                    new_added_photos_filename.push(filename);
                };
            })(f);
            reader.readAsDataURL(f);
        }
    async function storeImageData() {
        var newPhoto = [];
        if (photos.length > 0) {
            newPhoto = photos;
        }
        if (new_added_photos.length > 0) {
            await Promise.all(new_added_photos.map(async (vehPhoto, index) => {

                vehPhoto = vehPhoto.replace(/^data:image\/[a-z]+;base64,/, "");
                var uploadTask = await storageRef.child(new_added_photos_filename[index]).putString(vehPhoto, 'base64', { contentType: 'image/jpg' });
                var downloadURL = await uploadTask.ref.getDownloadURL();
                newPhoto.push(downloadURL);
            }));
        }
        if (photosToDelete.length > 0) {

            await Promise.all(photosToDelete.map(async (delImage) => {

                imageBucket = delImage.bucket;
                var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                if (imageBucket == envBucket) {
                    await delImage.delete().then(() => {
                        console.log("Old file deleted!")
                    }).catch((error) => {
                        console.log("ERR File delete ===", error);
                    });
                } else {
                    console.log('Bucket not matched');
                }

            }));
        }
        return newPhoto;
    }


    $(document).on("click", ".remove-btn", function () {

        var id = $(this).attr('data-id');
        var photo_remove = $(this).attr('data-img');
        var status = $(this).attr('data-status');
        if (status == "old") {
            photosToDelete.push(firebase.storage().refFromURL(photo_remove));
        }

        $("#photo_" + id).remove();
        index = photos.indexOf(photo_remove);
        if (index > -1) {
            photos.splice(index, 1); // 2nd parameter means remove one item only
        }
        index = new_added_photos.indexOf(photo_remove);
        if (index > -1) {
            new_added_photos.splice(index, 1); // 2nd parameter means remove one item only
            new_added_photos_filename.splice(index, 1);
        }

    });
    $('#addVehicleModel').on('show.bs.modal', function (e) {
         photos='';
         $('.vehicle_image').html('');
    });
</script>
@endsection
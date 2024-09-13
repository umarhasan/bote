@extends('layouts.app')

@section('content')
<div class="page-wrapper pb-5">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.booking_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item"><a href="{!! route('rides') !!}">{{trans('lang.booking_plural')}}</a>
                </li>

                <li class="breadcrumb-item">{{trans('lang.booking_show')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-body p-0 no_data_found">
            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                {{trans('lang.processing')}}
            </div>

            <div class="col-md-12">
                <div class="print-top non-printable mt-3">
                    <div class="text-right print-btn non-printable">
                        <button type="button" class="fa fa-print non-printable"
                            onclick="printDiv('printableArea')"></button>
                    </div>
                </div>

                <hr class="non-printable">
            </div>

            <div class="row restaurant_payout_create" style="max-width:100%;" role="tabpanel" id="printableArea">

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="category_information">
                        <div class="order_detail" id="order_detail">

                            <div class="order_detail-top mb-3 printableArea">
                                <div class="row">


                                    <div class="order_edit-genrl col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-white">
                                                <h3>{{trans('lang.general_details')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="order_detail-top-box">
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.booking_id')}}
                                                                : </strong><span id="booking_id"></span></label>

                                                    </div>

                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.date_created')}}
                                                                : </strong><span id="createdAt"></span></label>

                                                    </div>

                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.departure_date_time')}}
                                                                : </strong><span id="departure_date"></span></label>

                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col booked_seats">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.total_seats')}}
                                                                : </strong><span id="total_seats"></span></label>

                                                    </div>

                                                    <div class="form-group row widt-100 gendetail-col booked_seats">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.booked_seats')}}
                                                                : </strong><span id="booked_seats"></span></label>

                                                    </div>


                                                    <div class="form-group row widt-100 gendetail-col total_amount">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.total_amount')}}
                                                                : </strong><span id="total_amount"></span></label>

                                                    </div>

                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.booking_status')}}
                                                                :</strong> <span id="order_status"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.distance')}}
                                                                :</strong> <span id="distance"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.time')}}
                                                                :</strong> <span id="distance_time"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.women_only')}}
                                                                :</strong> <span id="women_only"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.two_passenger_max_in_back')}}
                                                                :</strong> <span
                                                                id="two_passenger_max_in_back"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.lauggage_allowed')}}
                                                                :</strong> <span id="lauggage_allowed"></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class=" order_edit-genrl col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-white">
                                                <h3>{{ trans('lang.publisher_detail')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="address order_detail-top-box user-details">
                                                    <p><strong>{{trans('lang.name')}}: </strong><span
                                                            id="publisher_name" class="d-flex"></span></p>

                                                    <p><strong>{{trans('lang.email')}}:</strong>
                                                        <span id="publisher_email"></span>
                                                    </p>
                                                    <p><strong>{{trans('lang.phone')}}:</strong>
                                                        <span id="publisher_phone"></span>
                                                    </p>

                                                    <p><strong>{{trans('lang.vehicles_name')}}:</strong>
                                                        <span id="vehicle_name"></span>
                                                    </p>
                                                    <p><strong>{{trans('lang.vehicle_number')}}:</strong>
                                                        <span id="vehicle_number"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row ride-map-dredetail">
                                <div class="col-md-7" id="ride-map-dredetail">
                                    <div class="card">
                                        <div class="box card-body p-0">
                                            <div class="box-header bb-2 card-header bg-white">
                                                <h3 class="box-title">{{trans('lang.map_view')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div id="map" style="height:300px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="card">
                                        <div class="box card-body p-0">
                                            <div class="box-header bb-2 card-header bg-white">
                                                <h3 class="box-title">{{trans('lang.location_details')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="live-tracking-list">
                                                    <div class="live-tracking-box track-from">


                                                        <div class="live-tracking-inner">
                                                            <div class="location-ride">




                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div class="row ride-loct-pricedet printableArea">
                                <div class="col-md-7">
                                    <div class="card">

                                        <div class="box-header bb-2 card-header bg-white">
                                            <h3 class="box-title">{{trans('lang.booked_user')}}</h3>
                                        </div>
                                        <div class="card-body">

                                            <div id="booked_user">

                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="box-header bb-2 card-header bg-white">
                                            <h3 class="box-title">{{trans('lang.travel_prefrences')}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="order_detail-top-box">
                                                <div class="travel_prefrence">

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
                <a href="{!! route('rides') !!}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}
                </a>

            </div>

        </div>


    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

    var database = firebase.firestore();

    var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
    var count = 0;

    var decimal_degits = 0;
    var symbolAtRight = false;
    var currentCurrency = '';
    var placeholderImage = "{{ asset('/images/default_user.png') }}";
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        decimal_degits = currencyData.decimalDigits;

        if (currencyData.symbolAtRight) {
            symbolAtRight = true;
        }
    });
    var refGlobalSetting = database.collection('settings').doc('globalKey');
    var distanceType = 'km';
    refGlobalSetting.get().then(function (globalData) {

        var globalValue = globalData.data();
        if (globalValue && globalValue.hasOwnProperty('distanceType')) {
            distanceType = globalValue.distanceType;
        }
    });

    var refData = database.collection('booking').where('id', '==', '{{$id}}');


    $(document).ready(async function () {

        $('.ride_sub_menu li').each(function () {
            var url = $(this).find('a').attr('href');
            if (url == document.referrer) {
                $(this).find('a').addClass('active');
                $('.ride_menu').addClass('active').attr('aria-expanded', true);
            }
            $('.ride_sub_menu').addClass('in').attr('aria-expanded', true);
        });
        getRideDeatils();


    });

    async function getRideDeatils() {
        jQuery("#overlay").show();

        await refData.get().then(async function (snapshots) {

            if (snapshots.docs[0]) {
                var orders = snapshots.docs[0].data();

                getBookedUserList(orders);
                var publisherId = orders.createdBy;
                if (orders.createdAt) {
                    var date1 = orders.createdAt.toDate().toDateString();
                    var date = new Date(date1);
                    var dd = String(date.getDate()).padStart(2, '0');
                    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = date.getFullYear();
                    var createdAt_val = yyyy + '-' + mm + '-' + dd;
                    var time = orders.createdAt.toDate().toLocaleTimeString('en-US');

                    $('#createdAt').text(createdAt_val + ' ' + time);
                }
                if (orders.departureDateTime) {
                    var date1 = orders.departureDateTime.toDate().toDateString();
                    var date = new Date(date1);
                    var dd = String(date.getDate()).padStart(2, '0');
                    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = date.getFullYear();
                    var createdAt_val = yyyy + '-' + mm + '-' + dd;
                    var time = orders.departureDateTime.toDate().toLocaleTimeString('en-US');

                    $('#departure_date').text(createdAt_val + ' ' + time);
                }

                $('#booking_id').html(orders.id);


                if (orders.status == "placed") {
                    status = 'Placed';
                    $('#order_status').html('<span class="badge badge-primary py-2 px-3">' + status + '</span>');
                } else if (orders.status == "completed") {
                    status = 'Completed';
                    $('#order_status').html('<span class="badge badge-success py-2 px-3">' + status + '</span>');
                } else if (orders.status == "onGoing") {
                    status = 'On Going';
                    $('#order_status').html('<span class="badge badge-warning py-2 px-3">' + status + '</span>');
                } else if (orders.status == "canceled") {
                    status = 'Cancelled';
                    $('#order_status').html('<span class="badge badge-danger py-2 px-3">' + status + '</span>');
                }
                if (distanceType == 'km') {
                    var distance = Math.round(parseFloat(orders.distance) / 1000);
                    $('#distance').html(parseFloat(distance) + ' ' + distanceType);
                } else {
                    var distance = Math.round(parseFloat(orders.distance) / 1609.34);
                    $('#distance').html(parseFloat(distance) + ' ' + distanceType);
                }

                $('#distance_time').html(orders.estimatedTime);
                var brand = orders.vehicleInformation.vehicleBrand.name;
                var model = orders.vehicleInformation.vehicleModel.name;
                $('#vehicle_name').html(brand + ' ' + model);
                $('#vehicle_number').html(orders.vehicleInformation.licensePlatNumber);
                var user_info = getUserInfo(publisherId);
                var travelPrefHtml = '';
                if (orders.hasOwnProperty('travelPreference') && orders.travelPreference.chattiness != '' && orders.travelPreference.chattiness != null) {
                    if (orders.travelPreference.chattiness == "I’m the quite type") {
                        var icon = "fa fa-minus-circle";
                    } else {
                        var icon = 'mdi mdi-check-circle'
                    }
                    travelPrefHtml += '<p><i class="' + icon + ' mr-2"></i>' + orders.travelPreference.chattiness + '</p>';

                }
                if (orders.hasOwnProperty('travelPreference') && orders.travelPreference.music != '' && orders.travelPreference.music != null) {
                    if (orders.travelPreference.music == "Silence is golden") {
                        var icon = "fa fa-volume-off"
                    } else {
                        var icon = 'fa fa-volume-up';
                    }
                    travelPrefHtml += '<p><i class="' + icon + ' mr-2"></i>' + orders.travelPreference.music + '</p>';

                }
                if (orders.hasOwnProperty('travelPreference') && orders.travelPreference.pets != '' && orders.travelPreference.pets != null) {
                    if (orders.travelPreference.pets == "I’d prefer not to travel with pet") {
                        var icon = 'fa fa-ban';
                    } else {
                        var icon = 'fa fa-paw'
                    }
                    travelPrefHtml += '<p><i class="' + icon + ' mr-2"></i>' + orders.travelPreference.pets + '</p>';
                }
                if (orders.hasOwnProperty('travelPreference') && orders.travelPreference.smoking != '' && orders.travelPreference.smoking != null) {
                    if (orders.travelPreference.smoking == "No smoking, Please") {
                        var icon = 'mdi mdi-smoking-off';
                    }
                    else {
                        var icon = 'mdi mdi-smoking';
                    }
                    travelPrefHtml += '<p><i class="' + icon + ' mr-2"></i>' + orders.travelPreference.smoking + '</p>';
                }

                if (travelPrefHtml != '') {

                    $('.travel_prefrence').html(travelPrefHtml);
                } else {
                    $('.travel_prefrence').html("{{trans('lang.no_prefrence_found')}}");
                }
                if (orders.bookedSeat != null && orders.bookedSeat != '') {
                    $('#booked_seats').html(orders.bookedSeat);
                } else {
                    $('#booked_seats').html(0);
                }
                $('#total_seats').html(orders.totalSeat);
               
                if (orders.hasOwnProperty('womenOnly')) {
                    $('#women_only').html((orders.womenOnly == true) ? '{{trans("lang.yes")}}' : '{{trans("lang.no")}}');
                }
                if (orders.hasOwnProperty('twoPassengerMaxInBack')) {
                    $('#two_passenger_max_in_back').html((orders.twoPassengerMaxInBack == true) ? '{{trans("lang.yes")}}' : '{{trans("lang.no")}}');
                }
                if (orders.hasOwnProperty('luggageAllowed') && orders.luggageAllowed!='' && orders.luggageAllowed != null) {
                    $('#lauggage_allowed').html(orders.luggageAllowed);
                }

                if (symbolAtRight) {
                    var amount = parseFloat(orders.pricePerSeat).toFixed(decimal_degits) + currentCurrency;
                    $('#total_amount').html(amount);

                } else {
                    var amount = currentCurrency + parseFloat(orders.pricePerSeat).toFixed(decimal_degits);
                    $('#total_amount').html(amount);
                }
                var order_details = getOrderDetails(orders);


            } else {
                $('.no_data_found').html('<p align="center">{{trans("lang.no_data_found")}}</p>');
            }

        });

        jQuery("#overlay").hide();

    }



    async function getBookedUserList(orders) {

        database.collection('booking/' + orders.id + '/bookedUser').get().then(async function (snapshot) {

            var bookedUserHTML = '';

            bookedUserHTML = await buildbookedUserHTML(orders, snapshot);

            if (bookedUserHTML != '') {
                jQuery("#booked_user").html(bookedUserHTML);
            } else {
                jQuery("#booked_user").html('<h5 class="no-review">{{trans("lang.booking_not_found")}}</h5>');
            }

        });
    }


    async function getBookedUserInfo(userId, subTotal = '') {

        var profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="Image"></span>';

        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {

            if (snapshots.docs.length > 0) {

                var user = snapshots.docs[0].data();
                var rating = 0;
                var reviewCount = 0;

                if (user.hasOwnProperty('reviewCount') && user.reviewCount && user.reviewCount != "0.0" && user.reviewCount != null && user.hasOwnProperty('reviewSum') && user.reviewSum && user.reviewSum != "0.0" && user.reviewSum != null) {

                    rating = (parseFloat(user.reviewSum) / parseFloat(user.reviewCount));

                    rating = (rating * 10) / 10;

                    reviewCount = parseInt(user.reviewCount);
                }


                var html = '';

                html += '<div class="applied_drivers_list mt-3">';

                html += ' <div class="d-flex"><div class="d-flex align-items-center driver_apply-left">';

                if (user.profilePic != '' && user.profilePic != null) {
                    profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + user.profilePic + '" alt="Image"></span>';
                }
                var route = "{{route('users.view', ':id')}}";
                route = route.replace(':id', userId);
                html += profile + '<div class="booked_user_cont"><h4><a href="' + route + '">' + user.firstName + ' ' + user.lastName + '</a></h4>';
                html += '<span class="badge badge-warning text-white dr-review"><i class="fa fa-star"></i>' + (rating).toFixed(1) + '</span>';

                html += '</div></div><div class="ml-auto"><span class="driver-rate ">' + subTotal + '</span>';
                var route1 = '{{route("ride.user.detail", [":rideId", ":userId"])}}';
                route1 = route1.replace(':rideId', "{{$id}}");
                route1 = route1.replace(':userId', userId);
                html += '<a href="' + route1 + '" class="btn btn-sm btn-primary">{{trans("lang.view_details")}}</a>';

                html += '</div></div>';

                $('.booked_user_div_' + userId).html(html);


            } else {
                $('.booked_user_div_' + userId).html('<div class="applied_drivers_list mt-3"><div class="d-flex"><div class="d-flex align-items-center driver_apply-left"><div class="applied_drivers_cont"><h4>{{trans("lang.unknown_user")}}</h4></div></div></div></div>');


            }



        });
    }

    async function getUserInfo(userId) {

        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                var user = snapshots.docs[0].data();
                if (user.profilePic != '' && user.profilePic != null) {
                    profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + user.profilePic + '" alt="Image"></span>';
                } else {
                    profile = '<span class="user-img"><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="Image"></span>';
                }

                var rating = 0;
                var reviewCount = 0;
                if (user.hasOwnProperty('reviewCount') && user.reviewCount && user.reviewCount != "0.0" && user.reviewCount != null && user.hasOwnProperty('reviewSum') && user.reviewSum && user.reviewSum != "0.0" && user.reviewSum != null) {

                    rating = (parseFloat(user.reviewSum) / parseFloat(user.reviewCount));

                    rating = (rating * 10) / 10;

                    reviewCount = parseInt(user.reviewCount);
                }
                var route = "{{route('users.view', ':id')}}";
                route = route.replace(':id', userId);
                var ratingHtml = '<span class="badge badge-warning text-white ml-auto" ><i class="fa fa-star" ></i>' + (rating).toFixed(1) + '</span>';

                var userHtml = '<div class="drove-det"><a href="' + route + '"><span class="drv-name">' + user.firstName + ' ' + user.lastName + '</span></a>' + ratingHtml + '</div>';
                $('#publisher_name').html(profile + userHtml);
                $('#publisher_email').html(user.email);
                $('#publisher_phone').html(user.countryCode + '-' + user.phoneNumber);
            } else {
                $(".user-details").html('<p>{{trans("lang.unknown_user")}}</p>');
            }

        });
    }

    async function getOrderDetails(orderData) {

        await Promise.all(orderData.stopOverList.map(async (element) => {
            var startAdrs = element.start_address;
            $('.location-ride').append('<div class="from-ride">' + startAdrs + '</div>');
        }));
        $('.location-ride').append('<div class="to-ride">' + orderData.dropAddress + '</div>');
        setTimeout(function () {
            setMap(orderData);
        }, 3000);

    }

    function setMap(orders) {

        var map;
        var marker;

        var myLatlng = new google.maps.LatLng(orders.dropLocation.geometry.location.lat, orders.dropLocation.geometry.location.lng);
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        var mapOptions = {
            zoom: 10,
            center: myLatlng,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("map"), mapOptions);

        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true
        });

        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(orders.dropAddress);
            infowindow.open(map, marker);
        });

        let directionsService = new google.maps.DirectionsService();

        let directionsRenderer = new google.maps.DirectionsRenderer();

        directionsRenderer.setOptions({
            polylineOptions: {
                strokeColor: '#000000'
            }
        });

        directionsRenderer.setMap(map);

        const origin = { lat: orders.pickupLocation.geometry.location.lat, lng: orders.pickupLocation.geometry.location.lng };
        const destination = {
            lat: orders.dropLocation.geometry.location.lat,
            lng: orders.dropLocation.geometry.location.lng
        };

        const waypoints = orders.stopOver.map(function (waypoint) {
            return {
                location: new google.maps.LatLng(waypoint.geometry.location.lat, waypoint.geometry.location.lng),
                stopover: true
            };
        });

        const route = {
            origin: origin,
            destination: destination,
            waypoints: waypoints,
            travelMode: 'DRIVING'
        };

        directionsService.route(route, function (response, status) {
            if (status !== 'OK') {
                window.alert('Directions request failed due to ' + status);
                return;
            } else {
                directionsRenderer.setDirections(response);
                var directionsData = response.routes[0].legs[0];
            }
        });

    }


    async function buildbookedUserHTML(orders, snapshot) {
        var allUserDataArr = [];
        var userHtml = '';
        snapshot.docs.forEach((listval) => {
            var datas = listval.data();
            allUserDataArr.push(datas);
        });

        if (allUserDataArr.length > 0) {
            allUserDataArr.forEach(function (listval) {
                var val = listval;

                if (symbolAtRight) {
                    var subTotal = parseFloat(val.subTotal).toFixed(decimal_degits) + currentCurrency;

                } else {
                    var subTotal = currentCurrency + parseFloat(val.subTotal).toFixed(decimal_degits);

                }

                userHtml += '<div class="booked_user_div_' + val.id + '" ></div>';

                getBookedUserInfo(val.id, subTotal);

            });

        }

        return userHtml;


    }

    function printDiv(divName) {

        var css = '@page { size: portrait; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);

        document.getElementById('ride-map-dredetail').innerHTML = '';

        var printContents = document.getElementById(divName).innerHTML;

        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        document.getElementById('ride-map-dredetail').innerHTML = '<div class="card">\n' +
            '                                            <div class="box card-body p-0">\n' +
            '                                                <div class="box-header bb-2 card-header bg-white">\n' +
            '                                                    <h3 class="box-title">{{trans('lang.map_view')}}</h3>\n' +
            '                                                </div>\n' +
            '                                                <div class="card-body">\n' +
            '                                                    <div id="map" style="height:300px">\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </div>';
        getRideDeatils();

    }


</script>


@endsection
@extends('layouts.app')

@section('content')
<div class="page-wrapper pb-5">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"> {{trans('lang.ride_detail_of')}} <span id="user_name"></span></span></h3>
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

                                                    <div class="form-group row widt-100 gendetail-col payment_method">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.payment_status')}}
                                                                : </strong><span id="payment_status"></span></label>

                                                    </div>


                                                    <div class="form-group row widt-100 gendetail-col payment_method">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.payment_methods')}}
                                                                : </strong><span id="payment_method"></span></label>

                                                    </div>


                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.distance')}}
                                                                :</strong> <span id="distance"></span></label>
                                                    </div>
                                                    <div class="form-group row widt-100 gendetail-col">
                                                        <label class="col-12 control-label"><strong>{{trans('lang.time')}}
                                                                :</strong> <span id="distance_time"></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class=" order_edit-genrl col-md-6">
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
                                                                    <div class="from-ride"></div>
                                                                    <div class="to-ride"></div>


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


                            <div class="row ride-loct-pricedet printableArea">
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="order_addre-edit ">
                                            <div class="card-header bg-white">
                                                <h3>{{ trans('lang.price_detail')}}</h3>
                                            </div>
                                            <div class="card-body price_detail">
                                                <div class="order-deta-btm-right">
                                                    <div class="order-totals-items pt-0">
                                                        <div class="row">
                                                            <div class="col-md-12 ml-auto">
                                                                <div class="table-responsive bk-summary-table">
                                                                    <table class="order-totals">

                                                                        <tbody id="order_products_total">

                                                                        </tbody>
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
                                <div class="col-md-5 ml-auto non-printable">
                                    <div class="card">
                                        <div class="box-header bb-2 card-header bg-white">
                                            <h3>{{trans("lang.ride_reviews")}}</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="order_detail-review mt-0">

                                                <div class="rental-review">
                                                    <div class="review-inner">

                                                        <div id="customers_rating_and_review">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 text-center btm-btn">
                <a href="{!! url('rides/show/' . $rideId) !!}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.back')}}
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
    var rideId = "{{$rideId}}";
    var userId = "{{$userId}}";
    var refData = database.collection('booking/' + rideId + '/bookedUser/').where('id', '==', userId);


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
        getUserName(userId);

    });
    async function getUserName(userId) {
        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                var data = snapshots.docs[0].data();
                var fullName = data.firstName + ' ' + data.lastName;
                $('#user_name').html(fullName);
            }
        })
    }
    async function getRideDeatils() {
        jQuery("#overlay").show();

        await refData.get().then(async function (snapshots) {

            if (snapshots.docs[0]) {
                var orders = snapshots.docs[0].data();
                getCutomerReview(orders);

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
                $('#booking_id').html(rideId);
                var payStatus = '{{trans("lang.unpaid")}}';
                var badgeClass = 'badge-danger';
                if (orders.paymentStatus) {
                    badgeClass = 'badge-success';
                    payStatus = '{{trans("lang.paid")}}';
                }

                $('#payment_status').html('<span class="badge ' + badgeClass + ' py-2 px-3">' + payStatus + '</span>');

                if (orders.paymentType == "FlutterWave") {
                    $('#payment_method').html('<img src="{{ asset("/images/flutter_wave.png") }}">');
                } else if (orders.paymentType == "MercadoPago") {
                    $('#payment_method').html('<img src="{{ asset("/images/marcado_pago.png") }}">');
                } else if (orders.paymentType == "yappy") {
                    $('#payment_method').html('<img src="{{ asset("/images/yappy.png") }}">');
                } else if (orders.paymentType == "PayStack") {
                    $('#payment_method').html('<img src="{{ asset("/images/paystack.png") }}">');
                } else if (orders.paymentType == "PayFast") {
                    $('#payment_method').html('<img src="{{ asset("/images/payfast.png") }}">');
                } else if (orders.paymentType == "Paypal") {
                    $('#payment_method').html('<img src="{{ asset("/images/paypal.png") }}">');
                } else if (orders.paymentType == "RazorPay") {
                    $('#payment_method').html('<img src="{{ asset("/images/razorepay.png") }}">');
                } else if (orders.paymentType == "Stripe") {
                    $('#payment_method').html('<img src="{{ asset("/images/stripe.png") }}">');
                } else if (orders.paymentType == "Cash") {
                    $('#payment_method').html('<img src="{{ asset("/images/cash.png") }}">');
                } else if (orders.paymentType == "Wallet") {
                    $('#payment_method').html('<img src="{{ asset("/images/wallet.png") }}">');
                } else {
                    $('#payment_method').html('<span class="badge badge-info py-2 px-3">' + orders.paymentType + '</span>');
                }

                var distance = orders.stopOver.distance.value;
                if (distanceType == 'km') {
                    distance = Math.round(parseFloat(distance) / 1000);
                    $('#distance').html(parseInt(distance) + ' ' + distanceType);
                } else {
                    distance = Math.round(parseFloat(distance) / 1609.34);
                    $('#distance').html(parseInt(distance) + ' ' + distanceType);
                }

                $('#distance_time').html(orders.stopOver.duration.text);
                $('.from-ride').html(orders.stopOver.start_address);
                $('.to-ride').html(orders.stopOver.end_address);
                var order_details = getOrderDetails(orders);
            } else {
                $('.no_data_found').html('<p align="center">{{trans("lang.no_data_found")}}</p>');
            }

        });

        jQuery("#overlay").hide();

    }

    async function getCutomerReview(orders) {
        var refCustomerReview = database.collection('review').where('id', "==", rideId + '-' + userId);
        refCustomerReview.get().then(async function (userreviewsnapshot) {
            var reviewHTML = '';
            reviewHTML = buildCustomerRatingsHTML(orders, userreviewsnapshot);

            if (userreviewsnapshot.docs.length > 0) {
                jQuery("#customers_rating_and_review").append(reviewHTML);
            } else {
                jQuery("#customers_rating_and_review").html('<h5 class="no-review">No Reviews Found</h5>');
            }
        });
    }

    async function getCityName(lat, lon) {
        const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data && data.address && data.address.city) {
                return data.address.city;
            } else if (data && data.address && data.address.town) {
                return data.address.town;
            } else if (data && data.address && data.address.village) {
                return data.address.village;
            } else if (data && data.address && data.address.county) {
                return data.address.county;
            }
            else {
                return 'City not found';
            }
        } catch (error) {
            console.error('Error fetching data:', error);
            return 'Error fetching city name';
        }


    }
    async function getOrderDetails(orderData) {

        var order_amount_html = '';

        var amount = 0;
        if (orderData.subTotal) {
            amount = parseFloat(orderData.subTotal);
        }

        var total_amount = 0;
        order_amount_html += '<tr ><td class="label">{{trans("lang.total_seat_booked")}}</td><td>× ' + orderData.bookedSeat + '</td></tr>';

        order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.ride_price")}}</span></td></tr>';
        if (symbolAtRight) {
            order_amount_html += '<tr ><td class="label">{{trans("lang.price_for_one_seat")}}</td><td>' + parseFloat(orderData.stopOver.price).toFixed(decimal_degits) + currentCurrency + '</td></tr>';

        } else {
            order_amount_html += '<tr><td class="label">{{trans("lang.price_for_one_seat")}}</td><td>' + currentCurrency + parseFloat(orderData.stopOver.price).toFixed(decimal_degits) + '</td></tr>';

        }
        if (symbolAtRight) {
            order_amount_html += '<tr class="fina-rate" ><td class="label">{{trans("lang.sub_total")}}</td><td>' + amount.toFixed(decimal_degits) + currentCurrency + '</td></tr>';

        } else {
            order_amount_html += '<tr class="final-rate"><td class="label">{{trans("lang.sub_total")}}</td><td>' + currentCurrency + amount.toFixed(decimal_degits) + '</td></tr>';

        }

        total_amount = amount;

        if (orderData.hasOwnProperty('taxList') && orderData.taxList.length > 0) {
            order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.tax_calculation")}}</span></td></tr>';
            var taxData = orderData.taxList;
            order_amount_html += '';
            var tax_amount_total = parseFloat(0);
            for (var i = 0; i < taxData.length; i++) {

                var data = taxData[i];
                if (data.enable) {

                    var tax_html = '<tr><td class="label">' + data.title + '(';

                    var tax_amount = data.tax;

                    if (data.type == "percentage") {
                        tax_html += data.tax + '%';
                        tax_amount = (data.tax * total_amount) / 100;
                    } else {
                        if (symbolAtRight) {
                            tax_html += parseFloat(data.tax).toFixed(decimal_degits) + currentCurrency;

                        } else {
                            tax_html += currentCurrency + parseFloat(data.tax).toFixed(decimal_degits);

                        }
                    }

                    tax_amount = parseFloat(tax_amount).toFixed(decimal_degits);
                    tax_amount_total = parseFloat(tax_amount_total) + parseFloat(tax_amount);
                    tax_html += ')</td>';

                    if (symbolAtRight) {
                        tax_html += '<td>' + tax_amount + currentCurrency + '</td></tr>';

                    } else {
                        tax_html += '<td>' + currentCurrency + tax_amount + '</td></tr>';

                    }


                }

                order_amount_html += tax_html;
            }
            total_amount += parseFloat(tax_amount_total);

        }

        var payableAmount = total_amount;
        if (orderData.hasOwnProperty('adminCommission') && orderData.adminCommission.enable == true) {
            order_amount_html += '<tr><td class="seprater" colspan="2"><hr><span>{{trans("lang.commission")}}</span></td></tr>';
            var data = orderData.adminCommission;
            order_amount_html += '';

            var commission_html = '<tr><td class="label">{{trans("lang.admin_commission")}}(';

            if (data.type == "percentage") {
                commission_html += data.amount + '%';
                commission_amount = (parseFloat(data.amount) * parseFloat(orderData.subTotal)) / 100;
            } else {
                commission_amount = data.amount;
                if (symbolAtRight) {
                    commission_html += parseFloat(data.amount).toFixed(decimal_degits) + currentCurrency;

                } else {
                    commission_html += currentCurrency + parseFloat(data.amount).toFixed(decimal_degits);

                }
            }

            commission_amount = parseFloat(commission_amount).toFixed(decimal_degits);

            commission_html += ')</td>';
            if (symbolAtRight) {
                commission_html += '<td ><span style="color:red">(-' + commission_amount + currentCurrency + ')</span></td>';

            } else {
                commission_html += '<td ><span style="color:red">(-' + currentCurrency + commission_amount + ')</span></td>';
            }

            commission_html += '</tr>';

            order_amount_html += commission_html;

            if (commission_amount) {
                total_amount = total_amount - commission_amount;

            }

        }
        order_amount_html += '<tr><td class="seprater" colspan="2"><hr></td></tr>';
        total_amount = total_amount.toFixed(decimal_degits);
        payableAmount = payableAmount.toFixed(decimal_degits);

        if (symbolAtRight) {
            total_amount = total_amount + currentCurrency;
            payableAmount = payableAmount + currentCurrency;
        } else {
            total_amount = currentCurrency + total_amount;
            payableAmount = currentCurrency + payableAmount;
        }
        order_amount_html += '<tr class="grand-total"><td class="label"><strong>{{trans("lang.payable_amount")}}</strong></td><td><strong>' + payableAmount + '</strong></td></tr>';
        if (orderData.hasOwnProperty('adminCommission') && orderData.adminCommission.enable == true) {
            order_amount_html += '<tr><td class="label"><strong>{{trans("lang.total")}}</strong><span> ({{trans("lang.after_admin_commission")}}) </span></td><td><strong>' + total_amount + '</strong></td></tr>';
        }

        $('#order_products_total').html(order_amount_html);

    }


    function setMap(orders) {

        var map;
        var marker;

        var myLatlng = new google.maps.LatLng(orders.destinationLocationLAtLng.latitude, orders.destinationLocationLAtLng.longitude);
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
            infowindow.setContent(orders.destinationLocationName);
            infowindow.open(map, marker);
        });

        //Set direction route
        let directionsService = new google.maps.DirectionsService();

        let directionsRenderer = new google.maps.DirectionsRenderer();

        directionsRenderer.setOptions({
            polylineOptions: {
                strokeColor: '#000000'
            }
        });

        directionsRenderer.setMap(map);

        const origin = { lat: orders.sourceLocationLAtLng.latitude, lng: orders.sourceLocationLAtLng.longitude };
        const destination = {
            lat: orders.destinationLocationLAtLng.latitude,
            lng: orders.destinationLocationLAtLng.longitude
        };

        const route = {
            origin: origin,
            destination: destination,
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

    function buildCustomerRatingsHTML(vendorOrder, userreviewsnapshot) {
        var allreviewdata = [];
        var reviewhtml = '';

        userreviewsnapshot.docs.forEach((listval) => {
            var reviewDatas = listval.data();
            allreviewdata.push(reviewDatas);
        });

        reviewhtml += '<div class="user-ratings">';
        allreviewdata.forEach((listval) => {
            var val = listval;

            rating = val.rating;
            reviewhtml = reviewhtml + '<div class="reviews-members py-3 border mb-3"><div class="media">';
            reviewhtml = reviewhtml + '<div class="media-body d-flex"><div class="reviews-members-header"><div class="star-rating"><div class="d-inline-block" style="font-size: 14px;">';
            reviewhtml = reviewhtml + ' <ul class="rating" data-rating="' + parseFloat(rating) + '">';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '<li class="rating__item"></li>';
            reviewhtml = reviewhtml + '</ul>';
            reviewhtml = reviewhtml + '</div></div>';
            reviewhtml = reviewhtml + '</div>';
            reviewhtml = reviewhtml + '<div class="review-date ml-auto">';
            if (val.date != null && val.date != "") {
                var review_date = val.date.toDate().toLocaleDateString('en', {
                    year: "numeric",
                    month: "short",
                    day: "numeric"
                });
                reviewhtml = reviewhtml + '<span>' + review_date + '</span>';
            }
            reviewhtml = reviewhtml + '</div>';


            reviewhtml = reviewhtml + '</div></div><div class="reviews-members-body w-100"><p class="mb-2">' + val.comment + '</div>';
            reviewhtml += '</div>';

            reviewhtml += '</div>';
        });


        reviewhtml += '</div>';

        return reviewhtml;
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

        var printContents = document.getElementById(divName).innerHTML;

        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        getRideDeatils();

    }


</script>


@endsection
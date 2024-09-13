@extends('layouts.app')
@section('content')
<div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">

    <div class="container-fluid">


        <div class="card mb-3 business-analytics">

            <div class="card-body">

                <div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
                    <div class="col-sm-6">
                        <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                            {{ trans('lang.dashboard_today_trip') }}
                        </h4>
                    </div>
                </div>

                <div class="row business-analytics_list">

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_total_orders') }}</h5>
                            <h2 id="total_rides_today"></h2>
                            <i class="mdi mdi-map-marker-multiple"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('users.index') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_total_clients') }}</h5>
                            <h2 id="users_count_today"></h2>
                            <i class="mdi mdi-account-multiple"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('users.pending') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.pending_users') }}</h5>
                            <h2 id="pending_user_count_today"></h2>
                            <i class="mdi mdi-account-multiple"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('users.approve') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.approved_users') }}</h5>
                            <h2 id="approve_user_count_today"></h2>
                            <i class="mdi mdi-account-multiple"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('walletTransaction.user') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_total_earnings') }}</h5>
                            <h2 id="earnings_count_today"></h2>
                            <i class="mdi mdi-cash-usd"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('walletTransaction.user') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_admin_commission') }}</h5>
                            <h2 id="admincommission_count_today"></h2>
                            <i class="ti-wallet"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 mb-3">

                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_ride_placed') }}</h5>
                            <h2 id="placed_count_today"></h2>
                            <i class="mdi mdi-check-circle"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_ride_active') }}</h5>
                            <h2 id="active_count_today"></h2>
                            <i class="mdi mdi-car-connected"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_ride_completed') }}</h5>
                            <h2 id="completed_count_today"></h2>
                            <i class="mdi mdi-check-circle-outline"></i>
                        </div>
                    </div>

                   

                </div>

            </div>

        </div>

        <div class="card mb-3 business-analytics">

            <div class="card-body">

                <div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
                    <div class="col-sm-6">
                        <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
                            {{ trans('lang.dashboard_total_trip') }}
                        </h4>
                    </div>
                </div>

                <div class="row business-analytics_list">

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_total_orders') }}</h5>
                            <h2 id="total_rides"></h2>
                            <i class="mdi mdi-map-marker-multiple"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('users.index') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_total_clients') }}</h5>
                            <h2 id="users_count"></h2>
                            <i class="mdi mdi-account-multiple"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('users.pending') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.pending_users') }}</h5>
                            <h2 id="total_pending_user_count"></h2>
                            <i class="mdi mdi-account-multiple"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('users.approve') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.approved_users') }}</h5>
                            <h2 id="total_approve_user_count"></h2>
                            <i class="mdi mdi-account-multiple"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('walletTransaction.user') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_total_earnings') }}</h5>
                            <h2 id="earnings_count"></h2>
                            <i class="mdi mdi-cash-usd"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 mb-3" onclick="location.href='{!! route('walletTransaction.user') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_admin_commission') }}</h5>
                            <h2 id="admincommission_count"></h2>
                            <i class="ti-wallet"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 mb-3">

                    </div>


                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_ride_placed') }}</h5>
                            <h2 id="placed_count"></h2>
                            <i class="mdi mdi-check-circle"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_ride_active') }}</h5>
                            <h2 id="active_count"></h2>
                            <i class="mdi mdi-car-connected"></i>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3 mb-3" onclick="location.href='{!! route('rides') !!}'">
                        <div class="card-box">
                            <h5>{{ trans('lang.dashboard_ride_completed') }}</h5>
                            <h2 id="completed_count"></h2>
                            <i class="mdi mdi-check-circle-outline"></i>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{ trans('lang.dashboard_total_sales') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2"> <i class="fa fa-square" style="color:#80b140"></i>
                                {{ trans('lang.dashboard_this_year') }} </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{ trans('lang.dashboard_service_overview') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="flex-row">
                            <canvas id="service-overview" height="222"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{ trans('lang.dashboard_sales_overview') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="flex-row">
                            <canvas id="sales-overview" height="222"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row daes-sec-sec">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border d-flex justify-content-between">
                        <h3 class="card-title">{{ trans('lang.dashboard_recent_rides') }}</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th style="text-align:center">{{ trans('lang.order_id') }}</th>
                                    <th>{{ trans('lang.dashboard_user') }}</th>
                                    <th>{{ trans('lang.location_details') }}</th>
                                </tr>
                            </thead>
                            <tbody id="append_list_recent_rides">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border d-flex justify-content-between">
                        <h3 class="card-title">{{ trans('lang.dashboard_recent_users') }}</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th style="text-align:center">{{ trans('lang.image') }}</th>
                                    <th>{{ trans('lang.name') }}</th>
                                    <th>{{trans('lang.email')}}</th>
                                    <th>{{ trans('lang.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id="append_list_recent_users">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/chart.js') }}"></script>


<script type="text/javascript">
    jQuery("#overlay").show();

    var database = firebase.firestore();
    var defaultImg = "{{ asset('/images/default_user.png') }}";

    var currency = database.collection('settings');
    const todayDate = new Date();
    todayDate.setHours(0, 0, 0, 0);
    var rides_data = [];
    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;
    var refCurrency = database.collection('currency').where('enable', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
        if (currencyData.decimalDigits) {
            decimal_degits = currencyData.decimalDigits;
        }
    });
    $(document).ready(function () {


        //today records
        database.collection('booking').where('createdAt', '>', todayDate).get().then((snapshot) => {

            jQuery("#total_rides_today").empty();
            jQuery("#total_rides_today").text(snapshot.docs.length);
        });

        database.collection('booking').where('status', '==', 'placed').where('createdAt', '>', todayDate)
            .get().then((snapshot) => {
                jQuery("#placed_count_today").empty();
                jQuery("#placed_count_today").text(snapshot.docs.length);
            });



        database.collection('booking').where('status', '==', 'onGoing').where('createdAt', '>', todayDate)
            .get().then((snapshot) => {
                jQuery("#active_count_today").empty();
                jQuery("#active_count_today").text(snapshot.docs.length);
            });



        database.collection('booking').where('status', '==', 'completed').where('createdAt', '>',
            todayDate).get().then((snapshot) => {
                jQuery("#completed_count_today").empty();
                jQuery("#completed_count_today").text(snapshot.docs.length);
            });

        database.collection('users').where('createdAt', '>', todayDate).get().then((snapshot) => {
            jQuery("#users_count_today").empty();
            jQuery("#users_count_today").text(snapshot.docs.length);
        });

        database.collection('users').where('createdAt', '>', todayDate).get().then((snapshot) => {
            var pendingUser = snapshot.docs.filter(doc => doc.data().isVerify !== true).length;
            jQuery("#pending_user_count_today").empty();
            jQuery("#pending_user_count_today").text(pendingUser);
        });
        database.collection('users').where('createdAt', '>', todayDate).where('isVerify', '==', true).get().then((snapshot) => {
            jQuery("#approve_user_count_today").empty();
            jQuery("#approve_user_count_today").text(snapshot.docs.length);
        });

        //todal records
        database.collection('booking').get().then((snapshot) => {
            jQuery("#total_rides").empty();
            jQuery("#total_rides").text(snapshot.docs.length);
        });


        database.collection('users').get().then((snapshot) => {
            jQuery("#users_count").empty();
            jQuery("#users_count").text(snapshot.docs.length);
        });
        database.collection('users').where('isVerify', '==', true).get().then((snapshot) => {
            jQuery("#total_approve_user_count").empty();
            jQuery("#total_approve_user_count").text(snapshot.docs.length);
        });
        database.collection('users').get().then((snapshot) => {
            var pendingUser = snapshot.docs.filter(doc => doc.data().isVerify !== true).length;
            jQuery("#total_pending_user_count").empty();
            jQuery("#total_pending_user_count").text(pendingUser);
        });


        database.collection('booking').where('status', '==', 'placed').get().then((snapshot) => {
            jQuery("#placed_count").empty();
            jQuery("#placed_count").text(snapshot.docs.length);
        });

        database.collection('booking').where('status', '==', 'onGoing').get().then((snapshot) => {
            jQuery("#active_count").empty();
            jQuery("#active_count").text(snapshot.docs.length);
        });


        database.collection('booking').where('status', '==', 'completed').get().then((snapshot) => {
            jQuery("#completed_count").empty();
            jQuery("#completed_count").text(snapshot.docs.length);
        });


  


        getTotalEarnings();
        getTotalEarningsToday();


        var offest = 1;
        var pagesize = 5;
        var limit = parseInt(offest) * parseInt(pagesize);
        var append_list_recent_rides = document.getElementById('append_list_recent_rides');
        append_list_recent_rides.innerHTML = '';

        database.collection('booking').orderBy('createdAt', 'desc').where('status', 'in', ["placed", "onGoing"]).limit(limit).get().then((snapshots) => {
            html = '';
            html = buildRidesHTML(snapshots);
            if (html != '') {
                append_list_recent_rides.innerHTML = html;
            }
        });
        var append_list_recent_users = document.getElementById('append_list_recent_users');
        append_list_recent_users.innerHTML = '';
        database.collection('users').orderBy('createdAt', 'desc').limit(limit).get().then((snapshots) => {
            html = '';
            html = buildUsersHTML(snapshots);
            if (html != '') {
                append_list_recent_users.innerHTML = html;
            }
        });

    });

    function buildRidesHTML(snapshots) {
        var html = '';
        snapshots.docs.forEach((listval) => {
            val = listval.data();
            val.id = listval.id;
            var ride_id = val.id.substring(0, 7);

            var ride_route = '<?php echo route('rides.show', ':id'); ?>';
            ride_route = ride_route.replace(':id', val.id);

            html = html + '<tr>';

            html = html + '<td><a href="' + ride_route + '">' + ride_id + '</a></td>';
            if (val.createdBy != null) {
                getUserName(val.createdBy, ride_id);
            }
            html = html + '<td class="user_name_' + ride_id + '"></td>';


            html = html + '<td>';
            html = html + '<div class="live-tracking-list">';
            html = html + '<div class="live-tracking-box track-from">';
            html = html + '<div class="live-tracking-inner">';
            html = html + '<div class="location-ride">';
            html = html + '<div class="from-ride">' + val.pickUpAddress + '</div>';
            html = html + '<div class="to-ride">' + val.dropAddress + '</div>';
            html = html + '</div>';
            html = html + '</div>';
            html = html + '</div>';
            html = html + '</div>';
            html = html + '</td>';
            html = html + '</tr>';
        });
        return html;
    }
    function buildUsersHTML(snapshots) {
        var html = '';
        snapshots.docs.forEach((listval) => {
            val = listval.data();
            val.id = listval.id;

            var user_id = val.id.substring(0, 7);

            var user_route = '<?php echo route('users.view', ':id'); ?>';
            user_route = user_route.replace(':id', val.id);

            html = html + '<tr>';
            if (val.profilePic == '' || val.profilePic == null) {

                html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.profilePic + '" alt="image"></td>';
            }
            html = html + '<td><a href="' + user_route + '">' + val.firstName + ' ' + val.lastName + '</a></td>';

            html = html + '<td>' + val.email + '</td>';

            html = html + '<td class="action-btn"><a href="' + user_route + '"><i class="fa fa-eye"></i></a>';

            html = html + '</tr>';
        });
        return html;
    }

    async function getUserName(userId, id) {
        await database.collection('users').where('id','==',userId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                var user = snapshots.docs[0].data();
                var customer_view = '{{ route('users.view', ':id') }}';
                customer_view = customer_view.replace(':id', userId);
                $('.user_name_' + id).html('<a href="' + customer_view + '">' + user.firstName + ' ' + user.lastName + '</a>');
            }
        });
    }


    async function getTotalEarnings() {
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
        var v01 = 0;
        var v02 = 0;
        var v03 = 0;
        var v04 = 0;
        var v05 = 0;
        var v06 = 0;
        var v07 = 0;
        var v08 = 0;
        var v09 = 0;
        var v10 = 0;
        var v11 = 0;
        var v12 = 0;
        var currentYear = new Date().getFullYear();

        await database.collection('booking').where('status', 'in', ["completed"]).get().then(async function (
            orderSnapshots) {

            var paymentData = orderSnapshots.docs;
            var totalEarning = 0;
            var adminCommission = 0;

            await Promise.all(paymentData.map(async (order) => {

                var orderData = order.data();
                var bookedUserRef = database.collection('booking/' + orderData.id + '/bookedUser');
                var snapshot = await bookedUserRef.get();

                await Promise.all(snapshot.docs.map(async (element) => {
                    var bookedOrderData = element.data();
                    if (bookedOrderData.paymentStatus == true) {
                        var price = 0;

                        price = bookedOrderData.subTotal;
                        var adminCommissionPrice = price;
                        tax = 0;
                        if (bookedOrderData.taxList != undefined && $.isArray(bookedOrderData.taxList)) {
                            for (let i = 0; i < bookedOrderData.taxList.length; i++) {
                                let taxData = bookedOrderData.taxList[i];
                                if (taxData.type == "percentage") {
                                    tax = tax + (parseFloat(taxData.tax) * price) / 100;
                                } else {
                                    tax = tax + parseFloat(taxData.tax);
                                }
                            }
                        }

                        if (!isNaN(tax)) {
                            price = parseFloat(price) + parseFloat(tax);
                        }

                        if (bookedOrderData.adminCommission != undefined &&  bookedOrderData.adminCommission.enable!=false && bookedOrderData.adminCommission.type !=undefined && bookedOrderData.adminCommission.amount > 0 && price > 0) {
                            var commission = 0;
                            if (bookedOrderData.adminCommission.type == "percentage") {
                                commission = (adminCommissionPrice * parseFloat(bookedOrderData.adminCommission.amount)) / 100;
                            } else {
                                commission = parseFloat(bookedOrderData.adminCommission.amount);
                            }
                            adminCommission = commission + adminCommission;
                        }
                        totalEarning = parseFloat(totalEarning) + parseFloat(price);
                        if (orderData.createdAt) {
                            var orderMonth = orderData.createdAt.toDate().getMonth() + 1;
                            var orderYear = orderData.createdAt.toDate().getFullYear();
                            if (currentYear == orderYear) {
                                switch (parseInt(orderMonth)) {
                                    case 1:
                                        v01 = parseFloat(v01) + parseFloat(price);
                                        break;
                                    case 2:
                                        v02 = parseFloat(v02) + parseFloat(price);
                                        break;
                                    case 3:
                                        v03 = parseFloat(v03) + parseFloat(price);
                                        break;
                                    case 4:
                                        v04 = parseFloat(v04) + parseFloat(price);
                                        break;
                                    case 5:
                                        v05 = parseFloat(v05) + parseFloat(price);
                                        break;
                                    case 6:
                                        v06 = parseFloat(v06) + parseFloat(price);
                                        break;
                                    case 7:
                                        v07 = parseFloat(v07) + parseFloat(price);
                                        break;
                                    case 8:
                                        v08 = parseFloat(v08) + parseFloat(price);
                                        break;
                                    case 9:
                                        v09 = parseFloat(v09) + parseFloat(price);
                                        break;
                                    case 10:
                                        v10 = parseFloat(v10) + parseFloat(price);
                                        break;
                                    case 11:
                                        v11 = parseFloat(v11) + parseFloat(price);
                                        break;
                                    default:
                                        v12 = parseFloat(v12) + parseFloat(price);
                                        break;
                                }
                            }
                        }
                    }
                }));


            }));

            if (currencyAtRight) {
                totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" +
                    currentCurrency;
            } else {
                totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(
                    decimal_degits);
            }

            $("#earnings_count").append(totalEarning);
            $("#admincommission_count").append(adminCommission);

            rides_data = [v01, v02, v03, v04, v05, v06, v07, v08, v09, v10, v11, v12];
            var labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV',
                'DEC'
            ];
            var $salesChart = $('#sales-chart');

            salesChart($salesChart, rides_data, labels);
            serviceOverview();
            salesOverview();
            jQuery("#overlay").hide();
        });

    }

    async function getTotalEarningsToday() {
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
        var v01 = 0;
        var v02 = 0;
        var v03 = 0;
        var v04 = 0;
        var v05 = 0;
        var v06 = 0;
        var v07 = 0;
        var v08 = 0;
        var v09 = 0;
        var v10 = 0;
        var v11 = 0;
        var v12 = 0;
        var currentYear = new Date().getFullYear();

        await database.collection('booking').where('status', 'in', ["completed"]).where('createdAt', '>=', todayDate)
            .get().then(async function (orderSnapshots) {

                var paymentData = orderSnapshots.docs;

                var totalEarning = 0;
                var adminCommission = 0;
                await Promise.all(paymentData.map(async (order) => {

                    var orderData = order.data();
                    var bookedUserRef = database.collection('booking/' + orderData.id + '/bookedUser');
                    var snapshot = await bookedUserRef.get();
                    await Promise.all(snapshot.docs.map(async (element) => {
                        var bookedOrderData = element.data();
                        if (bookedOrderData.paymentStatus == true) {

                            var price = 0;

                            price = bookedOrderData.subTotal;
                            var adminCommissionPrice = price;
                            tax = 0;
                            if (bookedOrderData.taxList != undefined && $.isArray(bookedOrderData.taxList)) {
                                for (let i = 0; i < bookedOrderData.taxList.length; i++) {
                                    let taxData = bookedOrderData.taxList[i];
                                    if (taxData.type == "percentage") {
                                        tax = tax + (parseFloat(taxData.tax) * price) / 100;
                                    } else {
                                        tax = tax + parseFloat(taxData.tax);
                                    }
                                }
                            }

                            if (!isNaN(tax)) {
                                price = price + tax;
                            }
                            if (bookedOrderData.adminCommission != undefined && bookedOrderData.adminCommission.enable!=false && bookedOrderData.adminCommission.type !=undefined && bookedOrderData.adminCommission.amount > 0 && price > 0) {
                                var commission = 0;
                                if (bookedOrderData.adminCommission.type == "percentage") {
                                    commission = (adminCommissionPrice * parseFloat(bookedOrderData.adminCommission.amount)) / 100;
                                } else {
                                    commission = parseFloat(bookedOrderData.adminCommission.amount);
                                }
                                adminCommission = commission + adminCommission;
                            }
                            totalEarning = parseFloat(totalEarning) + parseFloat(price);

                            if (orderData.createdAt) {
                                var orderMonth = orderData.createdAt.toDate().getMonth() + 1;
                                var orderYear = orderData.createdAt.toDate().getFullYear();
                                if (currentYear == orderYear) {
                                    switch (parseInt(orderMonth)) {
                                        case 1:
                                            v01 = parseFloat(v01) + parseFloat(price);
                                            break;
                                        case 2:
                                            v02 = parseFloat(v02) + parseFloat(price);
                                            break;
                                        case 3:
                                            v03 = parseFloat(v03) + parseFloat(price);
                                            break;
                                        case 4:
                                            v04 = parseFloat(v04) + parseFloat(price);
                                            break;
                                        case 5:
                                            v05 = parseFloat(v05) + parseFloat(price);
                                            break;
                                        case 6:
                                            v06 = parseFloat(v06) + parseFloat(price);
                                            break;
                                        case 7:
                                            v07 = parseFloat(v07) + parseFloat(price);
                                            break;
                                        case 8:
                                            v08 = parseFloat(v08) + parseFloat(price);
                                            break;
                                        case 9:
                                            v09 = parseFloat(v09) + parseFloat(price);
                                            break;
                                        case 10:
                                            v10 = parseFloat(v10) + parseFloat(price);
                                            break;
                                        case 11:
                                            v11 = parseFloat(v11) + parseFloat(price);
                                            break;
                                        default:
                                            v12 = parseFloat(v12) + parseFloat(price);
                                            break;
                                    }
                                }
                            }
                        }
                    }));


                }));

                if (currencyAtRight) {
                    totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                    adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                    adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(decimal_degits);
                }

                $("#earnings_count_today").append(totalEarning);
                $("#admincommission_count_today").append(adminCommission);
            });

        jQuery("#overlay").hide();


    }

    function salesChart(chartNode, rides_data, labels) {
        var ticksStyle = {
            fontColor: '#666',
            fontStyle: 'bold'
        };

        var mode = 'index';
        var intersect = true;
        return new Chart(chartNode, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "{{ trans('lang.order_plural') }}",
                    backgroundColor: '#80b140',
                    data: rides_data
                },

                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect,
                    callbacks: {
                        label: function (tooltipItem, data) {
                            let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return currentCurrency + parseFloat(value).toFixed(decimal_degits);
                        }
                    },
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return currentCurrency + value.toFixed(decimal_degits);
                            }


                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    }

    function serviceOverview() {

        const data = {
            labels: [
                "{{ trans('lang.dashboard_total_orders') }}",
                "{{ trans('lang.dashboard_total_clients') }}",
                "{{ trans('lang.dashboard_ride_placed') }}",
                "{{ trans('lang.dashboard_ride_active') }}",
                "{{ trans('lang.dashboard_ride_completed') }}",
               
            ],
            datasets: [{
                data: [
                    jQuery("#total_rides").text(),
                    jQuery("#placed_count").text(),
                    jQuery("#users_count").text(),
                    jQuery("#active_count").text(),
                    jQuery("#completed_count").text(),
                   
                ],
                backgroundColor: [
                    '#218be1',
                    '#000000',
                    '#5865F2',
                    '#FFAB2E',
                    '#FF683A',
                    
                    
                ],
                hoverOffset: 4
            }]
        };

        return new Chart('service-overview', {
            type: 'doughnut',
            data: data,
            options: {
                maintainAspectRatio: false,
            }
        });
    }

    function salesOverview() {

        const data = {
            labels: [
                "{{ trans('lang.dashboard_total_earnings') }}",
                "{{ trans('lang.dashboard_admin_commission') }}",
            ],
            datasets: [{
                data: [
                    jQuery("#earnings_count").text().replace(currentCurrency, ""),
                    jQuery("#admincommission_count").text().replace(currentCurrency, ""),
                ],
                backgroundColor: [
                    '#80b140',
                    '#000000',
                ],
                hoverOffset: 4
            }]
        };
        return new Chart('sales-overview', {
            type: 'doughnut',
            data: data,
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    callbacks: {
                        label: function (tooltipItems, data) {
                            return data.labels[tooltipItems.index] + ': ' + currentCurrency + data.datasets[
                                0].data[tooltipItems.index];
                        }
                    }
                }
            }
        })
    }
</script>
@endsection
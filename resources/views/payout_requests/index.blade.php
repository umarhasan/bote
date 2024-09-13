@extends('layouts.app')


@section('content')

<div class="page-wrapper">


    <div class="row page-titles">


        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.payout_request')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.payout_request')}}</li>

            </ol>

        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="error_top" style="display:none"></div>

                        <div class="success_top" style="display:none"></div>
                        <div class="table-responsive m-t-10">


                            <table id="payoutTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">

                                <thead>


                                    <tr>
                                        <?php if ($id == "") { ?>
                                            <th>{{ trans('lang.driver')}}</th>

                                        <?php } ?>

                                        <th>{{trans('lang.amount')}}</th>
                                        <th>{{trans('lang.note')}}</th>
                                        <th>{{trans('lang.drivers_payout_paid_date')}}</th>
                                        <th>{{trans('lang.status')}}</th>
                                        <th>{{trans('lang.admin_note')}}</th>
                                        <th>{{trans('lang.withdraw_method')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>

                                </thead>


                                <tbody id="append_list1">


                                </tbody>


                            </table>


                        </div>


                    </div>

                </div>
            </div>


        </div>
    </div>

</div>


<div class="modal fade" id="bankdetailsModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.bankdetails')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <input type="hidden" name="driverId" id="driverId">

                        <div class="form-group row">

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.bank_name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="bank_name" class="form-control" id="bankName">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.branch_name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="branch_name" class="form-control" id="branchName">
                                </div>
                            </div>


                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{
                                    trans('lang.holder_name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="holer_name" class="form-control" id="holderName">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.account_number')}}</label>
                                <div class="col-12">
                                    <input type="text" name="account_number" class="form-control" id="accountNumber">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-12 control-label">{{
                                    trans('lang.other_information')}}</label>
                                <div class="col-12">
                                    <input type="text" name="other_information" class="form-control" id="otherDetails">
                                </div>
                            </div>

                        </div>

                    </div>

                </form>

                <div class="modal-footer">
                    <a class="btn btn-primary acceptBtn" href="javascript:void(0)">{{trans("lang.accept")}}</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                        {{trans('lang.close')}}</a>
                    </button>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="cancelRequestModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered location_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title locationModalTitle">{{trans('lang.reason')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="">
                    <div class="form-row">
                        <div class="form-group row">
                            <div class="form-group row width-100">
                                <div class="col-12">
                                    <label class="col-12 control-label">{{trans('lang.reason_for_rejection')}}</label>
                                    <textarea name="reason" rows="5" class="form-control" id="reason"></textarea>
                                    <input type="text" name="ride_id" class="form-control" id="ride_id" hidden>
                                    <input type="text" name="driver_id" class="form-control" id="driver_id" hidden>
                                    <input type="text" name="price_add" class="form-control" id="price_add" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-primary save_reason">{{trans('lang.submit')}}</a>
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            aria-label="Close">{{trans('lang.close')}}</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="payoutResponseModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('lang.payout_response')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="payout-response"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
                    {{trans('lang.close')}}</a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script>
    var driverCheckConfirm = "{{ trans('lang.driver_check_confirm') }}";

    var database = firebase.firestore();

    if ('<?php echo $id ?>' != "") {
        var refData = database.collection('withdrawal_history').where('userId', '==', '<?php echo $id ?>');
    } else {
        var refData = database.collection('withdrawal_history');
    }
    var email_templates = database.collection('email_templates').where('type', '==', 'payout_request_status');

    var emailTemplatesData = null;
    var ref = refData.orderBy('createdDate', 'desc');
    var append_list = '';
    var currentCurrency = '';

    var currencyAtRight = false;
    var decimal_degits = 0;

    var refCurrency = database.collection('currency').where('enable', '==', true);

    refCurrency.get().then(async function (snapshots) {

        var currencyData = snapshots.docs[0].data();

        currentCurrency = currencyData.symbol;

        currencyAtRight = currencyData.symbolAtRight;

        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimalDigits) {
            decimal_degits = currencyData.decimalDigits;
        }


    });


    $(document).ready(function () {

        jQuery("#overlay").show();

        email_templates.get().then(async function (snapshots) {
            emailTemplatesData = snapshots.docs[0].data();
        });

        append_list = document.getElementById('append_list1');

        append_list.innerHTML = '';

        ref.get().then(async function (snapshots) {

            var html = '';

            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }

            if (html != '') {

                append_list.innerHTML = html;
            }

            $('#payoutTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: 3,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    { orderable: false, targets: [0, 5, 6] },

                ],
                order: [['3', 'desc']],
                "language": {
                    "zeroRecords": "{{trans('lang.no_record_found')}}",
                    "emptyTable": "{{trans('lang.no_record_found')}}"
                }
            });


            jQuery("#overlay").hide();

        });


    });

    $(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });

    async function buildHTML(snapshots) {

        var html = '';

        await Promise.all(snapshots.docs.map(async (listval) => {

            var val = listval.data();
            var getData = await getListData(val);
            html += getData;

        }));

        return html;

    }

    async function getListData(val) {

        var html = '';
        var price_val = '';
        var price = val.amount;
        html = html + '<tr>';

        if ('<?php echo $id ?>' == "") {
            const payoutDriver = await payoutDriverfunction(val.userId, val.id, val.amount);
            var routedriver = '{{route("users.view",":id")}}';
            routedriver = routedriver.replace(':id', val.userId);
            html = html + '<td><a href="' + routedriver + '">' + payoutDriver + '</a></td>';
        }

        if (currencyAtRight) {
            price_val = parseFloat(val.amount).toFixed(decimal_degits) + '' + currentCurrency;
            html = html + '<td>' + parseFloat(val.amount).toFixed(decimal_degits) + '' + currentCurrency + '</td>';
        } else {
            price_val = currentCurrency + "" + parseFloat(val.amount).toFixed(decimal_degits);
            html = html + '<td>' + currentCurrency + '' + parseFloat(val.amount).toFixed(decimal_degits) + '</td>';
        }


        var date = val.createdDate.toDate().toDateString();
        var time = val.createdDate.toDate().toLocaleTimeString('en-US');

        html = html + '<td>' + val.note + '</td>';

        html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';

        if (val.paymentStatus) {
            if (val.paymentStatus == "approved") {
                html = html + '<td><span  class="badge badge-success py-2 px-3">Approved</span></td>';
            } else if (val.paymentStatus == "pending") {
                html = html + '<td><span class="badge badge-warning py-2 px-3">Pending</span></td>';
            } else if (val.paymentStatus == "rejected") {
                html = html + '<td><span class="badge badge-danger py-2 px-3">Rejected</span></td>';
            } else if (val.paymentStatus == "In Process") {
                html = html + '<td><span class="badge badge-primary py-2 px-3">In Process</span></td>';
            }
        } else {
            html = html + '<td></td>';
        }

        if (val.adminNote) {
            html = html + '<td>' + val.adminNote + '</td>';
        } else {
            html = html + '<td></td>';
        }

        if (val.withdrawMethod) {
            var selectedwithdrawMethod = (val.withdrawMethod == "bank") ? "Bank Transfer" : val.withdrawMethod;

            html = html + '<td>';
            if(val.withdrawMethod == "flutterwave"){
                html = html + '<img src="{{ asset("/images/flutter_wave.png") }}">';
            }else if(val.withdrawMethod == "paypal"){
                html = html + '<img src="{{ asset("/images/paypal.png") }}">';  
            }else if(val.withdrawMethod == "razorpay"){
                html = html + '<img src="{{ asset("/images/razorepay.png") }}">';
            }else if(val.withdrawMethod == "stripe"){
                html = html + '<img src="{{ asset("/images/stripe.png") }}">';
            }else if(val.withdrawMethod == "cash"){
                html = html + '<img src="{{ asset("/images/cash.png") }}">';
            }else if(val.withdrawMethod == "wallet"){
                html = html + '<img src="{{ asset("/images/wallet.png") }}">';
            }else{
                html = html + '<span class="badge badge-info py-2 px-3">' + selectedwithdrawMethod + '</span>';
            }
            html = html + '</td>';

        } else {
            html = html + '<td></td>';
        }

        html = html + '<td class="action-btn">';

        if (val.paymentStatus != "rejected" && val.paymentStatus != "approved") {
            html = html + '<a id="' + val.id + '" name="driver_view" data-auth="' + val.userId + '" data-price = "' + price_val + '" href="javascript:void(0)" data-toggle="modal" data-target="#bankdetailsModal" class="btn btn-info mb-2">{{trans("lang.manual_pay")}}</a>';
        }

        if (val.withdrawMethod && val.withdrawMethod != "bank" && val.paymentStatus != "rejected" && val.paymentStatus != "approved") {
            html = html + '<br>';
            html = html + '<a id="' + val.id + '" name="driver_pay"  data-auth="' + val.userId + '" data-amount="' + price + '" data-method="' + val.withdrawMethod + '" href="javascript:void(0)" class="btn btn-success mb-2">{{trans("lang.pay_online")}}</a>';
        }

        if (val.paymentStatus != "rejected" && val.paymentStatus != "approved") {
            html = html + '<br>';
            html = html + '<a id="' + val.id + '" name="reject-request" data-toggle="modal" data-target="#cancelRequestModal" data-auth="' + val.userId + '" data-amount = "' + price_val + '" data-price="' + price + '" href="javascript:void(0)" class="btn btn-primary mb-2">{{trans("lang.cancel_request")}}</a>';
        }

        if (val.paymentStatus == "In Process") {
            html = html + '<br>';
            html = html + '<a id="' + val.id + '" name="driver_check_status" data-auth="' + val.userId + '" data-amount="' + price + '" data-method="' + val.withdrawMethod + '" href="javascript:void(0)" class="btn btn-dark mb-2">{{trans("lang.check_payment_status")}}</a>';
        }

        html = html + '</td>';

        html = html + '</tr>';
        return html;
    }

    async function getDriverBankDetails() {
        var driverId = $('#driverId').val();
        await database.collection('withdraw_method').where("userId", "==", driverId).get().then(async function (snapshotss) {
            if (snapshotss.docs[0]) {
                var user_data = snapshotss.docs[0].data();
                if (user_data && user_data.hasOwnProperty('bank')) {
                    $('#bankName').val(user_data.bank.bankName);
                    $('#branchName').val(user_data.bank.branchName);
                    $('#holderName').val(user_data.bank.holderName);
                    $('#accountNumber').val(user_data.bank.accountNumber);
                    $('#otherDetails').val(user_data.bank.otherDetails);
                }

            }
        });
    }

    $(document).on("click", "a[name='driver_view']", function (e) {
        $('#bankName').val("");
        $('#branchName').val("");
        $('#holderName').val("");
        $('#accountNumber').val("");
        $('#otherDetails').val("");

        var id = this.id;
        var auth = $(this).attr('data-auth');
        var price = $(this).attr('data-price');
        $('#driverId').val(auth);
        $('.acceptBtn').attr('data-auth', auth);
        $('.acceptBtn').attr('data-price', price);
        $('.acceptBtn').attr('id', id);
        $('.rejectBtn').attr('data-auth', auth);
        $('.rejectBtn').attr('data-price', price);
        $('.rejectBtn').attr('id', id);
        getDriverBankDetails();

    });

    async function payoutDriverfunction(driver, id, amount) {

        var payoutDriver = '';

        await database.collection('users').where("id", "==", driver).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {

                var driver_data = snapshotss.docs[0].data();

                payoutDriver = driver_data.firstName + ' ' + driver_data.lastName;

            }
            return payoutDriver;

        });

        return payoutDriver;

    }


    $(document).on("click", "a[name='driver_check']", function (e) {
        var id = this.id;
        var fullname = $(this).attr('data-name');
        var auth = $(this).attr('data-auth');
        var price = $(this).attr('data-price');
        $('.acceptBtn').attr('data-auth', auth);
        $('.acceptBtn').attr('data-price', price);
        $('.acceptBtn').attr('id', id);
        $('.rejectBtn').attr('data-auth', auth);
        $('.rejectBtn').attr('data-price', price);
        $('.rejectBtn').attr('id', id);
        $('#driverId').val(auth);


        getDriverBankDetails();


    });

    $(document).on("click", "a[name='reject-request']", function (e) {
        $('#bankdetailsModal').modal('hide');
        var id = this.id;
        var auth = $(this).attr('data-auth');
        var priceadd = $(this).attr('data-price');
        $('#ride_id').val(id);
        $('#driver_id').val(auth);
        $('#price_add').val(priceadd);
    })

    $('.save_reason').click(function () {
        
        var id = $('#ride_id').val();
        var auth = $('#driver_id').val();
        var priceadd = $('#price_add').val();
        var reason = $('#reason').val();
        jQuery("#overlay").show().html("{{trans('lang.saving')}}");
        database.collection('users').where("id", "==", auth).get().then(function (resultDriver) {
            if (resultDriver.docs.length) {
                var driver = resultDriver.docs[0].data();
                var walletAmount = 0;
                if (isNaN(driver.walletAmount) || driver.walletAmount == undefined) {
                    walletAmount = 0;
                } else {
                    walletAmount = driver.walletAmount;
                }

                price = parseFloat(walletAmount) + parseFloat(priceadd);
                price = price.toString();
                database.collection('withdrawal_history').doc(id).update({
                    'paymentStatus': 'rejected',
                    'adminNote': reason
                }).then(function (result) {
                    database.collection('users').doc(driver.id).update({ 'walletAmount': price }).then(function (result) {
                        window.location.href = '{{ url()->current() }}';
                    });
                });

            } else {
                alert('user not found.');
            }
        });
    });

    $('.acceptBtn').click(function () {

        $(this).prop('disabled', true).css({ 'cursor': 'default', 'opacity': '0.5' });
        var id = this.id;
        var auth = $(this).attr('data-auth');
        jQuery("#overlay").show().html("{{trans('lang.saving')}}");
        database.collection('withdrawal_history').doc(id).update({ 'paymentStatus': 'approved', 'paymentDate': firebase.firestore.FieldValue.serverTimestamp() }).then(function (result) {
            window.location.href = '{{ url()->current() }}';
        });
    });

    async function getUserData(userId) {
        var data = '';
        await database.collection('users').where("id", "==", userId).get().then(async function (snapshotss) {
            if (snapshotss.docs[0]) {
                data = snapshotss.docs[0].data();
            }
        });
        if (data.id) {
            await database.collection('withdraw_method').where("userId", "==", data.id).get().then(async function (snapshotss) {
                if (snapshotss.docs.length) {
                    data['withdrawMethod'] = snapshotss.docs[0].data();
                }
            });
        }
        return data;
    }
    async function getPaymentSettings() {
        var settings = {};
        await database.collection('settings').doc('payment').get().then(async function (paymentSnapshots) {
            settings["flutterwave"] = paymentSnapshots.data().flutterWave;
            settings["paypal"] = paymentSnapshots.data().paypal;
            settings["razorpay"] = paymentSnapshots.data().razorpay;
            settings["stripe"] = paymentSnapshots.data().strip;
        });
        return settings;
    }

    $(document).on("click", "a[name='driver_pay']", async function (e) {
        $(this).prop('disabled', true).css({ 'cursor': 'default', 'opacity': '0.5' });
        var data = {};
        data['payoutId'] = this.id;
        data['method'] = $(this).data('method');
        data['amount'] = $(this).data('amount');
        data['user'] = await getUserData($(this).data('auth'));
        data['settings'] = await getPaymentSettings();

        if (data['method'] != "undefined") {
            $.ajax({
                type: 'POST',
                data: {
                    data: toBase64Unicode(JSON.stringify(data)),
                },
                url: "{{url('pay-to-user')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success == true) {

                        $(".success_top").show().html("");
                        $(".success_top").append("<p>" + response.message + "</p>");
                        window.scrollTo(0, 0);
                        database.collection('withdrawal_history').doc(data['payoutId']).update({ 'paymentStatus': response.status, 'payoutResponse': response.result }).then(async function (result) {
                            if (data['user'] && data['user'] != undefined) {
                                var emailData = await sendMailToUser(data['user'], data['payoutId'], 'Approved', data['amount']);
                                if (emailData) {
                                    window.location.reload();
                                }
                            }
                            window.location.reload();
                        });
                    } else {

                        $(".error_top").show().html("");
                        $(".error_top").append("<p>" + response.message + "</p>");
                        window.scrollTo(0, 0);
                        setTimeout(function () {
                            window.location.reload();
                        }, 5000);
                    }
                }
            });
        }
    });
    $(document).on("click", "a[name='driver_check_status']", async function (e) {
        $(this).prop('disabled', true).css({ 'cursor': 'default', 'opacity': '0.5' });
        var data = {};
        data['payoutId'] = this.id;
        data['method'] = $(this).data('method');
        data['amount'] = $(this).data('amount');
        data['user'] = await getUserData($(this).data('auth'));
        data['settings'] = await getPaymentSettings();
        //data['payoutDetail'] = await getPayoutDetail(data['payoutId']);
        if (data['method'] != "undefined") {
            $.ajax({
                type: 'POST',
                data: {
                    data: toBase64Unicode(JSON.stringify(data)),
                },
                url: "{{url('check-payout-status')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success == true) {
                        $(".success_top").show().html("");
                        $(".success_top").append("<p>" + response.message + "</p>");
                        window.scrollTo(0, 0);
                    } else {
                        $(".error_top").show().html("");
                        $(".error_top").append("<p>" + response.message + "</p>");
                        window.scrollTo(0, 0);
                    }
                    $(this).prop('disabled', false).css({ 'cursor': 'pointer', 'opacity': '1' });

                    if (response.result && response.status) {
                        database.collection('withdrawal_history').doc(data['payoutId']).update({ 'paymentStatus': response.status, 'payoutResponse': response.result });
                        $("#payoutResponseModal .payout-response").html(JSON.stringify(JSON.parse(JSON.stringify(response.result)), null, 4));
                        $("#payoutResponseModal").modal('show');
                    }
                }
            });
        }
    });
    function toBase64Unicode(str) {
        const utf8Bytes = new TextEncoder().encode(str);
        const base64String = btoa(String.fromCharCode.apply(null, utf8Bytes));
        return base64String;
    }
    async function sendMailToUser(user, id, status, amount) {

        var formattedDate = new Date();
        var month = formattedDate.getMonth() + 1;
        var day = formattedDate.getDate();
        var year = formattedDate.getFullYear();

        month = month < 10 ? '0' + month : month;
        day = day < 10 ? '0' + day : day;

        formattedDate = day + '-' + month + '-' + year;

        var subject = emailTemplatesData.subject;

        subject = subject.replace(/{requestid}/g, id);
        emailTemplatesData.subject = subject;

        var message = emailTemplatesData.message;
        message = message.replace(/{username}/g, user.firstName + ' ' + user.lastName);
        message = message.replace(/{date}/g, formattedDate);
        message = message.replace(/{requestid}/g, id);
        message = message.replace(/{status}/g, status);
        message = message.replace(/{amount}/g, amount);
        message = message.replace(/{usercontactinfo}/g, user.phoneNumber);

        emailTemplatesData.message = message;

        var url = "{{url('send-email')}}";

        return await sendEmail(url, emailTemplatesData.subject, emailTemplatesData.message, [user.email]);
    }

</script>


@endsection
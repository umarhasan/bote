@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor orderTitle">{{trans('lang.order_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.order_plural')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                            style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div class="table-responsive m-t-10">
                            <table id="orderTable"
                                class="display nowrap  table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <?php if (
    (in_array('order.delete', json_decode(@session('user_permissions'))))
) { ?>

                                        <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                    class="do_not_delete" href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i></a></label>
                                        </th>
                                        <?php } ?>
                                        <th>{{trans('lang.booking_id')}}</th>
                                        <th>{{trans('lang.publish_by')}}</th>
                                        <th>{{trans('lang.departure_date_time')}}</th>
                                        <th>{{trans('lang.created_at')}}</th>
                                        <th>{{trans('lang.publish')}}</th>
                                        <th>{{trans('lang.status')}}</th>
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

@endsection

@section('scripts')

<script type="text/javascript">
    var database = firebase.firestore();
    var offest = 1;
    var append_list = '';
    var user_permissions = '<?php echo @session('user_permissions') ?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;
    if ($.inArray('order.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }
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
    });

    var refData = database.collection('booking').orderBy('createdAt', 'desc');
    var subject = '';
    $(document).ready(function () {

        jQuery('#search').hide();

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        jQuery("#overlay").show();

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';

        refData.get().then(async function (snapshots) {
            html = '';
            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }
            if (html != '') {
                append_list.innerHTML = html;

            }
            $('#orderTable').DataTable({
                order: [],
                columnDefs: [
                    {
                        targets: (checkDeletePermission) ? [3, 4] : [2, 3],
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    { orderable: false, targets: (checkDeletePermission) ? [1, 5, 6, 7] : [0, 4, 5, 6] },
                ],
                order: (checkDeletePermission) ? [['3', 'desc']] : ['2', 'desc'],
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true
            });

            jQuery("#overlay").hide();
        });
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
        html = html + '<tr>';
        var id = val.id;
        var user_id = val.userId;
        var ride_view = '{{route("rides.show", ":id")}}';
        ride_view = ride_view.replace(':id', val.id);

        if (checkDeletePermission) {
            html += '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }

        html += '<td><a href="' + ride_view + '">' + id + '</a></td>';
        if (val.createdBy) {


            var userData = await getUserName(val.createdBy);


            if (Object.keys(userData).length > 0) {
                var customer_view = '{{route("users.view", ":id")}}';
                customer_view = customer_view.replace(':id', val.createdBy);
                html += '<td class="redirecttopage user_name_' + val.id + '"><a href="' + customer_view + '">' + userData.firstName + ' ' + userData.lastName + '</a></td>';
            } else {
                html += '<td class="user_name_' + val.id + '">' + '{{trans("lang.unknown_user")}}' + '</td>';
            }
        } else {
            html += '<td class="redirecttopage user_name_' + val.id + '"></td>';
        }
        var date = '';
        var time = '';
        if (val.hasOwnProperty("departureDateTime")) {
            try {
                date = val.departureDateTime.toDate().toDateString();
                time = val.departureDateTime.toDate().toLocaleTimeString('en-US');
            } catch (err) {
            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
        } else {
            html = html + '<td></td>';
        }

        var date = '';
        var time = '';
        if (val.hasOwnProperty("createdAt")) {
            try {
                date = val.createdAt.toDate().toDateString();
                time = val.createdAt.toDate().toLocaleTimeString('en-US');
            } catch (err) {
            }
            html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
        } else {
            html = html + '<td></td>';
        }
        if (val.status == "placed") {
            if (val.publish) {
                html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            } else {
                html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            }
        } else {
            html = html + '<td></td>';
        }
        if (val.status == "placed") {
            status = 'Placed'
            html += '<td><span class="badge badge-primary py-2 px-3">' + status + '</span></td>';
        } else if (val.status == "completed") {
            status = 'Completed';
            html += '<td><span  class="badge badge-success py-2 px-3">' + status + '</span></td>';
        } else if (val.status == "onGoing") {
            status = 'On Going';
            html += '<td><span  class="badge badge-warning py-2 px-3">' + status + '</span></td>';
        }
        else if (val.status == "canceled") {
            status = 'Cancelled';
            html += '<td><span  class="badge badge-danger py-2 px-3">' + status + '</span></td>';
        }
        else {
            html += '<td><span class="badge badge-warning py-2 px-3">' + val.status + '</span></td>';
        }
        html += '<td class="action-btn">';
        html += '<a href="' + ride_view + '"><i class="fa fa-eye"></i></a>';
        if (checkDeletePermission) {
            html = html + '<a id="' + val.id + '" class="do_not_delete" name="ride-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }
        html += '</td>';
        html += '</tr>';
        return html;
    }


    $("#is_active").click(function () {
        $("#orderTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#orderTable .is_open:checked').length) {
            if (confirm("{{trans('lang.selected_delete_alert')}}")) {
                jQuery("#overlay").show();
                $('#orderTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');
                    database.collection('booking').doc(dataId).delete().then(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 5000);
                    });

                });

            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });


    $(document).on("click", "a[name='ride-delete']", function (e) {

        var id = this.id;
        jQuery("#overlay").show();
        database.collection('booking').doc(id).delete().then(function (result) {

            window.location.href = '{{ url()->current() }}';
        });

    });

    async function getUserName(userId) {
        var user = {};
        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                user = snapshots.docs[0].data();
            }
        });
        return user;
    }

    $(document).on("click", "input[name='isEnabled']", async function (e) {

        var ischeck = $(this).is(':checked');
        var id = this.id;

        if (ischeck) {
            database.collection('booking').doc(id).update({ 'publish': true }).then(function (result) {

            });
        } else {
            $('#overlay').show();
            await database.collection('booking').where('id', '==', id).get().then(async function (snapshot) {
                var bookingData = snapshot.docs[0].data();
                var totalSeatBooked = bookingData.bookedSeat;
                var bookedUserSnapshots = await database.collection('booking/' + id + '/bookedUser').get();

                var bookedUserArr = [];

                if (bookingData.hasOwnProperty("bookedUserId") && bookingData.bookedUserId != null) {
                    bookedUserArr = bookingData.bookedUserId;
                }
                if (bookedUserSnapshots.docs != undefined && bookedUserSnapshots.docs.length > 0) {

                    await Promise.all(bookedUserSnapshots.docs.map(async (element) => {
                        var userFcm = '';
                        var amount = 0;
                        var adminCommision = 0;
                        var tax_amount_total = parseFloat(0);
                        var bookedUserObj = element.data();
                        if (bookedUserObj.paymentStatus == true) {

                            var amount = parseFloat(bookedUserObj.subTotal);
                            if (bookedUserObj.hasOwnProperty('taxList') && bookedUserObj.taxList.length > 0) {
                                var taxData = bookedUserObj.taxList;
                                for (var i = 0; i < taxData.length; i++) {
                                    var data = taxData[i];
                                    if (data.enable) {
                                        var tax_amount = parseFloat(data.tax);
                                        if (data.type == "percentage") {
                                            tax_amount = (parseFloat(data.tax) * amount) / 100;
                                        }
                                        tax_amount_total += parseFloat(tax_amount);
                                    }
                                }
                                amount += tax_amount_total;
                            }
                            if (bookedUserObj.hasOwnProperty('adminCommission')) {
                                var commissionObj = bookedUserObj.adminCommission;
                                if (commissionObj.type == "percentage") {
                                    adminCommision = (parseFloat(commissionObj.amount) * parseFloat(bookedUserObj.subTotal)) / 100;
                                } else {
                                    adminCommision = parseFloat(commissionObj.amount);
                                }
                            }

                            var publisherAmount = parseFloat(amount) - parseFloat(adminCommision);


                        }

                        if (bookingData.hasOwnProperty("bookedUserId") && bookingData.bookedUserId != null && bookingData.bookedUserId.includes(bookedUserObj.id)) {
                            bookedUserArr = bookedUserArr.filter(bookedId => bookedId !== bookedUserObj.id)
                        }
                        await setCancelUSerBooking(bookingData, bookedUserObj);
                        await removeBookedUserBooking(bookingData, bookedUserObj);

                        var publisherData = await getUserName(bookingData.createdBy);
                        if (publisherData) {
                            userFcm = publisherData.fcmToken;
                            subject = publisherData.firstName + ' ' + publisherData.lastName;
                            await sendNotification(userFcm, 'publisher', bookingData.id);

                        }
                        var bookdedUserData = await getUserName(bookedUserObj.id);
                        if (bookdedUserData) {
                            userFcm = bookdedUserData.fcmToken;
                            await sendNotification(userFcm);

                        }



                    }))
                }
                await database.collection('booking').doc(id).update({
                    'publish': false,
                    'bookedSeat': '0',
                    'bookedUserId': bookedUserArr
                }).then(async function (result) {
                    window.location.reload();
                });

            })

        }

    });

    async function addWalletTransaction(totalAmount, publisherAmount, adminCommision, publisherId, bookedUserId, bookingId, paymentType) {
        var wId = database.collection('tmp').doc().id;
        var bookdedUserData = await getUserName(bookedUserId);
        userFcm = bookdedUserData.fcmToken;
        var publisherData = await getUserName(publisherId);
        await database.collection('wallet_transaction').doc(wId).set({
            'id': wId,
            'amount': adminCommision.toString(),
            'createdDate': firebase.firestore.FieldValue.serverTimestamp(),
            "paymentType": "Wallet",
            'transactionId': bookingId,
            "isCredit": true,
            "type": "publisher",
            "userId": publisherId,
            "note": "Admin commission credited for" + bookdedUserData.firstName + ' ' + bookdedUserData.lastName + "ride"
        }).then(async function (result) {
            if (paymentType.toLowerCase() != 'cash') {
                var wId = database.collection('tmp').doc().id;
                await database.collection('wallet_transaction').doc(wId).set({
                    'id': wId,
                    'amount': totalAmount.toString(),
                    'createdDate': firebase.firestore.FieldValue.serverTimestamp(),
                    "paymentType": "Wallet",
                    'transactionId': bookingId,
                    "isCredit": false,
                    "type": "publisher",
                    "userId": publisherId,
                    "note": "Amount refunded for" + bookdedUserData.firstName + ' ' + bookdedUserData.lastName + "ride"
                }).then(async function (result) {

                })
            }
            await database.collection('users').where('id', '==', publisherId).get().then(async function (snapshot) {
                if (snapshot.docs.length > 0) {
                    var userData = userRef.docs[0].data();
                    userWallet = 0;
                    if (userData.walletAmount != null && userData.walletAmount != '' && !isNaN(userData.walletAmount)) {
                        userWallet = userData.walletAmount;
                    }
                    if (paymentType.toLowerCase() != 'cash') {
                        newWalletAmount = parseFloat(userWallet) - parseFloat(publisherAmount)
                    } else {
                        newWalletAmount = parseFloat(userWallet) + parseFloat(adminCommision)
                    }

                    await database.collection('users').where('id', '==', publisherId).update({ 'walletAmount': newWalletAmount.toString() })
                }
            })
            await database.collection('users').where('id', '==', bookedUserId).get().then(async function (snapshot) {
                if (snapshot.docs.length > 0) {
                    var userData = userRef.docs[0].data();
                    userWallet = 0;
                    if (userData.walletAmount != null && userData.walletAmount != '' && !isNaN(userData.walletAmount)) {
                        userWallet = userData.walletAmount;
                    }
                    if (paymentType.toLowerCase() != 'cash') {
                        newWalletAmount = parseFloat(userWallet) + parseFloat(totalAmount);
                        await database.collection('users').where('id', '==', bookedUserId).update({ 'walletAmount': newWalletAmount.toString() }).then(async function (result) {
                            var wId = database.collection('tmp').doc().id;
                            await database.collection('wallet_transaction').doc(wId).set({
                                'id': wId,
                                'amount': totalAmount.toString(),
                                'createdDate': firebase.firestore.FieldValue.serverTimestamp(),
                                "paymentType": "Wallet",
                                'transactionId': bookingId,
                                "isCredit": true,
                                "type": "customer",
                                "userId": bookedUserId,
                                "note": "Amount refunded for" + publisherData.firstName + ' ' + publisherData.lastName + "ride"
                            })
                        });
                    }


                }
            })

        })

    }

    async function setCancelUSerBooking(bookingData, bookedUserObj) {
        await database.collection('booking/' + bookingData.id + '/cancelledUser').doc(bookedUserObj.id).set({ ...bookedUserObj });
    }
    async function removeBookedUserBooking(bookingData, bookedUserObj) {
        var docRef = database.collection('booking/' + bookingData.id + '/bookedUser').doc(bookedUserObj.id).delete();

    }
    async function sendNotification(fcmToken, notify = null, bookingId = null) {
        await $.ajax({
            type: 'POST',
            url: "<?php echo route('send-notification'); ?>",
            data: {
                _token: '<?php echo csrf_token() ?>',
                'fcm': fcmToken,
                'title': subject,
                'message': (notify == null) ? '{{trans("lang.booking_cancelled_message")}}' : '{{trans("lang.your_ride_id")}} #' + bookingId + '{{trans("lang.has_been_cancelled_by_administrator")}}',
            },
            success: function (data) {

                console.log(data);


            }
        });

    }
</script>


@endsection
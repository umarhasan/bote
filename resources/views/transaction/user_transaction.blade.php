@extends('layouts.app')

@section('content')

    <div class="page-wrapper">

        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.users_wallet_transactions')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.users_wallet_transactions')}}</li>
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
                                <table id="userTable"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>


                                        <th>{{trans('lang.id')}}</th>
                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.payment_method')}}</th>
                                        <th>{{trans('lang.total_amount')}}</th>
                                        <th>{{trans('lang.note')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.actions')}} </th>

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

        var symbolAtRight = false;
        var ref = database.collection('wallet_transaction').orderBy('createdDate', 'desc');
        var refCurrency = database.collection('currency').where('enable', '==', true).limit('1');
        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            decimal_degits = currencyData.decimalDigits;

            if (currencyData.symbolAtRight) {
                symbolAtRight = true;
            }
        });

        var append_list = '';

        var deleteMsg = "{{trans('lang.delete_alert')}}";
        var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";

        $(document).ready(function () {
            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });
            jQuery("#overlay").show();
            append_list = document.getElementById('append_list1');
            append_list.innerHTML = '';
            ref.get().then(async function (snapshots) {
                var html = '';
                if (snapshots.docs.length > 0) {
                    html = await buildHTML(snapshots);
                    jQuery("#overlay").hide();

                }
                if (html != '') {
                    append_list.innerHTML = html;


                }

                $('#userTable').DataTable({
                    processing: true,
                    order: [],
                    columnDefs: [
                        {
                            targets: 5,
                            type: 'date',
                            render: function (data) {
                                return data;
                            }
                        },
                        {orderable: false, targets: [2, 6]},
                    ],
                    order : [['5','desc']],
                    "language": {
                        "zeroRecords": "{{trans('lang.no_record_found')}}",
                        "emptyTable": "{{trans('lang.no_record_found')}}"
                    }
                });

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
            newdate = '';
            var id = val.userId;
            var route1 = '{{route("users.view", ":id")}}';
            route1 = route1.replace(':id', id);
            var trroute1 = '';
            trroute1 = trroute1.replace(':id', id);
            var t_id = val.id;
            var transaction = t_id.substring(0, 7);
            html = html + '<td>' + t_id + '</td>';
            if (val.userId) {
                var userName = await payoutuserfunction(val.userId);
                if (userName) {
                    html = html + '<td><a class="user_role_' + val.userId + '" href="' + route1 + '">' + userName + '</a></td>';

                } else {
                    html = html + '<td>{{trans("lang.unknown_user")}}</td>';
                }
            } else {
                html = html + '<td></td>';
            }
            
            html = html + '<td>';
            if(val.paymentType == "FlutterWave"){
                html = html + '<img src="{{ asset("/images/flutter_wave.png") }}">';
            }else if(val.paymentType == "MercadoPago"){
                html = html + '<img src="{{ asset("/images/marcado_pago.png") }}">';
            }else if(val.paymentType == "Yappy"){
                html = html + '<img src="{{ asset("/images/yappy.png") }}">';
            }else if(val.paymentType == "PayStack"){
                html = html + '<img src="{{ asset("/images/paystack.png") }}">';
            }else if(val.paymentType == "PayFast"){
                html = html + '<img src="{{ asset("/images/payfast.png") }}">';  
            }else if(val.paymentType == "Paypal"){
                html = html + '<img src="{{ asset("/images/paypal.png") }}">';  
            }else if(val.paymentType == "RazorPay"){
                html = html + '<img src="{{ asset("/images/razorepay.png") }}">';
            }else if(val.paymentType == "Stripe"){
                html = html + '<img src="{{ asset("/images/stripe.png") }}">';
            }else{
                html = html + '<span class="badge badge-info py-2 px-3">' + val.paymentType + '</span>';
            }
            html = html + '</td>';
            
            if (val.amount.charAt(0) == "-") {
                amount = Math.abs(val.amount);
                if (symbolAtRight) {
                    amount = parseFloat(amount).toFixed(decimal_degits) + currentCurrency;
                } else {
                    amount = currentCurrency + parseFloat(amount).toFixed(decimal_degits);
                }
                html = html + '<td><span class="text-danger">(-' + amount + ')</span></td>';
            } else {
                if (symbolAtRight) {
                    amount = parseFloat(val.amount).toFixed(decimal_degits) + currentCurrency;
                } else {
                    amount = currentCurrency + parseFloat(val.amount).toFixed(decimal_degits);
                }
                html = html + '<td><span class="text-success">(' + amount + ')</span></td>';
            }
            html = html + '<td>' + val.note + '</td>';
            if (val.hasOwnProperty("createdDate")) {
                var date = val.createdDate.toDate().toDateString();
                var time = val.createdDate.toDate().toLocaleTimeString('en-US');
                html = html + '<td class="dt-time">' + date + ' ' + time + '</td>';
            } else {
                html = html + '<td></td>';
            }
            var trroute1 = '{{route("rides.show", ":id")}}';
            trroute1 = trroute1.replace(':id', val.transactionId);
            var rideExist=await checkRideExist(val.transactionId);
            if(rideExist){
                html = html + '<td class="action-btn"><a href="' + trroute1 + '"><i class="fa fa-eye" aria-hidden="true"></i></a></td>';
            }else{
                html=html+'<td></td>';
            }
           
            html = html + '</tr>';
            return html;
        }

        async function payoutuserfunction(user) {
            var payoutuser = '';
            await database.collection('users').where("id", "==", user).get().then(async function (snapshotss) {
                if (snapshotss.docs[0]) {
                    var user_data = snapshotss.docs[0].data();
                    payoutuser = user_data.firstName+' '+user_data.lastName;
                }
            });
            return payoutuser;
        }

     async function checkRideExist(rideId){
        var rideExist=false;
        await database.collection('booking').where('id','==',rideId).get().then(async function(snapshots){
            if(snapshots.docs.length>0){
                rideExist=true;
            }
        })
        return rideExist;
     }
    </script>

@endsection

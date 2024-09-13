@extends('layouts.app')

@section('content')

<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.dynamic_notification')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item">{{trans('lang.dynamic_notification')}}</li>

            </ol>

        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                        class="fa fa-list mr-2"></i>{{trans('lang.notificaions_table')}}</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive m-t-10">


                            <table id="notificationTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>{{trans('lang.subject')}}</th>
                                        <th>{{trans('lang.message')}}</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>

                                <tbody id="append_restaurants">


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


@endsection

@section('scripts')

<script type="text/javascript">

    var database = firebase.firestore();
 
    var ref = database.collection('dynamic_notification');
    var append_list = '';


    $(document).ready(function () {

        jQuery("#data-table_processing").show();

        append_list = document.getElementById('append_restaurants');
        append_list.innerHTML = '';
        ref.get().then(async function (snapshots) {
            html = '';
            html = await buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                $('[data-toggle="tooltip"]').tooltip();

            }

            $('#notificationTable').DataTable({
                order: [],
                columnDefs: [
                  
                    { orderable: false, targets: [2] },
                ],
                
                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true
            });
        });

    })
  

    function buildHTML(snapshots) {


        var html = '';
        snapshots.docs.forEach(async (listval) => {
            var listval = listval.data();

            var val = listval;
            val.id = listval.id;
            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            route1 = '{{route("dynamic-notification.save",":id")}}'
            route1 = route1.replace(":id", id);

            if (val.type == "booking_confirmed") {
                title = "{{trans('lang.booking_confirmed_notification')}}";
            } else if (val.type == "payment_successful") {
                title = "{{trans('lang.payment_successful_notification')}}";
            } else if (val.type == "feedback") {
                title = "{{trans('lang.feedback_notification')}}";
            } else if (val.type == "ride_completed") {
                title = "{{trans('lang.ride_completed_notification')}}";

            } 

            html = html + '<td>' + val.subject + '</td>';

            html = html + '<td>' + val.message + '</td>';

            html = html + '<td class="action-btn"><i class="text-dark fs-12 fa-solid fa fa-info" data-toggle="tooltip" title="' + title + '" aria-describedby="tippy-3"></i><a href="' + route1 + '"><i class="fa fa-edit"></i></a></td>';

            html = html + '</tr>';
        });
        return html;
    }

</script>


@endsection
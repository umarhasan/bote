@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.complaint_subject')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.complaint_subject_list')}}</li>
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
                                        class="fa fa-list mr-2"></i>{{trans('lang.complaint_subject_list')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('complaint.subject.create')}}"><i
                                        class="fa fa-plus mr-2"></i>{{trans('lang.complaint_subject_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive m-t-10">
                            <table id="complaintTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>

                                        <th>{{trans('lang.title')}}</th>
                                        <th>{{trans('lang.subject_for')}}</th>
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


    var ref = database.collection('settings').doc("reasons");

    var append_list = '';

    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";
    var user_permissions = '<?php echo @session('user_permissions') ?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;
    if ($.inArray('complaint.subject.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }
    $(document).ready(function () {

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        jQuery("#overlay").show();


        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.get().then(async function (snapshots) {


            html = '';
            if (snapshots.data() != undefined) {
                html = await buildHTML(snapshots);
            }

            jQuery("#overlay").hide();
            if (html != '') {
                append_list.innerHTML = html;

            }

            $('#complaintTable').DataTable({
                order: [[1, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [2] },
                ],
                "language": {
                    "zeroRecords": "{{trans('lang.no_record_found')}}",
                    "emptyTable": "{{trans('lang.no_record_found')}}"
                }
            });
        });


    });


    async function buildHTML(snapshots) {
        var data = snapshots.data();
        var html = '';
        var id = '';
        if (data.hasOwnProperty('customer') && data.customer.length > 0) {

            data.customer.forEach((element, index) => {

                var route1 = '{{route("complaint.subject.edit",[":type", ":id"])}}';
                route1 = route1.replace(':type', 'customer');
                route1 = route1.replace(':id', index);
                html = html + '<tr>';
                html = html + '<td>' + element + '</td>';
                html = html + '<td>{{trans("lang.customer")}}</td>';

                html = html + '<td class="action-btn">';
                html = html + '<a href="' + route1 + '"><i class="fa fa-edit"></i></a>';
                if (checkDeletePermission) {
                    html = html + '<a data-type="customer" id="' + index + '" name="subject-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                }
                html = html + '</td>';
                html = html + '</tr>';
            });
        }
        if (data.hasOwnProperty('publisher') && data.publisher.length > 0) {
            data.publisher.forEach((element, index) => {
                var route1 = '{{route("complaint.subject.edit",[":type", ":id"])}}';
                route1 = route1.replace(':type', 'publisher');
                route1 = route1.replace(':id', index);
                html = html + '<tr>';
                html = html + '<td>' + element + '</td>';
                html = html + '<td>{{trans("lang.publisher")}}</td>'
                html = html + '<td class="action-btn">';
                html = html + '<a href="' + route1 + '"><i class="fa fa-edit"></i></a>';
                if (checkDeletePermission) {
                    html = html + '<a data-type="publisher" id="' + index + '" name="subject-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                }
                html = html + '</td>';
                html = html + '</tr>';
            });
        }
        return html;
    }


    $(document).on("click", "a[name='subject-delete']", function (e) {
        if (confirm(deleteMsg)) {
            var index = this.id;
            jQuery("#overlay").show();
            var type = $(this).attr('data-type');

            database.collection('settings').doc('reasons').get().then(async function (snapshots) {
                var data = snapshots.data();
                if (type == 'customer') {
                    var newArray = data.customer.filter(element => element !== data.customer[index]);
                    database.collection('settings').doc('reasons').update({
                        'customer': newArray
                    })
                } else {

                    var newArray = data.publisher.filter(element => element !== data.publisher[index]);
                    database.collection('settings').doc('reasons').update({
                        'publisher': newArray
                    })
                }
                window.location.href = '{{ url()->current() }}';

            });

        } else {
            return false;
        }

    });

</script>

@endsection
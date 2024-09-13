@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">
                @if(request()->is('users/approved'))
                @php $type = 'approved'; @endphp
                {{trans('lang.approved_users')}}
                @elseif(request()->is('users/pending'))
                @php $type = 'pending'; @endphp
                {{trans('lang.pending_users')}}
                @else
                @php $type = 'all'; @endphp
                {{trans('lang.all_users')}}
                @endif
            </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.user_table')}}</li>
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
                                        <?php if (
                                            ($type == "approved" && in_array('approve.user.delete', json_decode(@session('user_permissions'), true))) ||
                                            ($type == "pending" && in_array('pending.user.delete', json_decode(@session('user_permissions'), true))) ||
                                            ($type == "all" && in_array('user.delete', json_decode(@session('user_permissions'), true)))
                                        ) { ?>
                                            <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                        class="do_not_delete" href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                        <?php } ?>


                                        <th>{{trans('lang.extra_image')}}</th>
                                        <th>{{trans('lang.user_name')}}</th>
                                        <th>{{trans('lang.email')}}</th>
                                        <th>{{trans('lang.phone')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.active')}}</th>
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
</div>
</div>

@endsection

@section('scripts')


<script type="text/javascript">

    var database = firebase.firestore();
    var defaultImg = "{{ asset('/images/default_user.png') }}";
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var type = "{{$type}}";
    var ref = database.collection('users');
    var allData = [];
    var lastVisible = null;
    var pageSize = 10;
    var loadingData = false;
    var searchValue = '';

    if (type == 'pending') {
        ref = database.collection('users').where("isVerify", "==", false);
    } else if (type == 'approved') {
        ref = database.collection('users').where("isVerify", "==", true);
    }

    var user_permissions = '<?php echo @session('user_permissions') ?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;
    if (
        (type == 'pending' && $.inArray('pending.user.delete', user_permissions) >= 0) ||
        (type == 'approved' && $.inArray('approve.user.delete', user_permissions) >= 0) ||
        (type == 'all' && $.inArray('user.delete', user_permissions) >= 0)

    ) {
        checkDeletePermission = true;
    }
    var placeholderImage = '';
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
                        targets: (checkDeletePermission) ? 5 : 4,
                        type: 'date',
                        render: function (data) {
                            return data;
                        }
                    },
                    { orderable: false, targets: (checkDeletePermission) ? [0, 1, 6, 7] : [0, 5, 6] },
                ],
                order: [['5', 'desc']],
                "language": {
                    "zeroRecords": "{{trans('lang.no_record_found')}}",
                    "emptyTable": "{{trans('lang.no_record_found')}}"
                },
                responsive: true
            });

        });


        jQuery("#overlay").hide();

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
        var id = val.id;
        var route1 = '{{route("users.edit", ":id")}}';
        route1 = route1.replace(':id', id);

        var trroute1 = '';
        trroute1 = trroute1.replace(':id', id);

        var userview = '{{route("users.view", ":id")}}';
        userview = userview.replace(':id', id);

        if (checkDeletePermission) {
            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }


        if (val.profilePic == '' || val.profilePic == null) {

            html = html + '<td><img class="rounded" style="width:50px" src="' + defaultImg + '" alt="image"></td>';
        } else {
            html = html + '<td><img class="rounded" style="width:50px" src="' + val.profilePic + '" alt="image"></td>';
        }
        if (val.isVerify) {
            html = html + '<td><a href="' + userview + '">' + val.firstName + ' ' + val.lastName + '<sup class="badge badge-success ml-2"><i class="fa fa-check"></i> {{trans("lang.verified")}}</sup></a></td>';

        } else {
            html = html + '<td><a href="' + userview + '">' + val.firstName + ' ' + val.lastName + '</a></td>';

        }

        html = html + '<td>' + val.email + '</td>';
        html = html + '<td>' + '+' + (val.countryCode.includes('+') ? val.countryCode.slice(1) : val.countryCode) + '-' + val.phoneNumber + '</td>';

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
        if (val.isActive) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
        }
        document_list_view = "{{route('users.document', ':id')}}";
        document_list_view = document_list_view.replace(':id', val.id);

        html = html + '<td class="action-btn"><a href="' + document_list_view + '"><i class="fa fa-file"></i></a><a href="' + userview + '"><i class="fa fa-eye"></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';

        if (checkDeletePermission) {
            html = html + '<a id="' + val.id + '" class="do_not_delete" name="user-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }
        html = html + '</td>';

        html = html + '</tr>';
        return html;

    }


    $("#is_active").click(function () {
        $("#userTable .is_open").prop('checked', $(this).prop('checked'));
    });

    $("#deleteAll").click(function () {
        if ($('#userTable .is_open:checked').length) {
            if (confirm(deleteSelectedRecordMsg)) {
                jQuery("#overlay").show();
                $('#userTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');

                    database.collection('users').doc(dataId).delete().then(function () {
                        deleteUserData(dataId);
                        setTimeout(function () {
                            window.location.reload();
                        }, 7000);
                    });
                });
            } else {
                return false;
            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });

    async function deleteUserData(userId) {
        //delete user from authentication
        var route1 = '{{route("delete-user", ":id")}}';
        route1 = route1.replace(':id', userId);
        jQuery.ajax({
            url: route1,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
            },
            success: function (data) {
                console.log('Delete user success:', data);
            },
        });
        await database.collection('reports_help').where('reportedFrom', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();
                    database.collection('reports_help').doc(item_data.id).delete().then(function () {

                    });
                });
            }
        });
        await database.collection('reports_help').where('reportedTo', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();
                    database.collection('reports_help').doc(item_data.id).delete().then(function () {

                    });
                });
            }
        });
        await database.collection('review').where('userId', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();
                    database.collection('review').doc(item_data.id).delete().then(function () {

                    });
                });
            }
        });
        await database.collection('user_vehicle_information').where('userId', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();
                    database.collection('user_vehicle_information').doc(item_data.id).delete().then(function () {

                    });
                });
            }
        });
        await database.collection('user_verification').where('id', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();
                    database.collection('user_verification').doc(item_data.id).delete().then(function () {

                    });
                });
            }
        });
        await database.collection('wallet_transaction').where('userId', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('wallet_transaction').doc(item_data.id).delete().then(function () {

                    });
                });
            }
        });
        await database.collection('withdrawal_history').where('userId', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('withdrawal_history').doc(item_data.id).delete().then(function () {

                    });
                });
            }
        });

    }



    $(document).on("click", "a[name='user-delete']", function (e) {

        if (confirm(deleteMsg)) {
            jQuery("#overlay").show();
            var id = this.id;
            database.collection('users').doc(id).delete().then(function (result) {
                deleteUserData(id);
                setTimeout(function () {
                    window.location.href = '{{ url()->current() }}';
                }, 7000);
            });

        } else {
            return false;
        }

    });

    $(document).on("click", "input[name='isActive']", function (e) {
        var ischeck = $(this).is(':checked');
        var id = this.id;
        database.collection('users').doc(id).update({ 'isActive': ischeck ? true : false }).then(function (result) {
        });
    });
</script>

@endsection
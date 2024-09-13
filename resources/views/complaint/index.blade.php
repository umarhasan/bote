@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.complaints')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.complaints')}}</li>

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

                        <div class="table-responsive m-t-10">

                            <table id="example24"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>{{trans('lang.booking_id')}}</th>
                                        <th>{{trans('lang.complaint_by')}}</th>
                                        <th>{{trans('lang.complaint_for')}}</th>
                                        <th>{{trans('lang.title')}}</th>
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

</div>
</div>
<div class="modal fade" id="showComplaintModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.complaint_detail')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <div class="form-row">

                    <div class="form-group row">
                        <input type="text" name="complaint_id" id="complaint_id" hidden>
                        <input type="text" name="client_email" id="client_email" hidden>

                        <div class="form-group row width-100">
                            <label class="col-12 control-label">{{
                                trans('lang.title')}}</label>

                            <div class="col-12 title">
                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-12 control-label">{{
                                trans('lang.description')}}</label>

                            <div class="col-12 message">
                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-12 control-label">{{trans('lang.block_account')}}</label>
                            <div class="col-12">
                                <select name="block_account" class="form-control" id="block_account">
                                    <option value="" selected>{{trans("lang.select_user")}}</option>

                                </select>

                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-12 control-label">{{trans('lang.status')}}</label>
                            <div class="col-12">
                                <select name="complaint_status" class="form-control" id="complaint_status">
                                    <option value="Pending">{{trans('lang.pending')}}</option>
                                    <option value="Resolved">{{trans('lang.resolved')}}</option>
                                </select>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="update-complaint-btn">{{trans('lang.submit')}}</a>
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

<script type="text/javascript">

    var database = firebase.firestore();
    var ref = database.collection('reports_help');
    var placeholderImage = '';
    var append_list = '';
    var user_permissions = '<?php echo @session('user_permissions') ?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;
    var checkEditPermission = false;
    if ($.inArray('complaints.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }
    if ($.inArray('complaints.edit', user_permissions) >= 0) {
        checkEditPermission = true;
    }
    $(document).ready(function () {

        jQuery("#overlay").show();

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.get().then(async function (snapshots) {
            html = '';
            html = await buildHTML(snapshots);
            jQuery("#overlay").hide();
            if (html != '') {
                append_list.innerHTML = html;
            }
            $('#example24').DataTable({

                order: [],
                columnDefs: [

                    { orderable: false, targets: [4, 5] },
                ],

                "language": {
                    "zeroRecords": "{{trans("lang.no_record_found")}}",
                    "emptyTable": "{{trans("lang.no_record_found")}}"
                },
                responsive: true,
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
        route1 = "{{route('users.view', ':id')}}";
        route1 = route1.replace(':id', val.reportedFrom);
        route2 = "{{route('users.view', ':id')}}";
        route2 = route2.replace(':id', val.reportedTo);
        rideRoute = "{{route('rides.show', ':id')}}";
        rideRoute = rideRoute.replace(':id', val.bookingId);
        html = html + '<td><a href="' + rideRoute + '">' + val.bookingId + '</a></td>';

        var reportedFrom = await getUserData(val.reportedFrom);
        if (reportedFrom == '') {
            reportedFromName = '{{trans("lang.unknown_user")}}';
            html = html + '<td>' + reportedFromName + '</td>';
        } else {
            html = html + '<td ><a href="' + route1 + '">' + reportedFrom.firstName + ' ' + reportedFrom.lastName + '</a></td>';
        }
        var reportedTo = await getUserData(val.reportedTo);

        if (reportedTo == '') {
            reportedToName = '{{trans("lang.unknown_user")}}';
            html = html + '<td>' + reportedToName + '</td>';
        } else {
            html = html + '<td ><a href="' + route1 + '">' + reportedTo.firstName + ' ' + reportedTo.lastName + '</a></td>';
        }
        var id = val.id;
        html = html + '<td>' + val.title + '</td>';

        if (val.status == "Resolved") {
            status = 'Resolved';
            html = html + '<td><span class="badge badge-success">' + status + '</span></td>';
        } else {
            status = 'Pending'
            html = html + '<td><span class="badge badge-primary">' + status + '</span></td>';
        }
        html += '<td class="action-btn">';
        if (checkEditPermission) {
            html = html + '<a href="javascript:void(0)" name="complaint-edit" id="' + val.id + '" data-email="' + reportedFrom.email + '" data-fromId="' + val.reportedFrom + '" data-toId="' + val.reportedTo + '"><i class="fa fa-edit"></i></a>';
        }
        if (checkDeletePermission) {
            html = html + '<a id="' + val.id + '" name="complaint-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }
        html = html + '</td>';
        html = html + '</tr>';

        return html;
    }

    $(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });

    $(document).on("click", "a[name='complaint-delete']", function (e) {
        var id = this.id;
        database.collection('reports_help').doc(id).delete().then(function () {
            window.location.reload();
        });
    });
    async function getUserData(userId) {
        var userData = '';
        await database.collection('users').where('id', '==', userId).get().then(async function (snapshots) {

            if (snapshots.docs.length > 0) {
                userData = snapshots.docs[0].data();

            }

        });
        return userData;
    }
    async function getoptionData(fromId, toId) {
        await database.collection('users').where('id', 'in', [fromId, toId]).get().then(async function (snapshots) {
            $('#block_account').html('');

            if (snapshots.docs.length > 0) {
                $('#block_account').append('<option value="" disabled selected>{{trans("lang.select_user")}}</option>')

                userData = snapshots.docs.forEach(element => {
                    userData = element.data();
                    $('#block_account').append($("<option></option>")
                        .attr("value", userData.id)
                        .text(userData.firstName + ' ' + userData.lastName));
                });

            }

        });
    }

    $(document).on("click", "a[name='complaint-edit']", async function (e) {
        var id = this.id;
        var clientEmail = $(this).attr('data-email');
        var reportedFrom = $(this).attr('data-fromId');
        var reportedTo = $(this).attr('data-toId');
        await getoptionData(reportedFrom, reportedTo);
        await database.collection('reports_help').where('id', '==', id).get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                var data = snapshots.docs[0].data();
                $('.title').text(data.title);
                $('.message').text(data.description);
                $('#complaint_status').val(data.status);
                $('#complaint_id').val(data.id);
                $('#client_email').val(clientEmail);
            }
        });
        $('#showComplaintModal').modal('show');
    });
    $('#update-complaint-btn').on("click", async function () {
        var id = $('#complaint_id').val();
        var status = $('#complaint_status').val();
        var blockAccount = $('#block_account').val();
        var email = $('#client_email').val();

        await database.collection('reports_help').doc(id).update({ 'status': status }).then(async function (result) {


            if (blockAccount != '' && blockAccount != null) {
                await database.collection('users').doc(blockAccount).update({
                    'isActive': false
                });
            }
            if (status == "Resolved") {
                var url = "{{url('send-email')}}";
                var subject = "{{trans('lang.complaint_status_upadted')}}";
                message = "<p>{{trans('lang.complaint_resolved')}}</p>";
                var sendEmailStatus = await sendEmail(url, subject, message, email);
                if (sendEmailStatus) {

                    window.location.reload();
                } else {
                    window.location.reload();
                }
            } else {
                window.location.reload();
            }

        });
    })
    async function sendEmail(url, subject, message, recipients) {

        var checkFlag = false;

        await $.ajax({

            type: 'POST',
            data: {
                subject: subject,
                message: btoa(message),
                recipients: recipients
            },
            url: url,
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                checkFlag = true;
            },
            error: function (xhr, status, error) {
                checkFlag = true;
            }
        });

        return checkFlag;

    }

</script>

@endsection
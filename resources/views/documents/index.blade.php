@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.all_document_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.document_table')}}</li>
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
                                        class="fa fa-list mr-2"></i>{{trans('lang.document_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/documents/save/0') !!}"><i
                                        class="fa fa-plus mr-2"></i>{{trans('lang.document_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                       
                        <div class="error_top"></div>
                        <div class="table-responsive m-t-10">
                            <table id="documentTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <?php if (in_array('document.delete', json_decode(@session('user_permissions')))) { ?>

                                            <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                        class="do_not_delete" href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>
                                        <?php } ?>
                                        <th>{{trans('lang.document_title')}}</th>
                                        <th>{{trans('lang.enable')}}</th>
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
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var ref = database.collection('documents').orderBy('id', 'desc');
    var allUser = database.collection('users');
    var append_list = '';
    var deleteMsg = "{{trans('lang.delete_alert')}}";
    var deleteSelectedRecordMsg = "{{trans('lang.selected_delete_alert')}}";
    var docDeleteAlert = "{{trans('lang.doc_delete_alert')}}";

    var user_permissions = '<?php echo @session('user_permissions') ?>';

    user_permissions = JSON.parse(user_permissions);

    var checkDeletePermission = false;

    if ($.inArray('document.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }

    $(document).ready(function () {
        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#overlay").show();
        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.get().then(async function (snapshots) {
            html = '';
            if (snapshots.docs.length > 0) {
                html = await buildHTML(snapshots);
            }

            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
            }

            if (checkDeletePermission) {
                $('#documentTable').DataTable({
                    columnDefs: [{ orderable: false, targets: [0, 3] }],
                    order: [[1, 'asc']],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true,

                });
            } else {
                $('#documentTable').DataTable({
                    columnDefs: [{ orderable: false, targets: [2] }],
                    order: [[0, 'asc']],
                    "language": {
                        "zeroRecords": "{{trans("lang.no_record_found")}}",
                        "emptyTable": "{{trans("lang.no_record_found")}}"
                    },
                    responsive: true,

                });
            }

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
        newdate = '';
        var id = val.id;
        var route1 = '{{route("documents.save",":id")}}';
        route1 = route1.replace(':id', id);
        var trroute1 = '';
        trroute1 = trroute1.replace(':id', id);
        if (checkDeletePermission) {

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';
        }
        html = html + '<td><a href="' + route1 + '">' + val.title + '</a></td>';
        if (val.enable) {
            html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        } else {
            html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
        }
        html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';

        if (checkDeletePermission) {

            html = html + '<a id="' + val.id + '" class="do_not_delete" name="doc-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }

        html = html + '</td></tr>';
        return html;
    }

    $("#is_active").click(function () {
        $("#documentTable .is_open").prop('checked', $(this).prop('checked'));
    });

    $("#deleteAll").click(async function () {
        if ($('#documentTable .is_open:checked').length) {
            
            if (confirm(deleteSelectedRecordMsg)) {
                jQuery("#overlay").show();
                // Get all selected documents to be deleted
                const selectedDocs = $('#documentTable .is_open:checked').map(function () {
                    return {
                        dataId: $(this).attr('dataId'),
                    };
                }).get();

                for (let doc of selectedDocs) {
                    var dataId = doc.dataId;

                    let snapshots = await database.collection('documents').get();
                    if (snapshots.docs.length == 1) {
                        jQuery("#overlay").hide();
                        alert('{{trans("lang.atleast_one_document_should_be_there")}} ');
                        return false;  // Stop further processing
                    }

                    await database.collection('documents').doc(dataId).delete();

                    let verifySnapshots = await database.collection('user_verification').get();
                    for (let listval of verifySnapshots.docs) {
                        var data = listval.data();
                        var newDocArr = data.documents.filter(item => item.documentId !== dataId);
                        await database.collection('user_verification').doc(data.id).update({ 'documents': newDocArr });
                    }

                    var enableDocIds = await getDocId();
                    let userSnapshots = await database.collection('users').where('isVerify', '==', false).get();
                    if (userSnapshots.docs.length > 0) {
                        var verification = await userDocVerification(enableDocIds, userSnapshots);
                        if (verification) {
                            window.location.reload();
                        }
                    } else {
                        window.location.reload();
                    }

                }
                jQuery("#overlay").hide();

            } else {
                return false;
            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });

    $(document).on("click", "input[name='isEnabled']", function (e) {
        
        var ischeck = $(this).is(':checked');
        var id = $(this).attr('id');
        database.collection('documents').where('enable', "==", true).get().then(function (snapshots) {
            if (ischeck == false && snapshots.docs.length == 1) {
                $("#" + id).prop('checked', true);
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>" + docDeleteAlert + "</p>");
                window.scrollTo(0, 0);
                return false;
            } else {
                jQuery("#overlay").show();
                database.collection('documents').doc(id).update({
                    'enable': ischeck ? true : false
                }).then(async function (result) {
                    var enableDocIds = await getDocId();
                    if (ischeck == false) {
                        allUser = allUser.where('isVerify', '==', false);
                    }
                    await allUser.get().then(async function (snapshotsUser) {
                        if (snapshotsUser.docs.length > 0) {
                            var verification = await userDocVerification(enableDocIds, snapshotsUser);
                            if (verification) {
                                jQuery("#overlay").hide();
                                window.location.href = '{{ route("documents")}}';
                            }
                        } else {
                            jQuery("#overlay").hide();
                            window.location.href = '{{ route("documents")}}';
                        }
                    })
                });
            }
        });
    });


    $(document).on("click", "a[name='doc-delete']", async function (e) {
        if (confirm(deleteMsg)) {
            
            var id = $(this).attr('id');
            jQuery("#overlay").show();
            await database.collection('documents').get().then(async function (snapshots) {
                if (snapshots.docs.length == 1) {
                    alert('{{trans("lang.atleast_one_document_should_be_there")}}');
                    return false;
                } else {
                    database.collection('documents').doc(id).delete().then(async function (result) {
                        await database.collection('user_verification').get().then(async function (snapshots) {
                            snapshots.docs.forEach(async listval => {
                                var data = listval.data();
                                var newDocArr = data.documents.filter(item => item.documentId !== id);
                                await database.collection('user_verification').doc(data.id).update({ 'documents': newDocArr });
                            })
                        })
                        var enableDocIds = await getDocId();
                        await allUser.where('isVerify', '==', false).get().then(async function (snapshotsUser) {
                            if (snapshotsUser.docs.length > 0) {
                                var verification = await userDocVerification(enableDocIds, snapshotsUser);
                                if (verification) {
                                    jQuery("#overlay").hide();
                                    window.location.href = '{{ route("documents")}}';
                                }
                            } else {
                                jQuery("#overlay").hide();
                                window.location.href = '{{ route("documents")}}';
                            }
                        })
                    });

                }
            });
        } else {
            return false;
        }
    });

    async function getDocId() {
        var enableDocIds = [];
        await database.collection('documents').where('enable', "==", true).get().then(async function (snapshots) {
            await snapshots.forEach((doc) => {
                enableDocIds.push(doc.data().id);
            });
        });
        return enableDocIds;
    }

    async function userDocVerification(enableDocIds, snapshotsUser) {
        var isCompleted = false;
        await Promise.all(snapshotsUser.docs.map(async (user) => {
            await database.collection('user_verification').doc(user.id).get().then(async function (docrefSnapshot) {
                if (docrefSnapshot.data() && docrefSnapshot.data().documents.length > 0) {
                    var userDocId = await docrefSnapshot.data().documents.filter((doc) => doc.verified == true).map((docData) => docData.documentId);
                    if (userDocId.length >= enableDocIds.length) {
                        await database.collection('users').doc(user.id).update({ 'isVerify': true });
                    } else {
                        await enableDocIds.forEach(async (docId) => {
                            if (!userDocId.includes(docId)) {
                                await database.collection('users').doc(user.id).update({ 'isVerify': false });
                            }
                        });
                    }
                } else {
                    await database.collection('users').doc(user.id).update({ 'isVerify': false });
                }
            });
            isCompleted = true;
        }));
        return isCompleted;
    }
</script>

@endsection
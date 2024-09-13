@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.document_details')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('users.index') !!}">{{trans('lang.user_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.document_details')}}</li>
            </ol>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active user-name"
                                    href="{!! url()->current() !!}">{{trans('lang.document_details')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                      

                        <div class="table-responsive m-t-10 doc-body"></div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="max-width: 50%;">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <embed id="docImage" src="" frameBorder="0" scrolling="auto" height="100%"
                                                width="100%" style="height: 540px;"></embed>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{trans('lang.close')}}</button>
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
</div>


@endsection

@section('scripts')

<script>

    var id = "<?php echo $id; ?>";
    var database = firebase.firestore();
    var ref = database.collection('users').where("id", "==", id);
    var docsRef = database.collection('documents').where('enable', '==', true);
    var docref = database.collection('user_verification').doc(id);
    var back_photo = '';
    var front_photo = '';
    var backFileName = '';
    var frontFileName = '';
    var backFileOld = '';
    var frontFileOld = '';

    var fcmToken = "";

    $(document).ready(async function () {
        jQuery("#overlay").show();
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var img = button.data('image');
            var modal = $(this);
            modal.find('#docImage').attr('src', img);
        });
        ref.get().then(async function (snapshots) {
            var user = snapshots.docs[0].data();

            if (user.hasOwnProperty('fcmToken') && user.fcmToken != "" && user.fcmToken != null) {
                fcmToken = user.fcmToken;
            }
            $(".user-name").text(user.firstName + ' ' + user.lastName + "'s" + " {{trans('lang.document_details')}}")

        });
        var html = '';

        var count = 0;

        await docsRef.get().then(async function (docSnapshot) {
            html += '<table id="taxTable" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">';
            html += "<thead>";
            html += '<tr>';
            html += '<th>Name</th>';
            html += '<th>Status</th>';
            html += '<th>Action</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            html += '</tbody>';
            html += '</table>';

            if (docSnapshot.docs.length) {
                var documents = docSnapshot.docs;

                documents.forEach((ele) => {
                    var doc = ele.data();
                    var docRefs = database.collection('user_verification').doc(id);
                    docRefs.get().then(async function (docrefSnapshot) {

                        var docRef = docrefSnapshot.data() && docrefSnapshot.data().documents ? docrefSnapshot.data().documents.filter(docId => docId.documentId == doc.id)[0] : [];

                        var trhtml = '';
                        trhtml += '<tr>';


                        if (docRef && docRef.hasOwnProperty('backImage') && docRef.hasOwnProperty('frontImage')) {
                            if (docRef.backImage != '' && docRef.frontImage != '' && docRef.backImage != null && docRef.frontImage != null && doc.backSide && doc.frontSide) {
                                trhtml += '<td>' + doc.title + '&nbsp;&nbsp;<a href="#" class="badge badge-info" data-toggle="modal" data-target="#exampleModal" data-image="' + docRef.frontImage + '" data-id="front" class="open-image">{{trans('lang.view_front_image')}}</a>&nbsp;<a href="#" class="badge badge-info" data-toggle="modal" data-target="#exampleModal"  data-image="' + docRef.backImage + '" data-id="back" class="open-image">{{trans('lang.view_back_image')}}</a></td>';
                            } else if (docRef.backImage != '' && docRef.backImage != null && doc.backSide) {
                                trhtml += '<td>' + doc.title + '&nbsp;<a href="#" data-toggle="modal" class="badge badge-info" data-target="#exampleModal" data-id="back" data-image="' + docRef.backImage + '" class="open-image">{{trans('lang.view_back_image')}}</a></td>';
                            } else if (docRef.frontImage != '' && docRef.frontImage != null && doc.frontSide) {
                                trhtml += '<td>' + doc.title + '&nbsp;<a href="#" data-toggle="modal" class="badge badge-info" data-target="#exampleModal" data-id="front" class="open-image" data-image="' + docRef.frontImage + '">{{trans('lang.view_front_image')}}</a></td>';
                            } else {
                                trhtml += '<td>' + doc.title + '</td>';

                            }
                        } else {
                            trhtml += '<td>' + doc.title + '</td>';
                        }


                        var status = docRef && docRef.status == "approved" ? 'approved' : ((docRef && docRef.status == "rejected") ? "rejected" : ((docRef && docRef.status == "uploaded") ? 'uploaded' : 'pending'));

                        var display_status = '';

                        if (status == "approved") {
                            display_status = '<span class="badge badge-success py-2 px-3" style="text-transform:capitalize">' + status + '</span>';
                        } else if (status == "rejected") {
                            display_status = '<span class="badge badge-danger py-2 px-3" style="text-transform:capitalize">' + status + '</span>';
                        } else if (status == "uploaded") {
                            display_status = '<span class="badge badge-primary py-2 px-3" style="text-transform:capitalize">' + status + '</span>';
                        } else if (status == "pending") {
                            display_status = '<span class="badge badge-warning py-2 px-3" style="text-transform:capitalize">' + status + '</span>';
                        }

                        trhtml += '<td>' + display_status + '</td>';
                        trhtml += '<td class="action-btn">';
                        trhtml += '<a href="' + (`/users/document/upload/` + id.trim() + `/` + doc.id.trim()) + '" data-id="' + doc.id + '"><i class="fa fa-edit"></i></a>&nbsp;';

                        if (status !== 'pending') {

                            if (status == "rejected") {
                                trhtml += '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success verify-doc" id="approve-doc" data-title="' + doc.title + '"  data-id="' + doc.id + '">{{trans('lang.approve')}}</a>';

                            } else if (status == "approved") {
                                trhtml += '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-danger verify-doc" id="disapprove-doc" data-title="' + doc.title + '"  data-id="' + doc.id + '">{{trans('lang.reject')}}</a>';

                            } else {
                                trhtml += '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success verify-doc" id="approve-doc" data-title="' + doc.title + '"  data-id="' + doc.id + '">{{trans('lang.approve')}}</a>&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-danger verify-doc" id="disapprove-doc" data-title="' + doc.title + '"  data-id="' + doc.id + '">{{trans('lang.reject')}}</a>';

                            }
                        }
                        trhtml += '</td>';
                        trhtml += '</tr>';
                        $("tbody").append(trhtml);

                        count = count + 1;

                        if (count == docSnapshot.docs.length) {
                            $('#taxTable').DataTable({
                                order: [[0, 'asc']],
                                columnDefs: [
                                    { orderable: false, targets: [1, 2] }
                                ],
                            });

                        }
                    })
                });
            }
            $(".doc-body").append(html);
            jQuery("#overlay").hide();

        });

    });

    $(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });

    $(document).on('click', '.verify-doc', function () {

        jQuery("#overlay").show();
        var status = $(this).attr('id') == "approve-doc" ? "approved" : "rejected";
        var verified=false;
        if(status=='approved'){
            verified=true;
        }
        var docId = $(this).attr('data-id');
        var docTitle = $(this).attr('data-title');
        var docRefsTmp = database.collection('user_verification').doc(id);
        docRefsTmp.get().then(async function (docrefSnapshot) {
            var keydataId = docrefSnapshot.data() && docrefSnapshot.data().documents ? docrefSnapshot.data().documents.findIndex((doc) => doc.documentId == docId) : 0;
            database.collection('user_verification').doc(id)
                .get().then((doc) => {
                    var objects = doc.data().documents;
                    var objectToupdate = objects[keydataId];
                    objectToupdate.status = status;
                    objectToupdate.verified = verified;
                    objects[keydataId] = objectToupdate;
                    database.collection('user_verification').doc(id).update({
                        documents: objects
                    }).then(async function () {
                        var enableDocIds = await getDocId();
                        await ref.get().then(async function (snapshotUser) {
                            if (snapshotUser.docs.length > 0) {
                                var verification = await UserDocVerification(enableDocIds, snapshotUser);
                                if (verification) {
                                    if (status == "rejected") {
                                        var sendNotificationStatus = await sendNotification(fcmToken, 'Rejected  your document', 'Admin is Rejected your ' + docTitle + ' . Please submit again.');
                                        if (sendNotificationStatus) {
                                            jQuery("#overlay").hide();
                                            window.location.reload();
                                        }
                                    } else {
                                        jQuery("#overlay").hide();
                                        window.location.reload();
                                    }
                                }
                            } else {
                                jQuery("#overlay").hide();
                                window.location.reload();
                            }
                        })
                        $('li').removeClass('active');
                        $("#documents-tab").addClass('active');
                        $("#documents-tab").click();
                        $(".error_top").html("");
                    }).catch(function (error) {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + error + "</p>");
                    });
                })
        });

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
    async function UserDocVerification(enableDocIds, snapshotUser) {
        var isCompleted = false;
        await Promise.all(snapshotUser.docs.map(async (user) => {
            await database.collection('user_verification').doc(user.id).get().then(async function (docrefSnapshot) {
                if (docrefSnapshot.data() && docrefSnapshot.data().documents.length > 0) {
                    var userDocId = await docrefSnapshot.data().documents.filter((doc) => doc.status == 'approved').map((docData) => docData.documentId);
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
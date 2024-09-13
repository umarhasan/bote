@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.upload_document')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{!! route('users.index') !!}">{{trans('lang.user_plural')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.upload_document')}}</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card  pb-4">
            <div class="card-body">

                <div class="error_top"></div>
                <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner doc-body">
                    </div>
                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary save-doc"><i class="fa fa-save"></i> {{
    trans('lang.save')}}
                    </button>
                    <a href="{{url('users/document-list/' . $userId)}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{
    trans('lang.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script>

        var docId = "{{$id}}";
        var id = "{{$userId}}";

        var userRef = database.collection('users').where('id', '==', id);

        var database = firebase.firestore();
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        var docref = database.collection('user_verification').doc(id);
        var requestUrl = "{{request()->is('users/document-list/*')}}";
        var back_photo = '';
        var front_photo = '';
        var backFileName = '';
        var frontFileName = '';
        var backFileOld = '';
        var frontFileOld = '';
        var defaultImg = "{{ asset('/images/default_user.png') }}";

        $(document).ready(function () {
            jQuery("#overlay").show();

            var html = '';
            var docRef = database.collection('documents').doc(docId.trim());
            var userDocRef = database.collection('user_verification').doc(id);
            docRef.get().then(async function (Snapshot) {
                var docRef = Snapshot.data();
                userDocRef.get().then(async function (docrefSnapshot) {
                    var userDocRef = docrefSnapshot.data() && docrefSnapshot.data().documents ? docrefSnapshot.data().documents.filter((doc) => doc.documentId.trim() == docId.trim())[0] : [];
                    var keydata = docrefSnapshot.data() && docrefSnapshot.data().documents ? docrefSnapshot.data().documents.findIndex((doc) => doc.documentId.trim() == docId.trim()) : '';
                    if (docRef.enable) {
                        html += '<fieldset><legend>' + docRef.title + '</legend>';
                        html += '<div class="form-group row width-100">';
                        html += '<label class="col-3 control-label">' + "{{trans('lang.document_number')}}" + '<span class="required-field"></span></label><div class="col-7" class="document_number"><input type="text" class="form-control document_number" id="document_number" value="' + (userDocRef && userDocRef.documentNumber ? userDocRef.documentNumber : '') + '"></div></div>';

                        if (docRef.backSide) {
                            html += '<div class="form-group row width-50">';
                        } else {
                            html += '<div class="form-group row width-100">';
                        }
                        if (docRef.frontSide) {
                            html += '<input type="hidden" name="frontSide" id="frontSide" value="' + (docRef.frontSide ? true : false) + '">';
                            front_photo = userDocRef && userDocRef.frontImage ? userDocRef.frontImage : '';
                            frontFileOld = userDocRef && userDocRef.frontImage ? userDocRef.frontImage : '';
                            html += '<label class="col-3 control-label">' + "{{trans('lang.front_image')}}" + '<span class="required-field"></span></label><div class="col-7"><input type="file" onChange="handleFrontFileSelect(event)" class="form-control image"><div class="placeholder_img_thumb front_image"><span class="image-item"><span class="remove-btn" id="front_image"><i class="fa fa-remove"></i></span><img class="rounded" style="width:200px; height:auto" src="' + (userDocRef && userDocRef.frontImage ? userDocRef.frontImage : defaultImg) + '" alt="image"></span></div><div id="uploding_image"></div></div></div>';
                        }

                        if (docRef.backSide) {
                            html += '<input type="hidden" name="backSide" id="backSide" value="' + (docRef.backSide ? true : false) + '">';
                            back_photo = userDocRef && userDocRef.backImage ? userDocRef.backImage : '';
                            backFileOld = userDocRef && userDocRef.backImage ? userDocRef.backImage : '';
                            html += '<div class="form-group row width-50"><label class="col-3 control-label">' + "{{trans('lang.back_image')}}" + '<span class="required-field"></span></label><div class="col-7"><input type="file" onChange="handleBackFileSelect(event)" class="form-control image"><div class="placeholder_img_thumb back_image"><span class="image-item"><span class="remove-btn" id="back_image"><i class="fa fa-remove"></i></span><img class="rounded" style="width:200px; height:auto" src="' + (userDocRef && userDocRef.backImage ? userDocRef.backImage : defaultImg) + '" alt="image"></span></div><div id="uploding_image"></div></div></div>';
                        }

                        html += '<input type="hidden" name="docId" id="docId" value="' + docRef.id + '">';
                        html += '<input type="hidden" name="keydata" id="keydata" value="' + (keydata ? keydata : 0) + '">';
                        html += '<input type="hidden" name="isAdd" id="isAdd" value="' + (userDocRef && userDocRef.documentId ? false : true) + '">';
                        html += '</fieldset>';
                    }
                    $(".doc-body").html(html);
                    jQuery("#overlay").hide();
                })
            });
        })

        async function storeImageData() {
            var newPhoto = [];
            try {
                if (frontFileOld != "" && front_photo != frontFileOld) {
                    var frontFileOldRef = await storage.refFromURL(frontFileOld);
                    imageBucket = frontFileOldRef.bucket;
                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                    if (imageBucket == envBucket) {

                        await frontFileOldRef.delete().then(() => {
                            console.log("Old file deleted!")
                        }).catch((error) => {
                            console.log("ERR File delete ===", error);
                        });
                    } else {
                        console.log('Bucket not matched');
                    }
                }
                if (front_photo != frontFileOld) {
                    front_photo = front_photo.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(frontFileName).putString(front_photo, 'base64', { contentType: 'image/jpg' });
                    var downloadURL = await uploadTask.ref.getDownloadURL();
                    newPhoto['front_img'] = downloadURL;
                    front_photo = downloadURL;
                } else {
                    newPhoto['front_img'] = front_photo;
                }
                if (backFileOld != "" && back_photo != backFileOld) {
                    var backFileOldRef = await storage.refFromURL(backFileOld);
                    imageBucket = backFileOldRef.bucket;
                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                    if (imageBucket == envBucket) {

                        await backFileOldRef.delete().then(() => {
                            console.log("Old file deleted!")
                        }).catch((error) => {
                            console.log("ERR File delete ===", error);
                        });
                    } else {
                        console.log('Bucket not matched');
                    }

                }
                if (back_photo != backFileOld) {
                    back_photo = back_photo.replace(/^data:image\/[a-z]+;base64,/, "")
                    var uploadTask = await storageRef.child(backFileName).putString(back_photo, 'base64', { contentType: 'image/jpg' });
                    var downloadURL = await uploadTask.ref.getDownloadURL();
                    newPhoto['back_img'] = downloadURL;
                    back_photo = downloadURL;
                } else {
                    newPhoto['back_img'] = back_photo;
                }
            } catch (error) {
                console.log("ERR ===", error);
            }
            return newPhoto;
        }

        function handleFrontFileSelect(evt) {
            var f = evt.target.files[0];
            var validExtensions = ['jpg', 'jpeg', 'png'];
            var fileExtension = f.name.split('.').pop().toLowerCase();

            if (validExtensions.indexOf(fileExtension) === -1) {
                alert("{{trans('lang.invalid_file_extension')}}");
                return;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    var filePayload = e.target.result;
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')
                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    front_photo = filePayload;
                    frontFileName = filename;
                    $(".front_image").empty();
                    $(".front_image").append('<span class="image-item"><span class="remove-btn" id="front_image"><i class="fa fa-remove"></i></span><img class="rounded" style="width:200px; height:auto" src="' + filePayload + '" alt="image"></span>');
                };
            })(f);
            reader.readAsDataURL(f);
        }

        function handleBackFileSelect(evt) {
            var f = evt.target.files[0];
            var validExtensions = ['jpg', 'jpeg', 'png'];
            var fileExtension = f.name.split('.').pop().toLowerCase();

            if (validExtensions.indexOf(fileExtension) === -1) {
                alert("{{trans('lang.invalid_file_extension')}}");
                return;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    var filePayload = e.target.result;
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')
                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    back_photo = filePayload;
                    backFileName = filename;
                    $(".back_image").empty();
                    $(".back_image").append('<span class="image-item"><span class="remove-btn" id="back_image"><i class="fa fa-remove"></i></span><img class="rounded" style="width:200px; height:auto" src="' + filePayload + '" alt="image"></span>');
                };
            })(f);
            reader.readAsDataURL(f);
        }

        $(document).on('click', '.save-doc', function () {

            var status = 'approved';
            var verified = true;
            var docId = $("#docId").val();
            var isAdd = $("#isAdd").val();
            var keydata = $("#keydata").val();
            var backSide = $("#backSide").val();
            var frontSide = $("#frontSide").val();
            var documentNumber = $("#document_number").val();

            if (documentNumber && documentNumber == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.document_number_help')}}</p>");
                window.scrollTo(0, 0);
            }
            else if (backSide && back_photo == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.document_back_side_help')}}</p>");
                window.scrollTo(0, 0);
            } else if (frontSide && front_photo == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.document_front_side_help')}}</p>");
                window.scrollTo(0, 0);
            } else {
                jQuery("#overlay").show();

                storeImageData().then(IMG => {

                    if (isAdd == "true") {
                        database.collection('user_verification').doc(id).set({
                            id: id,
                            documents: firebase.firestore.FieldValue.arrayUnion({
                                backImage: IMG.back_img ? IMG.back_img : '',
                                documentId: docId.trim(),
                                frontImage: IMG.front_img ? IMG.front_img : '',
                                status: status,
                                verified: verified,
                                documentNumber: documentNumber

                            })
                        }, { merge: true }).then(async function (result) {
                            var enableDocIds = await getDocId();
                            await userRef.get().then(async function (snapshotsUser) {
                                if (snapshotsUser.docs.length > 0) {

                                    var verification = await userDocVerification(enableDocIds, snapshotsUser);
                                    if (verification) {

                                        jQuery("#overlay").hide();
                                        window.location.href = "/users/document-list/" + id;
                                    }
                                } else {

                                    jQuery("#overlay").hide();
                                    window.location.href = "/users/document-list/" + id;
                                }
                            })
                            $('li').removeClass('active');
                            $("#documents-tab").addClass('active');
                            $("#documents-tab").click();
                            $(".error_top").html("");
                            jQuery("#overlay").hide();
                        }).catch(function (error) {
                            jQuery("#overlay").hide();
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                        });
                    } else {
                        database.collection('user_verification').doc(id)
                            .get().then((doc) => {
                                var objects = doc.data().documents;
                                var objectToupdate = objects[keydata];
                                objectToupdate.backImage = IMG.back_img ? IMG.back_img : '';
                                objectToupdate.documentId = docId.trim();
                                objectToupdate.frontImage = IMG.front_img ? IMG.front_img : '';
                                objectToupdate.status = status;
                                objectToupdate.verified = verified;
                                objectToupdate.documentNumber = documentNumber;
                                objects[keydata] = objectToupdate;
                                database.collection('user_verification').doc(id).update({
                                    documents: objects
                                }).then(async function () {

                                    var enableDocIds = await getDocId();
                                    await userRef.get().then(async function (snapshotsUser) {
                                        if (snapshotsUser.docs.length > 0) {
                                            var verification = await userDocVerification(enableDocIds, snapshotsUser);
                                            if (verification) {
                                                jQuery("#overlay").hide();
                                                window.location.href = "/users/document-list/" + id;
                                            }
                                        } else {
                                            jQuery("#overlay").hide();
                                            window.location.href = "/users/document-list/" + id;
                                        }
                                    })
                                    $('li').removeClass('active');
                                    $("#documents-tab").addClass('active');
                                    $("#documents-tab").click();
                                    $(".error_top").html("");
                                    jQuery("#overlay").hide();

                                }).catch(function (error) {
                                    jQuery("#overlay").hide();
                                    $(".error_top").show();
                                    $(".error_top").html("");
                                    $(".error_top").append("<p>" + error + "</p>");
                                });
                            })
                    }
                }).catch(err => {
                    jQuery("#overlay").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + err + "</p>");
                    window.scrollTo(0, 0);
                });
            }
        });
        $(document).on('click', '.remove-btn', function () {
            var currentId = $(this).attr('id')
            if (currentId == "back_image") {
                $(".back_image").empty();
                back_photo = '';
                backFileName = '';
            }
            if (currentId == "front_image") {
                $(".front_image").empty();
                front_photo = '';
                frontFileName = '';
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
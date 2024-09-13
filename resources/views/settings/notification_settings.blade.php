@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.notification_settings')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.notification_settings')}}</li>
            </ol>
        </div>


    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                    style="display: none;">{{trans('lang.processing')}}</div>
                <div class="error_top"></div>

                <div class="terms-cond restaurant_payout_create row">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <legend>{{trans('lang.notification_settings')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-5 control-label">{{trans('lang.sender_id')}}</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="sender_id">
                                </div>
                                <div class="form-text pl-3 text-muted">
                                    {{ trans("lang.notification_sender_id_help") }}
                                </div>
                            </div>

                            <div class="form-group row width-100">

                                <label class="col-3 control-label">{{trans('lang.upload_json_file')}}</label>
                                <input type="file" class="col-7 pb-2" onChange="handleUploadJsonFile(event)">
                                <div id="uploding_json_file"></div>
                                <div id="uploded_json_file"></div>
                                <div class="form-text pl-3 text-muted">
                                    {{ trans("lang.notification_json_file_help") }}
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_user_btn"><i class="fa fa-save"></i>
                        {{ trans('lang.save')}}</button>
                    <a href="{!! route('settings.notificationSettings') !!}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

    var database = firebase.firestore();
    var photo = "";
    var serviceJsonFile = '';

    var refNotificationSetting = database.collection('settings').doc("notification_settings");
    $(document).ready(function () {
        try {
            jQuery("#overlay").show();
            refNotificationSetting.get().then(async function (snapshots) {
                var notificationData = snapshots.data();
                if (notificationData == undefined) {
                    database.collection('settings').doc('notification_settings').set({});
                } else {
                    if (notificationData.senderId != '' && notificationData.senderId != null) {
                        $('#sender_id').val(notificationData.senderId);
                    }
                    if (notificationData.serviceJson != '' && notificationData.serviceJson != null) {
                        $('#uploded_json_file').html("<a href='" + notificationData.serviceJson + "' class='btn-link pl-3' target='_blank'>See Uploaded File</a>");
                        serviceJsonFile = notificationData.serviceJson;
                    }
                }
            });
            jQuery("#overlay").hide();
        } catch (error) {
            jQuery("#overlay").hide();
        }

        $(".create_user_btn").click(function () {

            var senderId = $('#sender_id').val();
           
            if (senderId == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.notification_sender_id_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (serviceJsonFile == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.notification_service_json_error')}}</p>");
                window.scrollTo(0, 0);
            } else {
                database.collection('settings').doc("notification_settings").update({
                    'senderId': senderId,
                    'serviceJson': serviceJsonFile,
                }).then(function (result) {
                    window.location.href = '{{ route("settings.notificationSettings")}}';
                })
            }
        })
    });
        function handleUploadJsonFile(evt) {

            var f = evt.target.files[0];
            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {

                    var filePayload = e.target.result;
                    var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    var uploadTask = firebase.storage().ref('/').child(filename).put(theFile);
                    uploadTask.on('state_changed', function (snapshot) {
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        jQuery("#uploding_json_file").text("File is uploading...");
                    }, function (error) {
                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploding_json_file").text("Upload is completed");
                            serviceJsonFile = downloadURL;
                            setTimeout(function () {
                                jQuery("#uploding_json_file").hide();
                            }, 3000);
                        });
                    });
                };
            })(f);
            reader.readAsDataURL(f);
        }

</script>
@endsection
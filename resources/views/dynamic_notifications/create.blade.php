@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.edit_notification')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ url('dynamic-notification') }}">{{trans('lang.dynamic_notification')}}</a></li>


                <li class="breadcrumb-item active">{{trans('lang.edit_notification')}}</li>


            </ol>
        </div>

    </div>
    <div>

        <div class="card-body">


            <div class="error_top" style="display:none"></div>

            <div class="success_top" style="display:none"></div>

            <div class="row restaurant_payout_create">

                <div class="restaurant_payout_create-inner">

                    <fieldset>
                        <legend>{{trans('lang.notification')}}</legend>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.type')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="type" readonly>
                            </div>
                        </div>
                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.subject')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="subject">
                            </div>
                        </div>



                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.message')}}</label>
                            <div class="col-7">
                                <textarea class="form-control" id="message"></textarea>
                            </div>
                        </div>

                    </fieldset>
                </div>

            </div>

        </div>
        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary send_message"><i class="fa fa-save"></i> {{
                trans('lang.save')}}
            </button>
            <a href="{{url('/dynamic-notification')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                trans('lang.cancel')}}</a>
        </div>

    </div>

    @endsection

    @section('scripts')

    <script>

        var requestId = "<?php echo $id; ?>";
        var database = firebase.firestore();
        var createdAt = firebase.firestore.FieldValue.serverTimestamp();
        var id = requestId;

        $(document).ready(function () {
            if (requestId != '') {
                var ref = database.collection('dynamic_notification').where('id', '==', id);
                jQuery("#overlay").show();
                ref.get().then(async function (snapshots) {
                    if (snapshots.docs.length) {
                        var np = snapshots.docs[0].data();
                        $("#message").val(np.message);
                        $("#subject").val(np.subject);


                        if (np.type == "booking_confirmed") {
                            type = "{{trans('lang.booking_confirmed')}}";

                        }
                        else if (np.type == "payment_successful") {
                            type = "{{trans('lang.payment_successful')}}";
                        }
                        else if (np.type == "feedback") {
                            type = "{{trans('lang.feedback')}}";
                        }
                        else if (np.type == "ride_completed") {
                            type = "{{trans('lang.ride_completed')}}";

                        }

                        $('#type').val(type);

                    }
                    jQuery("#overlay").hide();

                });
            }
        });

        $(".send_message").click(async function () {

            $(".success_top").hide();
            $(".error_top").hide();
            var message = $("#message").val();
            var subject = $("#subject").val();
            var type = $('#type').val();

            if (subject == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.please_enter_subject')}}</p>");
                window.scrollTo(0, 0);
                return false;
            } else if (message == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.please_enter_message')}}</p>");
                window.scrollTo(0, 0);
                return false;
            } else {
                jQuery("#overlay").show();
                database.collection('dynamic_notification').doc(id).update({

                    'subject': subject,
                    'message': message,


                }).then(function (result) {
                    jQuery("#overlay").hide();
                    $(".success_top").show();
                    $(".success_top").html("");
                    $(".success_top").append("<p>{{trans('lang.notification_updated_success')}}</p>");
                    window.scrollTo(0, 0);

                    window.location.href = '{{ route("dynamic-notification.index")}}';
                }).catch(function (error) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + error + "</p>");
                });


            }




        });



    </script>

    @endsection
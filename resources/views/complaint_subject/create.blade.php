@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.complaint_subject_create')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a
                        href="{!! route('complaint.subject.index') !!}">{{trans('lang.complaint_subject_list')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.complaint_subject_create')}}</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <div class="error_top"></div>

                <div class="row restaurant_payout_create">
                    <div class="restaurant_payout_create-inner">
                        <fieldset>
                            <legend>{{trans('lang.complaint_subject_create')}}</legend>

                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{trans('lang.title')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control title">
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{trans('lang.subject_for')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <select class="form-control subject_for" id="subject_for">
                                        <option value="publisher">{{trans('lang.publisher')}}</option>
                                        <option value="customer">{{trans('lang.customer')}}</option>
                                    </select>

                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary  create_subject_btn"><i class="fa fa-save"></i> {{
                        trans('lang.save')}}
                    </button>
                    <a href="{!! route('complaint.subject.index') !!}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{
                        trans('lang.cancel')}}</a>
                </div>

            </div>
        </div>
    </div>

</div>


@endsection

@section('scripts')

<script>
    var database = firebase.firestore();
    var customerArr = [];
    var publisherArr = [];
    var ref = database.collection('settings').doc('reasons');

    $(document).ready(function () {
        ref.get().then(async function (snapshots) {
            var data = snapshots.data();
            if (data == undefined) {
                database.collection('settings').doc('reasons').set({});
            } else {
                customerArr = data.customer;
                publisherArr = data.publisher;
            }
          
        });
    })
    $(".create_subject_btn").click(function () {


        var title = $(".title").val();
        var subject_for = $('#subject_for').val();


        if (title == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.enter_title_error')}}</p>");
        } else {
            if (subject_for == 'customer') {
                 customerArr.push(title);
            } else {
                publisherArr.push(title);
            }
            database.collection('settings').doc('reasons').update({
                'customer': customerArr,
                'publisher': publisherArr

            }).then(function (result) {
                window.location.href = '{{ route("complaint.subject.index")}}';
            }).catch(function (error) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>" + error + "</p>");
            });
        }
    });
</script>
@endsection
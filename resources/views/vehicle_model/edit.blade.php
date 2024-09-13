@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.model_edit')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a
                        href="{!! route('vehicle-model') !!}">{{trans('lang.vehicle_model_table')}}</a>
                </li>
                <li class="breadcrumb-item active">{{trans('lang.model_edit')}}</li>
            </ol>
        </div>
    </div>
    <div class="card-body">

        <div class="error_top"></div>

        <div class="row restaurant_payout_create">
            <div class="restaurant_payout_create-inner">
                <fieldset>
                    <legend>{{trans('lang.vehicle_model')}}</legend>

                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{trans('lang.model_name')}}<span
                                class="required-field"></span></label>
                        <div class="col-7">
                            <input type="text" class="form-control model_name">
                            <div class="form-text text-muted">
                                {{ trans("lang.model_name_help") }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row width-100">
                        <label class="col-3 control-label">{{trans('lang.brand_name')}}<span
                                class="required-field"></span></label>
                        <div class="col-7">
                            <select class="form-control brand" id="brand">
                                <option value="" disabled selected>{{trans('lang.select_brand')}}</option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group row width-100">
                        <div class="form-check">
                            <input type="checkbox" class="model_active" id="active">
                            <label class="col-3 control-label" for="active">{{trans('lang.enable')}}</label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary  create_vehicle_btn"><i class="fa fa-save"></i> {{
                trans('lang.save')}}
            </button>
            <a href="{!! route('vehicle-model') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{
                trans('lang.cancel')}}</a>
        </div>

    </div>

</div>
@endsection

@section('scripts')

<script>

    var database = firebase.firestore();
    var id = "{{$id}}";
    var refBrand = database.collection('vehicle_brand').where('enable', '==', true);
    var ref = database.collection('vehicle_model').where('id', '==', id);
    $(document).ready(function () {
        jQuery("#overlay").show();

        refBrand.get().then(async function (snapshots) {
            snapshots.docs.forEach(element => {
                var data = element.data();
                $('#brand').append($("<option></option>")
                    .attr("value", data.id)
                    .text(data.name));
            });
        })
        ref.get().then(async function (snapshots) {
            var data = snapshots.docs[0].data();

            $(".model_name").val(data.name);
            $('#brand').val(data.brandId);
            if (data.enable) {
                $('.model_active').prop('checked', true);
            }

            jQuery("#overlay").hide();
        });
        $('.vehicle_model_menu').addClass('active');

    });

    $(".create_vehicle_btn").click(function () {

        var name = $(".model_name").val();
        var brand = $('#brand').val();
        var enable = false;

        if ($(".model_active").is(':checked')) {
            enable = true;
        }

        if (name == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.model_name_error')}}</p>");
            window.scrollTo(0, 0);
        } else if (brand == '') {
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.select_brand')}}</p>");
            window.scrollTo(0, 0);
        }
        else {
            jQuery("#overlay").show();

            database.collection('vehicle_model').doc(id).update({
                'name': name,
                'brandId': brand,
                'id': id,
                'enable': enable,
            }).then(function (result) {
                jQuery("#overlay").hide();

                window.location.href = '{{ route("vehicle-model")}}';
            }).catch(function (error) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>" + error + "</p>");
            });
        }
    });


</script>
@endsection
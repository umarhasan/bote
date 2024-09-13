@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.app_setting_global')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.app_setting_global')}}</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                    style="display: none;">{{trans('lang.processing')}}</div>
                <div class="error_top" style="display:none"></div>

                <div class="row restaurant_payout_create">

                    <div class="restaurant_payout_create-inner">

                        <fieldset>
                            <legend>{{trans('lang.general_settings')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.app_version')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control" name="app_version" id="app_version">
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.app_logo')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="file" onChange="handleLogoFileSelect(event)" class="form-control image"
                                        id="appLogo">
                                    <div class="placeholder_img_thumb app_logo_image"></div>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.app_favicon_logo')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="file" onChange="handleFavIconFileSelect(event)"
                                        class="form-control image" id="faviconLogo">
                                    <div class="placeholder_img_thumb app_favicon_logo_image"></div>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.app_banner')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="file" onChange="handleBannerFileSelect(event)"
                                        class="form-control image" id="bannerImage">
                                    <div class="placeholder_img_thumb app_banner_image"></div>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{trans('lang.admin_panel_color_settings')}}</label>
                                <input type="color" class="ml-3" name="admin_color" id="admin_color">
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-5 control-label">{{trans('lang.app_color_settings')}}</label>
                                <input type="color" class="ml-3" name="app_color" id="app_color">
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>{{trans('lang.google_map_api_key_title')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.google_map_api_key')}}</label>
                                <div class="col-7">
                                    <input type="password" class="form-control" name="map_key" id="map_key">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{trans('lang.distance_type')}}</label>
                                <div class="col-7">
                                    <select name="delivery_distance" id="delivery_distance" class="form-control">
                                        <option value="km">{{trans('lang.km')}}</option>
                                        <option value="miles">{{trans('lang.miles')}}</option>

                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>{{trans('lang.wallet_settings')}}</legend>
                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{ trans('lang.minimum_deposit_amount')}}</label>
                                <div class="col-7">
                                    <div class="control-inner">
                                        <input type="number" class="form-control minimum_deposit_amount">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{ trans('lang.minimum_withdrawal_amount')}}</label>
                                <div class="col-7">
                                    <div class="control-inner">
                                        <input type="number" class="form-control minimum_withdrawal_amount">
                                    </div>
                                </div>
                            </div>
                        </fieldset>


                        <fieldset>
                            <legend>{{trans('lang.ride_distance')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{trans('lang.radius')}}</label>
                                <div class="col-7">
                                    <input type="number" name="radius" id="radius" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{trans('lang.price_variation')}}</label>
                                <div class="col-7">
                                    <input type="number" name="price_variation" id="price_variation"
                                        class="form-control price_variation">
                                </div>
                                <div class="form-text text-muted pl-3">
                                    {{ trans("lang.price_variation_help") }}
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>{{trans('lang.email_setting')}}</legend>


                            <div class="form-group row width-50">

                                <label class="col-3 control-label">{{trans('lang.smtp')}}
                                    {{trans('lang.from_name')}}</label>

                                <div class="col-7">

                                    <input type="text" class="form-control from_name">

                                </div>

                            </div>

                            <div class="form-group row width-50">

                                <label class="col-3 control-label">{{trans('lang.smtp')}} {{trans('lang.host')}}</label>

                                <div class="col-7">

                                    <input type="text" class="form-control host">

                                </div>

                            </div>

                            <div class="form-group row width-50">

                                <label class="col-3 control-label">{{trans('lang.smtp')}} {{trans('lang.port')}}</label>

                                <div class="col-7">

                                    <input type="number" class="form-control port">

                                </div>

                            </div>

                            <div class="form-group row width-50">

                                <label class="col-3 control-label">{{trans('lang.smtp_user_name')}}</label>

                                <div class="col-7">

                                    <input type="text" class="form-control user_name">

                                </div>

                            </div>

                            <div class="form-group row width-50">

                                <label class="col-3 control-label">{{trans('lang.smtp')}}
                                    {{trans('lang.password')}}</label>

                                <div class="col-7">

                                    <input type="password" class="form-control password">

                                </div>

                            </div>

                        </fieldset>


                        <fieldset>
                            <legend>{{trans('lang.contact_us')}}</legend>
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.email_subject')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" class="form-control" name="contact_us_subject"
                                        id="contact_us_subject">
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-4 control-label">{{trans('lang.email')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" name="contact_us_email" id="contact_us_email"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <label class="col-4 control-label">{{trans('lang.contact_us_phone')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" name="contact_us_phone_number" id="contact_us_phone_number"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{trans('lang.address')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <textarea name="contact_us_address" id="contact_us_address"
                                        class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-4 control-label">{{trans('lang.support_url')}}<span
                                        class="required-field"></span></label>
                                <div class="col-7">
                                    <input type="text" name="support_url" id="support_url" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary save_global_settings_btn"><i class="fa fa-save"></i>
                        {{trans('lang.save')}}</button>
                    <a href="{{url('/dashboard')}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}
                    </a>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')

    <script>
        var app_logo_image = '';
        var app_favicon_logo_image = '';
        var appLogoImagePath = '';
        var appFavIconImagePath = '';
        var logoFileName = '';
        var favIconFileName = '';
        var app_banner_image = '';
        var bannerFileName = '';
        var appBannerImagePath = '';
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();

        var database = firebase.firestore();
        var globalKey = database.collection('settings').doc("globalKey");
        var globalValue = database.collection('settings').doc("globalValue");
        var contactUsRef = database.collection('settings').doc("contact_us");
        var logoRef = database.collection('settings').doc("logo");
        var refEmailSetting = database.collection('settings').doc("emailSetting");
        var global = database.collection('settings').doc("global");
        var refCurrency = database.collection('currency').where('enable', '==', true);
        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            $(".currentCurrency").text(currencyData.symbol);
        });
        $(document).ready(function () {

            jQuery("#overlay").show();

            globalKey.get().then(async function (snapshots) {
                var globalKeyData = snapshots.data();

                try {
                    if (globalKeyData.googleMapKey) {
                        $("#map_key").val(globalKeyData.googleMapKey);
                    }

                    if (globalKeyData.distanceType) {
                        $('#delivery_distance').val(globalKeyData.distanceType);
                    }
                } catch (error) {

                }
            })

            global.get().then(async function (snapshots) {
                var globalSetting = snapshots.data();
                if (globalSetting.appVersion) {
                    $("#app_version").val(globalSetting.appVersion);
                }
                if (globalSetting.appColor) {
                    $("#app_color").val(globalSetting.appColor);
                }
                if (globalSetting.adminColor) {
                    $("#admin_color").val(globalSetting.adminColor);
                }
                if (globalSetting.appBannerImage) {
                    app_banner_image = globalSetting.appBannerImage;
                    appBannerImagePath = globalSetting.appBannerImage;
                    $(".app_banner_image").append('<span class="image-item"><span class="remove-btn" data-val="app_banner_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + globalSetting.appBannerImage + '" alt="image"></span>');
                }
                jQuery("#overlay").hide();
            })


            globalValue.get().then(async function (snapshots) {
                var globalValueSettings = snapshots.data();

                if (globalValueSettings == undefined) {
                    database.collection('settings').doc('globalValue').set({});
                } else {


                    if (globalValueSettings.radius) {
                        $('#radius').val(globalValueSettings.radius);
                    }
                    if (globalValueSettings.minimumAmountToDeposit) {
                        $(".minimum_deposit_amount").val(globalValueSettings.minimumAmountToDeposit);
                    }
                    if (globalValueSettings.minimumAmountToWithdrawal) {
                        $(".minimum_withdrawal_amount").val(globalValueSettings.minimumAmountToWithdrawal);
                    }

                    if (globalValueSettings.priceVariation) {
                        $(".price_variation").val(globalValueSettings.priceVariation);
                    }

                }
                jQuery("#overlay").hide();
            })
            contactUsRef.get().then(async function (contactusSnap) {
                var contactData = contactusSnap.data();
                if (contactData == undefined) {
                    database.collection('settings').doc('contact_us').set({});
                } else {
                    $("#contact_us_subject").val(contactData.subject);
                    $("#contact_us_email").val(contactData.email);
                    $("#contact_us_phone_number").val(contactData.phone);
                    $("#contact_us_address").text(contactData.address);
                    $("#support_url").val(contactData.supportURL);
                }
            });
            logoRef.get().then(async function (snapshots) {
                var logoRefData = snapshots.data();
                if (logoRefData == undefined) {
                    database.collection('settings').doc('logo').set({});
                }
                try {
                    if (logoRefData.appLogo) {
                        app_logo_image = logoRefData.appLogo;
                        appLogoImagePath = logoRefData.appLogo;
                        $(".app_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + logoRefData.appLogo + '" alt="image"></span>');
                    }
                    if (logoRefData.appFavIconLogo) {
                        app_favicon_logo_image = logoRefData.appFavIconLogo;
                        appFavIconImagePath = logoRefData.appFavIconLogo;
                        $(".app_favicon_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_favicon_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + logoRefData.appFavIconLogo + '" alt="image"></span>');
                    }

                } catch (error) {
                }
                jQuery("#overlay").hide();
            })
            refEmailSetting.get().then(async function (snapshots) {
                var emailSettingData = snapshots.data();

                if (emailSettingData == undefined) {
                    database.collection('settings').doc('emailSetting').set({});
                }

                try {

                    if (emailSettingData.fromName) {
                        $('.from_name').val(emailSettingData.fromName);

                    }
                    if (emailSettingData.host) {
                        $('.host').val(emailSettingData.host);

                    }

                    if (emailSettingData.port) {
                        $('.port').val(emailSettingData.port);

                    }

                    if (emailSettingData.userName) {
                        $('.user_name').val(emailSettingData.userName);

                    }
                    if (emailSettingData.password) {
                        $('.password').val(emailSettingData.password);

                    }

                } catch (error) {

                }

                jQuery("#data-table_processing").hide();

            });

            async function storeImageData() {
                var newPhoto = [];
                try {
                    if (appLogoImagePath != "" && app_logo_image != appLogoImagePath) {
                        var appLogoImagePathRef = await storage.refFromURL(appLogoImagePath);
                        imageBucket = appLogoImagePathRef.bucket;
                        var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                        if (imageBucket == envBucket) {

                            await appLogoImagePathRef.delete().then(() => {
                                console.log("Old file deleted!")
                            }).catch((error) => {
                                console.log("ERR File delete ===", error);
                            });
                        } else {
                            console.log('Bucket not matched');
                        }

                    }
                    if (app_logo_image != appLogoImagePath) {
                        app_logo_image = app_logo_image.replace(/^data:image\/[a-z]+;base64,/, "")
                        var uploadTask = await storageRef.child(logoFileName).putString(app_logo_image, 'base64', { contentType: 'image/jpg' });
                        var downloadURL = await uploadTask.ref.getDownloadURL();
                        newPhoto['app_logo_image'] = downloadURL;
                        app_logo_image = downloadURL;
                    } else {
                        newPhoto['app_logo_image'] = app_logo_image;
                    }

                    if (appBannerImagePath != "" && app_banner_image != appBannerImagePath) {
                        var appBannerImagePathRef = await storage.refFromURL(appBannerImagePath);
                        imageBucket = appBannerImagePathRef.bucket;
                        var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                        if (imageBucket == envBucket) {

                            await appBannerImagePathRef.delete().then(() => {
                                console.log("Old file deleted!")
                            }).catch((error) => {
                                console.log("ERR File delete ===", error);
                            });
                        } else {
                            console.log("Bucket not matched!")
                        }
                    }
                    if (app_banner_image != appBannerImagePath) {
                        app_banner_image = app_banner_image.replace(/^data:image\/[a-z]+;base64,/, "")
                        var uploadTask = await storageRef.child(bannerFileName).putString(app_banner_image, 'base64', { contentType: 'image/jpg' });
                        var downloadURL = await uploadTask.ref.getDownloadURL();
                        newPhoto['app_banner_image'] = downloadURL;
                        app_banner_image = downloadURL;
                    } else {
                        newPhoto['app_banner_image'] = app_banner_image;
                    }

                    if (appFavIconImagePath != "" && app_favicon_logo_image != appFavIconImagePath) {
                        var appFavIconImagePathRef = await storage.refFromURL(appFavIconImagePath);
                        imageBucket = appFavIconImagePathRef.bucket;
                        var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                        if (imageBucket == envBucket) {

                            await appFavIconImagePathRef.delete().then(() => {
                                console.log("Old file deleted!")
                            }).catch((error) => {
                                console.log("ERR File delete ===", error);
                            });
                        } else {
                            console.log("Bucket not matched!")
                        }
                    }
                    if (app_favicon_logo_image != appFavIconImagePath) {
                        app_favicon_logo_image = app_favicon_logo_image.replace(/^data:image\/[a-z]+;base64,/, "")
                        var uploadTask = await storageRef.child(favIconFileName).putString(app_favicon_logo_image, 'base64', { contentType: 'image/jpg' });
                        var downloadURL = await uploadTask.ref.getDownloadURL();
                        newPhoto['app_favicon_logo_image'] = downloadURL;
                        app_favicon_logo_image = downloadURL;
                    } else {
                        newPhoto['app_favicon_logo_image'] = app_favicon_logo_image;
                    }
                } catch (error) {
                    console.log("ERR ===", error);
                }
                return newPhoto;
            }


            $(".save_global_settings_btn").click(function () {

                var mapKey = $("#map_key").val();
                var app_version = $("#app_version").val();
                var app_color = $("#app_color").val();
                var admin_color = $("#admin_color").val();
                if (admin_color != null && admin_color != '') {
                    setCookie('admin_panel_color', admin_color, 365);
                }
                var distance = $("#delivery_distance :selected").val();
                var radius = $('#radius').val();
                var subject = $("#contact_us_subject").val();
                var email = $("#contact_us_email").val();
                var phone = $("#contact_us_phone_number").val();
                var address = $("#contact_us_address").val();
                var supportURL = $('#support_url').val();
                var minimumDepositToRideAccept = $(".minimum_deposit_amount").val();
                var minimumAmountToWithdrawal = $(".minimum_withdrawal_amount").val();
                var priceVariation = $(".price_variation").val();
                var fromName = $('.from_name').val();
                var host = $('.host').val();
                var port = $('.port').val();
                var userName = $('.user_name').val();
                var password = $('.password').val();
                if (app_version == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.app_version_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (subject == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.please_enter_subject')}}</p>");
                    window.scrollTo(0, 0);
                } else if (email == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.contact_us_email_help')}}</p>");
                    window.scrollTo(0, 0);
                } else if (phone == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.contact_us_phone_help')}}</p>");
                    window.scrollTo(0, 0);
                } else if (address == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.contact_us_address_help')}}</p>");
                    window.scrollTo(0, 0);
                } else if (supportURL == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.support_url_help')}}</p>");
                    window.scrollTo(0, 0);
                } else if (app_logo_image == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.app_logo_image_help')}}</p>");
                    window.scrollTo(0, 0);
                }
                else if (app_favicon_logo_image == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.app_favicon_logo_image_help')}}</p>");
                    window.scrollTo(0, 0);
                } else if (app_banner_image == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.app_banner_image_help')}}</p>");
                    window.scrollTo(0, 0);
                }
                else if (minimumDepositToRideAccept == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_minimum_deposit_amount_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (minimumAmountToWithdrawal == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_minimum_withdrawal_amount_error')}}</p>");
                    window.scrollTo(0, 0);
                }
                else if (priceVariation == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_price_variation_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (host == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.host_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (port == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.port_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (userName == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.username_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (password == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.password_error')}}</p>");
                    window.scrollTo(0, 0);
                }
                else {

                    jQuery("#overlay").show();

                    storeImageData().then(IMG => {
                        database.collection('settings').doc('global').update({
                            'appVersion': app_version,
                            'adminColor': admin_color,
                            'appColor': app_color,
                            'appBannerImage': IMG.app_banner_image

                        });
                        database.collection('settings').doc("logo").update({
                            'appLogo': IMG.app_logo_image,
                            'appFavIconLogo': IMG.app_favicon_logo_image,
                        }).then(function (result) {
                            window.location.href = '{{ url("settings/globals")}}';
                        })
                        database.collection('settings').doc("globalKey").update({
                            'googleMapKey': mapKey,
                            'distanceType': distance,
                        }).then(function (result) {
                            window.location.href = '{{ url("settings/globals")}}';
                        })

                        database.collection('settings').doc("globalValue").update({
                            'radius': radius,
                            'minimumAmountToDeposit': minimumDepositToRideAccept,
                            'minimumAmountToWithdrawal': minimumAmountToWithdrawal,
                            'priceVariation': priceVariation
                        }).then(function (result) {
                            window.location.href = '{{ url("settings/globals")}}';
                        })
                        database.collection('settings').doc("contact_us").update({
                            'subject': subject,
                            'email': email,
                            'phone': phone,
                            'address': address,
                            'supportURL': supportURL,
                        }).then(function (result) {
                            window.location.href = '{{ url("settings/globals")}}';
                        })
                         database.collection('settings').doc("emailSetting").update({
                            'fromName': fromName,
                            'host': host,
                            'port': port,
                            'userName': userName,
                            'password': password,
                            'mailMethod': "smtp",
                            'mailEncryptionType': "ssl",
                        }).then(function (result) {
                            window.location.href = '{{ url("settings/globals")}}';
                        });
                    }).catch(err => {
                        jQuery("#overlay").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + err + "</p>");
                        window.scrollTo(0, 0);
                    });
                     
               
                }
            })
        })

        function handleLogoFileSelect(evt) {
            var f = evt.target.files[0];
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
                    app_logo_image = filePayload;
                    logoFileName = filename;
                    $(".app_logo_image").empty();
                    $(".app_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
                };
            })(f);
            reader.readAsDataURL(f);
        }
        function handleFavIconFileSelect(evt) {
            var f = evt.target.files[0];
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
                    app_favicon_logo_image = filePayload;
                    favIconFileName = filename;
                    $(".app_favicon_logo_image").empty();
                    $(".app_favicon_logo_image").append('<span class="image-item"><span class="remove-btn" data-val="app_favicon_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
                };
            })(f);
            reader.readAsDataURL(f);
        }

        function handleBannerFileSelect(evt) {
            var f = evt.target.files[0];
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
                    app_banner_image = filePayload;
                    bannerFileName = filename;
                    $(".app_banner_image").empty();
                    $(".app_banner_image").append('<span class="image-item"><span class="remove-btn" data-val="app_banner_logo"><i class="fa fa-remove"></i></span><img class="rounded" style="width:50px" src="' + filePayload + '" alt="image"></span>');
                };
            })(f);
            reader.readAsDataURL(f);
        }

        $(document).on('click', '.remove-btn', function () {
            
            if ($(this).attr('data-val') == "app_logo") {
                $(".app_logo_image").empty();
                app_logo_image = '';
                logoFileName = '';
            } else if ($(this).attr('data-val') == "app_banner_logo") {
                $(".app_banner_image").empty();
                app_banner_image = '';
                bannerFileName = '';
            }
            else {
                $(".app_favicon_logo_image").empty();
                app_favicon_logo_image = '';
                favIconFileName = '';
            }
        });
        
    </script>

    @endsection
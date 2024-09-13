@php
$user = Auth::user();
$role_has_permission = App\Models\Permission::where('role_id', $user->role_id)->pluck('permission')->toArray();

@endphp
<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li>
            <a class="waves-effect waves-dark" href="{!! url('dashboard') !!}" aria-expanded="false">

                <i class="mdi mdi-home"></i>

                <span class="hide-menu">{{trans('lang.dashboard')}}</span>

            </a>
        </li>


        @if(in_array('admins', $role_has_permission) || in_array('roles', $role_has_permission))

            <li>
                <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">

                    <i class="mdi mdi-lock-outline"></i>

                    <span class="hide-menu">{{trans('lang.access_control')}}</span>

                </a>

                <ul aria-expanded="false" class="collapse">
                    @if(in_array('roles', $role_has_permission))
                        <li><a href="{!! url('role') !!}">{{trans('lang.role_plural')}}</a></li>
                    @endif

                    @if(in_array('admins', $role_has_permission))
                        <li><a href="{!! url('admin-users') !!}">{{trans('lang.admin_plural')}}</a></li>
                    @endif
                </ul>

            </li>

        @endif

        @if(
    in_array('users', $role_has_permission) || in_array('documents', $role_has_permission) ||
    in_array('reports', $role_has_permission) || in_array('approve_users', $role_has_permission) ||
    in_array('pending_users', $role_has_permission)
)

                    <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.account_management')}}</span></li>

        @endif
        @if(
    in_array('users', $role_has_permission) || in_array('approve_users', $role_has_permission) ||
    in_array('pending_users', $role_has_permission)
)
                    @if(in_array('users', $role_has_permission))
                        <li>
                            <a class="has-arrow waves-effect waves-dark user_menu" href="#" aria-expanded="false">

                                <i class="mdi mdi-account-card-details"></i>

                                <span class="hide-menu">{{trans('lang.users')}}</span>

                            </a>
                            <ul aria-expanded="false" class="collapse driver_sub_menu">
                                @if(in_array('users', $role_has_permission))
                                    <li class="all_user_menu">
                                        <a href="{!! url('users') !!}">{{trans('lang.all_users')}}</a>
                                    </li>
                                @endif

                                @if(in_array('approve_users', $role_has_permission))
                                    <li class="approve_user_menu">
                                        <a href="{!! url('users/approved') !!}">{{trans('lang.approved_users')}}</a>
                                    </li>
                                @endif

                                @if(in_array('pending_users', $role_has_permission))
                                    <li class="pending_user_menu">
                                        <a href="{!! url('users/pending') !!}">{{trans('lang.pending_users')}}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
        @endif
        @if(in_array('documents', $role_has_permission))

            <li>
                <a class="waves-effect waves-dark document_menu" href="{!! url('documents') !!}" aria-expanded="false">

                    <i class="mdi mdi-file-document"></i>

                    <span class="hide-menu">{{trans('lang.document_plural')}}</span>

                </a>
            </li>

        @endif

        @if(in_array('reports', $role_has_permission))
            <li>
                <a class="has-arrow waves-effect waves-dark report_menu" href="#" aria-expanded="false">
                    <i class="mdi mdi-calendar-check"></i>
                    <span class="hide-menu">{{trans('lang.report_plural')}}</span>
                </a>
                <ul aria-expanded="false" class="collapse report_sub_menu">
                    <li><a href="{!! url('reports/user') !!}">{{trans('lang.reports_user')}}</a></li>
                    <li><a href="{!! url('reports/ride') !!}">{{trans('lang.reports_ride')}}</a></li>
                    <li><a href="{!! url('reports/transaction') !!}">{{trans('lang.reports_transaction')}}</a></li>
                </ul>

            </li>
        @endif

        @if(
    in_array('vehicle-type', $role_has_permission)
    || in_array('vehicle-brand', $role_has_permission)
    || in_array('vehicle-model', $role_has_permission)
    || in_array('ride_order', $role_has_permission)
)

                                <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.ride_management')}}</span></li>

        @endif
        @if(
    in_array('vehicle-type', $role_has_permission) || in_array('vehicle-model', $role_has_permission) ||
    in_array('vehicle-brand', $role_has_permission) || in_array('ride_order', $role_has_permission)
)
                                                        <li>
                                                            <a class="has-arrow waves-effect waves-dark vehicle_menu" href="#" aria-expanded="false">
                                                                <i class="mdi mdi-car"></i>
                                                                <span class="hide-menu">{{trans('lang.vehicle_settings')}}</span>
                                                            </a>
                                                            <ul aria-expanded="false" class="collapse vehicle_sub_menu">
                                                                @if(in_array('vehicle-type', $role_has_permission))
                                                                    <li class="vehicle_type_menu"><a href="{!! url('vehicle-type') !!}">{{trans('lang.vehicle_type')}}</a>
                                                                    </li>
                                                                @endif
                                                                @if(in_array('vehicle-brand', $role_has_permission))
                                                                    <li class="vehicle_brand_menu"><a href="{!! url('vehicle-brand') !!}">{{trans('lang.vehicle_brand')}}</a>
                                                                    </li>
                                                                @endif
                                                                @if(in_array('vehicle-model', $role_has_permission))
                                                                    <li class="vehicle_model_menu"><a
                                                                            href="{!! url('vehicle-model') !!}">{{trans('lang.vehicle_modal')}}</a>
                                                                    </li>
                                                                @endif


                                                            </ul>
                                                        </li>
                                                        @if(in_array('ride_order', $role_has_permission))
                                                            <li>
                                                                <a class="waves-effect waves-dark ride_menu" href="{!! url('rides') !!}" aria-expanded="false">

                                                                    <i class="mdi mdi-calendar-check"></i>

                                                                    <span class="hide-menu">{{trans('lang.booking_plural')}}</span>

                                                                </a>
                                                            </li>
                                                        @endif        
        @endif  


        @if(
    in_array('cms', $role_has_permission)
    || in_array('on-board', $role_has_permission)
    || in_array('faq', $role_has_permission)
    || in_array('complaints', $role_has_permission)


)

                    <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.app_management')}}</span></li>
        @endif

        @if(in_array('cms', $role_has_permission))

            <li><a class="waves-effect waves-dark cms_page" href="{!! url('cms') !!}" aria-expanded="false">
                    <i class="mdi mdi-file-document"></i>
                    <span class="hide-menu">{{trans('lang.cms_plural')}}</span>
                </a>
            </li>
        @endif
      
        @if(in_array('on-board', $role_has_permission))
            <li><a class="waves-effect waves-dark onboard_menu" href="{!! url('on-board') !!}" aria-expanded="false">
                    <i class="mdi mdi-book-open-page-variant"></i>
                    <span class="hide-menu">{{trans('lang.on_board_plural')}}</span>
                </a>
            </li>
        @endif
        @if(in_array('faq', $role_has_permission))

            <li><a class="waves-effect waves-dark faq_menu" href="{!! url('faq') !!}" aria-expanded="false">
                    <i class="mdi mdi-comment-question-outline"></i>
                    <span class="hide-menu">{{trans('lang.faq_plural')}}</span>
                </a>
            </li>
        @endif
         @if(in_array('complaints', $role_has_permission))
<li><a class="waves-effect waves-dark complaints_menu" href="{!! url('complaints') !!}" aria-expanded="false">
        <i class="mdi mdi-alert"></i>
        <span class="hide-menu">{{trans('lang.complaints')}}</span>
    </a>
</li>
@endif

        @if(
                in_array('tax', $role_has_permission)
                || in_array('currency', $role_has_permission)
                || in_array('language', $role_has_permission)
                || in_array('complaint-subject', $role_has_permission)
                || in_array('dynamic-notification', $role_has_permission)
                || in_array('payout-request', $role_has_permission) ||
                in_array('users-wallet-transaction', $role_has_permission) || in_array(
                    'global-setting',
                    $role_has_permission
                )
                || in_array('admin-commission', $role_has_permission) || in_array('notification-setting', $role_has_permission)
                ||
                in_array('payment-method', $role_has_permission)
                || in_array('homepageTemplate', $role_has_permission) || in_array('header-template', $role_has_permission)
                || in_array('footer-template', $role_has_permission) || in_array('privacy', $role_has_permission)
                || in_array('terms', $role_has_permission)|| in_array('email-template', $role_has_permission)
            )

                                            <li class="nav-subtitle"><span class="nav-subtitle-span">{{trans('lang.setting_management')}}</span></li>

        @endif

        @if(in_array('tax', $role_has_permission))

            <li>
                <a class="waves-effect waves-dark tax_menu" href="{!! url('tax') !!}" aria-expanded="false">

                    <i class="mdi mdi-cash"></i>

                    <span class="hide-menu">{{trans('lang.tax_plural')}}</span>

                </a>
            </li>

        @endif
       
        @if(in_array('currency', $role_has_permission))

            <li>
                <a class="waves-effect waves-dark currency" href="{!! url('currency') !!}" aria-expanded="false">

                    <i class="mdi mdi-currency-usd"></i>

                    <span class="hide-menu">{{trans('lang.currencies')}}</span>

                </a>
            </li>
        @endif
        @if(in_array('language', $role_has_permission))

            <li>
                <a class="waves-effect waves-dark language_menu" href="{!! route('settings.languages') !!}" aria-expanded="false">

                    <i class="mdi mdi-earth"></i>

                    <span class="hide-menu">{{trans('lang.languages')}}</span>

                </a>
            </li>

        @endif
        @if(in_array('complaint-subject', $role_has_permission))
    <li>
        <a class="waves-effect waves-dark complaint_subject_menu" href="{!! url('complaint-subject') !!}" aria-expanded="false">

            <i class="mdi mdi-calendar-check"></i>

            <span class="hide-menu">{{trans('lang.complaint_subject')}}</span>

        </a>
    </li>
    @endif

    @if(in_array('dynamic-notification', $role_has_permission))
    <li>
        <a class="waves-effect waves-dark notification_menu" href="{!! url('dynamic-notification') !!}" aria-expanded="false">
    
            <i class="mdi mdi-table"></i>
    
            <span class="hide-menu">{{trans('lang.dynamic_notification')}}</span>
    
        </a>
    </li>
    @endif
    @if(in_array('email-template', $role_has_permission))

        <li><a class="waves-effect waves-dark" href="{!! url('email-templates') !!}" aria-expanded="false">
                <i class="mdi mdi-email"></i>
                <span class="hide-menu">{{trans('lang.email_templates')}}</span>
            </a>
        </li>
   @endif
        @if(
    in_array('payout-request', $role_has_permission) ||
    in_array('users-wallet-transaction', $role_has_permission)
)

                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                        <i class="mdi mdi-bank"></i>
                                        <span class="hide-menu">{{trans('lang.payment_plural')}}</span>
                                    </a>
                                    @if(in_array('payout-request', $role_has_permission))
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{!! url('payoutRequest') !!}">{{trans('lang.payout_request')}}</a></li>
                                        </ul>
                                    @endif
                                  
                                    @if(in_array('users-wallet-transaction', $role_has_permission))
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{!! url('walletTransaction/user') !!}">{{trans('lang.users_wallet_transactions')}}</a></li>
                                        </ul>
                                    @endif
                                </li>
        @endif
        @if(
    in_array('global-setting', $role_has_permission) || in_array('admin-commission', $role_has_permission) ||
    in_array('payment-method', $role_has_permission) || in_array('notification-setting', $role_has_permission)
    || in_array('homepageTemplate', $role_has_permission) || in_array('header-template', $role_has_permission) ||
    in_array('footer-template', $role_has_permission)
    || in_array('privacy', $role_has_permission) || in_array('terms', $role_has_permission)
)

                    <li>
                        <a class="has-arrow waves-effect waves-dark setting_menu" href="#" aria-expanded="false">

                            <i class="mdi mdi-settings"></i>

                            <span class="hide-menu">{{trans('lang.app_setting')}}</span>

                        </a>

                        <ul aria-expanded="false" class="collapse setting_sub_menu">
                            @if(in_array('global-setting', $role_has_permission))
                                <li><a href="{!! url('settings/globals') !!}">{{trans('lang.app_setting_globals')}}</a></li>
                            @endif
                            @if(in_array('admin-commission', $role_has_permission))
                                <li><a href="{!! url('settings/adminCommission') !!}">{{trans('lang.admin_commission')}}</a></li>
                            @endif
                            @if(in_array('notification-setting', $role_has_permission))
                                <li><a href="{!! url('settings/notificationSettings') !!}">{{trans('lang.notification_settings')}}</a>
                                </li>
                            @endif
                            @if(in_array('payment-method', $role_has_permission))

                                <li><a href="{!! url('settings/payments/stripe') !!}"
                                        class="setting_payment_menu">{{trans('lang.payment_methods')}}</a></li>
                            @endif
                            @if(in_array('homepageTemplate', $role_has_permission))

                                <li><a href="{!! url('settings/landingPageTemplate') !!}">{{trans('lang.homepageTemplate')}}</a></li>
                            @endif
                            @if(in_array('header-template', $role_has_permission))

                                <li><a href="{!! url('settings/headerTemplate') !!}">{{trans('lang.header_template')}}</a></li>
                            @endif
                            @if(in_array('footer-template', $role_has_permission))

                                <li><a href="{!! url('settings/footerTemplate') !!}">{{trans('lang.footer_template')}}</a></li>
                            @endif
                            @if(in_array('privacy', $role_has_permission))

                                <li><a href="{!! url('settings/privacyPolicy') !!}">{{trans('lang.privacy_policy')}}</a></li>
                            @endif
                            @if(in_array('terms', $role_has_permission))

                                <li><a href="{!! url('settings/termsAndConditions') !!}">{{trans('lang.terms_and_conditions')}}</a></li>
                            @endif
                        </ul>

                    </li>
        @endif


    </ul>

    <p class="web_version"></p>

</nav>
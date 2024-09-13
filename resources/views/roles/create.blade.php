@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.create_role')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('role') }}">{{trans('lang.role_plural')}}</a>
                </li>

                <li class="breadcrumb-item active">{{trans('lang.create_role')}}</li>


            </ol>
        </div>

    </div>
    <div>

        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                {{trans('lang.processing')}}
            </div>

            <div class="error_top" style="display:none"></div>

            <div class="success_top" style="display:none"></div>

            @if($errors->any())
                <p class="alert alert-danger"> {{$errors->first()}}</p>
            @endif

            <form action="{{route('role.store')}}" method="post" id="roleForm">
                @csrf
                <div class="row restaurant_payout_create">

                    <div class="restaurant_payout_create-inner">

                        <fieldset>
                            <legend>{{trans('lang.role_details')}}</legend>
                            <div class="form-group row width-100 d-flex">
                                <label class="col-3 control-label">{{trans('lang.name')}}</label>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-6 text-right">
                                    <label for="permissions"
                                        class="form-label">{{trans('lang.assign_permissions')}}</label>
                                    <div class="text-right">
                                        <input type="checkbox" name="all_permission" id="all_permission">
                                        <label class="control-label"
                                            for="all_permission">{{trans('lang.all_permissions')}}</label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row width-100">

                                <div class="role-table width-100">
                                    <div class="col-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>Menu</th>
                                                <th>Permission</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.role_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="role-list" value="roles.list"
                                                            name="roles[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="role-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="role-save" value="roles.create"
                                                            name="roles[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="role-save">{{trans('lang.create')}}</label>

                                                        <input type="checkbox" id="role-store" value="roles.store"
                                                            name="roles[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="role-store">{{trans('lang.store')}}</label>

                                                        <input type="checkbox" id="role-edit" value="roles.edit"
                                                            name="roles[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="role-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="role-update" value="roles.update"
                                                            name="roles[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="role-update">{{trans('lang.update')}}</label>

                                                        <input type="checkbox" id="role-delete" value="roles.delete"
                                                            name="roles[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="role-delete">{{trans('lang.delete')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.admin_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="admin-list" value="admin.list"
                                                            name="admins[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="admin-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="admin-create" value="admin.create"
                                                            name="admins[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="admin-create">{{trans('lang.create')}}</label>

                                                        <input type="checkbox" id="admin-store" value="admin.store"
                                                            name="admins[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="admin-store">{{trans('lang.store')}}</label>

                                                        <input type="checkbox" id="admin-edit" value="admin.edit"
                                                            name="admins[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="admin-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="admin-update" value="admin.update"
                                                            name="admins[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="admin-update">{{trans('lang.update')}}</label>

                                                        <input type="checkbox" id="admin-delete" value="admin.delete"
                                                            name="admins[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="admin-delete">{{trans('lang.delete')}}</label>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.user_customer')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="user-list" value="user.list"
                                                            name="users[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="user-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="user-edit" value="user.edit"
                                                            name="users[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="user-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="user-view" value="user.view"
                                                            name="users[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="user-view">{{trans('lang.view')}}</label>

                                                        <input type="checkbox" id="user-delete" value="user.delete"
                                                            name="users[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="user-delete">{{trans('lang.delete')}}</label>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.approve_user_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="approve-user-list"
                                                            value="approve.user.list" name="approve_users[]"
                                                            class="permission">
                                                        <label class="control-label2"
                                                            for="approve-user-list">{{trans('lang.list')}}</label>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.pending_user_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="pending-user-list"
                                                            value="pending.user.list" name="pending_users[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="pending-user-list">{{trans('lang.list')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.document_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="documents-list" value="document.list"
                                                            name="documents[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="documents-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="documents-create"
                                                            value="document.create" name="documents[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="documents-create">{{trans('lang.create')}}</label>

                                                        <input type="checkbox" id="documents-edit" value="document.edit"
                                                            name="documents[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="documents-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="documents-delete"
                                                            value="document.delete" name="documents[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="documents-delete">{{trans('lang.delete')}}</label>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.report_plural')}}</strong>

                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="user-report" value="user.report"
                                                            name="reports[]" class="permission">
                                                        <label class="control-label2"
                                                            for="user-report">{{trans('lang.user')}}</label>

                                                        <input type="checkbox" id="ride-report" value="ride.report"
                                                            name="reports[]" class="permission">
                                                        <label class="control-label2"
                                                            for="ride-report">{{trans('lang.ride')}}</label>

                                                        <input type="checkbox" id="transaction-report"
                                                            value="transaction.report" name="reports[]"
                                                            class="permission">
                                                        <label class="control-label2"
                                                            for="transaction-report">{{trans('lang.transaction')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.vehicle_type')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="vehicle-type-list"
                                                            value="vehicle.type.list" name="vehicle-type[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-type-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="vehicle-type-create"
                                                            value="vehicle.type.create" name="vehicle-type[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-type-create">{{trans('lang.create')}}</label>

                                                        <input type="checkbox" id="vehicle-type-edit"
                                                            value="vehicle.type.edit" name="vehicle-type[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-type-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="vehicle-type-delete"
                                                            value="vehicle.type.delete" name="vehicle-type[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-type-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.vehicle_brand')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="vehicle-brand-list"
                                                            value="vehicle.brand.list" name="vehicle-brand[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-brand-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="vehicle-brand-create"
                                                            value="vehicle.brand.create" name="vehicle-brand[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-brand-create">{{trans('lang.create')}}</label>

                                                        <input type="checkbox" id="vehicle-brand-edit"
                                                            value="vehicle.brand.edit" name="vehicle-brand[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-brand-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="vehicle-brand-delete"
                                                            value="vehicle.brand.delete" name="vehicle-brand[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-brand-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.vehicle_model')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="vehicle-model-list"
                                                            value="vehicle.model.list" name="vehicle-model[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-model-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="vehicle-model-create"
                                                            value="vehicle.model.create" name="vehicle-model[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-model-create">{{trans('lang.create')}}</label>

                                                        <input type="checkbox" id="vehicle-model-edit"
                                                            value="vehicle.model.edit" name="vehicle-model[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-model-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="vehicle-model-delete"
                                                            value="vehicle.model.delete" name="vehicle-model[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="vehicle-model-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.ride_order_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="ride-order-list" value="order.list"
                                                            name="ride_order[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="ride-order-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="ride-order-view" value="order.view"
                                                            name="ride_order[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="ride-order-view">{{trans('lang.view')}}</label>

                                                        <input type="checkbox" id="ride-order-delete"
                                                            value="order.delete" name="ride_order[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="ride-order-delete">{{trans('lang.delete')}}</label>

                                                        <input type="checkbox" id="user-ride-detail"
                                                            value="user.ride.detail" name="user-ride-detail[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="user-ride-detail">{{trans('lang.booked_user_detail')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.cms_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="cms" value="cms.list" name="cms[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="cms">{{trans('lang.list')}}</label>
                                                        <input type="checkbox" id="cms-create" value="cms.create"
                                                            name="cms[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="cms-create">{{trans('lang.create')}}</label>
                                                        <input type="checkbox" id="cms-edit" value="cms.edit"
                                                            name="cms[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="cms-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="cms-delete" value="cms.delete"
                                                            name="cms[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="cms-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.on_board_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="on-board-list" value="onboard.list"
                                                            name="on-board[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="on-board-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="on-board-edit" value="onboard.edit"
                                                            name="on-board[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="on-board-edit">{{trans('lang.edit')}}</label>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.faq_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="faq-list" value="faq.list"
                                                            name="faq[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="faq-list">{{trans('lang.list')}}</label>
                                                        <input type="checkbox" id="faq-create" value="faq.create"
                                                            name="faq[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="faq-create">{{trans('lang.create')}}</label>
                                                        <input type="checkbox" id="faq-edit" value="faq.edit"
                                                            name="faq[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="faq-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="faq-delete" value="faq.delete"
                                                            name="faq[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="faq-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.complaints')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="complaints-list"
                                                            value="complaints.list" name="complaints[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="complaints-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="complaints-edit"
                                                            value="complaints.edit" name="complaints[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="complaints-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="complaints-delete"
                                                            value="complaints.delete" name="complaints[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="complaints-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.tax_plural')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="tax-list" value="tax.list"
                                                            name="tax[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="tax-list">{{trans('lang.list')}}</label>
                                                        <input type="checkbox" id="tax-create" value="tax.create"
                                                            name="tax[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="tax-create">{{trans('lang.create')}}</label>
                                                        <input type="checkbox" id="tax-edit" value="tax.edit"
                                                            name="tax[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="tax-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="tax-delete" value="tax.delete"
                                                            name="tax[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="tax-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.currencies')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="currency-list" value="currency.list"
                                                            name="currency[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="currency-list">{{trans('lang.list')}}</label>
                                                        <input type="checkbox" id="currency-create"
                                                            value="currency.create" name="currency[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="currency-create">{{trans('lang.create')}}</label>
                                                        <input type="checkbox" id="currency-edit" value="currency.edit"
                                                            name="currency[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="currency-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="currency-delete"
                                                            value="currency.delete" name="currency[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="currency-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.all_languages')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="language-list" value="language.list"
                                                            name="language[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="language-list">{{trans('lang.list')}}</label>
                                                        <input type="checkbox" id="language-create"
                                                            value="language.create" name="language[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="language-create">{{trans('lang.create')}}</label>
                                                        <input type="checkbox" id="language-edit" value="language.edit"
                                                            name="language[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="language-edit">{{trans('lang.edit')}}</label>

                                                        <input type="checkbox" id="language-delete"
                                                            value="language.delete" name="language[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="language-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.complaint_subject')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="complaint-subject-list"
                                                            value="complaint.subject.list" name="complaint-subject[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="complaint-subject-list">{{trans('lang.list')}}</label>
                                                        <input type="checkbox" id="complaint-subject-create"
                                                            value="complaint.subject.create" name="complaint-subject[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="complaint-subject-create">{{trans('lang.create')}}</label>
                                                        <input type="checkbox" id="complaint-subject-edit"
                                                            value="complaint.subject.edit" name="complaint-subject[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="complaint-subject-edit">{{trans('lang.edit')}}</label>
                                                        <input type="checkbox" id="complaint-subject-delete"
                                                            value="complaint.subject.delete" name="complaint-subject[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="complaint-subject-delete">{{trans('lang.delete')}}</label>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.dynamic_notification')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="dynamic-notification-list"
                                                            value="dynamic.notification.list"
                                                            name="dynamic-notification[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="dynamic-notification-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="dynamic-notification-edit"
                                                            value="dynamic.notification.edit"
                                                            name="dynamic-notification[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="dynamic-notification-edit">{{trans('lang.edit')}}</label>


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.email_templates')}}</strong>
                                                    </td>

                                                    <td>
                                                        <input type="checkbox" id="email-template-list"
                                                            value="email.template.index"
                                                            name="email-template[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="email-template-list">{{trans('lang.list')}}</label>

                                                        <input type="checkbox" id="email-template-edit"
                                                            value="email.template.save"
                                                            name="email-template[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="email-template-edit">{{trans('lang.edit')}}</label>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.payout_request')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="payout-request-list"
                                                            value="payout-request" name="payout-request[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="payout-request-list">{{trans('lang.list')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.users_wallet_transactions')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="users-wallet-transactions"
                                                            value="user.wallet.list" name="users-wallet-transaction[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="users-wallet-transactions">{{trans('lang.list')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.app_setting_globals')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="global-setting"
                                                            value="global-setting" name="global-setting[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="global-setting">{{trans('lang.update')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.admin_commission')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="admin-commission"
                                                            value="admin-commision" name="admin-commission[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="admin-commission">{{trans('lang.update')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.notification_settings')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="notification-setting"
                                                            value="notification-setting" name="notification-setting[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="notification-setting">{{trans('lang.update')}}</label>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.payment_methods')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="payment-method-list"
                                                            value="payment-method" name="payment-method[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="payment-method-list">{{trans('lang.update')}}</label>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.homepageTemplate')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="homepageTemplate" value="home-page"
                                                            name="homepageTemplate[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="homepageTemplate">{{trans('lang.update')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.header_template')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="header-template" value="header"
                                                            name="header-template[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="header-template">{{trans('lang.update')}}</label>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.footer_template')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="footer-template" value="footer"
                                                            name="footer-template[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="footer-template">{{trans('lang.update')}}</label>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.privacy_policy')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="privacy" value="privacy"
                                                            name="privacy[]" class="permission">
                                                        <label class=" control-label2"
                                                            for="privacy">{{trans('lang.update')}}</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>{{trans('lang.terms_and_conditions')}}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" id="terms" value="terms" name="terms[]"
                                                            class="permission">
                                                        <label class=" control-label2"
                                                            for="terms">{{trans('lang.update')}}</label>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </fieldset>
                    </div>

                </div>

        </div>
        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_role"><i class="fa fa-save"></i> {{
    trans('lang.save')}}
            </button>
            <a href="{{url('role')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{
    trans('lang.cancel')}}</a>
        </div>
        <form>

    </div>

    @endsection

    @section('scripts')

    <script>
        $(".save_role").click(async function () {

            $(".success_top").hide();
            $(".error_top").hide();
            var name = $("#name").val();

            if (name == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_name_help')}}</p>");
                window.scrollTo(0, 0);
                return false;
            } else {
                $('form#roleForm').submit();

            }

        });

        $('#all_permission').on('click', function () {

            if ($(this).is(':checked')) {
                $.each($('.permission'), function () {
                    $(this).prop('checked', true);
                });
            } else {
                $.each($('.permission'), function () {
                    $(this).prop('checked', false);
                });
            }

        });
    </script>

    @endsection
<!--begin::Budget-->
<div data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="mb-13">
            <!--begin::Title-->
            <h2 class="mb-3">Finance</h2>
            <!--end::Title-->
            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-5">
                If you need more info, please check out
                <a href="#" class="link-primary fw-bold">FAQ Page</a>.
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">Setup Budget</span>
@include('partials/general/_bank-popover-hint')
            </label>
            <!--end::Label-->
            <!--begin::Dialer-->
            <div class="position-relative w-lg-250px"
                id="kt_modal_finance_setup"
                data-kt-dialer="true"
                data-kt-dialer-min="50"
                data-kt-dialer-max="50000"
                data-kt-dialer-step="100"
                data-kt-dialer-prefix="$"
                data-kt-dialer-decimals="2">
                <!--begin::Decrease control-->
                <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                    <i class="ki-solid ki-minus-circle fs-1"></i>                </button>
                <!--end::Decrease control-->
                <!--begin::Input control-->
                <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="finance_setup" readonly value="$50"/>
                <!--end::Input control-->
                <!--begin::Increase control-->
                <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                    <i class="ki-solid ki-plus-circle fs-1"></i>                </button>
                <!--end::Increase control-->
            </div>
            <!--end::Dialer-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="fs-6 fw-semibold mb-2">Budget Usage</label>
            <!--end::Label-->
            <!--begin::Row-->
            <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-12 col-xxl-6">
                    <!--begin::Option-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input class="form-check-input" type="radio" name="finance_usage" value="1" checked="checked" />
                        </span>
                        <!--end::Radio-->
                        <!--begin::Info-->
                        <span class="ms-5">
                            <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Precise Usage</span>
                            <span class="fw-semibold fs-7 text-gray-600">
                                Withdraw money to your bank account per transaction under $50,000 budget
                            </span>
                        </span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 col-lg-12 col-xxl-6">
                    <!--begin::Option-->
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                        <!--begin::Radio-->
                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                            <input class="form-check-input" type="radio" name="finance_usage" value="2" />
                        </span>
                        <!--end::Radio-->
                        <!--begin::Info-->
                        <span class="ms-5">
                            <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Extreme Usage</span>
                            <span class="fw-semibold fs-7 text-gray-600">
                                Withdraw money to your bank account per transaction under $50,000 budget
                            </span>
                        </span>
                        <!--end::Info-->
                    </label>
                    <!--end::Option-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-15">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack">
                <!--begin::Label-->
                <div class="me-5">
                    <label class="fs-6 fw-semibold">Allow Changes in Budget</label>
                    <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
                </div>
                <!--end::Label-->
                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" name="finance_allow" checked="checked"/>
                    <span class="form-check-label fw-semibold text-muted">
                        Allowed
                    </span>
                </label>
                <!--end::Switch-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="d-flex flex-stack">
            <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="finance-previous">
                Project Settings
            </button>
            <button type="button" class="btn btn-lg btn-primary" data-kt-element="finance-next">
                <span class="indicator-label">
                    Build Team
                </span>
                <span class="indicator-progress">
                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Budget-->

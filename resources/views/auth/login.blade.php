<x-auth-layout>

    <!--begin::Signin Form-->
    <form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
    @csrf

    <!--begin::Heading-->
        <div class="text-center mb-10">
            <img src="{{asset('front-end/assets/img/Log-v1.png')}}" style="width: 200px;" alt="">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Log In') }}
            </h1>
            <!--end::Title-->
        </div>
        <!--begin::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" value="{{ old('email', 'demo@demo.com') }}" required autofocus/>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                <!--end::Label-->

                <!--begin::Link-->
                @if (Route::has('password.request'))
                    {{-- <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">
                        {{ __('Forgot Password ?') }}
                    </a> --}}
            @endif
            <!--end::Link-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Input-->
            <div class="input-group">
            <input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" value="demo" required/>
            <span class="show_eye"><i class="fas fa-eye-slash" onclick="showpassword(this)"></i>
            </span>
            </div>
                <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <label class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="remember"/>
                <span class="form-check-label fw-bold text-gray-700 fs-6">{{ __('Remember me') }}
            </span>
            </label>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                @include('partials.general._button-indicator', ['label' => __('Login')])
            </button>
            <!--end::Submit button-->
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Signin Form-->

</x-auth-layout>

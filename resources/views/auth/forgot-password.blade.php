@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.maintenance')
@push('css')
    <style>
        .text-orange{
            color: #f06a25 !important;
        }
    </style>
@endpush
@php
   $maintenance = getMaintenance();
@endphp
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>হোম</a>
                <span></span></span> আমার অ্যাকাউন্ট
            </div>
        </div>
    </div>

    <div class="page-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-12 m-auto">
                    <div class="login_wrap widget-taber-content background-white">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <img class="border-radius-15" src="assets/imgs/page/forgot_password.svg" alt="" />
                                <h2 class="mb-15 mt-15" style="font-size: 28px !important;">আপনি কি পাসওয়ার্ড ভুলে গেছেন?</h2>
                                <p class="mb-30">চিন্তা করবেন না, আমরা আপনাকে পেয়েছি! আপনাকে একটি নতুন পাসওয়ার্ড দেওয়া যাক। আপনার ইমেইল ঠিকানা লিখুন।</p>
                            </div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ইমেইল *" />
                                </div>
                                <div class="form-group">
                                    @if($maintenance==1)
                                        <button type="button" class="btn btn-heading btn-block hover-up" data-bs-toggle="modal" data-bs-target="#maintenance">পাসওয়ার্ড রিসেট</button>
                                    @else
                                       <button type="submit" class="btn btn-heading btn-block hover-up" name="login">পাসওয়ার্ড রিসেট</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<script>
    function validateNumberInput(input) {
      // Remove 'e' from the input value
      input.value = input.value.replace(/e/gi, '');
    }
  </script>
@endsection

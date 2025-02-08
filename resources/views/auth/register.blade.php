@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.maintenance')
@php
   $maintenance = getMaintenance();
@endphp
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>হোম</a>
                <span></span> রেজিস্টার
            </div>
        </div>
    </div>
    <div class="page-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all card p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                    <div class="heading_s1 text-center">
                                        <h1 class="mb-5" style="font-size: 28px !important;">একটি অ্যাকাউন্ট তৈরি করুন</h1>
                                        <p class="mb-30">ইতিমধ্যে আপনার একটি অ্যাকাউন্ট আছে? <a href="{{route('login')}}">লগইন</a></p>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="form-group">
                                            <label for="name" class="fw-900">নাম : <span class="text-danger">*</span></label>
                                            <input type="text" name="name" placeholder="নাম" id="name" value="{{ old('name') }}" />
                                            @error('name')
                                                <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="fw-900">ফোন নম্বর : <span class="text-danger">*</span></label>
                                            <input type="number" id="numberInput" oninput="validateNumberInput(this)" name="phone" placeholder="ফোন *" value="{{ old('phone') }}" autofocus/>
                                            @error('phone')
                                                <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="fw-900">পাসওয়ার্ড : <span class="text-danger">*</span></label>
                                            <input type="password" name="password" placeholder="পাসওয়ার্ড" id="password" autocomplete="new-password" />
                                            <span>পাসওয়ার্ড নাম্বার কমপক্ষে ৮ অক্ষরের হতে হবে</span>
                                            @error('password')
                                                <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="fw-900">পাসওয়ার্ড নিশ্চিত করুন : <span class="text-danger">*</span></label>
                                            <input type="password" placeholder="পাসওয়ার্ড নিশ্চিত করুন" name="password_confirmation" />
                                            @error('password')
                                                <div class="text-danger" style="font-weight: bold;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>আমি শর্তাবলী ও নীতিতে সম্মত।</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-30">
                                            @if($maintenance==1)
                                                <button type="button" class="btn btn-fill-out btn-block hover-up font-weight-bold" data-bs-toggle="modal" data-bs-target="#maintenance" >সাবমিট & রেজিস্টার</button>
                                            @else
                                               <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">সাবমিট & রেজিস্টার</button>
                                            @endif
                                        </div>
                                        <p class="font-xs text-muted"><strong class="text-muted">নোট:</strong>আপনার ব্যক্তিগত ডেটা এই ওয়েবসাইট জুড়ে আপনার অভিজ্ঞতাকে সমর্থন করতে, আপনার অ্যাকাউন্টে অ্যাক্সেস পরিচালনা করতে এবং আমাদের গোপনীয়তা নীতিতে বর্ণিত অন্যান্য উদ্দেশ্যে ব্যবহার করা হবে।</p>
                                    </form>
                                </div>
                            </div>
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

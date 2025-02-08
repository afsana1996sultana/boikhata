@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Writers Create</h2>
        <div class="">
            <a href="{{ route('writer.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Writer List</a>
        </div>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="POST" action="{{ route('writer.update',$vendor->id) }}" enctype="multipart/form-data">
		                    	@csrf
		                    	@method('PUT')

		                        <div class="mb-4">
		                          <label for="writer_name" class="col-form-label col-md-4" style="font-weight: bold;"> Writer Name : <span class="text-danger">*</span></label>
		                            <input class="form-control" id="writer_name" type="text" name="writer_name" placeholder="Write writer name" value="{{$vendor->writer_name}}">
									@error('writer_name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

								<div class="mb-4">
		                          <label for="phone" class="col-form-label col-md-4" style="font-weight: bold;"> Writer Phone : </label>
		                            <input class="form-control" id="phone" type="text" name="phone" placeholder="Write writer phone number" value="{{$vendor->user->phone}}">
		                        </div>

								<div class="mb-4">
		                          <label for="email" class="col-form-label col-md-4" style="font-weight: bold;"> Writer Email : </label>
		                            <input class="form-control" id="email" type="email" name="email" placeholder="Write writer email address" value="{{$vendor->user->email}}">
		                        </div>

		                        <div class="mb-4">
		                          <label for="address" class="col-form-label col-md-4" style="font-weight: bold;"> Writer Address : </label>
		                            <input class="form-control" id="address" type="text" name="address" placeholder="Write writer address" value="{{$vendor->address}}">
		                        </div>

		                        <div class="mb-4">
                                    <label for="writer_image" class="col-form-label" style="font-weight: bold;"> Writer Image:</label>
                                    <input name="writer_image" class="form-control" type="file" id="writer_image">
                                </div>
                                <div class="mb-4">
                                    <img id="showImage" class="rounded avatar-lg" src="{{ asset($vendor->writer_image) }}"
                                        alt="Card image cap" width="100px" height="80px;">
                                </div>

		                        <div class="mb-4">
		                          <label for="description" class="col-form-label col-md-4" style="font-weight: bold;">Description :</label>
		                            <textarea name="description" id="description" cols="5" placeholder="Write vendor description" class="form-control ">{{$vendor->description}}</textarea>
		                        </div>

		                        <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $vendor->status == 1 ? 'checked': '' }} >
                                        <label class="form-check-label cursor" for="status">Status</label>
                                    </div>
                                </div>

		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Update">
									</div>
								</div>
		                    </form>
		                </div>
		            </div>
		            <!-- .row // -->
		        </div>
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>
@endsection

@push('footer-script')
<!-- Shop Cover Photo Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image2').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage2').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Nid Card Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image3').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage3').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Trade license Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image4').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage4').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush

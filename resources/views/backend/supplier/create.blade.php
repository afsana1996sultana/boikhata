@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Publications Create</h2>
        <div class="">
            <a href="{{ route('publication.all') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>  Back To List</a>
        </div>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('publication.store') }}" enctype="multipart/form-data">
		                    	@csrf

		                        <div class="mb-4">
		                           <label for="name" class="col-form-label col-md-3" style="font-weight: bold;"> Publication Name: <span class="text-danger"> *</span></label>
		                            <input class="form-control" id="name" type="text" name="name" placeholder="Write Publication Name" value="{{old('name')}}">
		                            @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

		                        <div class="mb-4">
		                          <label for="phone" class="col-form-label col-md-3" style="font-weight: bold;"> Publication Phone:</label>
		                            <input class="form-control" id="phone" type="number" name="phone" placeholder="Write Publication Phone">
		                        </div>

		                        <div class="mb-4">
		                          <label for="email" class="col-form-label col-md-3" style="font-weight: bold;"> Publication Email:</label>
		                            <input class="form-control" id="email" type="email" name="email" placeholder="Write Publication Email">
		                        </div>

		                        <div class="mb-4">
		                          	<label for="address" class="col-form-label col-md-3" style="font-weight: bold;">Publication Address: </label>
		                            <textarea name="address" id="address" cols="5" class="form-control" >{{old('address')}}</textarea>
		                        </div>

								<div class="mb-4">
									<label for="background_color" class="col-form-label col-md-3" style="font-weight: bold;">Background Color:</label>
									<input class="form-control" id="background_color" type="text" name="background_color" value="{{old('background_color')}}">
								</div>

		                        <div class="mb-4">
		                            <div class="custom-control custom-switch">
		                                <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
		                                <label class="form-check-label cursor" for="status">Status</label>
		                            </div>
                                </div>

		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Submit">
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

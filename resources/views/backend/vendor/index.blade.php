@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Writers list <span class="badge rounded-pill alert-success"> {{ count($vendors) }} </span></h2>
        <div>
            <a href="{{ route('writer.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Writer Create</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Writer Image</th>
                            <th scope="col">Writer Name</th>
                            <th scope="col">Writer Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $key => $vendor)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($vendor->writer_image) }}" class="img-sm img-avatar" alt="Writer pic" />
                                    </div>
                                </a>
                            </td>
                            <td> {{ $vendor->user->name ?? ' ' }} </td>
                            <td> {{ $vendor->user->email ?? 'No Email' }} </td>
                            <td> {{ $vendor->user->phone ?? 'No Phone' }} </td>
                            <td>
                                @if($vendor->status == 1)
                                  <a href="{{ route('writer.in_active',['id'=>$vendor->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('writer.active',['id'=>$vendor->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>

                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('writer.edit',$vendor->id) }}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('writer.delete',$vendor->id) }}" id="delete">Delete</a>
                                    </div>
                                </div>
                                <!-- dropdown //end -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection

@extends('admin.admin_master')
@section('admin')

<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }

</style>

<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order List</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <!-- card-header end// -->
                <div class="card-body">
                    <form class="" action="" method="GET">
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label class="col-form-label"><span>All Orders :</span></label>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="note_status" id="note_status">
                                    <option value="" selected="">Note Status</option>
                                    @foreach($ordernotes as $ordernote)
                                        <option value="{{ $ordernote->name }}" @if($note_status == $ordernote->name) selected @endif>
                                            {{ $ordernote->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                <select class="form-select d-inline-block select-active select-nice mb-lg-0 mr-5 mw-200" name="delivery_status" id="delivery_status">
                                    <option value="" selected="">Delivery Status</option>
                                    <option value="pending" @if ($delivery_status == 'pending') selected @endif>Pending</option>
                                    <option value="holding" @if ($delivery_status == 'holding') selected @endif>Holding</option>
                                    <option value="processing" @if ($delivery_status == 'processing') selected @endif>Processing</option>
                                    <option value="shipped" @if ($delivery_status =='shipped') selected @endif>Shipped</option>
                                    <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>Delivered</option>
                                    <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                <select class=" select-active select-nice form-select d-inline-block mb-lg-0 mr-5 mw-200" name="payment_status" id="payment_status">
                                    <option value="" selected="">Payment Status</option>
                                    <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>Unpaid</option>
                                    <option value="paid" @if ($payment_status == 'paid') selected @endif>Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="custom_select">
                                <input type="text" name="date_range" class="form-control" placeholder="Select date" id="date" value="">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                    </div>
                    <div class="row mb-3 pack_print">
                        <div class="col-sm-3 col-6">
                            <button type="button" class="btn   btn-sm" id="all_print" target="blank">Print</button>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-hover" id="example" width="100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all_ids"></th>
                                    <th>Order Code</th>
                                    <th>Customer name</th>
                                    <th>Customer Phone</th>
                                    <th>Amount</th>
                                    <th>Profit</th>
                                    <th>Shipping</th>
                                    <th>Delivery Status</th>
                                    <th>Payment Status</th>
                                    <th>Note Status</th>
                                    <th>Created Date</th>
                                    <th class="text-end">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach ($orders as $key => $order)
                                <tr id="order_ids{{$order->id}}">
                                    @if($order->delivery_status == 'cancelled')
                                        <td><input type="checkbox"  disabled ></td>
                                    @else
                                        <td><input type="checkbox" class="check_ids" name="ids" value="{{$order->id}}"></td>
                                    @endif
                                    <td>{{ $order->invoice_no }}</td>
                                    <td><b>{{ $order->name ?? '' }}</b></td>
                                    <td>{{ $order->phone ?? 'No Phone'}}</td>
                                    <td>{{ $order->grand_total }} TK</td>
                                    <td>{{ $order->grand_total - ($order->shipping_charge + $order->pur_sub_total) }}</td>
                                    <td>{{ $order->shipping_charge }}</td>
                                    <td>
                                        @php
                                            $status = $order->delivery_status;
                                            if($order->delivery_status == 'cancelled') {
                                                $status = '<span class="badge rounded-pill alert-danger">Cancelled</span>';
                                            } elseif($order->delivery_status == 'pending') {
                                                $status = '<span class="text-danger">Pending</span>';
                                            }
                                        @endphp
                                        {!! $status !!}
                                    </td>
                                    <td>
                                        @php
                                            $status = $order->payment_status;
                                            if($order->payment_status == 'unpaid') {
                                                $status = '<span class="badge rounded-pill alert-danger">Unpaid</span>';
                                            }
                                            elseif($order->payment_status == 'paid') {
                                                $status = '<span class="badge rounded-pill alert-success">Paid</span>';
                                            }

                                        @endphp
                                        {!! $status !!}
                                    </td>
                                    <td>{{ $order->note_status }}</td>
                                    <td>{{ $order->created_at ? $order->created_at->format('Y-m-d g:i:s A') : '' }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a  type="button" class="btn btn-block" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                            </a>
                                            <ul class="dropdown-menu order__action" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item" target="blank" href="{{route('print.invoice.download',$order->id) }}"><i class="fa-solid fa-print" style="color:#3BB77E"></i>Invoice Print</a>
                                                </li>
                                                @if(Auth::guard('admin')->user()->role == '1' || in_array('18', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                    <li>
                                                        <a  target="_blank" class="dropdown-item" href="{{route('all_orders.show',$order->id) }}">
                                                            <i class="fa-solid fa-eye" style="color:#3BB77E"></i>Details
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a title="Download" href="{{ route('invoice.download', $order->id) }}" class="dropdown-item">
                                                        <i class="fa-solid fa-download" style="color:#3BB77E"></i> Invoice Download
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </form>
                    <!-- table-responsive //end -->
                </div>
                <!-- card-body end// -->
            </div>
            <!-- card end// -->
        </div>
    </div>
</section>

@push('footer-script')
<script type="text/javascript">
    $(function() {
        $('input[name="date_range"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: false,
            locale: {
                format: 'YYYY-MM-DD h:mm A'
            }
        });
    });
</script>
<script>
    $(function() {
        // Function to update "Select All" checkbox based on individual checkboxes
        function updateSelectAll() {
            var allChecked = $('.check_ids:checked').length === $('.check_ids').length;
            $('#select_all_ids').prop('checked', allChecked);
        }

        // Click event for individual checkboxes
        $('.check_ids').change(function() {
            updateSelectAll();
        });

        // Click event for "Select All" checkbox
        $('#select_all_ids').change(function() {
            $('.check_ids').prop('checked', $(this).prop('checked'));
        });
    });
</script>
<script>
    $(function(e) {
        $("#all_package").click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });
            $.ajax({
                url: "{{ route('order.product.packaged') }}",
                type: "GET",
                data: {
                    ids: all_ids,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message, 'message');
                        $.each(all_ids, function(key, val) {
                            $('#order_ids' + val).remove();
                        });
                        window.location.reload(true);
                        }
                    else {
                        toastr.error(response.error, 'Error');
                    }
                }
            });
        });
    });
</script>
<script>
$(function(e) {
    $("#all_print").click(function(e) {
        e.preventDefault();
        var all_ids = [];
        $('input:checkbox[name=ids]:checked').each(function() {
            all_ids.push($(this).val());
        });
        $.ajax({
            url: "{{ route('order.product.Print') }}",
            type: "GET",
            data: {
                ids: all_ids,
                _token: "{{csrf_token()}}"
            },
            success: function(response) {
                window.location.href = response.redirect_url;
                $.each(all_ids, function(key, val) {
                        $('#order_ids' + val).remove();
                    });
            }
        });
    });
});
</script>
@endpush
@endsection

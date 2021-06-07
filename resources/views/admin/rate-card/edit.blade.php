@extends('admin.admin_layout.main')
@section('title', 'Edit Rate Card')
@section('page_title', 'Edit Rate Card')
@section('customcss')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection
@section('content')
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('danger'))
            <div class="alert alert-danger alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form class="form-horizontal" method="POST" action="{{ route('admin.rate-card.update', $rateCard->id) }}">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Rate Card</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="title">Ad Category</label><span class="text-danger" id="cat_err"></span>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $c)
                                        <option value="{{ $c->id }}" @if($c->id == $rateCard->category_id) Selected @endif>{{ $c->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="title">Title</label><span class="text-danger" id="title_err"></span>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $rateCard->title }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Rate Card Rate</label><span class="text-danger" id="price_err"></span>
                                    <input type="number" name="price" id="price" class="form-control" value="{{ $rateCard->rate_price }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Discount (in %)</label><span class="text-danger" id="percent_err"></span>
                                    <input type="number" name="discount_per" id="discount_per" class="form-control" value="{{ $rateCard->discount_per }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Discounted Rate</label><span class="text-danger" id="rate_err"></span>
                                    <input type="text" name="discount_rate" id="discount_rate" class="form-control" value="{{ $rateCard->discount_rate }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Ad Quantity</label><span class="text-danger" id="quantity_err"></span>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $rateCard->quantity }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duration">Duration <small>(in days)</small></label><span class="text-danger" id="duration_err"></span>
                                    <input type="number" class="form-control" id="duration" name="duration" value="{{ $rateCard->duration }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <span id="benefit_err" class="text-danger"></span>
                                @foreach($rateB as $b)
                                <div id="inputFormRow">
                                    <div class="input-group mb-3">
                                        <input type="text" name="benefit[]" id="benefit" class="form-control m-input" placeholder="Enter Benefits" value="{{ $b->benefits }}">
                                        <div class="input-group-append">                
                                            <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div id="newRow"></div>
                            </div>
                            <div class="col-md-3">
                                <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" id="submitButton" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('customjs')

<script type=text/javascript>
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="benefit[]" id="benefit" class="form-control m-input" placeholder="Enter Benefits" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });

    $('body').on('click', '#submitButton', function (event) {
        event.preventDefault();
       
        var category = $("#category").val();
        var title = $("#title").val();
        var price = $("#price").val();
        var discount_per = $("#discount_per").val();
        var discount_rate = $("#discount_rate").val();
        var quantity = $("#quantity").val();
        var duration = $("#duration").val();
        var benefit = $("input[id='benefit']").map(function(){return $(this).val();}).get();
        if (category=="") {
            $("#cat_err").fadeIn().html("Required");
            setTimeout(function(){ $("#cat_err").fadeOut(); }, 3000);
            $("#category").focus();
            return false;
        }
        if (title=="") {
            $("#title_err").fadeIn().html("Required");
            setTimeout(function(){ $("#title_err").fadeOut(); }, 3000);
            $("#title").focus();
            return false;
        }
        if (price=="") {
            $("#price_err").fadeIn().html("Required");
            setTimeout(function(){ $("#price_err").fadeOut(); }, 3000);
            $("#price").focus();
            return false;
        }
        if (discount_per=="") {
            $("#percent_err").fadeIn().html("Required");
            setTimeout(function(){ $("#percent_err").fadeOut(); }, 3000);
            $("#discount_per").focus();
            return false;
        }
        if (discount_rate=="") {
            $("#rate_err").fadeIn().html("Required");
            setTimeout(function(){ $("#rate_err").fadeOut(); }, 3000);
            $("#discount_rate").focus();
            return false;
        }
        if (quantity=="") {
            $("#quantity_err").fadeIn().html("Required");
            setTimeout(function(){ $("#quantity_err").fadeOut(); }, 3000);
            $("#quantity").focus();
            return false;
        }
        if (duration=="") {
            $("#duration_err").fadeIn().html("Required");
            setTimeout(function(){ $("#duration_err").fadeOut(); }, 3000);
            $("#duration").focus();
            return false;
        }
        if (benefit=="") {
            $("#benefit_err").fadeIn().html("Required");
            setTimeout(function(){ $("#benefit_err").fadeOut(); }, 3000);
            $("#benefit").focus();
            return false;
        }
        else{
           $(".form-horizontal").submit();
        }
    })

    $(document).ready(function(){
        var $discount = $('#discount_per'), $price = $('#price'), $newPrice = $('#discount_rate');
        $discount.on('keypress', function(e){
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
                e.stopImmediatePropagation();
                return false;
            } 
        }).on('keyup', function(e) {
		    console.log('keyup');
	        $newPrice.val(Math.round(($price.val() - (($discount.val() / 100) * $price.val()))* 100) / 100);
	    });
    });
</script>
@endsection
@endsection

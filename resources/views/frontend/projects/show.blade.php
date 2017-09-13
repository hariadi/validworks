@extends('frontend.layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">

                <div class="panel-heading">{{ $project->title }}</div>

                <div class="panel-body">
                	<div class="row">
                		<div class="col-md-7">
                			<iframe
							  width="100%"
							  height="500"
							  frameborder="0" style="border:0"
							  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBPl9YmWREYZ6FLFa03YVXp4rH92uAtBJY&q={{ $project->location }}" allowfullscreen>
</iframe>
                		</div>
                		<div class="col-md-5">
	                		<div class="panel panel-info">
	                			<div class="panel-heading">Detail</div>
	                			<div class="panel-body">{{ $project->description }}</div>
	                			@include('backend.projects.includes.overview')
	                			<div class="panel-footer panel-verify">
	                				@if(!$project->isVerified())
	                				<button type="button" class="btn btn-success btn-verify" data-choice="Yes">Yes</button>

	                				<button type="button" class="btn btn-danger btn-verify" data-choice="No">No</button>

	                				<span>Work site at the right location?</span>
	                				@else
	                				<span>Work site has been verified</span>
	                				@endif
	                			</div>
	                		</div>
                		</div>
                	</div>
                </div>
             </div>
		</div>
	</div>
@endsection

@section('after-styles')
    {{ Html::style('plugins/toastr/toastr.min.css') }}
@endsection

@section('after-scripts')
    {{ Html::script('plugins/toastr/toastr.min.js') }}

    <script>
		$(function () {
			toastr.options = {
		        closeButton: true,
		        debug: false,
		        positionClass: "toast-bottom-right",
		        onclick: null,
		        showDuration: "300",
		        hideDuration: "1000",
		        //timeOut: "2000",
		        timeOut: "NEVER",
		        extendedTimeOut: "1000",
		        showEasing: "swing",
		        hideEasing: "linear",
		        showMethod: "fadeIn",
		        hideMethod: "fadeOut"
		    }

			$('.btn-verify').on('click', function(e) {
				e.preventDefault();

				var choice = $(this).attr('data-choice');

				@if(auth()->check())
				toastr.success("1 point has been awarded for verification. Your current point now is <b>{{ access()->user()->point+1 }}</b>");
				@endif

				$.post( "{{ route('frontend.projects.verify', $project) }}", {
					choice: choice,
					@if(isset($locations))
					lat: "{{ $locations['lat'] }}",
					lng: "{{ $locations['lng'] }}",
					@endif
				}, function( response ) {
					$('.panel-verify').html( "<span>Thanks!</span>" );
					toastr.success(response.message);
				}, "json");
			});
		});
	</script>
@endsection

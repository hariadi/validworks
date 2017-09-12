@extends('frontend.layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">

                <div class="panel-heading">{{ $project->title }}</div>

                <div class="panel-body">
                	<div class="row">
                		<div class="col-md-7">
                		{{ var_dump($locations) }}
                		</div>
                		<div class="col-md-5">
	                		<div class="panel panel-info">
	                			<div class="panel-heading">Detail</div>
	                			<div class="panel-body">
	                			{{ $project->description }}
	                			</div>
	                			@include('backend.projects.includes.overview')
	                			<div class="panel-footer">
	                				<a href="#" class="btn btn-danger"><i class="fa fa-exclamation-triangle"></i> Report</a>

	                				<a href="#"><i class="fa fa-facebook-official"></i></a>
	                			</div>
	                		</div>
                		</div>
                	</div>
                </div>
             </div>
		</div>
	</div>
@endsection

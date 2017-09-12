@extends('frontend.layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">

                <div class="panel-heading">{{ $project->title }}</div>

                <div class="panel-body">
                	<div class="row">
                		<div class="col-md-7">Maps</div>
                		<div class="col-md-5">
	                		<div class="panel panel-info">
	                			<div class="panel-heading">Detail</div>
	                			<div class="panel-body">
	                			{{ $project->description }}
	                			</div>
	                			@include('backend.projects.includes.overview')
	                		</div>
                		</div>
                	</div>
                </div>
             </div>
		</div>
	</div>
@endsection

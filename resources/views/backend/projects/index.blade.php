@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.projects.management') }}
        <small>{{ trans('labels.backend.projects.lists') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.projects.lists') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.projects.includes.project-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Title</th>
                        @if(! access()->user()->hasRole('User'))
                        <th>Submit by</th>
                        <th>Vendor</th>
                        @endif
                        <th>Approved</th>
                        <th>Started At</th>
                        <th>Ended At</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    	@foreach($projects as $project)
                    	<tr id="project-{!! $project->uuid !!}">
	                        <td>{{ $project->title }}</td>
                        	@if(! access()->user()->hasRole('User'))
	                        <td>{{ $project->submitBy }}</td>
	                        <td>{{ $project->vendor->name }}</td>
	                        @endif
	                        <td>{!! $project->status !!}</td>
	                        <td>{{ $project->started_at->diffForHumans() }}</td>
	                        <td>{{ $project->ended_at->diffForHumans() }}</td>
	                        <td>{!! $project->action_buttons !!}</td>
                    	</tr>
                    	@endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->

        <div class="box-footer clearfix">
        {{ $projects->appends(request()->only('status'))->links() }}
        </div>
    </div><!--box-->
@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

    <script>
        $(function () {

        });
    </script>
@endsection

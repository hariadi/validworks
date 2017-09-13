@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.reports.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.reports.management') }}
        <small>{{ trans('labels.backend.reports.lists') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.reports.lists') }}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Submit by</th>
                        <th>Project</th>
                        <th>Feedback</th>
                        <th>Created</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    	@foreach($reports as $report)
                    	<tr>
                    		<td>{!! $report->id !!}</td>
	                        <td>{{ $report->submit_by }}</td>
	                        <td>{{ $report->project->title }}</td>
	                        <td>{!! $report->feedback !!}</td>
	                        <td>{{ $report->created_at->diffForHumans() }}</td>
	                        <td>{!! $report->action_buttons !!}</td>
                    	</tr>
                    	@endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->

        <div class="box-footer clearfix">
        {{ $reports->appends(request()->only('status'))->links() }}
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

<table class="table table-hover">

	<tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.qrcode') }}</th>
        <td>{!! $project->qrcode !!}</td>
    </tr>

    @if(!auth()->guest())
    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.uuid') }}</th>
        <td>{!! $project->uuid_label !!}</td>
    </tr>
    @endif

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.title') }}</th>
        <td>{{ $project->title }}</td>
    </tr>

    @if(isset($description) && $description === true)
    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.description') }}</th>
        <td>{{ $project->description }}</td>
    </tr>
    @endif

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.address') }}</th>
        <td>{{ $project->address }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.vendor') }}</th>
        <td>{!! $project->vendor->name !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.submit_by') }}</th>
        <td>{!! $project->user->name !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.approved') }}</th>
        <td>{!! $project->status !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.started_at') }}</th>
        <td>{{ $project->started_at }} ({{ $project->started_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.ended_at') }}</th>
        <td>{{ $project->ended_at }} ({{ $project->ended_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.created_at') }}</th>
        <td>{{ $project->created_at }} ({{ $project->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.projects.tabs.content.overview.last_updated') }}</th>
        <td>{{ $project->updated_at }} ({{ $project->updated_at->diffForHumans() }})</td>
    </tr>
</table>

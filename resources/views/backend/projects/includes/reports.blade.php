<div class="row">
	<div class="col-md-4">
		<ul class="list-group">
		  <li class="list-group-item list-group-item-success">Yes <span class="badge">{{ $project->verifies->filter(function($v) { return $v->choice == 'Yes'; })->count() }}</span></li>
		  <li class="list-group-item list-group-item-warning">No <span class="badge">{{ $project->verifies->filter(function($v) { return $v->choice == 'No'; })->count() }}</span></li>
		  <li class="list-group-item list-group-item-info">Total <span class="badge">{{ $project->verifies->count() }}</span></li>
		</ul>
	</div>
</div>

<table class="table table-hover">
	<thead>
		<tr>
	        <th>IP</th>
	        <th>Project</th>
	        <th>Choice</th>
	        <th>Latitude</th>
	        <th>Longitude</th>
	        <th>Created</th>
	    </tr>
    </thead>
	@foreach($project->verifies as $verify)
		<tr>
	        <td>{{ $verify->ip }}</td>
	        <td>{{ $verify->project->title }}</td>
	        <td>{{ $verify->choice }}</td>
	        <td>{{ $verify->latitude }}</td>
	        <td>{{ $verify->longitude }}</td>
	        <td>{{ $verify->created_at->diffForHumans() }}</td>
	    </tr>
	@endforeach
</table>

@extends('frontend.layouts.app')

@section('content')
	<div class="row">

		<div class="col-md-5">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#projects" data-toggle="tab">Projects</a></li>
              <li><a href="#report" data-toggle="tab">Report</a></li>
            </ul>
            <div class="tab-content">

              <!-- /.tab-pane -->
              <div class="active tab-pane" id="projects">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">

                	@foreach($projects as $project)
	                  <!-- timeline time label -->
	                  <li class="time-label">
	                        <span class="bg-yellow">
	                        	<time datetime="{{ $project->started_at->toW3cString() }}">{{ $project->started_at->format('j M Y')  }}</time>
	                        </span>
	                  </li>
	                  <!-- /.timeline-label -->

	                  <!-- timeline item -->
	                  <li>
	                    <i class="fa fa-map-marker bg-blue"></i>

	                    <div class="timeline-item">
	                      <span class="time"><i class="fa fa-clock-o"></i> {{ $project->started_at->format('g:i A')  }}</span>

	                      <h3 class="timeline-header"><a href="#">{{ $project->title }}</a></h3>

	                      <div class="timeline-body">{{ $project->description }}</div>
	                      <div class="timeline-footer">
	                        <a class="btn btn-primary btn-xs">Read more</a>
	                        <a class="btn btn-danger btn-xs">Report</a>
	                      </div>
	                    </div>
	                  </li>
	                  <!-- END timeline item -->
	                @endforeach
                </ul>
                <div class="box-footer clearfix">
		        {{ $projects->links() }}
		        </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="report">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <div class="col-md-7">
        <iframe width="100%" height="500" frameborder="0" style="border:0" src="{{ route('frontend.map') }}"></iframe>
        </div>
	</div>
@endsection

@section('after-styles')
	<style>
	  /* Always set the map height explicitly to define the size of the div
	   * element that contains the map. */
	  #map {
		height: 100%;
	  }
	  /* Optional: Makes the sample page fill the window. */
	  html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	  }
	</style>
@endsection




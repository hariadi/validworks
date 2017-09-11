@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.projects.management') . ' | ' . trans('labels.backend.projects.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.projects.management') }}
        <small>{{ trans('labels.backend.projects.edit') }}</small>
    </h1>
@endsection

@section('content')
{{ Form::model($project, ['route' => ['admin.projects.update', $project], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class=" box-title">{{ trans('labels.backend.projects.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.projects.includes.project-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">

                 @include('backend.projects.includes.forms')

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.projects.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.edit'), ['class' => 'btn btn-success']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection

@section('after-scripts')
    {{-- {{ Html::script('js/backend/projects/projects/script.js') }} --}}
@endsection

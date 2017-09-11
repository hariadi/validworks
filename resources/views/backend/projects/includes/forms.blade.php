<div class="form-group">
    {{ Form::label('title', trans('validation.attributes.backend.projects.title'), ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-10">
        {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.projects.title')]) }}
    </div><!--col-lg-10-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('description', trans('validation.attributes.backend.projects.description'),
     ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-10">
        {{ Form::textarea('description', null, ['rows' => 3,'class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.projects.description')]) }}
    </div><!--col-lg-10-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('address', trans('validation.attributes.backend.projects.address'), ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-10">
        {{ Form::text('address', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.projects.address')]) }}
    </div><!--col-lg-10-->
</div><!--form control-->


<div class="form-group">
    {{ Form::label('latitude', trans('validation.attributes.backend.projects.latitude'), ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-6">
        {{ Form::text('latitude', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.projects.latitude')]) }}
    </div><!--col-lg-6-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('longitude', trans('validation.attributes.backend.projects.longitude'), ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-6">
        {{ Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.projects.longitude')]) }}
    </div><!--col-lg-6-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('started_at', trans('validation.attributes.backend.projects.started_at'), ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-6">
        {{ Form::text('started_at', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.projects.started_at')]) }}
    </div><!--col-lg-6-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('ended_at', trans('validation.attributes.backend.projects.ended_at'), ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-6">
        {{ Form::text('ended_at', null, ['class' => 'form-control', 'required' => 'required','placeholder' => trans('validation.attributes.backend.projects.ended_at')]) }}
    </div><!--col-lg-6-->
</div><!--form control-->

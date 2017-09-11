<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{ link_to_route('admin.projects.index', trans('menus.backend.projects.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{ link_to_route('admin.projects.create', trans('menus.backend.projects.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    {{ link_to_route('admin.projects.index', trans('menus.backend.projects.approved'), ['status' => 'approved'], ['class' => 'btn btn-warning btn-xs']) }}
    {{ link_to_route('admin.projects.index', trans('menus.backend.projects.unapproved'), ['status' => 'unapproved'], ['class' => 'btn btn-danger btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.projects.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('admin.projects.index', trans('menus.backend.projects.all')) }}</li>
            <li>{{ link_to_route('admin.projects.create', trans('menus.backend.projects.create')) }}</li>
            <li class="divider"></li>
            <li>{{ link_to_route('admin.projects.index', trans('menus.backend.projects.approved'), ['status' => 'approved']) }}</li>
            <li>{{ link_to_route('admin.projects.index', trans('menus.backend.projects.unapproved'), ['status' => 'approved']) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>

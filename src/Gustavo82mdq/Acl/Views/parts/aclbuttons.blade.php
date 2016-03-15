@if ($role->permissions()->where('slug', $action)->get()->first())
    <form action="{{ route('acl.unsetpermission', [$action, $role->id]) }}" method="POST">
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-success">
             <i class="fa fa-check-square" ></i>
        </button>
    </form>
@else
    <form action="{{ route('acl.setpermission', [$action, $role->id]) }}" method="POST">
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-danger">
             <i class="fa fa-minus-square" ></i>
        </button>
    </form>
@endif

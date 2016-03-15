@extends('layouts.app')

@section('content')
    <script src="{{ asset('gustavo82mdq/acl/js/functions.js') }}"></script>
    @if (count($actions) > 0 && count($roles) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                ACLs
            </div>
            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                        <th>&nbsp;</th>
                        @foreach ($roles as $role)
                            <th>{{ $role->name }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        <tr>
                            <td>&nbsp;</td>
                            @foreach ($roles as $role)
                                <td>
                                    <form action="{{ route('acl.setall', $role->id) }}" method="POST" data-noajax="true">
                                        {!! csrf_field() !!}
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-check-square" >  Set All</i>
                                        </button>
                                    </form>&nbsp;
                                    <form action="{{ route('acl.unsetall', $role->id) }}" method="POST" data-noajax="true">
                                        {!! csrf_field() !!}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-minus-square" >  Unset All</i>
                                        </button>
                                    </form>
                                </td>
                            @endforeach
                        </tr>
                        @foreach ($actions as $action)
                            <tr>
                                <td>{{ $action }}</td>
                                @foreach ($roles as $role)
                                    <td>
                                        @include('acl::parts.aclbuttons')
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
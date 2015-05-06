@extends('layout')

@section('title') Users @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <?php if (Session::has('success')): ?>
        <p class="success"><?php echo Session::get('success'); ?></p>
    <?php endif; ?>

    <h1><i class="fa fa-users"></i> Manage Users <a href="/logout" class="btn btn-default pull-right">Logout</a></h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date/Time Added</th>
                <th>Last Updated</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                <td>{{ $user->updated_at->format('F d, Y h:ia') }}</td>
                <td>
                    <a href="/user/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                    <a href="/user/{{ $user->id }}/delete" class="btn btn-info pull-left">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <a href="/user/create" class="btn btn-success">Add User</a>

</div>

@stop
@extends('layouts.admin')

@section('header')
    User
@endsection

@section('scripts')
    <script>
        $("#change-userGroup").on('click', e => {
            $('#usergroup-change-modal').modal('show')
        })
    </script>
@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div>
                        <h5><b>Name</b> : {{ $user->name }}</h5>
                        <h5><b>Phone</b> : {{ $user->phone }}</h5>
                        <h5><b>Group</b> : {{ $user->usergroup?->name ?? 'normal' }}</h5>
                        <h5><b>Member since</b> : {{ $user->created_at }}</h5>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card card-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Facebook</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <img src="{{ $user->facebook_profilePhoto }}" class="img-fluid img-section mb-2" alt="">
                        <h4 class="text-center">{{ $user->facebook_displayName ?? "Not Connected" }}</h4>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-2">
                    <div class="card card-warning collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Google</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <img src="{{ $user->google_profilePhoto }}" class="img-fluid img-section mb-2" alt="">
                        <h4 class="text-center">{{ $user->google_displayName ?? "Not Connected" }}</h4>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                
            </div>
            
            <button class="btn btn-primary my-2 mb-4" id="change-userGroup"><i class="fa fa-edit"></i> Edit</button>
            @include('admin.user._modal_edit_user')
            
            <table class="table table-hover no-more-tables">
                <tr>
                    <td class="h5">Active Points</td>
                    <td class="h5">Total Points</td>
                    <td class="h5">Level Points</td>
                    <td class="h5"></td>
                </tr>
                <tr>
                    <td>{{ $user->points }}</td>
                    <td>{{ $user->total_points }}</td>
                    <td>{{ $user->level_points }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th class="h4">POINTS</th>
                    <th class="h4">TYPE</th>
                    <th class="h4">DATE</th>
                </tr>
                @foreach($user->userTransactions as $userTransaction)
                    <tr>
                        <td>{{ $userTransaction->points }}</td>
                        <td>{{ $userTransaction->transaction->name }}</td>
                        <td>{{ date('d/m/y h:i A', strtotime($userTransaction->created_at )) }}</td>
                    </tr>
                @endforeach
            </table>

            <ul class="pagination">

            </ul>
        </div>
    </div>
<style>
    .img-section{
        width: 173px;
        height: 173px;
    }
</style>

@endsection
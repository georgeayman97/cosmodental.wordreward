@extends('layouts.admin')

@section('header')
    TRANSACTIONS
@endsection

@section('scripts')
    @include('admin.transaction._js')
@endsection

@section('content')
    <div class="administrators index">
        <div class="box box-primary">
            <form>
                <select name="transaction_type_id" class="form-control">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id != request()->type ?: 'selected' }}
                        >{{ $type->name }}</option>
                    @endforeach
                </select>
                <div class="my-4">
                    <button class="btn btn-primary right">Filter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-hover no-more-tables">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>RECEIVER</th>
                    <th>REFERER</th>
                    <th>POINTS</th>
                    <th>MEMBERSHIP</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th class="actions">Actions</th>
                </tr>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td><a href="{{ route('user.show', $transaction->user->id) }}"
                            >{{ $transaction->user->name }}</a>
                        </td>
                        <td>{{ $transaction->name }}</td>
                        <td><a href="{{ route('user.show', $transaction->user->id) }}"
                            >{{ $transaction->receiver?->name ?? '' }}</a>
                        </td>
                        <td><a href="{{ route('user.show', $transaction->user->id) }}"
                            >{{ $transaction->referer?->name ?? '' }}</a>
                        </td>
                        <td>{{ $transaction->points }}</td>
                        <td>{{ $transaction->user?->userGroup->name ?? '' }}</td>
                        <td>{{ date('d/m/y h:i A', strtotime($transaction->created_at)) }}</td>
                        <td>
                            <span class="badge {{ $transaction->status_name }}">{{ $transaction->status_name }}</span>
                        </td>
                        <td>
                            @if ($transaction->status === TRANSACTION_PENDING)
                                <button class="btn btn-success acceptTransaction" value="{{ $transaction->id }}">
                                    ACCEPT
                                </button>
                                <button class="btn btn-danger rejectTransaction" value="{{ $transaction->id }}">
                                    REJECT
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="paginating-container">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>


@endsection
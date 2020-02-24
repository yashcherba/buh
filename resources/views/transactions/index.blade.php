@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Transactions</div>

                    <div class="card-body">
                        @if(session()->get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <div class="table-actions" style="margin-bottom: 20px;">
                            <a href="{{ route('transactions.create')}}">Add new transaction</a>
                        </div>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Category</th>
                                <th scope="col">Sum</th>
                                <th scope="col" colspan="2" width="15%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date->format('d.m.Y') }}</td>
                                    <td>{{ $categories[$transaction->categoryid] }}</td>
                                    <td>{{ $transaction->sum }}</td>
                                    <td>
                                        <a href="{{ route('transactions.edit', $transaction->id)}}"
                                           class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('transactions.destroy', $transaction->id)}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $transactions->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

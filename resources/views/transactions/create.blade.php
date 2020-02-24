@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add transaction</div>

                    <div class="card-body">
                        @if(session()->get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br/>
                            @endif
                            <form method="post" action="{{ route('transactions.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" class="form-control" name="date"/>
                                </div>

                                <div class="form-group">
                                    <label for="categoryid">Category:</label>
                                    <select name="categoryid" id="categoryid">
                                        <option value="null">-</option>
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sum">Sum:</label>
                                    <input type="text" class="form-control" name="sum"/>
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Add transaction</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

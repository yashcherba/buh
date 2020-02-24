@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update category</div>

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
                            <form method="post" action="{{ route('categories.update', $category->id) }}">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" value={{ $category->name }} />
                                </div>
                                <div class="form-group">
                                    <label for="typeid">Type:</label>
                                    <select name="typeid" id="typeid">
                                        @foreach($categoryType as $key => $type)
                                            @if($key == $category->typeid)
                                                <option selected value="{{ $key }}">{{ $type }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Update category</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

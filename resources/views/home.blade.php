@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Bookkeeping</div>

                    <div class="card-body">
                        @if(session()->get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <div class="month-choice" style="margin-bottom: 10px;">
                            <label for="month">Month</label>
                            <select name="month" id="month">
                                <option value="1">Январь</option>
                                <option value="2">Февраль</option>
                                <option value="3">Март</option>
                                <option value="4">Апрель</option>
                                <option value="5">Март</option>
                                <option value="6">Июнь</option>
                                <option value="7">Июль</option>
                                <option value="8">Август</option>
                                <option value="9">Сентябрь</option>
                                <option value="10">Октябрь</option>
                                <option value="11">Ноябрь</option>
                                <option value="12">Декабрь</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Категория</th>
                                    @foreach($monthDates as $key => $value)
                                        <th scope="col">{{ $value['date'] }}</th>
                                    @endforeach
                                    <th scope="col">Итого</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($monthTransactions as $key => $value)
                                        <tr>
                                            <td>{{ $value['name'] }}</td>
                                            @foreach($value['dates'] as $keyDates => $valueDates)
                                                <td>{{ $valueDates['sum'] }}</td>
                                            @endforeach
                                            <td>{{ $value['itogo'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

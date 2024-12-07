@extends('admin.layout.layout')
@section('panel')
    <div class="card my-2">
        <div class="card-header">
            <h5 class="card-title">Dashboard</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 p-2">

                    <div class="card bg-primary text-light p-4">
                        <h5>Total Users</h5>
                        <h6></h6>
                        <h6>{{$totalUsers }}</h6>
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="card bg-primary text-light p-4">
                        <h5>Total Sellers</h5>
                        <h6></h6>
                        <h6>{{ $totalSellers }}</h6>
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="card bg-primary text-light p-4">
                        <h5>Total Buyer</h5>
                        <h6></h6>
                        <h6>{{ $totalBuyer}}</h6>
                    </div>
                </div>
                <div class="col-md-3 p-2">
                    <div class="card bg-primary text-light p-4">
                        <h5>Total Brands</h5>
                        <h6></h6>
                        <h6>{{ $totalBrands }}</h6>
                    </div>
                </div>

            </div>
            {{-- <div class="card p-1 bg-primary text-light">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Sales</h5>
                    </div>
                </div> --}}
                {{-- <div class="table-responsive rounded text-dark bg-light">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($total_year_expense as $expense)
                                <tr>
                                    <td>{{ DateTime::createFromFormat('!m', $expense->month)->format('F') }}</td>
                                    <td>Rs {{ $expense->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('panel.js')

@endsection

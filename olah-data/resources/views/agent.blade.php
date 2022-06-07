@extends('welcome')


@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">TOP 10 Agent dengan Customer Terbanyak<br>
                    {{-- <div class="row mt-2">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Registrasi awal</label>
                                <input type="text" class="form-control tgl1" id="datepicker1" name="nama" aria-describedby="emailHelp" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Registrasi akhir</label>
                                <input type="text" class="form-control tgl2" id="datepicker2" name="nama" aria-describedby="emailHelp" autocomplete="off">
                            </div>
                        </div>
                        <button onclick="search()" class="btn btn-primary">Cari</button>
                    </div> --}}
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N0</th>
                                <th scope="col">Nama Agent</th>
                                <th scope="col">Jumlah Customer</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">



                            @foreach ($item as $data)
                            <tr>
                                <td scope="col">{{ $loop->iteration }}</td>
                                <td scope="col">{{ $data->store_name }}</td>
                                <td scope="col">{{ $data->orders_count }}</td>
                                 </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination">

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@endpush

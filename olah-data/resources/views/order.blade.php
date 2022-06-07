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
                <div class="card-header">List Order<br>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Delivery awal</label>
                                <input type="text" class="form-control tgl1" id="datepicker1" name="nama" aria-describedby="emailHelp" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Delivery akhir</label>
                                <input type="text" class="form-control tgl2" id="datepicker2" name="nama" aria-describedby="emailHelp" autocomplete="off">
                            </div>
                        </div>
                        <button onclick="search()" class="btn btn-primary">Cari</button>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N0</th>
                                <th scope="col">Invoice Id</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Nama Agent</th>
                                <th scope="col">Payment Final</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

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

<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="hidden" class="form-control" id="id">
                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Telepon</label>
                        <input type="number" class="form-control" id="phone" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Nomor Telepon">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Registrasi</label>
                        <input type="text" class="form-control tgl" id="datepicker" name="nama" aria-describedby="emailHelp" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary submit">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <script>
        let data = [];
        let last_page = 0;
        let last_page_url = "";
        let per_page = 0;
        let prev_page = 0;
        let prev_page_url = '';
        let next_page = 0;
        let next_page_url = "";
        let from = 0;
        let to = 0;
        let current_page = 0;
        let total = 0;
        let fromDate = null
        let toDate = null
        $(document).ready(async function () {
            await $.ajax({
                url: '/order/getData',
                type: "get",
                success: function (result) {
                    data = result.data;
                    form = result.form;
                    total = result.total;
                    current_page = result.current_page;
                    to = result.to;
                    per_page = result.per_page;
                    prev_page = result.prev_page;
                    last_page = result.last_page;
                    next_page = result.next_page;
                    first_page = result.first_page;
                    last_page_url = result.last_page_url;
                    first_page_url = result.first_page_url;
                    prev_page_url = result.prev_page_url;
                    next_page_url = result.next_page_url;
                } //Change to this
            });

            $.each(data, function (key, value) {
                var status = '';

                if (value['status'] == 1) status = 'new order';
                else if (value['status'] == 2) status = 'payment success';
                else if (value['status'] == 3) status = 'order proccess';
                else if (value['status'] == 4) status = 'order completed';
                else if (value['status'] == 5) status = 'order cancel ';
                else if (value['status'] == 6) status = 'payment pending';
                else if (value['status'] == 7) status = 'payment failed';
                $('#tbody').append(
                    '   <tr><th scope="row">' + (key + 1) + '</th>' + '<td>' + value["invoice_id"] + '</td>' + '<td>' + (value['name']) + '</td><td>' + (value['agent_name']) + '</td><td>' + (value['payment_final']) + '</td><td>' + status + '</td><td><a href="/order/' + value['id'] + '" class="btn btn-warning">detail</a></td></>'
                );


            });
            $('.pagination').empty();
            if (prev_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + prev_page_url + '`)">Previous</a></li>'
                );
            } else {
                $('.pagination').append(
                    '<li class="page-item disabled"><a class="page-link" onClick="prev()">Previous</a></li>'
                );
            }
            if (1 != current_page) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + first_page_url + '`)">' + 1 + '</a></li>'
                );
            }


            $('.pagination').append(
                '<li class="page-item disabled"><a class="page-link" >' + current_page + '</a></li>'
            );

            if (last_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + last_page_url + '`)">' + last_page + '</a></li>'
                );
            }

            if (next_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + next_page_url + '`)">Next</a></li>'
                );
            } else {
                $('.pagination').append(
                    '<li class="page-item disabled"><a class="page-link" onClick="next()">Next</a></li>'
                );
            }
        });


        async function render() {

            await $.ajax({
                url: '/order/getData?start=' + fromDate + '&end=' + toDate,
                type: "get",
                success: function (result) {
                    data = result.data;
                    form = result.form;
                    total = result.total;
                    current_page = result.current_page;
                    to = result.to;
                    per_page = result.per_page;
                    prev_page = result.prev_page;
                    last_page = result.last_page;
                    next_page = result.next_page;
                    first_page = result.first_page;
                    last_page_url = result.last_page_url;
                    first_page_url = result.first_page_url;
                    prev_page_url = result.prev_page_url;
                    next_page_url = result.next_page_url;
                } //Change to this
            });
            await $('#tbody').empty();
            if (data.length == 0) {
                $('#tbody').append(
                    '<tr><th scope="row">No data</th></tr>'
                );
            }
            $.each(data, function (key, value) {

               var status = '';

                if (value['status'] == 1) status = 'new order';
                else if (value['status'] == 2) status = 'payment success';
                else if (value['status'] == 3) status = 'order proccess';
                else if (value['status'] == 4) status = 'order completed';
                else if (value['status'] == 5) status = 'order cancel ';
                else if (value['status'] == 6) status = 'payment pending';
                else if (value['status'] == 7) status = 'payment failed';
                $('#tbody').append(
                    '   <tr><th scope="row">' + (key + 1) + '</th>' + '<td>' + value["invoice_id"] + '</td>' + '<td>' + (value['name']) + '</td><td>' + (value['agent_name']) + '</td><td>' + (value['payment_final']) + '</td><td>' + status + '</td><td><a href="/order/' + value['id'] + '" class="btn btn-warning">detail</a></td></>'
                );

            });
            $('.pagination').empty();
            if (prev_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + prev_page_url + '`)">Previous</a></li>'
                );
            } else {
                $('.pagination').append(
                    '<li class="page-item disabled"><a class="page-link" onClick="prev()">Previous</a></li>'
                );
            }
            if (1 != current_page) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + first_page_url + '`)">' + 1 + '</a></li>'
                );
            }


            $('.pagination').append(
                '<li class="page-item disabled"><a class="page-link" >' + current_page + '</a></li>'
            );

            if (last_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + last_page_url + '`)">' + last_page + '</a></li>'
                );
            }

            if (next_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + next_page_url + '`)">Next</a></li>'
                );
            } else {
                $('.pagination').append(
                    '<li class="page-item disabled"><a class="page-link" onClick="next()">Next</a></li>'
                );
            }
        }

        async function search() {
            fromDate = $('#datepicker1').val();
            toDate = $('#datepicker2').val();
            await render();
        }

        async function changePage(url) {
            await $.ajax({
                url: url,
                type: "get",
                success: function (result) {
                    console.log(result);
                    data = result.data;
                    form = result.form;
                    total = result.total;
                    current_page = result.current_page;
                    to = result.to;
                    per_page = result.per_page;
                    prev_page = result.prev_page;
                    last_page = result.last_page;
                    next_page = result.next_page;
                    first_page = result.first_page;
                    last_page_url = result.last_page_url;
                    first_page_url = result.first_page_url;
                    prev_page_url = result.prev_page_url;
                    next_page_url = result.next_page_url;
                } //Change to this
            });

            $.each(data, async function (key, value) {
                await $('#tbody').empty();
                var status = '';

                if (value['status'] == 1) status = 'new order';
                else if (value['status'] == 2) status = 'payment success';
                else if (value['status'] == 3) status = 'order proccess';
                else if (value['status'] == 4) status = 'order completed';
                else if (value['status'] == 5) status = 'order cancel ';
                else if (value['status'] == 6) status = 'payment pending';
                else if (value['status'] == 7) status = 'payment failed';
                $('#tbody').append(
                    '   <tr><th scope="row">' + (key + 1) + '</th>' + '<td>' + value["invoice_id"] + '</td>' + '<td>' + (value['name']) + '</td><td>' + (value['agent_name']) + '</td><td>' + (value['payment_final']) + '</td><td>' + status + '</td><td><a href="/order/' + value['id'] + '" class="btn btn-warning">detail</a></td></>'
                );


            });
            $('.pagination').empty();
            if (prev_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + prev_page_url + '`)">Previous</a></li>'
                );
            } else {
                $('.pagination').append(
                    '<li class="page-item disabled"><a class="page-link" onClick="prev()">Previous</a></li>'
                );
            }
            if (1 != current_page) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + first_page_url + '`)">' + 1 + '</a></li>'
                );
            }

            $('.pagination').append(
                '<li class="page-item disabled"><a class="page-link" >' + current_page + '</a></li>'
            );

            if (last_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + last_page_url + '`)">' + last_page + '</a></li>'
                );
            }

            if (next_page_url != null) {
                $('.pagination').append(
                    '<li class="page-item"><a class="page-link" onClick="changePage(`' + next_page_url + '`)">Next</a></li>'
                );
            } else {
                $('.pagination').append(
                    '<li class="page-item disabled"><a class="page-link" onClick="next()">Next</a></li>'
                );
            }
        }


        $('#datepicker1').datepicker({
            dateFormat: 'yy-mm-dd',
        })
        $('#datepicker2').datepicker({
            dateFormat: 'yy-mm-dd',
        })
        $('#datepicker').datepicker({
            dateFormat: 'yy-dd-mm',
            onSelect: function (datetext) {
                var d = new Date(); // for now

                var h = d.getHours();
                h = (h < 10) ? ("0" + h) : h;

                var m = d.getMinutes();
                m = (m < 10) ? ("0" + m) : m;

                var s = d.getSeconds();
                s = (s < 10) ? ("0" + s) : s;

                datetext = datetext + "T" + h + ":" + m + ":" + s + ".000000Z";

                $('#datepicker').val(datetext);
            }
        });
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

    </script>
@endpush

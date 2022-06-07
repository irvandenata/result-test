@extends('layouts.app')


@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detai Customer {{ $user->first_name }} {{ $user->last_name }}<br>
                </div>

                <div class="card-body">
                    <div class="row">


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" value="{{ $user->first_name }}" disabled>
                                    </div>
                                </div>
                                 <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" value="{{ $user->last_name }}" disabled>
                                    </div>
                                </div>
                                 <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" value="{{ $user->customer->address }}" disabled>
                                    </div>
                                </div>
                                 <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" value="{{ $user->phone }}" disabled>
                                    </div>
                                </div>
                                 <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Registrasi</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" value="{{ $user->created_at }}" disabled>
                                    </div>
                                </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

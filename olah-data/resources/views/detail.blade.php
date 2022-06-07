@extends('welcome')


@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detai Order {{ $order->name }}<br>
                </div>

                <div class="card-body">
                    <div class="row">


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Name</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" value="{{ $order->detailOrder->product->product_name }}" disabled>
                                    </div>
                                </div>
                                 <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price Sell</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" value="{{ $order->detailOrder->product->price_sell }}" disabled>
                                    </div>
                                </div>

                                 <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deskripsi</label>
                                        <input type="hidden" class="form-control" id="id">
                                        <textarea class="form-control" style="width: 100%; height: 300px;"   disabled>
                                            {{ $order->detailOrder->product->description }}
                                        </textarea>
                                    </div>
                                </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

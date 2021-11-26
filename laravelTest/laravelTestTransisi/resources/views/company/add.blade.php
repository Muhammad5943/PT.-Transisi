@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('company.store') }}" enctype="multipart/form-data" method="POST" class="mb-3">
                            @csrf

                            <div class="input-group flex-nowrap mt-3">
                                <span class="input-group-text" id="addon-wrapping">Name</span>
                                <input type="text" name="name" class="form-control" aria-describedby="addon-wrapping">
                            </div>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Email</span>
                                <input type="text" name="email" class="form-control" aria-describedby="addon-wrapping">
                            </div>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Website</span>
                                <input type="text" name="website" class="form-control" aria-describedby="addon-wrapping">
                            </div>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Logo</span>
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right btn-block">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

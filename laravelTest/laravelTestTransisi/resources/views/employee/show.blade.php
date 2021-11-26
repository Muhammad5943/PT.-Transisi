@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('employee.update', $employee->id) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PUT')

                            <div class="input-group flex-nowrap mt-3">
                                <span class="input-group-text" id="addon-wrapping">Company</span>
                                <input type="number" name="company_id" class="form-control" value="{{ $employee->company_id }}" aria-label="Product Price" aria-describedby="addon-wrapping">
                            </div>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Name</span>
                                <input type="text" name="name" class="form-control" aria-label="quantity" value="{{ $employee->name }}" aria-describedby="addon-wrapping">
                            </div>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Email</span>
                                <input type="text" name="email" class="form-control" aria-label="quantity" value="{{ $employee->email }}" aria-describedby="addon-wrapping">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right btn-block">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

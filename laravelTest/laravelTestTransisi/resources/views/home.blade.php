@extends('layouts.app')

@section('content')
    {{-- notifikasi form validasi --}}
    @if ($errors->has('file'))
        <span class="invalid-feedback mt-3" role="alert">
            <strong>{{ $errors->first('file') }}</strong>
        </span>
    @endif

    {{-- notifikasi sukses --}}
    @if ($success = Session::get('success'))
        <div class="alert alert-success alert-block mt-3">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{{ $success }}</strong>
        </div>
    @endif

    {{-- notifikasi sukses --}}
    @if ($delete = Session::get('delete'))
        <div class="alert alert-danger alert-block mt-3">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{{ $delete }}</strong>
        </div>
    @endif


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-md-8 d-flex justify-content-between">
                <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                    IMPORT EXCEL
                </button>
                <a href="/employee/export_pdf" class="btn btn-danger" target="_blank">CETAK PDF</a>
                <a href="{{ route('posts.add') }}" class="btn btn-success">Tambah Employee</a>
                <a href="{{ route('company.create') }}" class="btn btn-info">Tambah Company</a>
            </div>
            <!-- Import Excel -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="/employee/import_excel" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}

                                <label>Pilih file excel</label>
                                <div class="form-group">
                                    <input type="file" name="file" required="required">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <div>
                <table class='table table-bordered mt-5'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($companies as $key => $company)
                        <tr>
                            <td>{{ $companies->firstItem() + $key }}</td>
                            <td>{{$company->name}}</td>
                            <td>{{$company->email}}</td>
                            <td>{{$company->website}}</td>
                            <td>
                                <img src="{{$company->logo}}" style="width: 50%; height: 50%;" alt="{{$company->name}}"><br>
                                {{$company->name}}
                            </td>
                            <td class="d-flex">
                                <button class="btn btn-warning"><a href="{{ route('company.show', [$company->id]) }}">Edit</a></button>
                                <form action="{{ route('company.destroy', $company->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {!! $companies->links() !!}
                </div>
            </div>


            <table class='table table-bordered mt-5'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($employees as $key => $employee)
                    <tr>
                        <td>{{ $employees->firstItem() + $key }}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->company->name}}</td>
                        <td class="d-flex">
                            <button class="btn btn-warning"><a href="{{ route('employee.show', [$employee->id]) }}">Edit</a></button>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {!! $employees->links() !!}
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        </div>
    </div>
@endsection

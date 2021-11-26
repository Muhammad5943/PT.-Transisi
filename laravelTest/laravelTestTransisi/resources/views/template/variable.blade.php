<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <style type="text/css">
        @page {
            size: F4;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-top: 1cm;
            margin-bottom: 2cm;
        }

        body {
            line-height: 1;
            font-family: 'arial', sans-serif;
            font-size: 12px
        }

        table {
            border-collapse: collapse;
        }


        th {
            font-weight: bold;
            border: 1px solid black;
            vertical-align: top;
            padding: 8px;
        }

        td {
            border: 1px solid black;
            vertical-align: top;
            padding: 8px;
        }

        .fullwidth {
            width: 100%;
        }
    </style>

    <table class="fullwidth">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($employees as $key => $employee)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->company->name }}</td>
                </tr>
                @endforeach
            </tbody>
    </table>


</body>

</html>

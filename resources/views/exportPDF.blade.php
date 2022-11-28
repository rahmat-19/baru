<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th scope="col">Nama OLT</th>
                <th scope="col">Label</th>
                <th scope="col">Port</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Izin</th>
                <th scope="col">Waktu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data->olt_ports->olts->hostname}}</td>
                <td>{{$data->label}}</td>
                <td>{{$data->olt_ports->port_number}}</td>
                <td>{!! $data->keterangan !!}</td>
                <td>@if($data->izin === 2) <p class="text-primary">Menunggu</p> @elseif($data->izin === 1) <p class="text-success">Di Izinkan</p> @else <p class="text-danger">Di Tolak</p> @endif</td>
                <td>{{(new DateTime($data->create_at))->format(' l, d M Y')}}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
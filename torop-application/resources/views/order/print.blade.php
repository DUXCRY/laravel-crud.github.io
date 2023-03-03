<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 1cm 0cm;
        }

        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #333;
            margin: 0 auto;
        }

        /** Define the header rules **/
        table {
            border: 1px solid #333;
            border-collapse: collapse;
            margin: 0 auto;

        }

        td,
        tr,
        th {
            padding: 12px;
            border: 1px solid #333;
            width: 185px;
        }

        th {
            background-color: #f0f0f0;
        }

        h4,
        p {
            margin: 0px;
        }

    </style>
</head>

<body>
    <div class="container">
        <img src="{{ base_path() }}/public/adminlte/img/header.png"  alt="" height="100%" width="100%" style="margin-bottom: 25px">
        <br>
        <header style="margin-bottom: -90px !important;">
            <table style="margin: 0 auto;" width="965px">
                <thead>
                    <tr>
                        <th>Invoice <strong>{{ $orders->order_id }}</strong></th>
                        <th>{{ $orders->created_at->format('D, d M Y') }}</th>
                    </tr>
                    <tr>
                        <td>
                            <h4>From: </h4>
                            <p>PT. Torop Sumber Makmur<br>
                                Jln. Pangeran Jayakarta 68 Blok B No. 23<br>
                                Jakarta, Indonesia<br>
                                0216498323<br>
                                sales@tms.com
                            </p>
                        </td>
                        <td>
                            <h4>To: </h4>
                            @foreach ($data_pj as $pj)
                            <p>{{ $pj->cs_nama }}<br>
                                {{ $pj->cs_alamat }}<br>
                                Phone: {{ $pj->cs_notelp }}<br>
                                Email: {{ $pj->cs_email }}
                            </p>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        @foreach ($data_pj as $pj)
                        <td colspan="2"><strong>Nama Project :</strong> {{ $pj->pj_nama }}<br/>
                            <strong>PM/PIC Project :</strong> {{ $pj->pj_pic }}
                        </td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </header>
        <main style="margin-top: 100px !important;">
            <table style="margin: 0 auto;" width="965px">
                <thead></thead>
                <tbody>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    @foreach ($data_it as $row)
                    <tr>
                        <td>{{ $row->pd_nama }}</td>
                        <td>Rp {{ number_format($row->pd_harga, 0 ,',', '.') }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>Rp {{ number_format($row->qty * $row->pd_harga, 0 ,',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3">Subtotal</th>
                        @foreach ($data_od as $item)
                        <td>Rp. {{number_format($item->total, 0, ',','.') }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Pajak</th>
                        <td></td>
                        <td>2%</td>
                        @foreach ($data_od as $item)
                        <td>Rp. {{ number_format($item->tax, 0, ',','.') }}</td>
                        @endforeach
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        @foreach ($data_od as $item)
                        <td>Rp. {{ number_format($item->total_harga, 0, ',','.') }}</td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </main>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Kode Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            /* Flexible grid */
            gap: 20px;
            /* Spacing between grid items */
            padding: 10px;
        }

        .label-box {
            border: 1px solid #000;
            padding: 10px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-size: 12px;
            margin: 10px;
            /* Removed margin to prevent overlapping */
            height: auto;
        }

        .label-box h3 {
            font-size: 14px;
            margin: 0;
            font-weight: bold;
            text-align: center;
        }

        .label-box p {
            margin: 3px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        @foreach ($data_buku['items'] as $row)
        <div class="label-box">
            <h3>{{ $row['kode_item'] }}</h3>
            <p><strong>{{ $data_buku['judul'] }}</strong></p>
            <p>Pengadaan: {{ date('d-m-Y', strtotime($row['tanggal_pengadaan'])) }}</p>
        </div>
        @endforeach
    </div>

</body>

</html>
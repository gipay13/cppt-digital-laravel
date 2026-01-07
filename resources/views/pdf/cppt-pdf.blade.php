<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CPPT</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap');

        .courier-prime-regular {
            font-family: "Courier Prime", monospace;
            font-weight: 400;
            font-style: normal;
        }

        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }

        .table-list {
            border-collapse: collapse;
            width: 100%;
        }

        .table-list th, .table-list td {
            border: 1px solid rgb(0, 0, 0);
            text-align: left;
            padding: 4px;
        }

        .second-page {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <table style="width: 100%" class="table-list">
        <tr>
            <td width="1px" style="white-space: nowrap;">
                <img src="{{ public_path('storage/'.$data->hospital->logo) }}" alt="Logo" style="width: 100px; height: 100px; object-fit: contain; margin: 0;">
            </td>
            <td width="50%">
                <p style="text-align: center; font-weight: bold; font-size: 16pt; font-family: Aptos; margin: 0;">
                    {{ $data->hospital->name }}
                </p>
                <p
                    style="text-align: center; font-size: 9pt; font-family: Tahoma; margin: 0;">
                    {{ $data->hospital->address }}
                </p>

            </td>
            <td>
                <p style="text-align: start; margin: 0; font-size: 9pt; font-family: Tahoma; margin-bottom:2px;">
                    No. Rekam Medis: {{ $data->patient->nomr }}
                </p>
                <p style="text-align: start; margin: 0; font-size: 9pt; font-family: Tahoma; margin-bottom:2px;">
                    Nama: {{ $data->patient->name }}
                </p>
                <p style="text-align: start; margin: 0; font-size: 9pt; font-family: Tahoma; margin-bottom:2px;">
                    Tanggal lahir: {{ date('d/m/Y', strtotime($data->patient->born_date)) }}
                </p>
                <p style="text-align: start; margin: 0; font-size: 9pt; font-family: Tahoma; margin-bottom:2px;">
                    Tanggal periksa: {{ date('d/m/Y', strtotime($data->patient->created_at)) }}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p style="text-align: center; font-weight: bold; font-size: 12pt; font-family: Aptos; margin: 0;">
                    CATATAN PERKEMBANGAN PASIEN TERINTEGRASI
                </p>
            </td>
        </tr>
        <tr >
            <td style="font-weight: bold">Diagnosis</td>
            <td colspan="2">{{ $data->diagnose->code }} - {{ $data->diagnose->name }}</td>
        </tr>
        <tr >
            <td style="font-weight: bold">Subjective</td>
            <td colspan="2">{{ $data->subjective }}</td>
        </tr>
        <tr >
            <td style="font-weight: bold">Objective</td>
            <td colspan="2">{{ $data->objective }}</td>
        </tr>
        <tr >
            <td style="font-weight: bold">Assessment</td>
            <td colspan="2">{{ $data->assessment }}</td>
        </tr>
        <tr >
            <td style="font-weight: bold">Plan</td>
            <td colspan="2">{!! $data->plan !!}</td>
        </tr>
        <tr >
            <td style="font-weight: bold">Instruksi</td>
            <td colspan="2">{!! $data->instruction !!}</td>
        </tr>
    </table>
</body>
</html>

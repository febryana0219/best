<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="PT. Best Insulation Indonesia" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Project Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td, th {
            border: 0px solid #ddd;
            padding: 2px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: -1;
            transform: translate(-50%, -50%) rotate(-30deg);
            opacity: 0.2;
            width: 500px;
            height: auto;
        }
        @page {
            size: A4 landscape;
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <img loading="lazy" src="{{ $watermarkPath }}" alt="Watermark" class="watermark">

    <!-- Content -->
    <table>
            <!-- Header Section -->
            <tr>
                <td colspan="3" rowspan="3" style="text-align: center;">
                    <img loading="lazy" src="{{ public_path('assets/user/images/pt_best_logo.png') }}" alt="PT. Best Insulation Indonesia Logo" style="width: 120px;">
                </td>
                <td colspan="6" rowspan="3" style="text-align: center;">
                    <h1>Project Detail Form</h1>
                </td>
                <td colspan="2">No. Production</td>
                <td>:</td>
                <td>{{ $detail->production_number }}</td>
            </tr>
            <tr>
                <td colspan="2">Project</td>
                <td>:</td>
                <td>{{ $project->name }}</td>
            </tr>
            <tr>
                <td colspan="2">Date</td>
                <td>:</td>
                <td>{{ date('d-m-Y', strtotime($detail->date)) }}</td>
            </tr>

            <!-- Detail Rows -->
            <tr>
                <td colspan="13">&nbsp;</td>
            </tr>
            <tr>
                <td>1.</td>
                <td>Name of Contractor</td>
                <td>:</td>
                <td colspan="3">{{ $detail->contractor_name }}</td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Type of Pipe / Brand</td>
                <td>:</td>
                <td>{{ $detail->pipe_type }}</td>
                <td>Size Pipe:</td>
                <td>{{ $detail->pipe_size }} mm</td>
                <td>Qty Pipe:</td>
                <td>{{ $detail->pipe_qty }} pcs</td>
                <td>Pipe Length:</td>
                <td>{{ $detail->pipe_length }} mm</td>
                <td colspan="3"></td>
            </tr>

            <!-- Jacketing Section -->
            <tr>
                <td>3.</td>
                <td>Type of Jacketing</td>
                <td>:</td>
                <td>
                    <input type="radio" {{ $detail->jacketing_type == 1 ? 'checked' : '' }}> Galvanized
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 1 ? 'checked' : '' }}> 0.4 mm
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 2 ? 'checked' : '' }}> 0.5 mm
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 3 ? 'checked' : '' }}> 0.6 mm
                </td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>
                    <input type="radio" {{ $detail->jacketing_type == 2 ? 'checked' : '' }}> Aluminium
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 4 ? 'checked' : '' }}> 0.6 mm
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 5 ? 'checked' : '' }}> 0.7 mm
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 6 ? 'checked' : '' }}> 0.8 mm
                </td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>
                    <input type="radio" {{ $detail->jacketing_type == 3 ? 'checked' : '' }}> Stainless
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 7 ? 'checked' : '' }}> 0.4 mm
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 8 ? 'checked' : '' }}> 0.5 mm
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 9 ? 'checked' : '' }}> 0.6 mm
                </td>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>
                    <input type="radio" {{ $detail->jacketing_type == 4 ? 'checked' : '' }}> PVC
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 10 ? 'checked' : '' }}> Class VP
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 11 ? 'checked' : '' }}> Class VU
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 12 ? 'checked' : '' }}> Class AW
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 13 ? 'checked' : '' }}> Class D
                </td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>
                    <input type="radio" {{ $detail->jacketing_type == 5 ? 'checked' : '' }}> HDPE
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 14 ? 'checked' : '' }}> PN 6
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 15 ? 'checked' : '' }}> PN 8
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 16 ? 'checked' : '' }}> PN 10
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 17 ? 'checked' : '' }}> PN 12.5
                </td>
                <td>
                    <input type="radio" {{ $detail->jacketing_size == 18 ? 'checked' : '' }}> PN 16
                </td>
                <td colspan="4"></td>
            </tr>

            <!-- Polyurethane Section -->
            <tr>
                <td>5.</td>
                <td>Polyurethane / PU Insulation</td>
                <td colspan="11"></td>
            </tr>
            <tr class="row15">
                <td colspan="2"></td>
                <td colspan="2">Density</td>
                <td>: {{$detail->density}} kg/m3</td>
                <td></td>
                <td>Thickness Pu</td>
                <td>:</td>
                <td colspan="2"></td>
                <td colspan="3" rowspan="5">
                    <div style="position: relative; width: 100px; height: 100px;">
                        <!-- Kanan -->
                        <div style="position: absolute; top: 50%; right: -20px; transform: translateY(-50%);">
                            {{$detail->thickness_pu_4}}
                        </div>

                        <!-- Kiri -->
                        <div style="position: absolute; top: 50%; left: -20px; transform: translateY(-50%);">
                            {{$detail->thickness_pu_3}}
                        </div>

                        <!-- Atas -->
                        <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%);">
                            {{$detail->thickness_pu_1}}
                        </div>

                        <!-- Bawah -->
                        <div style="position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%);">
                            {{$detail->thickness_pu_2}}
                        </div>

                        <!-- Gambar -->
                        <img loading="lazy" src="{{ public_path('assets/user/images/thickness.png') }}" style="position: absolute; width: 100%; height: 100%;">
                    </div>

                </td>
            </tr>
            <tr class="row16">
                <td colspan="2"></td>
                <td colspan="2" >Closed Cell Content</td>
                <td>: 90 %</td>
                <td></td>
                <td>Tolerance </td>
                <td>: {{$detail->tolerance}} mm</td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td colspan="2">(Photo as attached)</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="13 ">&nbsp;</td>
            </tr>
    </table>

    <div style="position: absolute; right: 0; bottom: 0; margin-right: 10px;">
        <img loading="lazy" src="{{ public_path('assets/user/images/ISObarcode.jpg') }}" style="height: 60px; width: auto;" alt="ISO Barcode">
    </div>
</body>
</html>

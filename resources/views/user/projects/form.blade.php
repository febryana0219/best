@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">{{ $project->name }}</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Quality Control</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->

<!-- Project Detail Section Start -->
<section class="pdt-110 pdb-80" data-background="{{ asset('assets/user/images/bg/abs-bg1.png') }}">
    <div class="section-content">
        <div class="container">
            <div class="pdb-50 row">
                <div class="col-xl-8">
                    <div class="col-xl-12">
                        <h3>{{ $project->name }}</h3>
                        <h5> {{ $project->category->name }}</h5>
                        {{-- <a href="{{ $previousUrl }}">
                            <i class="fa fa-arrow-left"></i> Back
                        </a> --}}
                    </div>
                </div>
                <div class="col-xl-4" style="text-align: right; align-items: end;">
                    <a href="{{ route('projects.print', ['encryptedId' => Crypt::encrypt($detail->id)]) }}" class="btn btn-danger" target="_blank">
                        <i class="fa fa-print"></i> Print as PDF
                    </a>
                </div>
            </div>

            <!-- Project Details Table -->
            <div class="row">
                <div class="col-xl-12">
                    <table border="0" class="sheet0 table" style="width: 100%;">
                        <tbody>
                            <!-- Header Section -->
                            <tr>
                                <td colspan="3" rowspan="3" style="text-align: center;">
                                    <img loading="lazy" src="{{ asset('assets/user/images/pt_best_logo.png') }}" alt="PT. Best Insulation Indonesia Logo" style="width: 120px;">
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
                                <td>{{ $detail->contractor_name }}</td>
                                <td colspan="9"></td>
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
                                    <div style="position: relative;">
                                        <!-- thickness_pu_3 kiri -->
                                        <div style="position: absolute; top: 48%; left: 0px; transform: translate(-50%, -50%); z-index: 2;">
                                            {{$detail->thickness_pu_3}}
                                        </div>

                                        <!-- tengah -->
                                        <div style="position: relative; text-align: center;">
                                            <!-- atas -->
                                            <div style="position: absolute; bottom: 85%; left: 50%; transform: translate(-50%, -50%); z-index: 2;">
                                                {{$detail->thickness_pu_1}}
                                            </div>

                                            <!-- gambar -->
                                            <img loading="lazy" src="{{ asset('assets/user/images/thickness.png') }}"
                                                style="position: relative; z-index: 1; width: 100px; height: 100px;" />

                                            <!-- bawah -->
                                            <div style="position: absolute; top: 110%; left: 50%; transform: translate(-50%, -50%); z-index: 2;">
                                                {{$detail->thickness_pu_2}}
                                            </div>
                                        </div>

                                        <!-- thickness_pu_4 kanan -->
                                        <div style="position: absolute; top: 48%; right: -15px; transform: translate(-50%, -50%); z-index: 2;">
                                            {{$detail->thickness_pu_4}}
                                        </div>
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
                            <tr>
                                <td>6.</td>
                                <td>Inspection Photo</td>
                                <td colspan="11"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Project Images Grid -->
            <div class="row mt-2">
                <div class="col-xl-12">
                    <div class="row d-flex justify-content-between align-items-start">
                        <!-- Grid Gambar -->
                        <div class="d-flex flex-wrap">
                            @foreach($images as $image)
                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                    <a href="{{ $image->img ? asset('storage/uploads/quality_control_detail/' . $image->img) : asset('storage/uploads/default/default.jpg') }}" target="_blank">
                                        <img loading="lazy" src="{{ $image->img ? asset('storage/uploads/quality_control_detail/' . $image->img) : asset('storage/uploads/default/default.jpg') }}"
                                            class="img-fluid border rounded shadow-sm"
                                            alt="{{ $image->img ? 'Image ' . $loop->iteration : 'Default Image' }}"
                                            style="object-fit: cover; width: 100%; height: 150px;">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- ISO Barcode Image -->
                        <div class="mt-3 text-end" style="width: 100%;">
                            <img loading="lazy" src="{{ asset('assets/user/images/ISObarcode.jpg') }}" alt="ISO Barcode"
                                style="height: 60px; width: auto;">
                        </div>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="row">
                        <div class="col-xl-12">
                            <nav class="pagination-nav pdt-30">
                                <ul class="pagination-list">
                                    <!-- Previous Button -->
                                    <li class="pagination-left-arrow {{ $images->onFirstPage() ? 'disabled' : '' }}">
                                        <a href="{{ $images->previousPageUrl() }}" {{ $images->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>

                                    <!-- Page Numbers -->
                                    @foreach ($images->links()->elements[0] as $page => $url)
                                        <li class="{{ $page == $images->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}" class="page-numbers">{{ sprintf('%02d', $page) }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Next Button -->
                                    <li class="pagination-right-arrow {{ $images->hasMorePages() ? '' : 'disabled' }}">
                                        <a href="{{ $images->nextPageUrl() }}" {{ $images->hasMorePages() ? '' : 'aria-disabled=true' }}>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Project Detail Section End -->
@endsection

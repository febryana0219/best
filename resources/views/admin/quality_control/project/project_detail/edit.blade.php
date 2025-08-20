@extends('admin.layouts.master-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">Quality Control</li>
            <li class="breadcrumb-item">Project</li>
            <li class="breadcrumb-item active">Edit Project Detail</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Edit Project Detail for {{ $projectHeader->name }}</h4>
        <a href="{{ route('admin.qc.project.project_detail.index', $projectHeader->id) }}" class="btn btn-secondary waves-effect">Back to Project Detail</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-body">
                    <form action="{{ route('admin.qc.project.project_detail.update', [$projectHeader->id, $projectDetail->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Equipment Code <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="hidden" name="project_id" value="{{ $projectHeader->id }}">
                                <input type="text" class="form-control" name="equipment_code" value="{{ old('equipment_code', $projectDetail->equipment_code) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Production Number <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="production_number" value="{{ old('production_number', $projectDetail->production_number) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Contractor Name <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="contractor_name" value="{{ old('contractor_name', $projectDetail->contractor_name) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Date <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="date" class="form-control" name="date" value="{{ old('date', $projectDetail->date->format('Y-m-d')) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Pipe Type <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="pipe_type" value="{{ old('pipe_type', $projectDetail->pipe_type) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Pipe Size <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="pipe_size" value="{{ old('pipe_size', $projectDetail->pipe_size) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Pipe Qty <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="pipe_qty" value="{{ old('pipe_qty', $projectDetail->pipe_qty) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Pipe Length <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="pipe_length" value="{{ old('pipe_length', $projectDetail->pipe_length) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Type of Jacketing <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jacketing_type_1" name="jacketing_type" value="1" required {{ $projectDetail->jacketing_type == 1 ? 'checked' : '' }} onclick="showJacketingSizeOptions(1)" />
                                    <label class="form-check-label" for="jacketing_type_1">Galvanized</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jacketing_type_2" name="jacketing_type" value="2" required {{ $projectDetail->jacketing_type == 2 ? 'checked' : '' }} onclick="showJacketingSizeOptions(2)" />
                                    <label class="form-check-label" for="jacketing_type_2">Aluminium</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jacketing_type_3" name="jacketing_type" value="3" required {{ $projectDetail->jacketing_type == 3 ? 'checked' : '' }} onclick="showJacketingSizeOptions(3)" />
                                    <label class="form-check-label" for="jacketing_type_3">Stainless</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jacketing_type_4" name="jacketing_type" value="4" required {{ $projectDetail->jacketing_type == 4 ? 'checked' : '' }} onclick="showJacketingSizeOptions(4)" />
                                    <label class="form-check-label" for="jacketing_type_4">PVC</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jacketing_type_5" name="jacketing_type" value="5" required {{ $projectDetail->jacketing_type == 5 ? 'checked' : '' }} onclick="showJacketingSizeOptions(5)" />
                                    <label class="form-check-label" for="jacketing_type_5">HDPE</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Jacketing Size <span class="text-danger">*</span></label>
                            <div class="col-sm-4" id="jacketingSizeOptions"></div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Jacket Od <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="jacket_od" value="{{ old('jacket_od', $projectDetail->jacket_od) }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Density <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="density" value="{{ old('density', $projectDetail->density) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Thickness Pu 1 <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="thickness_pu_1" value="{{ old('thickness_pu_1', $projectDetail->thickness_pu_1) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Thickness Pu 2 <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="thickness_pu_2" value="{{ old('thickness_pu_2', $projectDetail->thickness_pu_2) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Thickness Pu 3 <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="thickness_pu_3" value="{{ old('thickness_pu_3', $projectDetail->thickness_pu_3) }}" required />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">Thickness Pu 4 <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="thickness_pu_4" value="{{ old('thickness_pu_4', $projectDetail->thickness_pu_4) }}" required />
                                <input type="hidden" name="tolerance" value="-3">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('script')
<script>
    function showJacketingSizeOptions(type) {
        const options = {
            1: [
                { value: 1, label: '0.4mm' },
                { value: 2, label: '0.5mm' },
                { value: 3, label: '0.6mm' }
            ],
            2: [
                { value: 4, label: '0.6mm' },
                { value: 5, label: '0.7mm' },
                { value: 6, label: '0.8mm' }
            ],
            3: [
                { value: 7, label: '0.4mm' },
                { value: 8, label: '0.5mm' },
                { value: 9, label: '0.6mm' }
            ],
            4: [
                { value: 10, label: 'Class VP' },
                { value: 11, label: 'Class VU' },
                { value: 12, label: 'Class AW' },
                { value: 13, label: 'Class D' }
            ],
            5: [
                { value: 14, label: 'PN 6' },
                { value: 15, label: 'PN 8' },
                { value: 16, label: 'PN 10' },
                { value: 17, label: 'PN 12.5' },
                { value: 18, label: 'PN 16' }
            ]
        };

        const container = document.getElementById('jacketingSizeOptions');
        container.innerHTML = '';

        if (options[type]) {
            options[type].forEach(option => {
                const input = document.createElement('input');
                input.type = 'radio';
                input.className = 'form-check-input';
                input.name = 'jacketing_size';
                input.value = option.value;
                input.id = 'jacketing_size_' + option.value;

                const label = document.createElement('label');
                label.className = 'form-check-label';
                label.htmlFor = 'jacketing_size_' + option.value;
                label.innerText = option.label;

                const wrapper = document.createElement('div');
                wrapper.className = 'form-check form-check-inline';
                wrapper.appendChild(input);
                wrapper.appendChild(label);

                container.appendChild(wrapper);
            });
        }

        const selectedSize = @json($projectDetail->jacketing_size);
        if (selectedSize) {
            const existingInput = document.getElementById('jacketing_size_' + selectedSize);
            if (existingInput) {
                existingInput.checked = true;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        showJacketingSizeOptions({{ $projectDetail->jacketing_type }});
    });
</script>
@yield('script-bottom')

@endsection

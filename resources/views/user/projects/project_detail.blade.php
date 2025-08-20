@extends('user.layouts.master-layout')

@section('content')
<!-- Page Title Start -->
<section class="page-title-section" style="background-image: url('{{ asset('storage/uploads/bg/' . $bg->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-area">
                    <h2 class="page-title">{{ $projects->name }}</h2>
                    <ul class="breadcrumbs-link">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="active">Project Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Title End -->
<!-- Project Details Section Start -->
<section class="project-details-page pdt-105 pdb-80" data-background="{{ asset('assets/user/images/bg/abs-bg6.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="project-thumb">
                    @if ($projects->image)
                        <img loading="lazy" class="img-full mrb-45 mrb-sm-0" src="{{ asset('storage/uploads/quality_control/' . $projects->image) }}" alt="{{ $projects->name }}">
                    @else
                        <img loading="lazy" class="img-full mrb-45 mrb-sm-0" src="{{ asset('storage/uploads/default/default.jpg') }}" alt="{{ $projects->name }}">
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 mrt--110 mrt-sm-30">
                <div class="project-sidebar-widget">
                    <div class="project-sidebar">
                        <ul class="list project-info-list">
                            <li>
                                <span class="title"><i class="far fa-clock"></i> Project Date:</span> {{ $projects->project_date ? \Carbon\Carbon::parse($projects->project_date)->format('d-m-Y') : '-' }}

                            </li>
                            <li>
                                <span class="title"><i class="far fa-user"></i> Client:</span> {{ $projects->client ?? '-' }}

                            </li>
                            <li>
                                <span class="title"><i class="far fa-hdd"></i> Products:</span> {{ $projects->product ?? '-' }}
                            </li>
                            <li>
                                <a href="#" title="Click to view quality control" data-toggle="modal" data-target="#passwordModal" data-permalink="{{ $projects->permalink }}" data-password="{{ $projects->password_access }}">
                                    <span class="title"><i class="far fa-money-bill-alt"></i> Quality Control</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mb-4">
            <div class="col-xl-12">
                <a href="{{ $previousUrl }}">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div> --}}
        <div class="row align-items-center mrb-40">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="project-detail-text mrb-md-25">
                    <h3 class="project-details-title mrb-20">{{ $projects->name }}</h3>
                    <div class="project-details-content">
                        <p class="mrb-0">{{ $projects->project_info }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mrt-40">
            <div class="col-xl-12">
                <h3 class="mrb-30">Related Projects</h3>
                <div class="row">
                    @foreach ($imgDetails as $row)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="project-item-style1 mrb-30">
                                <div class="project-item-thumb">
                                    @if ($row->img)
                                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/project_image/' . $row->img) }}" alt="{{ $row->name }}">
                                    @else
                                        <img loading="lazy" class="img-full" src="{{ asset('storage/uploads/default/default.jpg') }}" alt="Default Image">
                                    @endif
                                    <div class="project-item-details">
                                        <h6 class="project-item-category">{{ $row->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Please Enter Password</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password">
                                <input type="hidden" id="project_permalink" name="project_permalink">
                                <input type="hidden" id="project_password" name="project_password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" style="background: rgb(188,28,4);" onclick="validatePassword()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Project Details Section End -->

<!-- Call to Action Start -->
<div class="call-to-action">
    <div class="container">
        <div class="call-to-action-inner">
            <div class="call-to-action-left">
                <div class="call-to-action-icon">
                    <span class="webexflaticon base-icon-chat1"></span>
                </div>
                <div class="call-to-action-content">
                    <p class="call-to-action-sub-title">We are ready to help you</p>
                    <h3 class="call-to-action-title">Need Any Pipe Insulation Help?</h3>
                </div>
            </div>
            <div class="call-to-action-btn-box mrt-md-30">
                <a href="{{ route('contact.index') }}" class="animate-btn-style4">Contact With Us</a>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->
@yield('script')

<script>
    $('#passwordModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var permalink = button.data('permalink');
        var password = button.data('password');

        $('#project_permalink').val(permalink);
        $('#project_password').val(password);
    });

    function validatePassword() {
        var enteredPassword = $('#password').val();
        var storedPassword = $('#project_password').val();
        var projectPermalink = $('#project_permalink').val();

        if (enteredPassword) {
            $.ajax({
                url: "{{ route('projects.auth') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    permalink: projectPermalink,
                    password: enteredPassword,
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = "{{ url('projects/show') }}/" + projectPermalink;
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while validating the password.');
                }
            });
        } else {
            alert('Please enter a password.');
        }
    }

</script>
@yield('script-bottom')

@endsection

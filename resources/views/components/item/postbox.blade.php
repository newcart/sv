@if(!empty($post))
<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
    <div class="card card-blog card-plain">
        <div class="card-header p-0 mt-n4 mx-3">
            <a class="d-block shadow-xl border-radius-xl">
                <img src="{{ $post['image'] }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
            </a>
        </div>
        <div class="card-body p-3">
            <div class="content">
                <p class="mb-0 text-sm">{{ $post['category']  }}</p>
                <a href="javascript:;">
                    <h5>
                        {{ $post['title'] }}
                    </h5>
                </a>
                <p class="mb-4 text-sm">
                    {{ $post['description'] }}
                </p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                <div class="avatar-group mt-2">
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{ url('assets/img/team-1.jpg') }}">
                    </a>
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{ url('assets/img/team-1.jpg') }}">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

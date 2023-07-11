@if (request()->session()->has('notif-y'))
{{-- <br>
<notification>
    <div class="mt-5 mt-lg-2 shadow">
        <div class="mt-0 mb-0 text-capitalize text-center text-break text-light fw-bold alert alert-success" role="alert">
            {{ session('notif-y') }}
        </div>
    </div>
</notification> --}}
<notification class="position-fixed bottom-0 end-0 starts-0 starts-md-auto p-3" style="z-index: 11">
    <div id="liveToast" class="toast rounded-5-important overflow-hidden shadow fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-gradient-primary text-dark rounded-top">
            <img src="{{ url('media/logo/favicon.png') }}" class="rounded w-10 me-2">
            <strong class="me-auto">{{ ucwords(' notification') }}</strong>
            <small>{{ date('d-m-Y, H:i') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body rounded-bottom">
            {{ ucwords(session('notif-y')) }}
        </div>
    </div>
</notification>
@elseif (request()->session()->has('notif-x'))
{{-- <br>
<notification>
    <div class="mt-5 mt-lg-2 shadow">
        <div class="mt-0 mb-0 text-capitalize text-center text-break text-light fw-bold alert alert-danger" role="alert">
            {{ session('notif-x') }}
        </div>
    </div>
</notification> --}}
<notification class="position-fixed bottom-0 end-0 starts-0 starts-md-auto p-3" style="z-index: 11">
    <div id="liveToast" class="toast rounded-5-important overflow-hidden shadow fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-gradient-danger text-dark rounded-top">
            <img src="{{ url('media/logo/favicon.png') }}" class="rounded w-10 me-2">
            <strong class="me-auto">{{ ucwords(' notification') }}</strong>
            <small>{{ date('d-m-Y, H:i') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body rounded-bottom">
            {{ ucwords(session('notif-x')) }}
        </div>
    </div>
</notification>
@endif

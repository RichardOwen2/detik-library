<div class="col-md-6 col-lg-4 mb-3">
    <a class="card shadow-sm" href="{{ $href }}">
        <div class="card-header">
            <h3 class="card-title" style="overflow: hidden;text-overflow: ellipsis; white-space: nowrap; max-width: 65%">
                {{ $title }}
            </h3>
            <div class="card-toolbar">
                <div class="badge badge-light-info">
                    {{ $category }}
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="text-center px-4">
                <img class="w-100 h-400px card-rounded-bottom" alt="" src="{{ $image }}" />
            </div>
        </div>
    </a>
</div>

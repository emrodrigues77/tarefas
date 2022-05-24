<div class="col-sm">
    <a href="{{ route('tasks.filtered', ['status' => $status]) }}" class="text-decoration-none">
        <div class="card {{ $borderType }} h-100 text-center">
            <div class="card-body">
                <span class="display-3 {{ $textType }}">{{ sprintf('%01d', $count) }}</span>
                <p class="card-text {{ $textType }}">{{ $text }}</p>
            </div>
        </div>
    </a>
</div>

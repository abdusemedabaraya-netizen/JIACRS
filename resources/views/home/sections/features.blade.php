<section class="jiacrs-stats">
    <div class="container">
        <div class="row g-3">

            @foreach ([
                ['icon' => 'bi-shield-fill-check', 'title' => 'Secure',      'text' => 'Reporting'],
                ['icon' => 'bi-people-fill',       'title' => 'Anonymous',   'text' => 'Reporting Supported'],
                ['icon' => 'bi-lock-fill',         'title' => 'Encrypted',   'text' => 'Information'],
                ['icon' => 'bi-search',            'title' => 'Transparent', 'text' => 'Case Tracking'],
            ] as $item)
                <div class="col-6 col-lg-3">
                    <div class="info-box shadow-sm mb-0">
                        <span class="info-box-icon text-bg-primary"><i class="bi {{ $item['icon'] }}"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text fw-bold">{{ $item['title'] }}</span>
                            <span class="info-box-number fw-normal">{{ $item['text'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
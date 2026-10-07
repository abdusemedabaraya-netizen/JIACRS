<section class="jiacrs-section" id="about">
    <div class="container">
        <div class="row g-4">

            {{-- LEFT: Why use JIACRS --}}
            <div class="col-lg-7">
                <h2 class="jiacrs-heading-left">Why Use JIACRS?</h2>
                <p class="jiacrs-sub-left">Because integrity matters. JIACRS gives everyone a safe, structured way to raise concerns.</p>

                <div class="row g-3">
                    @foreach ([
                        ['icon' => 'bi-lock-fill',         'title' => 'Confidentiality', 'text' => 'Your information is protected.'],
                        ['icon' => 'bi-patch-check-fill',  'title' => 'Accountability',  'text' => 'Every report follows a structured workflow.'],
                        ['icon' => 'bi-eye-fill',          'title' => 'Transparency',    'text' => 'Track the progress of your submission.'],
                        ['icon' => 'bi-phone-fill',        'title' => 'Accessibility',   'text' => 'Submit anytime, anywhere.'],
                        ['icon' => 'bi-shield-fill-check', 'title' => 'Security',        'text' => 'Evidence and sensitive information are protected.'],
                    ] as $why)
                        <div class="col-6 col-md-4">
                            <div class="card jiacrs-why h-100 shadow-sm">
                                <div class="card-body">
                                    <span class="jiacrs-why-icon"><i class="bi {{ $why['icon'] }}"></i></span>
                                    <h3 class="jiacrs-why-title">{{ $why['title'] }}</h3>
                                    <p class="jiacrs-why-text">{{ $why['text'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: Track your report --}}
            <div class="col-lg-5">
                @include('home.sections.track-report')
            </div>

        </div>
    </div>
</section>
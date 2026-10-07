<section class="jiacrs-section jiacrs-section-alt" id="lifecycle">
    <div class="container">

        <h2 class="jiacrs-section-title">Case Lifecycle</h2>
        <p class="jiacrs-section-subtitle">Your report goes through a structured process until resolution.</p>

        <ol class="jiacrs-lifecycle">
            @foreach ([
                ['icon' => 'bi-file-earmark-text', 'label' => 'Submitted',                'tone' => 'blue'],
                ['icon' => 'bi-search',            'label' => 'Under Review',             'tone' => 'blue'],
                ['icon' => 'bi-check-lg',          'label' => 'Accepted',                 'tone' => 'blue'],
                ['icon' => 'bi-person-fill',       'label' => 'Assigned',                 'tone' => 'blue'],
                ['icon' => 'bi-gear-fill',         'label' => 'Under Investigation',      'tone' => 'blue'],
                ['icon' => 'bi-clipboard-check',   'label' => 'Investigation Completed',  'tone' => 'teal'],
                ['icon' => 'bi-people-fill',       'label' => 'Under Approval',           'tone' => 'teal'],
                ['icon' => 'bi-hammer',            'label' => 'Action Taken',             'tone' => 'teal'],
                ['icon' => 'bi-check-circle-fill', 'label' => 'Closed',                   'tone' => 'green'],
            ] as $stage)
                <li class="jiacrs-stage">
                    <span class="jiacrs-stage-icon is-{{ $stage['tone'] }}"><i class="bi {{ $stage['icon'] }}"></i></span>
                    <span class="jiacrs-stage-label">{{ $stage['label'] }}</span>
                </li>
            @endforeach
        </ol>

    </div>
</section>
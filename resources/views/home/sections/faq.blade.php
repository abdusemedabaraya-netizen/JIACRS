<section class="jiacrs-section" id="faq">
    <div class="container">

        <h2 class="jiacrs-section-title">Frequently Asked Questions</h2>
        <p class="jiacrs-section-subtitle">Find answers to common questions about JIACRS.</p>

        <div class="jiacrs-faq-wrap">

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="search" id="faqSearch" class="form-control" placeholder="Search questions..." aria-label="Search questions">
            </div>

            <div class="accordion" id="faqAccordion">
                @foreach ([
                    ['q' => 'Can I report anonymously?',
                     'a' => 'Yes. Choose "Submit Anonymous Report". You will receive a reference number and an access key so you can follow your report without giving your name.'],
                    ['q' => 'Can I upload evidence?',
                     'a' => 'Yes. You can attach supporting files such as documents, photos or recordings when you submit your report. The form shows the allowed file types and sizes.'],
                    ['q' => 'How do I track my report?',
                     'a' => 'Enter your reference number and access key in the "Track Your Report" panel or on the Track Report page. You will see the current stage of your case.'],
                    ['q' => 'What happens after I submit a report?',
                     'a' => 'Authorized officers review the report, accept it, assign it and investigate where needed. The case lifecycle above shows every stage until it is closed.'],
                    ['q' => 'What if I lose my access key?',
                     'a' => 'The access key cannot be recovered, which protects anonymous reporters. Please save it somewhere safe as soon as you receive it.'],
                    ['q' => 'Who can see my report?',
                     'a' => 'Only authorized integrity officers assigned to your case. Your information is handled confidentially.'],
                ] as $i => $faq)
                    <div class="accordion-item jiacrs-faq-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button {{ $i ? 'collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}"
                                    aria-expanded="{{ $i ? 'false' : 'true' }}" aria-controls="faq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h3>
                        <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i ? '' : 'show' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <p id="faqEmpty" class="text-center text-secondary mt-3 d-none">
                No questions match your search. Try different words or <a href="#contact">contact us</a>.
            </p>
        </div>

    </div>
</section>

@push('scripts')
<script>
    // Live FAQ search
    document.getElementById('faqSearch')?.addEventListener('input', function () {
        const term = this.value.trim().toLowerCase();
        let visible = 0;
        document.querySelectorAll('.jiacrs-faq-item').forEach(function (item) {
            const match = item.textContent.toLowerCase().includes(term);
            item.classList.toggle('d-none', !match);
            if (match) visible++;
        });
        document.getElementById('faqEmpty').classList.toggle('d-none', visible > 0);
    });
</script>
@endpush
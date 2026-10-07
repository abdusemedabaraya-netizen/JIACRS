<?php

return [
    // Send e-mail copies of notifications (needs working SMTP in .env).
    'mail_notifications' => env('JIACRS_MAIL_NOTIFICATIONS', false),

    // PRIVATE disk (storage/app/private). Never use the "public" disk for evidence.
    'evidence_disk' => 'local',

    'max_files'   => 5,
    'max_file_kb' => 20480, // 20 MB, per the SRS
];

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tipe Penugasan & Format Pengumpulan Tugas (Single Source of Truth)
    |--------------------------------------------------------------------------
    |
    | Konfigurasi terpusat untuk batasan berkas, batasan ukuran berkas,
    | MIME types, dan domain yang diizinkan untuk setiap tipe penugasan.
    |
    */

    'types' => [
        'visual' => [
            'id' => 'visual',
            'label' => 'Media Visual',
            'description' => 'Poster digital, infografis, lembar kerja desain, atau dokumentasi karya fisik/prakarya',
            'examples' => 'Seni Budaya, DKV, Prakarya, Biologi (gambar anatomi/sketsa)',
            'mimes' => ['jpg', 'jpeg', 'png', 'pdf'],
            'max_kb' => 20480, // 20 MB
            'accept' => '.jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf',
            'icon' => 'fa-palette',
            'badge_class' => 'bg-purple-100 text-purple-700 dark:bg-purple-950/40 dark:text-purple-300',
            'is_file' => true,
        ],
        'dokumen' => [
            'id' => 'dokumen',
            'label' => 'Berkas Dokumen',
            'description' => 'Makalah, laporan praktikum, studi kasus, esai, atau rangkuman materi tertulis',
            'examples' => 'Bahasa Indonesia, Sejarah, PPKn, Sosiologi',
            'mimes' => ['pdf', 'doc', 'docx'],
            'max_kb' => 20480, // 20 MB
            'accept' => '.pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'icon' => 'fa-file-lines',
            'badge_class' => 'bg-blue-100 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300',
            'is_file' => true,
        ],
        'audiovisual' => [
            'id' => 'audiovisual',
            'label' => 'Multimedia Audiovisual',
            'description' => 'Rekaman audio pelafalan atau tautan video presentasi/unjuk kerja',
            'examples' => 'PJOK (praktik gerak), Bahasa Inggris (speaking), Seni Musik',
            'audio_mimes' => ['mp3', 'm4a'],
            'audio_max_kb' => 10240, // 10 MB
            'audio_accept' => '.mp3,.m4a,audio/mpeg,audio/mp4,audio/x-m4a',
            'icon' => 'fa-video',
            'badge_class' => 'bg-rose-100 text-rose-700 dark:bg-rose-950/40 dark:text-rose-300',
        ],
        'tautan' => [
            'id' => 'tautan',
            'label' => 'Tautan Karya Eksternal',
            'description' => 'Tautan ke hasil karya digital siswa di platform daring',
            'examples' => 'Canva, Figma, GitHub, Google Drive/Docs/Sheets/Slides',
            'max_chars' => 2048,
            'icon' => 'fa-link',
            'badge_class' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300',
            'is_file' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Whitelist Domain Penyedia Video
    |--------------------------------------------------------------------------
    */
    'allowed_video_hosts' => [
        'youtube.com',
        'www.youtube.com',
        'm.youtube.com',
        'youtu.be',
        'youtube-nocookie.com',
        'www.youtube-nocookie.com',
        'drive.google.com',
        'loom.com',
        'www.loom.com',
    ],

    /*
    |--------------------------------------------------------------------------
    | Whitelist Domain Penyedia Proyek Eksternal
    |--------------------------------------------------------------------------
    */
    'allowed_project_hosts' => [
        'canva.com',
        'www.canva.com',
        'figma.com',
        'www.figma.com',
        'github.com',
        'www.github.com',
        'drive.google.com',
        'docs.google.com',
    ],
];

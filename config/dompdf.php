<?php

return [

    'show_warnings' => false,
    // IMPORTANT: tell the package where your "public" web root is
    'public_path'   => public_path(),

    /*
    |--------------------------------------------------------------------------
    | Character / Entity Handling
    |--------------------------------------------------------------------------
    | Set convert_entities to false if you need to display € and £ correctly.
    */
    'convert_entities' => false,

    'options' => [

        // Where Dompdf stores generated fonts and cache
        'font_dir'   => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),

        // Temporary directory
        'temp_dir'   => sys_get_temp_dir(),

        // Restrict Dompdf file access to your PUBLIC web root
        // (so /images/… in HTML maps to {public_path()}/images/…)
        'chroot'     => public_path(),   // ⬅️ was realpath(base_path())

        // Allow local + remote images
        'allowed_protocols' => [
            'data://'  => ['rules' => []],
            'file://'  => ['rules' => []],
            'http://'  => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        // Font handling
        'enable_font_subsetting' => true,
        'default_font'           => 'DejaVu Sans',
        'font_height_ratio'      => 1.1,

        // PDF + rendering settings
        'pdf_backend'            => 'CPDF',
        // 'image_backend'        => 'imagick', // optional if you have Imagick
        'default_media_type'     => 'screen',
        'default_paper_size'     => 'a4',
        'default_paper_orientation' => 'portrait',
        'dpi'                    => 96,

        // Enable useful features
        'enable_php'             => false,
        'enable_javascript'      => true,
        'enable_remote'          => true,
        'enable_html5_parser'    => true,

        'allowed_remote_hosts'   => null,

        'log_output_file'        => null,
        'artifactPathValidation' => null,
    ],

];

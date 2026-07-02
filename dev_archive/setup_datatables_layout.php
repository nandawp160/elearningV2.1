<?php
$file = 'resources/views/layouts/app.blade.php';
$content = file_get_contents($file);

// Add CSS DataTables before closing </head>
$css = "
    <!-- DataTables CSS -->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css\"/>

    <!-- Custom DataTables UI Override for Minimalist Theme -->
    <style>
        /* Base Table Styling */
        table.dataTable { border-collapse: collapse !important; border-spacing: 0; width: 100% !important; margin-bottom: 1rem; border: 1px solid #f1f5f9; }
        table.dataTable thead th { border-bottom: 2px solid #f8fafc !important; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; color: #64748b; padding: 1rem 1.5rem !important; background-color: #ffffff; }
        table.dataTable tbody td { border-bottom: 1px solid #f1f5f9 !important; padding: 1rem 1.5rem !important; font-size: 0.875rem; color: #334155; vertical-align: middle; }
        table.dataTable tbody tr:hover { background-color: #f8fafc !important; }
        .dark table.dataTable { border-color: #1e293b; }
        .dark table.dataTable thead th { border-bottom-color: #1e293b !important; color: #94a3b8; background-color: #0f172a; }
        .dark table.dataTable tbody td { border-bottom-color: #1e293b !important; color: #cbd5e1; }
        .dark table.dataTable tbody tr:hover { background-color: #1e293b !important; }
        
        /* Filters and Search Wrapper */
        .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_length { margin-bottom: 1.5rem; color: #475569; font-size: 0.875rem; }
        .dataTables_wrapper .dataTables_filter input { border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.5rem 1rem; margin-left: 0.5rem; outline: none; transition: border-color 0.2s; }
        .dataTables_wrapper .dataTables_filter input:focus { border-color: #f97316; box-shadow: 0 0 0 1px #f97316; }
        .dataTables_wrapper .dataTables_length select { border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.4rem 1.5rem 0.4rem 0.75rem; margin: 0 0.5rem; outline: none; }
        
        /* Export Buttons - Compact Minimalist */
        .dt-buttons { margin-bottom: 1.5rem; display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .dt-button { background: #ffffff !important; border: 1px solid #e2e8f0 !important; color: #475569 !important; border-radius: 0.5rem !important; padding: 0.4rem 0.75rem !important; font-size: 0.75rem !important; font-weight: 500 !important; font-family: 'Inter', sans-serif !important; box-shadow: none !important; margin: 0 !important; }
        .dt-button:hover { background: #f8fafc !important; border-color: #cbd5e1 !important; color: #1e293b !important; }
        .dark .dt-button { background: #1e293b !important; border-color: #334155 !important; color: #cbd5e1 !important; }
        .dark .dt-button:hover { background: #334155 !important; color: #f8fafc !important; }
        
        /* Pagination */
        .dataTables_wrapper .dataTables_paginate { margin-top: 1.5rem; display: flex; align-items: center; justify-content: flex-end; gap: 0.25rem; font-size: 0.875rem; }
        .dataTables_wrapper .dataTables_paginate .paginate_button { border: 1px solid #e2e8f0 !important; background: #ffffff !important; color: #475569 !important; border-radius: 0.5rem !important; padding: 0.35rem 0.75rem !important; margin: 0 !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: #f97316 !important; border-color: #f97316 !important; color: #ffffff !important; font-weight: 600; }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) { background: #f8fafc !important; border-color: #cbd5e1 !important; color: #1e293b !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled { opacity: 0.5; cursor: not-allowed; }
        .dataTables_wrapper .dataTables_info { margin-top: 1.5rem; color: #64748b; font-size: 0.875rem; }
        
        /* DataTables Sorting Icons Reset */
        table.dataTable thead th.sorting, table.dataTable thead th.sorting_asc, table.dataTable thead th.sorting_desc { background-image: none !important; position: relative; padding-right: 2rem !important; }
        table.dataTable thead th.sorting::after, table.dataTable thead th.sorting_asc::after, table.dataTable thead th.sorting_desc::after { position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); font-family: 'Font Awesome 6 Free'; font-weight: 900; content: '\\f0dc'; color: #cbd5e1; opacity: 1; font-size: 0.75rem; }
        table.dataTable thead th.sorting_asc::after { content: '\\f0de'; color: #f97316; }
        table.dataTable thead th.sorting_desc::after { content: '\\f0dd'; color: #f97316; }
    </style>
";

if (strpos($content, 'DataTables CSS') === false) {
    $content = str_replace('</head>', $css . "\n</head>", $content);
}

// Add JS DataTables before closing </body>
$js = "
    <!-- jQuery (Required for DataTables) -->
    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>
    
    <!-- DataTables JS & Plugins -->
    <script type=\"text/javascript\" src=\"https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js\"></script>
    <script type=\"text/javascript\" src=\"https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js\"></script>
";

if (strpos($content, 'jQuery (Required for DataTables)') === false) {
    // Insert before stack scripts or body
    if (strpos($content, "@stack('scripts')") !== false) {
        $content = str_replace("@stack('scripts')", $js . "\n    @stack('scripts')", $content);
    } else {
        $content = str_replace('</body>', $js . "\n</body>", $content);
    }
}

file_put_contents($file, $content);
echo "Layout updated with DataTables CDN and Styles.\n";

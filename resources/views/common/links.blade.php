
<!--Tailwind Utility & Flowbite-->
@vite(['resources/css/app.css','resources/js/app.js',
// Custom Javascript Files
'resources/js/users.js',
'resources/js/login.js',
'resources/js/home.js',
'resources/js/register.js'])

{{-- LINKS --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


{{-- DATATABLE SEARCH BAR ALLIGNMENT --}}
<style>
    .dt-layout-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .dt-length, .dt-search {
        display: flex;
        align-items: center;
    }

    .dt-length label {
        margin-left: 5px;
    }

    .dt-search label {
        margin-right: 5px;
    }

    .dt-layout-cell {
        flex: 1;
    }

    .dt-end {
        text-align: right;
    }
</style>






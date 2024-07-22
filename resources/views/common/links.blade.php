
{{-- LINKS --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- Datepicker --}}
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
{{-- JQuery Validation --}}
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>

<!--Tailwind Utility & Flowbite-->
@vite(['resources/css/app.css','resources/js/app.js'])


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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('common.links')
    @vite('resources/js/charts.js')
</head>
<body class="bg-gray-100">
    @include('common.adminheader') 
    @include('common.sidebar') 
    
    <div class="px-4 pt-6">
        @include('common.charts')
        @include('common.summary')
        
    </div>

    @include('common.footer')
</body>
</html>
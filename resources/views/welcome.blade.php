<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel + ZURB Foundation</title>

    <link href="/public/css/app.css" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>

</head>
<body>

    @include('foundation-items.top-bar')

    @include('foundation-items.orbit')
    @include('foundation-items.grid')
    @include('foundation-items.callout')
    @include('foundation-items.table')
    @include('foundation-items.pagination')
    <br>
    @include('foundation-items.modal')
    <br>
    @include('foundation-items.tabs')
    <br>
    @include('foundation-items.other')



    @include('block.footer')
    
    @include('block.lang')

    <script src="/public/js/app.js"></script>
</body>
</html>

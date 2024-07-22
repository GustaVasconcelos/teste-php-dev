<!DOCTYPE html>
<html lang="pt-br">

<head>
    @include('includes.head')

    @yield('page-specific-head')
</head>

<body id="page-top">

    <div id="wrapper">

        @include('includes.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('includes.header')

                @yield('content')

            </div>

            @include('includes.footer')

        </div>
        
    </div>
    
    @include('includes.scripts')

    @yield('page-specific-scripts')

</body>

</html>
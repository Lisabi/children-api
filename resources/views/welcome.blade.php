<html>

<head>
    <title>Children Database</title>
    <link rel="stylesheet" href="{{ url('css/index.css') }}">

    <script src="{{ url('js/jquery.js') }}"></script>
</head>

<body>
    <div id="header">
        <h1>Children Database</h1>
    </div>

    <div id="main-body-wrapper">
        <h2>Select children attribute and search</h2>
        <form id="categories">
            <span>
                Sex: <select name="sex" id="">
                    @foreach($sex as $s)
                    <option vanlue="{ $s }}">{{ $s }}</option>
                    @endforeach
                </select>
            </span>

            <span>
                age: <select name="age" id="">
                    @foreach($age as $a)
                    <option vanlue="{ $a }}">{{ $a }}</option>
                    @endforeach
                </select>
            </span>

            <span>
                Ethnicity: <select name="ethnicity" id="">
                    @foreach($ethnicity as $e)
                    <option vanlue="{ $s }}">{{ $e }}</option>
                    @endforeach
                </select>
            </span>
            <span>
                Health Status: <select name="health_status" id="">
                    @foreach($health_status as $hs)
                    <option vanlue="{ $s }}">{{ $hs }}</option>
                    @endforeach
                </select>
            </span>



        </form>

        <button id="fetch-all">Load Data</button>
        <div id="results">
            <div id="data-container"></div>
            <div id="paginate-links">
                <button data-href="#" id="link-previous">Previous</button>
                <button data-href="#" id="link-next">Next</button>
            </div>
        </div>
    </div>


    <script src="{{ url('js/index.js') }}"></script>

</body>

</html>
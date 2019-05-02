<html>

<head>
    <style>
        #body-wrapper {
            margin: 20px auto;
            width: 50%;
        }

        table {
            border: 1px solid #000;
            border-collapse: collapse
        }

        table thead {
            background: #000;
            color: #fff;
            font-weight: bold;
        }

        table td {
            padding: 10px;
        }

        table tr {
            border-bottom: 1px solid #000;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2
        }

        #page-links ul {
            padding: 0;
        }

        #page-links li {
            display: inline;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div id="body-wrapper">
        <h1>Results page {{ $results->currentPage() }}</h1>
        <table width="100%">
            <thead>
                <td>Age</td>
                <td>Sex</td>
                <td>Ethnicity</td>
                <td>Health status</td>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td>{{ $result->age }}</td>
                    <td>{{ $result->sex }}</td>
                    <td>{{ $result->ethnicity }}</td>
                    <td>{{ $result->health_status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Links</h2>
        <div id="page-links">
            {{ $results->appends($_GET)->links() }}
        </div>
    </div>
</body>

</html> 
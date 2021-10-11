<html>
<title>PDF Report</title>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        .pagenum:before {
            content: counter(page);
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin: 145px 50px 30px 50px;
            font-family: Arial, sans-serif;
        }

        /* header */

        header  {
            position: fixed;
            padding: 50px 50px 0px 50px;
            height: 75px;
        }

        header .table-header tr th{
            text-align: left;
            padding: 1px 0px;
            font-size: 13px;
            font-weight: normal;
        }

        header .table-header tr .company {
            font-weight: bold;
            font-size: 20px;
        }

        header .table-header tr .report-title {
            font-weight: bold;
        }

        /* main */

        main {
            font-size: 15px;
        }

        main table {
            border-collapse: collapse;
        }

        main table thead {
            border: 1px solid #000;
        }

        main table thead tr th:nth-child(1) {
            width: 10%;
        }

        main table thead tr th:nth-child(2) {
            width: 50%;
        }

        main table thead tr th:nth-child(1),
        table tbody tr td:nth-child(1)
        {
            text-align: left;
        }

        main table thead tr th:nth-child(2),
        :nth-child(3),
        :nth-child(4)
        {
            text-align: left;
        }

        main table thead tr th,
        main table tbody tr td {
            padding: 5px 5px;
            font-weight: normal;
        }

        main table tbody tr td {
            border-bottom: 1px solid #000;
        }

        main table tbody tr td:nth-child(5),
        main table tbody tr td:nth-child(6),
        main table tbody tr td:nth-child(7),
        main table tbody tr td:nth-child(8),
        main table tbody tr td:nth-child(9) {
            text-align: center;
        }


    </style>
</head>
<body>




<!-- Define header and footer blocks before your content -->
<header>
    <table class="table-header" width="100%;">
        <tr>
            <th width="75%" class="company">Survey</th>
            <th>User ID: <span class="username">{{ Auth::user()->name }}</span></th>
        </tr>
        <tr>
            <th class="city">{{ $stub_number[0]->city }}</th>
            <th class="page-number">Page No: <span class="pagenum"></span></th>
        </tr>
        <tr>
            <th class="report-title">{{ $stub_number[0]->shop_name }} Survey Numbers & Voucher Code</th>
            <th class="datetime">{{ date('m/d/Y h:i:s A') }}</th>
        </tr>
    </table>
</header>


{{--<footer>--}}

{{--</footer>--}}

<!-- Wrap the content of your PDF inside a main tag -->

<main>


<table style="width: 100%">

       <thead>

            <tr>
                <th>Stub Number</th>
                <th>Voucher Code</th>
            </tr>


        </thead>

        <tbody>

            @foreach($stub_number as $key=>$value)

                <tr>
                    <td>{{ $value['survey_stub'] }}</td>
                    <td>{{ $value['voucher_code'] }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

   

</main>
</body>
</html>


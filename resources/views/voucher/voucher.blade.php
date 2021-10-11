<html>
<title>Voucher</title>
<header>
    <style>
       
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .voucher-container {
            position: relative;
            width: 100%;
            border-radius: 3px;
            border: 1px solid #636e72;
        }

        .voucher-container img {
            width: 100%;
        }

        .voucher-container h3, p, .voucher-code {
            color: white;
            padding: 0;
            margin: 0;
        }

        .voucher-container h3 {
            font-weight: bold;
            font-size: 20px;
            margin: 10px 0;
        }

        .voucher-container p {
            font-weight: normal;
            font-size: 15px;
        }

        .voucher-container .content {
            position: absolute;
            width: 400px;
            top: 250px;
            right: 10px;
        }

        .voucher-container .voucher-code {
            padding-top: 20px;
            font-weight: bold;
        }





    </style>
</header>
<body>

    <div class="voucher-container">

        <img src="{{ asset('image/background/sample_voucher.jpg ')}}">
        <div class="content">
            <h3>Tea-Mang Voucher</h3>
            <p>
                Sample Voucher
            </p>    
            <div class="voucher-code">
                <table>
                    <tr>
                        <td style="text-align: right; padding-right: 10px">SURVEY CODE:</td>
                        <td>{{ $code }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; padding-right: 10px">VOUCHER CODE:</td>
                        <td>{{ $voucher_code }}</td>
                    </tr>
                </table>               
            </div>  
        </div>
    </div>
</body>
</html>


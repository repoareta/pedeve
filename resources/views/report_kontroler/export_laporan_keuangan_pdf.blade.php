<?php ini_set('memory_limit', '2048M'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        CATATAN ATAS LAPORAN KEUANGAN
    </title>
</head>
<style media="screen">

table {
    font: normal 10px Verdana, Arial, sans-serif;
    border-collapse: collapse;
}

.table-no-border-all td {
    border: 0px;
    padding: 0px;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}

.text-center {
    text-align: center;
}

.text-right {
    text-align: right;
}

th, tr {
    white-space: nowrap;
}

header { 
    position: fixed; 
    left: 0px; 
    top: -110px;
    right: 0px;
    height: 0px;
}

@page { 
    margin: 130px 50px 50px 50px;
}

</style>
<body>
    <header id="header">
        <div class="row">
            <div class="text-center">
                <p>
                    <b>
                    PT. PERTAMINA PEDEVE INDONESIA
                    <br>
                    CATATAN ATAS LAPORAN KEUANGAN
                    </b>
                    <br>
                    BULAN BUKU: MEI 2020
                </p>
            </div>
    
            <div>
                <img align="right" src="{{ public_path() . '/images/pertamina.jpg' }}" width="120px" height="60px" style="padding-top:10px">
            </div>
        </div>
    </header>
      
    <main>
        <div class="row">
            <table style="width:100%;" class="table">
                <thead>
                    <tr>
                        <th>KETERANGAN</th>
                        <th>SUB AKUN</th>
                        <th>MMD</th>
                        <th>MS</th>
                        <th>KONSOLIDASI</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </main>  
</body>
</html>
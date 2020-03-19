<!DOCTYPE html>
<html lang="en">
<head>
</head>
<style media="screen">
/* body {
    font: normal 14px Verdana, Arial, sans-serif;
} */

.table {
    font: normal 12px Verdana, Arial, sans-serif;
    border-collapse: collapse;
    border: 1px solid black;
}

th, td {
    border: 1px solid black;
    padding: 5px;
}

.table-no-border-all td {
    font: normal 12px Verdana, Arial, sans-serif;
    border: 0px;
    padding: 0px;
}

.table-no-border td, .table-no-border tr {
    font: normal 12px Verdana, Arial, sans-serif;
    border:0px;
    padding: 0px;
}

h4 {
    font-size: 15px;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}

.content {
    width: 100%;
    padding: 0px;
    overflow: hidden;
}

.content img {
    margin-right: 15px;
    float: left;
}

.content h4 {
    margin-left: 15px;
    display: block;
    margin: 2px 0 15px 0;
}

.content p {
    margin-left: 15px;
    display: block;
    margin: 0px 0 10px 0;
    font-size: 12px;
    padding-bottom: 10px;
}

</style>
<body>
    <table style="width:100%;" class="table">
        <thead>
            <tr>
                <th>No. Panjar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($umk_header_list as $umk)
                <tr>
                    <td>{{ $umk->no_umk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
{{-- Datatables --}}
<link href="{{ asset('plugins/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
{{-- <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" > --}}
{{-- Global CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

{{-- custom style --}}
<style>
.kt-portlet .kt-portlet__head {
    justify-content: start;
}

.kt-portlet__head-actions {
    margin-left: 10px;
}

.kt-radio {
    display: inline-block;
    position: relative;
    padding-left: 10px;
    text-align: left;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s ease;
}

td.sorting_1 {
    padding-top: 0px;
}
</style>

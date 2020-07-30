<div class="kt-portlet__head-actions">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a class="btn btn-outline-secondary @if(Route::current()->getName() == 'gcg.gratifikasi.index') active @endif" href="{{ route('gcg.gratifikasi.index') }}" role="button">Outstanding</a>
        <a class="btn btn-outline-secondary @if(Route::current()->getName() == 'gcg.gratifikasi.penerimaan') active @endif" href="{{ route('gcg.gratifikasi.penerimaan') }}" role="button">Penerimaan</a>
        <a class="btn btn-outline-secondary @if(Route::current()->getName() == 'gcg.gratifikasi.pemberian') active @endif" href="{{ route('gcg.gratifikasi.pemberian') }}" role="button">Pemberian</a>
        <a class="btn btn-outline-secondary @if(Route::current()->getName() == 'gcg.gratifikasi.permintaan') active @endif" href="{{ route('gcg.gratifikasi.permintaan') }}" role="button">Permintaan</a>
        <div class="btn-group" role="group">
            <button id="btnGroupVerticalDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle @if(Route::current()->getName() == 'gcg.gratifikasi.report.personal' || Route::current()->getName() == 'gcg.gratifikasi.report.management') active @endif" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Report
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                <a class="dropdown-item @if(Route::current()->getName() == 'gcg.gratifikasi.report.personal') active @endif" href="{{ route('gcg.gratifikasi.report.personal') }}">Personal</a>
                <a class="dropdown-item @if(Route::current()->getName() == 'gcg.gratifikasi.report.management') active @endif" href="{{ route('gcg.gratifikasi.report.management') }}">Management</a>
            </div>
        </div>
    </div>
</div>
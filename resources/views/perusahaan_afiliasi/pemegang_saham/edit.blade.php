{{-- PEMEGANG SAHAM START --}}
<div class="kt-portlet__head kt-portlet__head">
    <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-line-chart"></i>
        </span>
        <h3 class="kt-portlet__head-title">
            Pemegang Saham
        </h3>
        
        <div class="kt-portlet__head-actions" style="font-size: 2rem;">
            <a href="#" id="openDetail">
                <span class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
                    <i class="fas fa-plus-circle"></i>
                </span>
            </a>

            <span class="kt-font-warning pointer-link" id="editRow" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
                <i class="fas fa-edit"></i>
            </span>

            <span class="kt-font-danger pointer-link" id="deleteRow" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
                <i class="fas fa-times-circle"></i>
            </span>
        </div>
    </div>
    <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
        </div>
    </div>
</div>
<div class="kt-portlet__body">
    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
        <thead class="thead-light">
            <tr>
                <th></th>
                <th>Nama PT</th>
                <th>% Kepemilikan</th>
                <th>Jumlah Saham (lembar)</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
{{-- PEMEGANG SAHAM END --}}

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title_modal" data-state="add">Tambah Detail Panjar Dinas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form class="kt-form kt-form--label-right" action="" method="POST" id="formPanjarDinasDetail">
				<div class="modal-body">
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. Urut</label>
						<div class="col-10">
							<input class="form-control" type="number" name="no_urut" id="no_urut">
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Keterangan</label>
						<div class="col-10">
							<textarea class="form-control" name="keterangan_detail" id="keterangan_detail"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">Golongan</label>
						<div class="col-10">
							<input class="form-control" type="text" name="golongan_detail" id="golongan_detail">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Batal</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--end::Modal-->
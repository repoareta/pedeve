@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Permintaan Bayar </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Permintaan Bayar </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edit</span>
			</div>
		</div>
	</div>
</div>
<!-- end:: Subheader -->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-plus-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Menu Permintaan Bayar
				</h3>			
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
				</div>
			</div>
		</div>
			<!--begin: Datatable -->
			<form  class="kt-form kt-form--label-right" id="form-update-permintaan-bayar">
				{{csrf_field()}}
				<div class="kt-portlet__body">
					<div class="form-group form-group-last">
						<div class="alert alert-secondary" role="alert">
							<div class="alert-text">
								<h5 class="kt-portlet__head-title">
									Header Permintaan Bayar
								</h5>	
							</div>
						</div>
                        @foreach($data_bayars as $data_bayar)
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">No. Permintaan<span style="color:red;">*</span></label>
							<div class="col-5">
								<input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" name="nobayar" value="{{$data_bayar->no_bayar}}" id="nobayar">
							</div>

							<label for="spd-input" class="col-2 col-form-label">Tanggal<span style="color:red;">*</span></label>
							<div class="col-3">
								<input class="form-control" type="text" name="tanggal" id="tanggal" value="<?php echo date("d-m-Y", strtotime($data_bayar->tgl_bayar)) ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="nopek-input" class="col-2 col-form-label">Terlampir<span style="color:red;">*</span></label>
							<div class="col-10">
								<textarea class="form-control" type="text" name="lampiran" value=""  id="lampiran"  required>{{$data_bayar->lampiran}}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="id-pekerja;-input" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
							<div class="col-10">
								<textarea class="form-control" type="text" value=""  name="keterangan" size="50" maxlength="200" required>{{$data_bayar->keterangan}}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="jenis-dinas-input" class="col-2 col-form-label">Dibayar Kepada<span style="color:red;">*</span></label>
							<div class="col-10">
								<select name="dibayar" id="dibayar" class="form-control selectpicker" data-live-search="true" required oninvalid="this.setCustomValidity('Dibayar Kepada Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach ($vendor as $row)
									<option value="{{ $row->nama }}" <?php if($row->nama  == $data_bayar->kepada ) echo 'selected' ; ?>>{{ $row->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-2 col-form-label">Rekening Bank</label>
							<div class="col-10">
								<input style=" width: 17px;height: 26px;margin-left:50px;" name="rekyes" type="checkbox"  id="rekyes" value="{{$data_bayar->rekyes}}" <?php if ($data_bayar->rekyes == '1' )  echo 'checked' ; ?>></td>
							</div>
						</div>
						<div class="form-group row">
							<label for="dari-input" class="col-2 col-form-label">Debet Dari</label>
							<div class="col-10">
								<select name="debetdari" id="select-debetdari" class="form-control selectpicker" data-live-search="true" >
                                    <option value="">- Pilih -</option>
									@foreach ($debit_nota as $row)
									<option value="{{ $row->kode }}" <?php if($row->kode == $data_bayar->debet_dari ) echo 'selected' ; ?>>{{ $row->kode.' - '.$row->keterangan }}</option>
									@endforeach
									
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2 col-form-label">No. Debet</label>
							<div class="col-5">
								<input class="form-control" type="text" name="nodebet" id="nodebet" value="{{$data_bayar->debet_no}}" size="15" maxlength="15" >
							</div>
							<label class="col-2 col-form-label">Tgl Debet</label>
							<div class="col-3" >
								<input class="form-control" type="text" name="tgldebet" value="<?php echo date("d-m-Y", strtotime($data_bayar->debet_tgl)) ?>" id="tgldebet" size="15" maxlength="15" >
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input"  class="col-2 col-form-label">No. Kas</label>
							<div class="col-5">
								<input style="background-color:#DCDCDC; cursor:not-allowed" readonly  class="form-control" name="nokas" type="text" value="{{$data_bayar->no_kas}}" id="nokas" size="10" maxlength="25">
							</div>
							<label for="spd-input"  class="col-2 col-form-label">Bulan Buku<span style="color:red;">*</span></label>
							<div class="col-3" >
								<input class="form-control" type="text" value="{{$data_bayar->bulan_buku}}"  name="bulanbuku" size="6" maxlength="6" style="background-color:#DCDCDC; cursor:not-allowed" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="spd-input" class="col-2 col-form-label">CI<span style="color:red;">*</span></label>
							<div class="col-5">
								<input id="ci"   style=" width: 26px;height: 17px;margin-left:50px;" value="1" <?php if ($data_bayar->ci == '1' )  echo 'checked' ; ?> type="radio"  name="ci" onclick="displayResult(1)"  checked />  <label style="font-size:14px; margin-left:10px;">IDR</label>
								<input  id="ci" style=" width: 26px;height: 17px;margin-left:50px;" value="2" <?php if ($data_bayar->ci == '2' )  echo 'checked' ; ?> type="radio"    name="ci"  onclick="displayResult(2)" /><label style="font-size:14px; margin-left:10px;"> USD</label>
							</div>

							<label for="spd-input" class="col-2 col-form-label">Kurs<span style="color:red;">*</span></label>
							<div class="col-3">
								<input class="form-control" type="text" name="kurs" id="kurs" value="<?php echo number_format($data_bayar->rate, 0, ',', '.'); ?>" size="10" maxlength="10" onkeypress="return hanyaAngka(event)" >
								<input class="form-control" type="hidden" id="data-kurs" value="<?php echo number_format($data_bayar->rate, 0, ',', '.'); ?>" >
							</div>
						</div>
						<div class="form-group row">
							<label for="mulai-input" class="col-2 col-form-label">Periode<span style="color:red;">*</span></label>
							<div class="col-10">
								<div class="input-daterange input-group" id="date_range_picker">
									<input type="text" class="form-control" name="mulai" value="<?php echo date("d-m-Y", strtotime($data_bayar->mulai)) ?>" />
									<div class="input-group-append">
										<span class="input-group-text">s/d</span>
									</div>
									<input type="text" class="form-control" name="sampai"  value="<?php echo date("d-m-Y", strtotime($data_bayar->sampai)) ?>"/>
								</div>
							</div>
						</div>
                        @endforeach
						<div class="form-group row">
							<label class="col-2 col-form-label">Total Nilai</label>
							<div class="col-10">
								<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" value="<?php echo number_format($count, 2, '.', ','); ?>"  readonly>
								<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" name="totalnilai" type="text" id="totalnilai" value="<?php echo number_format($count, 2, '.', ''); ?>"  hidden>
							</div>
						</div>
                        @foreach($data_bayars as $data_bayar)
						<?php
						if($data_bayar->app_pbd == 'Y'){ ?>
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-2"></div>
								<div class="col-10">
									<a  href="{{route('permintaan_bayar.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',741)->limit(1)->get() as $data_akses)
									@if($data_akses->rubah == 1)
									<button type="submit" class="btn btn-brand" disabled style="cursor:not-allowed"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
									@endif
									@endforeach
								</div>
							</div>
						</div>
						<?php }else{ ?>
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-2"></div>
									<div class="col-10">
										<a  href="{{route('permintaan_bayar.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
										@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',741)->limit(1)->get() as $data_akses)
										@if($data_akses->rubah == 1)
										<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
										@endif
										@endforeach
									</div>
								</div>
							</div>
						<?php } ?>
						@endforeach
					</div>
				</div>
			</form>

				

					
				<div class="kt-portlet__head kt-portlet__head">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon2-line-chart"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Detail Permintaan Bayar
						</h3>			
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<div class="kt-portlet__head-actions">
								@foreach($data_bayars as $data)
									<?php
									if($data->app_pbd == 'Y'){ ?>
										<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
											<i class="fas fa-plus-circle" disabled style="cursor:not-allowed"></i>
										</span>
						
										<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
											<i class="fas fa-edit"  disabled style="cursor:not-allowed"></i>
										</span>
						
										<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
											<i class="fas fa-times-circle"  disabled style="cursor:not-allowed"></i>
										</span>
									<?php }else{ ?>
										<a href="#" data-toggle="modal" data-target="#kt_modal_4">
										<span style="font-size: 2em;" class="kt-font-success">
											<i class="fas fa-plus-circle"></i>
										</span>
										</a>
						
										<a href="#" id="editRow">
											<span style="font-size: 2em;" class="kt-font-warning">
												<i class="fas fa-edit"></i>
											</span>
										</a>
						
										<a href="#" id="deleteRow">
											<span style="font-size: 2em;" class="kt-font-danger">
												<i class="fas fa-times-circle"></i>
											</span>
										</a>
									<?php } ?>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">
					<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table">
						<thead class="thead-light">
							<tr>
								<th ><input type="radio" hidden name="btn-radio"  data-id="1" class="btn-radio" checked ></th>
								<th >No.</th>
								<th >Keterangan</th>
								<th >Bagian</th>
								<th >Account</th>
								<th >JB</th>
								<th >PK</th>
								<th >CJ</th>
								<th >Jumlah</th>
							</tr>
						</thead>
						<tbody>
                            <?php $no=0; ?>
                            @foreach($data_bayar_details as $data_bayar_detail)
                            <?php $no++; ?>
                                <tr class="table-info">
                                    <td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" data-no="{{$data_bayar_detail->no}}"  data-id="{{str_replace('/', '-', $data_bayar_detail->no_bayar)}}" nobayar="{{$data_bayar_detail->no_bayar}}" class="btn-radio" ><span></span></label></td>
                                    <td scope="row" align="center">{{$no}}</td>
                                    <td>{{$data_bayar_detail->keterangan}}</td>
                                    <td align="center">{{$data_bayar_detail->bagian}}</td>
                                    <td align="center">{{$data_bayar_detail->account}}</td>
                                    <td align="center">{{$data_bayar_detail->jb}}</td>
                                    <td align="center">{{$data_bayar_detail->pk}}</td>
                                    <td align="center">{{$data_bayar_detail->cj}}</td>
                                    <td><?php echo number_format($data_bayar_detail->nilai, 2, '.', ','); ?></td>
                                </tr>
                            @endforeach
                        </tbody>
                                <tr>
                                    <td colspan="8" align="right">Jumlah Total : </td>
                                    <td ><?php echo number_format($count, 2, '.', ','); ?></td>
                                </tr>
						</tbody>
					</table>
				</div>
			<!--end: Datatable -->
	</div>
</div>

<!--begin::Modal-->
<div class="modal fade modal-create-detail-umk" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Tambah Menu Rincian Minta Bayar</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-tambah-bayar-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_bayars as $data_bayar)
                        <input  class="form-control" hidden type="text" value="{{$data_bayar->no_bayar}}"  name="nobayar">
                        @endforeach
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_bayar_details}}"  name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<textarea  class="form-control" type="text" value=""  name="keterangan" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi..')" oninput="setCustomValidity('')">-</textarea>
						</div>
					</div>
									
																					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Account</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-8" >
							<select class="cariaccount form-control" style="width: 100% !important;" name="acc"></select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kode Bagian</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-8">
							<select class="caribagian form-control" style="width: 100% !important;" name="bagian"></select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="000"  name="pk" size="6" maxlength="6" autocomplete='off'>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div  class="col-8">
							<select class="carijb form-control" style="width: 100% !important;" name="jb"></select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C. Judex</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<select class="caricj form-control" style="width: 100% !important;" name="cj"></select>
						</div>
					</div>

									

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="nilai"  required oninvalid="this.setCustomValidity('Jumlah Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ','); setCustomValidity('')" autocomplete='off'>
						</div>
					</div>

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',741)->limit(1)->get() as $data_akses)
								@if($data_akses->rubah == 1)
								<button type="submit" class="btn btn-brand"><i class="fa fa-reply" aria-hidden="true"></i>Save</button>
								@endif
								@endforeach
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--end::Modal-->
<div class="modal fade modal-edit-detail-bayar" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Edit Menu Rincian Minta Bayar</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-edit-bayar-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_bayars as $data_bayar)
                        <input  class="form-control" hidden type="text" value="{{$data_bayar->no_bayar}}"  name="nobayar">
                        @endforeach
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_bayar_details}}" id="no" name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<textarea  class="form-control" type="text" value="" id="keterangan" name="keterangan"></textarea>
						</div>
					</div>
									
																					
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Account</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div id="div-acc" class="col-8">
							<select name="acc" id="select-acc" class="cariaccount form-control" style="width: 100% !important;">
								<option value="">-Pilih-</option>
									@foreach($data_account as $row)
								<option value="{{$row->kodeacct}}">{{$row->kodeacct}} - {{$row->descacct}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Kode Bagian</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div id="div-bagian" class="col-8">
							<select name="bagian" id="select-bagian"  class="caribagian form-control" style="width: 100% !important;">
								<option value="">-Pilih-</option>
									@foreach($data_bagian as $row)
								<option value="{{$row->kode}}" >{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" id="pk" name="pk" size="6" maxlength="6" autocomplete='off'>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div id="div-jb" class="col-8">
							<select name="jb" id="select-jb" class="carijb form-control" style="width: 100% !important;">
								<option value="">-Pilih-</option>
									@foreach($data_jenisbiaya as $row)
								<option value="{{$row->kode}}" >{{$row->kode}} - {{$row->keterangan}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">C. Judex</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8" id="div-cj">
							<select name="cj" id="select-cj" class="caricj form-control" style="width: 100% !important;">
								<option value="">-Pilih-</option>
									@foreach($data_cj as $row)
								<option value="{{$row->kode}}">{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>
									

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="" name="nilai" id="nilai" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');" autocomplete='off'>
						</div>
					</div>

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',741)->limit(1)->get() as $data_akses)
								@if($data_akses->rubah == 1)
								<button type="submit" class="btn btn-brand"><i class="fa fa-reply" aria-hidden="true"></i>Save</button>
								@endif
								@endforeach
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection

@section('scripts')
	<script type="text/javascript">
	$(document).ready(function () {
		var t = $('#kt_table').DataTable({
			scrollX   : true,
			processing: true,
			serverSide: false,
		});
		$('#kt_table tbody').on( 'click', 'tr', function (event) {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			} else {
				t.$('tr.selected').removeClass('selected');
				// $(':radio', this).trigger('click');
				if (event.target.type !== 'radio') {
					$(':radio', this).trigger('click');
				}
				$(this).addClass('selected');
			}
		} );

		$('.kt-select2').select2().on('change', function() {
			// $(this).valid();
		});

		$('.cariaccount').select2({
			placeholder: '-Pilih-',
			allowClear: true,
			ajax: {
				url: "{{ route('permintaan_bayar.search.account') }}",
				type : "get",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				delay: 250,
			processResults: function (data) {
				return {
				results:  $.map(data, function (item) {
					return {
					text: item.kodeacct +'--'+ item.descacct,
					id: item.kodeacct
					}
				})
				};
			},
			cache: true
			}
		});

		$('.caribagian').select2({
			placeholder: '-Pilih-',
			allowClear: true,
			ajax: {
				url: "{{ route('permintaan_bayar.search.bagian') }}",
				type : "get",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				delay: 250,
			processResults: function (data) {
				return {
				results:  $.map(data, function (item) {
					return {
					text: item.kode +'--'+ item.nama,
					id: item.kode
					}
				})
				};
			},
			cache: true
			}
		});

		$('.carijb').select2({
			placeholder: '-Pilih-',
			allowClear: true,
			ajax: {
				url: "{{ route('permintaan_bayar.search.jb') }}",
				type : "get",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				delay: 250,
			processResults: function (data) {
				return {
				results:  $.map(data, function (item) {
					return {
					text: item.kode +'--'+ item.keterangan,
					id: item.kode
					}
				})
				};
			},
			cache: true
			}
		});

		$('.caricj').select2({
			placeholder: '-Pilih-',
			allowClear: true,
			ajax: {
				url: "{{ route('permintaan_bayar.search.cj') }}",
				type : "get",
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				delay: 250,
			processResults: function (data) {
				return {
				results:  $.map(data, function (item) {
					return {
					text: item.kode +'--'+ item.nama,
					id: item.kode
					}
				})
				};
			},
			cache: true
			}
		});

		$("input[name=ci]:checked").each(function() {  
			var ci = $(this).val();
			if(ci == 1)
			{
				$('#kurs').val(1);
				$('#simbol-kurs').hide();
				$( "#kurs" ).prop( "required", false );
				$( "#kurs" ).prop( "readonly", true );
				$('#kurs').css("background-color","#DCDCDC");
				$('#kurs').css("cursor","not-allowed");

			}else{
				var kurs1 = $('#data-kurs').val();
				$('#kurs').val(kurs1);
				$('#simbol-kurs').show();
				$( "#kurs" ).prop( "required", true );
				$( "#kurs" ).prop( "readonly", false );
				$('#kurs').css("background-color","#ffffff");
				$('#kurs').css("cursor","text");
			}
				
		});


// proses update permintaan bayar
		$('#form-update-permintaan-bayar').submit(function(){
        	var no_umk = $("#noumk").val();
			$.ajax({
				url  : "{{route('permintaan_bayar.store')}}",
				type : "POST",
				data : $('#form-update-permintaan-bayar').serialize(),
				dataType : "JSON",
				headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success : function(data){
				console.log(data);
				Swal.fire({
					type  : 'success',
					title : 'Data Permintaan Biaya Berhasil Disimpan',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
						window.location.replace("{{ route('permintaan_bayar.index')}}");;
					});
				}, 
				error : function(){
					alert("Terjadi kesalahan, coba lagi nanti");
				}
			});	
			return false;
		});
	



 //prosess create detail
 $('#form-tambah-bayar-detail').submit(function(){
		$.ajax({
			url  : "{{route('permintaan_bayar.store.detail')}}",
			type : "POST",
			data : $('#form-tambah-bayar-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                Swal.fire({
					type  : 'success',
					title : 'Data Detail Permintaan Biaya Berhasil Ditambah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
                    location.reload();
                });
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});	
		return false;
	});

 //proses update detail
 $('#form-edit-bayar-detail').submit(function(){
		$.ajax({
			url  : "{{route('permintaan_bayar.store.detail')}}",
			type : "POST",
			data : $('#form-edit-bayar-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                Swal.fire({
					type  : 'success',
					title : 'Data Detail Permintaan Biaya Berhasil Diubah',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
                    window.location.reload();
                });
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});	
		return false;
	});



//tampil edit detail
$('#editRow').on('click', function(e) {
	e.preventDefault();
var allVals = [];  
$(".btn-radio:checked").each(function() {  
	var dataid = $(this).attr('data-id');
	var datano = $(this).attr('data-no');
	if(dataid == 1)  
	{  
		swalAlertInit('ubah'); 
	}  else { 
		$.ajax({
			url :"{{url('umum/permintaan_bayar/editdetail')}}"+ '/' +dataid+ '/' +datano,
			type : 'get',
			dataType:"json",
			headers: {
				'X-CSRF-Token': '{{ csrf_token() }}',
				},
			success:function(data)
			{
				$('#no').val(data.no);
				$('#keterangan').val(data.keterangan);
				$('#pk').val(data.pk);
				var d=parseFloat(data.nilai);
				var rupiah = d.toFixed(2);
				$('#nilai').val(rupiah);
				$('.modal-edit-detail-bayar').modal('show');
				$('#select-bagian').val(data.bagian).trigger('change');
				$('#select-acc').val(data.account).trigger('change');
				$('#select-jb').val(data.jb).trigger('change');
				$('#select-cj').val(data.cj).trigger('change');

			}
		})
	}
				
});
});


//delete permintaan bayar detail
$('#deleteRow').click(function(e) {
			e.preventDefault();
			$(".btn-radio:checked").each(function() {  
			var dataid = $(this).attr('data-id');
				if(dataid == 1)  
				{  
					swalAlertInit('hapus'); 
				}  else { 
				$("input[type=radio]:checked").each(function() {
                    var id = $(this).attr('nobayar');
                    var no = $(this).attr('data-no');
					// delete stuff
					const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-primary',
							cancelButton: 'btn btn-danger'
						},
							buttonsStyling: false
						})
						swalWithBootstrapButtons.fire({
							title: "Data yang akan dihapus?",
							text: "No. Bayar : " + id+"dan NO urut :"+no,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('permintaan_bayar.delete.detail') }}",
								type: 'DELETE',
								dataType: 'json',
								data: {
									"id": id,
									"no": no,
									"_token": "{{ csrf_token() }}",
								},
								success: function () {
									Swal.fire({
										type  : 'success',
										title : 'Hapus Data Detail Permintaan Bayar',
										text  : 'Berhasil',
										timer : 2000
									}).then(function() {
										location.reload();
									});
								},
								error: function () {
									alert("Terjadi kesalahan, coba lagi nanti");
								}
							});
						}
					});
				});
			} 
		});
	});


	// range picker
	$('#date_range_picker').datepicker({
		todayHighlight: true,
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});

	// minimum setup
	$('#tanggal').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});
	// minimum setup
	$('#tgldebet').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});
	$('#bulanbuku').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	$('#bulanbuku').datepicker("setDate", new Date());


});
function displayResult(ci){ 
	if(ci == 1)
	{
		$('#kurs').val(1);
		$('#simbol-kurs').hide();
		$( "#kurs" ).prop( "required", false );
		$( "#kurs" ).prop( "readonly", true );
		$('#kurs').css("background-color","#DCDCDC");
		$('#kurs').css("cursor","not-allowed");

	}else{
		var kurs1 = $('#data-kurs').val();
		$('#kurs').val(kurs1);
		$('#simbol-kurs').show();
		$( "#kurs" ).prop( "required", true );
		$( "#kurs" ).prop( "readonly", false );
		$('#kurs').css("background-color","#ffffff");
		$('#kurs').css("cursor","text");
	}
}
        function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

@endsection

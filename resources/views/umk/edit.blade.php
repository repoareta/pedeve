@extends('layout.global')

@section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-subheader__main">
			<h3 class="kt-subheader__title">
				Uang Muka Kerja </h3>
			<span class="kt-subheader__separator kt-hidden"></span>
			<div class="kt-subheader__breadcrumbs">
				<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Umum </a>
				<span class="kt-subheader__breadcrumbs-separator"></span>
				<a href="" class="kt-subheader__breadcrumbs-link">
					Uang Muka Kerja </a>
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
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Menu Uang Muka Kerja
				</h3>
			</div>
		</div>
		<!--begin: Datatable -->
		<form  class="kt-form kt-form--label-right" id="form-update-umk">
			{{csrf_field()}}
			<div class="kt-portlet__body">
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-text">
							<h5 class="kt-portlet__head-title">
								Header Uang Muka Kerja
							</h5>	
						</div>
					</div>
                    @foreach($data_umks as $data_umk)
					<div class="form-group row">
						<label for="spd-input" class="col-2 col-form-label">No. UMK<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$data_umk->no_umk}}" name="no_umk" size="25" maxlength="25" readonly>
                        </div>
					</div>
					<div class="form-group row">
						<label for="nopek-input" class="col-2 col-form-label">Tanggal<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input class="form-control" type="text" name="tgl_panjar" id="tgl_panjar" value="<?php echo date("d-m-Y", strtotime($data_umk->tgl_panjar)) ?>" size="15" maxlength="15">
						</div>
					</div>
					<div class="form-group row">
						<label for="jenis-dinas-input" class="col-2 col-form-label">Dibayar Kepada<span style="color:red;">*</span></label>
						<div class="col-10">
								<select name="kepada" id="kepada" class="form-control kt-select2" style="width: 100% !important;" required oninvalid="this.setCustomValidity('Dibayar Kepada Harus Diisi..')" onchange="setCustomValidity('')">
									<option value="">- Pilih -</option>
									@foreach ($vendor as $row)
									<option value="{{ $row->nama }}"  <?php if($row->nama  == $data_umk->kepada ) echo 'selected' ; ?>>{{ $row->nama }}</option>
									@endforeach
								</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-email-input" class="col-2 col-form-label">Jenis Uang Muka<span style="color:red;">*</span></label>
						<div class="col-6">
							<label class="kt-radio kt-radio--solid">
								<input value="K" <?php if ($data_umk->jenis_um == 'K' )  echo 'checked' ; ?> type="radio" name="jenis_um" > Uang Muka Kerja
								<span></span>
							</label>
							<label style="margin-left:50px;" class="kt-radio kt-radio--solid">
								<input value="D" <?php if ($data_umk->jenis_um == 'D' )  echo 'checked' ; ?> type="radio"  name="jenis_um"> Uang Muka Dinas
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group row">
						<label for="id-pekerja;-input" class="col-2 col-form-label">Bulan Buku<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input class="form-control" type="text" value="{{$data_umk->bulan_buku}}"   name="bulan_buku" size="6" maxlength="6" readonly style="background-color:#DCDCDC; cursor:not-allowed">
						</div>
					</div>
					<div class="form-group row">
						<label for="dari-input" class="col-2 col-form-label">Mata Uang<span style="color:red;">*</span></label>
						<div class="col-10">
							<label class="kt-radio kt-radio--solid">
								<input value="1" <?php if ($data_umk->ci == '1' )  echo 'checked' ; ?> type="radio"  name="ci" onclick="displayResult(1)"> IDR
								<span></span>
							</label>
							<label style="margin-left:50px;" class="kt-radio kt-radio--solid">
								<input value="2" <?php if ($data_umk->ci == '2' )  echo 'checked' ; ?> type="radio"    name="ci"  onclick="displayResult(2)"> USD
								<span></span>
							</label>
						</div>
					</div>
					<div class="form-group row">
						<label for="tujuan-input" class="col-2 col-form-label">Kurs<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input class="form-control" type="text" value="<?php echo number_format($data_umk->rate, 0, ',', '.'); ?>" name="kurs"  id="kurs" size="10" maxlength="10" onkeypress="return hanyaAngka(event)" autocomplete='off' readonly oninvalid="this.setCustomValidity('Kurs Harus Diisi..')" oninput="setCustomValidity('')" >
                            <input class="form-control" type="hidden" value="<?php echo number_format($data_umk->rate, 0, ',', '.'); ?>" id="data-kurs"  size="10" maxlength="10">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Untuk<span style="color:red;">*</span></label>
						<div class="col-10">
							<textarea  class="form-control" type="text"  name="untuk" id="untuk" size="70" maxlength="200" required oninvalid="this.setCustomValidity('Untuk Harus Diisi..')" oninput="setCustomValidity('')">{{$data_umk->keterangan}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="example-datetime-local-input" class="col-2 col-form-label">Jumlah<span style="color:red;">*</span></label>
						<div class="col-10">
                            <input style="background-color:#DCDCDC; cursor:not-allowed" class="form-control" type="text" value="<?php echo number_format($count, 2, '.', ','); ?>"  size="16" maxlength="16" readonly>
							<input  class="form-control" type="text" value="<?php echo number_format($count, 2, '.', ''); ?>" name="jumlah" id="jumlah" size="16" hidden maxlength="16"  readonly>
						</div>
					</div>
					<?php
					if($data_umk->app_pbd == 'Y'){ ?>
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
								@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',721)->limit(1)->get() as $data_akses)
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
									<a  href="{{route('uang_muka_kerja.index')}}" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</a>
									@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',721)->limit(1)->get() as $data_akses)
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
						Detail Uang Muka Kerja
					</h3>			
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
							@foreach($data_umks as $data)
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
								<a href="#" id="btn-create-detail" data-target="#kt_modal_4">
									<span style="font-size: 2em;" class="kt-font-success" data-toggle="kt-tooltip" data-placement="top" title="Tambah Data">
										<i class="fas fa-plus-circle"></i>
									</span>
								</a>
				
								<span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Ubah Data">
									<i class="fas fa-edit" id="btn-edit-detail"></i>
								</span>
				
								<span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Hapus Data">
									<i class="fas fa-times-circle" id="deleteRow"></i>
								</span>
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
							<th >Account</th>
							<th >Bagian</th>
							<th >PK</th>
							<th >JB</th>
							<th >KK</th>
							<th >Jumlah</th>
						</tr>
					</thead>
					<tbody>
                    <?php $no=0; ?>
					@foreach($data_umk_details as $data_umk_detail)
					<?php $no++; ?>
						<tr class="table-info">
							<td scope="row" align="center"><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="btn-radio" data-no="{{$data_umk_detail->no}}"  data-id="{{str_replace('/', '-', $data_umk_detail->no_umk)}}" noumk="{{$data_umk_detail->no_umk}}" class="btn-radio" ><span></span></label></td>
							<td scope="row" align="center">{{$no}}</td>
							<td>{{$data_umk_detail->keterangan}}</td>
							<td align="center">{{$data_umk_detail->account}}</td>
							<td align="center">{{$data_umk_detail->bagian}}</td>
							<td align="center">{{$data_umk_detail->pk}}</td>
							<td align="center">{{$data_umk_detail->jb}}</td>
							<td align="center">{{$data_umk_detail->cj}}</td>
							<td><?php echo number_format($data_umk_detail->nilai, 2, '.', ','); ?></td>
						</tr>
					@endforeach
					</tbody>
                        <tr>
                            <td colspan="8" align="right">Jumlah Total : </td>
                            <td ><?php echo number_format($count, 2, '.', ','); ?></td>
                        </tr>
				</table>
			</div>
		<!--end: Datatable -->
	</div>
</div>

<!--begin::Modal creaate--> 
<div class="modal fade modal-create-detail-umk" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail"></h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-tambah-umk-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_umks as $data_umk)
                        <input  class="form-control" hidden type="text" value="{{$data_umk->no_umk}}"  name="no_umk">
                        @endforeach
                    <div class="form-group row ">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut<span style="color:red;">*</span></label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_umk_details}}"  name="no" readonly>
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
							<input  class="form-control" type="text" value="" name="nilai"   required oninvalid="this.setCustomValidity('Jumlah Harus Diisi..')" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ','); setCustomValidity('')" autocomplete='off'>
						</div>
					</div>

																					
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',721)->limit(1)->get() as $data_akses)
								@if($data_akses->rubah == 1)
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
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
<!--begin::Modal edit--> 
<div class="modal fade modal-edit-detail-umk" id="kt_modal_4"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="title-detail">Edit Detail Uang Muka Kerja</h5>
			</div>
			<div class="modal-body">
			<span id="form_result"></span>
                <form  class="kt-form " id="form-edit-tambah-umk-detail"  enctype="multipart/form-data">
					{{csrf_field()}}
                        @foreach($data_umks as $data_umk)
                        <input  class="form-control" hidden type="text" value="{{$data_umk->no_umk}}"  name="no_umk">
                        @endforeach
                    <div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">No. Urut</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input style="background-color:#DCDCDC; cursor:not-allowed"  class="form-control" type="text" value="{{$no_umk_details}}" id="no" name="no" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
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
							<select name="bagian" id="select-bagian"  class="caribagian form-control kt-select2" style="width: 100% !important;">
								<option value="">-Pilih-</option>
									@foreach($data_bagian as $row)
								<option value="{{$row->kode}}" <?php if( '<input value="$row->kode">' == '<input id="bagian">' ) echo 'selected' ; ?>>{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Perintah Kerja</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value="000" id="pk" name="pk" size="6" maxlength="6" autocomplete='off'>
						</div>
					</div>

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jenis Biaya</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div id="div-jb" class="col-8">
							<select name="jb" id="select-jb"  class="carijb form-control kt-select2" style="width: 100% !important;">
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
							<select name="cj" id="select-cj" class="caricj form-control kt-select2" style="width: 100% !important;">
								<option value="">-Pilih-</option>
									@foreach($data_cj as $row)
								<option value="{{$row->kode}}">{{$row->kode}} - {{$row->nama}}</option>
									@endforeach
							</select>
						</div>
					</div>
									

					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Jumlah</label>
						<label for="example-text-input" class=" col-form-label">:</label>
						<div class="col-8">
							<input  class="form-control" type="text" value=""  name="nilai" id="nilai" oninput="this.value = this.value.replace(/[^0-9\-]+/g, ',');" autocomplete='off'>
						</div>
					</div>
					<div class="kt-form__actions">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-10">
								<button type="reset"  class="btn btn-warning"  data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>Cancel</button>
								@foreach(DB::table('usermenu')->where('userid',Auth::user()->userid)->where('menuid',721)->limit(1)->get() as $data_akses)
								@if($data_akses->rubah == 1)
								<button type="submit" class="btn btn-brand"><i class="fa fa-check" aria-hidden="true"></i>Save</button>
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
				url: "{{ route('uang_muka_kerja.search.account') }}",
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
				url: "{{ route('uang_muka_kerja.search.bagian') }}",
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
				url: "{{ route('uang_muka_kerja.search.jb') }}",
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
				url: "{{ route('uang_muka_kerja.search.cj') }}",
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
		
    });
 
//update
$('#form-update-umk').submit(function(){
        var no_umk = $("#noumk").val();
		$.ajax({
			url  : "{{route('uang_muka_kerja.store')}}",
			type : "POST",
			data : $('#form-update-umk').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
			   Swal.fire({
					type  : 'success',
					title : 'Data Berhasil Disimpan',
					text  : 'Berhasil',
					timer : 2000
				}).then(function() {
                    window.location.replace("{{route('uang_muka_kerja.index')}}");
                });
			}, 
			error : function(){
				alert("Terjadi kesalahan, coba lagi nanti");
			}
		});	
		return false;
    });

	$('#btn-create-detail').on('click', function(e) {
		e.preventDefault();
		$('#title-detail').html("Tambah Detail Uang Muka Kerja");
		$('.modal-create-detail-umk').modal('show');
	});

    //create detail
    $('#form-tambah-umk-detail').submit(function(){
		$.ajax({
			url  : "{{route('uang_muka_kerja.store.detail')}}",
			type : "POST",
			data : $('#form-tambah-umk-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                Swal.fire({
					type  : 'success',
					title : 'Data Detail UMK Berhasil Ditambah',
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
    $('#form-edit-tambah-umk-detail').submit(function(){
		$.ajax({
			url  : "{{route('uang_muka_kerja.store.detail')}}",
			type : "POST",
			data : $('#form-edit-tambah-umk-detail').serialize(),
			dataType : "JSON",
            headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
            },
			success : function(data){
                Swal.fire({
					type  : 'success',
					title : 'Data Detail UMK Berhasil Diubah',
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


//tampil edit detail
$('#btn-edit-detail').on('click', function(e) {
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
			url :"{{url('umum/uang_muka_kerja/edit_detail')}}"+ '/' +dataid+'/'+datano,
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
				$('#title-detail').html("Edit Detail Uang Muka Kerja");
				$('.modal-edit-detail-umk').modal('show');
				$('#select-bagian').val(data.bagian).trigger('change');
				$('#select-acc').val(data.account).trigger('change');
				$('#select-jb').val(data.jb).trigger('change');
				$('#select-cj').val(data.cj).trigger('change');
			}
		})
	}
				
});
});



//delete
	$('#deleteRow').click(function(e) {
			e.preventDefault();
			$(".btn-radio:checked").each(function() {  
			var dataid = $(this).attr('data-id');
				if(dataid == 1)  
				{  
					swalAlertInit('hapus'); 
				}  else { 
				$("input[type=radio]:checked").each(function() {
					var id = $(this).attr('noumk');
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
							text: "No. UMK : " + id+" dan NO urut : "+no,
							type: 'warning',
							showCancelButton: true,
							reverseButtons: true,
							confirmButtonText: 'Ya, hapus',
							cancelButtonText: 'Batalkan'
						})
						.then((result) => {
						if (result.value) {
							$.ajax({
								url: "{{ route('uang_muka_kerja.delete.detail') }}",
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
										title : 'Hapus Data Detail UMK',
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


	// minimum setup
	$('#tgl_panjar').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'dd-mm-yyyy'
	});
	// minimum setup
	$('#bulan_buku').datepicker({
		todayHighlight: true,
		orientation: "bottom left",
		autoclose: true,
		// language : 'id',
		format   : 'yyyymm'
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
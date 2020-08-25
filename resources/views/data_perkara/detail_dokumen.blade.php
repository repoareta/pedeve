<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_jabatan">
	@foreach($data_list as $data)
		<tr >
			<td style="" align="center"><embed width="960" height="450" src="{{asset('data_perkara/'.$data->file)}}" type="application/pdf"></embed></td>
		</tr>
	@endforeach
</table>

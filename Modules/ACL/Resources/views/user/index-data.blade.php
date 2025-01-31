				<div class="table-responsive">
					<table class="table table-bordered table-striped table-vcenter">
						<tr>
							<th>{{ __('panel.no') }}</th>
							<th>{{ __('panel.username') }}</th>
							<th>{{ __('panel.name') }}</th>
							<th>{{ __('panel.email') }}</th>
							<th>{{ __('panel.verified') }}</th>
							<th>{{ __('panel.action') }}</th>
						</tr>
						<tbody>
							@if(isset($data) && !$data->isEmpty())
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ $data->firstItem() + $key }}</td>
								<td>{{$row->username}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->email}}</td>
								<td>
									@if($row->verified=='1')
									<a class="btn btn-sm btn-success">{{__('button.yes')}}</a>
									@else
									<a class="btn btn-sm btn-danger">{{__('button.no')}}</a>
									@endif
								</td>
								<td style="text-align:center"><a onclick='show_modal("<?php echo url("user/".$row->id)."/edit"?>")' style='color:white' class='btn btn-sm btn-primary' data-toggle='click-ripple' data-original-title='Edit' title='{{__('button.edit')}}'><i class='fa fa-edit' aria-hidden='true'></i> {{__('button.edit')}}</a>
								<a onclick='hapus("<?php echo url("user/".$row->id)?>")' style='color:white' class='btn btn-sm btn-danger' data-toggle='click-ripple' data-original-title='Remove' title='{{__('button.delete')}}'><i class='fa fa-trash-o' aria-hidden='true'></i> {{__('button.delete')}}</a>
								<a onclick='reset_password("<?php echo url("user/".$row->id)."/reset"?>")' style='color:white' class='btn btn-sm btn-warning' data-toggle='click-ripple' data-original-title='Reset Password' title='{{__('button.reset')}}'><i class='fa fa-refresh' aria-hidden='true'></i> {{__('button.reset')}}</a>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="5" style="text-align: center">Data Kosong</td>
							</tr>
							@endif
						</tbody>
					</table>
					<?php
// config
$link_limit = 8; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($data->lastPage() > 1)
<nav aria-label="Page navigation">
	<ul class="pagination pagination-sm">
		<li class="page-item {{ ($data->currentPage() == 1) ? ' disabled' : '' }}">
			<a class="page-link" href="{{ $data->url(1) }}">First</a>
		</li>
		@for ($i = 1; $i <= $data->lastPage(); $i++)
		<?php
		$half_total_links = floor($link_limit / 2);
		$from = $data->currentPage() - $half_total_links;
		$to = $data->currentPage() + $half_total_links;
		if ($data->currentPage() < $half_total_links) {
			$to += $half_total_links - $data->currentPage();
		}
		if ($data->lastPage() - $data->currentPage() < $half_total_links) {
			$from -= $half_total_links - ($data->lastPage() - $data->currentPage()) - 1;
		}
		?>
		@if ($from < $i && $i < $to)
		<li class="page-item {{ ($data->currentPage() == $i) ? ' active' : '' }}">
			<a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
		</li>
		@endif
		@endfor
		<li class="page-item {{ ($data->currentPage() == $data->lastPage()) ? ' disabled' : '' }}">
			<a class="page-link" href="{{ $data->url($data->lastPage()) }}">Last</a>
		</li>
	</ul>
</nav>
@endif
</div>
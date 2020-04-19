				<div class="table-responsive">
					<table class="table table-bordered table-striped table-vcenter">
						<tr>
							<th>{{ __('panel.no') }}</th>
							<th>{{ __('panel.name') }}</th>
							<th>{{ __('panel.display_name') }}</th>
							<th>{{ __('panel.description') }}</th>
							<th>{{ __('panel.action') }}</th>
						</tr>
						<tbody>
							@if(isset($data) && !$data->isEmpty())
							@foreach($data as $key=>$row)
							<tr>
								<td>{{ $data->firstItem() + $key }}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->display_name}}</td>
								<td>{{$row->description}}</td>
								<td style="text-align:center">
									<a href='{{url("role/get/".$row->id."/")."/menu"}}' class='btn btn-sm btn-primary' >{{__('button.edit')}}</a>
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
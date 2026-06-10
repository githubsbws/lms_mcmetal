@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Learn;
use App\Models\Score;
use App\Models\Company;
@endphp
<style>
	.dataTables_wrapper {
    width: 100%;
    overflow-x: auto;
}
</style>
<body class="">
	<div id="wrapper">
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="d-flex align-items-center">
						<div class="">
							<h4 class="m-0">ระบบReport</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('admin')}}">
								<button class="btn btn-warning d-flex align-items-center">
									<i class="fas fa-angle-left mr-2"></i>
									หน้าหลัก
								</button>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card m-0">
						<div class="card-body">
							<h4 class="m-0">{{ $course->course->course_title }}</h4>
							<table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
								<thead>
									<tr>
										<th>Username</th>
										<th>Name</th>
										<th>Organization Name</th>
										<th colspan="{{ count($lesson)}}" style="text-align: center;">Lesson</th>
										<th>Pass</th>
										<th>Last Score</th>
									</tr>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										@foreach($lesson as $ls)
										<th>{{ $ls->id}}</th>
										@endforeach
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody id="sortable">
									@foreach ($user as $us)
										@php
										$com = Company::find($us->company_id);
										$score_pre = Score::where('user_id',$us->id)->where('course_id',$id)->where('type','pre')->first();
										$score_post = Score::where('user_id',$us->id)->where('course_id',$id)->where('type','post')->first();
										$score = Score::where('user_id',$us->id)->where('course_id',$id)->latest('score_id')->first();
										@endphp
									<tr>
										@if($us != null)
											<td>{{ $us->username }}</td>
											@else
											<td> - </td>
											@endif
											@if($us != null)
											<td>{{ $us->firstname }} {{ $us->lastname }}</td>
											@else
											<td> - </td>
											@endif
											@if($com != null)
											<td>
												{{ $com->company_title }}
											</td>
											@else
											<td> - </td>
											@endif
											@foreach($lesson as $l)
												@php
												$learn = Learn::where('lesson_id',$l->id)->where('user_id',$us->id)->first();
												@endphp
												@if($learn != null)
												<td>{{ $learn->learn_date}}</td>
												@else
												<td></td>
												@endif
											@endforeach
											@if($score_pre != null)
											<td>{{ $score_pre->score_past === 'n' ? '' : 'pass'}}</td>
											@elseif($score_post != null)
											<td>{{ $score_post->score_past === 'n' ? '' : 'pass'}}</td>
											@else
											<td></td>
											@endif
											<td>
												{{ $score->score_number ?? ''}}
											</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="card-footer">
								<a class="btn btn-primary"   href="{{ route('export.users', $id) }}"><i></i> Export Excel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="sidebar">
			</div><!-- sidebar -->
		</div>
	</div>
	<div class="clearfix">
<script>
	$(document).ready(function() {
		// Initialize DataTable
		$('#settingTable').DataTable({
			responsive: true,
			scrollX: true,
			paging: true,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
</script>
</body>
@endsection

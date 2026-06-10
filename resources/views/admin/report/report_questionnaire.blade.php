@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Learn;
use App\Models\Lesson;
use App\Models\Course;
@endphp
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
				<div class="col-3 mt-0 ms-3">
					<a href="#" id="export-excel-btn" class="btn btn-success">
						Export Excel
					</a>
				</div>
				<div class="section-body">
					@foreach($survey as $sur)
						<div class="card m-3">
							<div class="card-body">
								<h3 class="title-table">{{ $sur->surbey_name }}</h3>

								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>หัวข้อ</th>
											<th>คำถาม</th>
											<th>ตัวเลือก</th>
											<th>คะแนน</th>
										</tr>
									</thead>
									<tbody>
										@foreach($sur->sections as $section)
											@foreach($section->questions as $question)
												@foreach($question->choices as $choice)
													@foreach($choice->answers as $answer)
														@if($answer->answer_numeric !== null)
															<tr>
																<td>{{ $section->section_title }}</td>
																<td>{{ $question->question_name }}</td>
																<td>{{ $choice->option_choice_name }}</td>
																<td>{{ $answer->answer_numeric }}</td>
															</tr>
														@endif
													@endforeach
												@endforeach
											@endforeach
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					@endforeach

					{{-- Pagination --}}
					<div class="d-flex justify-content-center">
						{!! $survey->links('pagination::bootstrap-5') !!}
					</div>
				</div>
			</div>
			<div id="sidebar">
			</div><!-- sidebar -->
		</div>
	</div>
	<div class="clearfix"></div>
<script>
	$(document).ready(function() {
		// Initialize DataTable
		$('#settingTable').DataTable({
			responsive: true,
			scrollX: true,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
</script>
</body>
@endsection

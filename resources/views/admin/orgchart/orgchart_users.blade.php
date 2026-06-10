
<script src="{{ asset('js/app.js') }}"></script>

@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Orgchart;
@endphp
<body>
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">จัดการผู้ใช้</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('admin')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
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
                            <form action="{{ route('orgchart.unuser',['org_id' => $org_id]) }}" method="POST">
                                @csrf
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all_remove"></th>
                                        <th>ชื่อผู้ใช้</th>
										<th>หลักสูตรเรียน</th>
                                        <th>Company</th>
                                        <th>ASC</th>
                                        <th>Position</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach ($user_chart as $index => $item)
                                    <tr>
                                        <td><input class="select-on-check" value="{{$item->user_id}}" id="chk_{{ $index }}" type="checkbox"  name="remove_users[]"></td>
                                        <td>
											{{$item->user->username ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->orgchart->title ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->user->company->company_title ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->user->asc->name ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->user->position->position_title ?? '-'}}
                                        </td>
                                        <td>
                                            <a href="{{route('orgchart.unactive',['id' => $item->user_id,'org_id' => $item->orgchart_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                <button class="btn btn-primary btn-icon glyphicons ok_2" type="submit"><i></i>ลบผู้ใช้ที่เลือก</button>
                            </form>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('orgchart.adduser',['org_id' => $org_id]) }}" method="POST">
                                @csrf
                            <table id="settingTable2" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>ชื่อผู้ใช้</th>
										<th>หลักสูตรเรียน</th>
                                        <th>Company</th>
                                        <th>ASC</th>
                                        <th>Position</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach ($user as $item)
                                        @php
                                        $org_chart = Orgchart::where('id',$item->department_id)->first();
                                        @endphp
                                    <tr>
                                        <td><input class="select-on-check" value="{{$item->id}}" id="chk_0" type="checkbox"  name="add_users[]"></td>
                                        <td>
											{{$item->username ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $org_chart->title ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->company->company_title ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->asc->name ?? '-'}}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->position->position_title ?? '-'}}
                                        </td>
                                        <td>
                                            <a href="{{ route('orgchart.active',['id' => $item->id,'org_id' => $org_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                <button class="btn btn-primary btn-icon glyphicons ok_2" type="submit"><i></i>เพิ่มผู้ใช้ที่เลือก</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

    $(document).ready(function() {
		// Initialize DataTable
		$('#settingTable2').DataTable({
			responsive: true,
			scrollX: true,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
     document.getElementById('select_all_remove').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('#settingTable .select-on-check');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    document.getElementById('select_all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('#settingTable2 .select-on-check');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
</body>
@endsection


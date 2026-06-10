@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">

	<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">

		<!-- Top navbar -->
		@include('admin.layouts.partials.top-nav')
		<!-- Top navbar END -->


		<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">

			<!-- Sidebar Menu -->
			@include('admin.layouts.partials.menu-left')
			<!-- // Sidebar Menu END -->


			<!-- Content -->
			<!-- <div class="span-19"> -->
			<div id="content">
				<ul class="breadcrumb">
					<li><a href="{{route('admin')}}">หน้าหลัก</a></li> » <li><a href="/admin/index.php/grouptesting/index">ระบบชุดข้อสอบบทเรียนออนไลน์</a></li> » <li>เพิ่มชุดข้อสอบอบรมออนไลน์</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>
				
				<script>
					tinymce.init({
						selector: ".tinymce",
						theme: "modern",
						width: 680,
						height: 300,
						plugins: [
							"advlist autolink link image lists charmap print preview hr anchor pagebreak",
							"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
							"table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
						],
						toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
						toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
						image_advtab: true,
				
						external_filemanager_path: "{{asset('filemanager_f')}}",
						filemanager_title: "Responsive Filemanager",
						external_plugins: {
							"filemanager": "{{asset('filemanager_f/plugin.min.js')}}"
						}
					});
				</script>

			<!-- JavaScript สำหรับการเพิ่ม textarea หรือ checkbox -->
			<script type="text/javascript">
				$(function() {
					var scntDiv = $('#rowUp');
					var Int = 0; 
					var IntNum = 1; 
					var i = $('#p_scents p').size() + 1;
					Int = Int+1;
					IntNum = IntNum+1;
					$('#addScnt').live('click', function() { 
						var questionBox = $('#countQuestionBox').val();
						var quesBox = parseInt(questionBox)+1;
						var title = '<p><div class="progress progress-inverse progress-mini"><div class="bar" style="width: 100%;"></div></div></p><div class="row"><label for="Question_ques_title" class="required">โจทย์ข้อสอบ <span class="required">*</span></label></div><div class="row"> <textarea class="span8 tinymce" name="Question[ques_title]['+Int+']" id="Question_ques_title_'+Int+'" rows="3" style="width:500px;" maxlength="255"></textarea><input type="hidden" name="QuestionType['+Int+']" id="QuestionType_'+Int+'" value="2"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> <div class="row"><div class="span4"><div id="ErrorChoice'+Int+'"></div></div></div><div class="row"><div class="span4"><label for="Question_ques_title_'+Int+'" class="error errorMessage"><span class="label label-important">กรุณากรอกโจทย์ข้อนี้</span></label></div></div>';
						var btnAns = '<div class="row"><p><a class="btn btn-icon btn-success" onclick="addChoiceUp('+Int+');"><i class="icon-book"></i> เพิ่มคำตอบ</a> <a onclick="RemoveDiv('+i+',1);" class="btn btn-icon btn-inverse circle_ok" id="remScnt"><i class="icon-remove"></i> Remove</a></div></p><input id="countBox'+Int+'" name="countBox['+Int+']" type="hidden" value="4"> </div>'
						var type0 = '<input name="Choice[choice_type]['+Int+'][0]" id="choice_type'+Int+'0" type="hidden" value="radio">';
						var type1 = '<input name="Choice[choice_type]['+Int+'][1]" id="choice_type'+Int+'1" type="hidden" value="radio">';
						var exam = '<div class="row"><label for="Choice_choice_detail" class="required">คำตอบช้อยส์ <span class="required">*</span></label> <input name="Choice[choice_answer]['+Int+'][0]" onclick="ReSetClick('+Int+',0);" type="radio" value="1"> <input class="required span7" name="Choice[choice_detail]['+Int+'][0]" id="Choice_choice_detail_'+Int+'_0" type="text" maxlength="255">'+type0+' <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span></div><div class="row"><div class="span4"><label for="Choice_choice_detail_'+Int+'_0" class="error errorMessage"><span class="label label-important">กรุณากรอกคำตอบช้อยส์นี้</span></label></div></div>';
						exam+= '<div class="row"><input name="Choice[choice_answer]['+Int+'][1]" onclick="ReSetClick('+Int+',1);" type="radio" value="1"> <input class="required span7" name="Choice[choice_detail]['+Int+'][1]" id="Choice_choice_detail_'+Int+'_1" type="text" maxlength="255"> '+type1+' <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span></div><div class="row"><div class="span4"><label for="Choice_choice_detail_'+Int+'_1" class="error errorMessage"><span class="label label-important">กรุณากรอกคำตอบช้อยส์นี้</span></label></div></div>';
						var rowUpChoiceCheck = '<div id="rowUpChoice'+Int+'"></div>';
						var rowUp = $('<div id="d_'+i+'"> '+title+' '+ btnAns +' '+exam+' '+rowUpChoiceCheck+' </div>');
						$("#rowUp").append(rowUp);
						$('#countQuestion').val(i);
						$('#countQuestionBox').val(quesBox);
						$('#CountNumAll').html(quesBox);
						i++;
						Int++;
						IntNum++;
						initTiny();
						return false;
					}); 
				
					$('#addScntMulti').live('click', function() { 
						var questionBox = $('#countQuestionBox').val();
						var quesBox = parseInt(questionBox)+1;
						var title = '<p><div class="progress progress-inverse progress-mini"><div class="bar" style="width: 100%;"></div></div></p><div class="row"><label for="Question_ques_title" class="required">โจทย์ข้อสอบ <span class="required">*</span></label></div><div class="row"> <textarea class="required" name="Question[ques_title]['+Int+']" id="Question_ques_title_'+Int+'" rows="3" style="width:500px;" maxlength="255"></textarea> <input type="hidden" name="QuestionType['+Int+']" id="QuestionType_'+Int+'" value="1"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> <div class="row"><div class="span4"><div id="ErrorChoice'+Int+'"></div></div></div><div class="row"><div class="span4"><label for="Question_ques_title_'+Int+'" class="error errorMessage"><span class="label label-important">กรุณากรอกโจทย์ข้อนี้</span></label></div></div>';
						var btnAns = '<div class="row"><p><a class="btn btn-icon btn-success" onclick="addChoiceUpMulti('+Int+');"><i class="icon-book"></i> เพิ่มคำตอบ</a> <a onclick="RemoveDiv('+i+',1);" class="btn btn-icon btn-inverse circle_ok" id="remScnt"><i class="icon-remove"></i> Remove</a></div></p><input id="countBox'+Int+'" name="countBox['+Int+']" type="hidden" value="4"> </div>'
						var type0 = '<input name="Choice[choice_type]['+Int+'][0]" id="choice_type'+Int+'0" type="hidden" value="checkbox">';
						var type1 = '<input name="Choice[choice_type]['+Int+'][1]" id="choice_type'+Int+'1" type="hidden" value="checkbox">';
						var exam = '<div class="row"><label for="Choice_choice_detail" class="required">คำตอบช้อยส์ <span class="required">*</span></label> <input name="Choice[choice_answer]['+Int+'][0]" type="checkbox" value="1"> <input class="required span7" name="Choice[choice_detail]['+Int+'][0]" id="Choice_choice_detail_'+Int+'_0" type="text" maxlength="255">'+type0+' <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span></div><div class="row"><div class="span4"><label for="Choice_choice_detail_'+Int+'_0" class="error errorMessage"><span class="label label-important">กรุณากรอกคำตอบช้อยส์นี้</span></label></div></div>';
						exam+= '<div class="row"><input name="Choice[choice_answer]['+Int+'][1]" type="checkbox" value="1"> <input class="required span7" name="Choice[choice_detail]['+Int+'][1]" id="Choice_choice_detail_'+Int+'_1" type="text" maxlength="255">'+type1+' <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span></div><div class="row"><div class="span4"><label for="Choice_choice_detail_'+Int+'_1" class="error errorMessage"><span class="label label-important">กรุณากรอกคำตอบช้อยส์นี้</span></label></div></div>';
						var rowUpChoiceCheck = '<div id="rowUpChoice'+Int+'"></div>';
						var rowUp = $('<div id="d_'+i+'"> '+title+' '+ btnAns +' '+exam+' '+rowUpChoiceCheck+' </div>');
						$("#rowUp").append(rowUp);
						$('#countQuestion').val(i);
						$('#countQuestionBox').val(quesBox);
						$('#CountNumAll').html(quesBox);
						i++;
						Int++;
						IntNum++;
						initTiny();
						return false;
					}); 
				
					$('#addScntText').live('click', function() { 
						var questionBox = $('#countQuestionBox').val();
						var quesBox = parseInt(questionBox)+1;
						var title = '<p><div class="progress progress-inverse progress-mini"><div class="bar" style="width: 100%;"></div></div></p><div class="row"><label for="Question_ques_title" class="required">โจทย์ข้อสอบ <span class="required">*</span></label></div><div class="row"> <textarea class="span8 tinymce" name="Question[ques_title]['+Int+']" id="Question_ques_title_'+Int+'" rows="3" style="width:500px;" maxlength="255"></textarea><input type="hidden" name="QuestionType['+Int+']" id="QuestionType_'+Int+'" value="3"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> <div class="row"><div class="span4"><div id="ErrorChoice'+Int+'"></div></div></div><div class="row"><div class="span4"><label for="Question_ques_title_'+Int+'" class="error errorMessage"><span class="label label-important">กรุณากรอกโจทย์ข้อนี้</span></label></div></div>';
						var btnAns = '<div class="row"><p><a onclick="RemoveDiv('+i+',1);" class="btn btn-icon btn-inverse circle_ok" id="remScnt"><i class="icon-remove"></i> Remove</a></div></p><input id="countBox'+Int+'" name="countBox['+Int+']" type="hidden" value="4"> </div>'
						var type0 = '<input name="Choice[choice_type]['+Int+'][0]" id="choice_type'+Int+'0" type="hidden" value="text">';
						var exam = '<div class="row"><label for="Choice_choice_detail" class="required">คำตอบบรรยาย <span class="required">*</span></label> <input name="Choice[choice_answer]['+Int+'][0]" type="radio" checked="checked" style="display:none;" value="1"> <input class="required span7" name="Choice[choice_detail]['+Int+'][0]" id="Choice_choice_detail_'+Int+'_0" type="hidden" maxlength="255" value="text">'+type0+' <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span></div><div class="row"><div class="span4"><label for="Choice_choice_detail_'+Int+'_0" class="error errorMessage"><span class="label label-important">กรุณากรอกคำตอบช้อยส์นี้</span></label></div></div>';
						var rowUpChoiceCheck = '<div id="rowUpChoice'+Int+'"></div>';
						var rowUp = $('<div id="d_'+i+'"> '+title+' '+ btnAns +' '+exam+' '+rowUpChoiceCheck+' </div>');
						$("#rowUp").append(rowUp);
						$('#countQuestion').val(i);
						$('#countQuestionBox').val(quesBox);
						$('#CountNumAll').html(quesBox);
						i++;
						Int++;
						IntNum++;
						initTiny();
						return false;
					}); 
				
				
				//	$("#Question").validate({
				//		submitHandler: function (form) {
				//			SubMitCheck();
				//		}
				//	});
				
					initTiny();
				
				});
				function SubMitCheck(){
					var count = $('#countQuestionBox').val();
					var countQ = $('#countQuestion').val();
					var countCheck = 0;
					for(i=0; i<=countQ; i++){
						$('#ErrorChoice'+i).hide();
						var countBox = $('#countBox'+i).val();
						if(countBox){
							var countInt = 0;
							for(z=0; z<countBox; z++){
								if($("[name='Choice[choice_answer]["+i+"]["+z+"]']:checked").is(':checked') == true){
									countInt = 1;
								}
							}
						   if(countInt != 0){
								   $('#ErrorChoice'+i).hide();
								   countCheck++;
						   }else{
								$('#Question_ques_title_'+i).focus();
								$('#ErrorChoice'+i).show().html('<div class="row"><div class="span4"><label><div class="error help-block"><span class="label label-important">กรุณาเลือก (ถูก) อย่างน้อย 1 ข้อ</span></div></label></div></div>');
						   }
						   if(countCheck == count){ Question.submit(); }
						}
					}
				}
				function RemoveDiv(id,num,CheckNum){
					var IntCheck;
					var CheckBox = $('#countQuestionBox').val();
					var DropSum = parseInt(CheckBox)-1;
					if(CheckNum == 1){ IntCheck = 0; }else{ IntCheck = ''; }
					if(num == '1'){ $('#d_'+id).remove(); $('#countQuestionBox').val(DropSum); $('#CountNumAll').html(DropSum); }
					if(num == '2'){ 
						var CheckOk = IntCheck+''+id;
						$('#choice_answer'+IntCheck+''+id).removeAttr('checked');
						$('#choice'+IntCheck+''+id).remove(); 
					}
				}
				var IntChoice = 1;
				var IntChoiceBox = 2;
				function addChoiceUp(num){	
					var CheckNum;
					var countBox = $('#countBox'+num).val();
					countBox = parseInt(countBox)+1;
					var countBoxCheck = parseInt(countBox)-1;
					var countRemove = num+''+countBoxCheck;
					if(num == 0){ CheckNum = '1'; }else{ CheckNum = '2'; }
					var checkbox = '<input name="Choice[choice_answer]['+num+']['+countBoxCheck+']" id="choice_answer'+num+''+countBoxCheck+'" onclick="ReSetClick('+num+','+countBoxCheck+');" type="radio" value="1">';
					var type = '<input name="Choice[choice_type]['+num+']['+countBoxCheck+']" id="choice_type'+num+''+countBoxCheck+'" type="hidden" value="radio">';
					var input = '<input class="required span7" name="Choice[choice_detail]['+num+']['+countBoxCheck+']" id="Choice_choice_detail_'+num+'_'+countBoxCheck+'" type="text"  maxlength="255"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>';
					var choice = '<div class="row"> '+checkbox+' '+input+' '+type+' <a onclick="RemoveDiv('+parseInt(countRemove)+',2,'+CheckNum+');" class="btn btn-icon btn-inverse circle_ok"><i class="icon-remove"></i> Remove</a></div> <div class="row"><div class="span4"><label for="Choice_choice_detail_'+num+'_'+countBoxCheck+'" class="error errorMessage"><span class="label label-important">กรุณากรอกคำตอบช้อยส์นี้</span></label></div></div>';
					var rowUpChoice = $('<div id="choice'+num+''+countBoxCheck+'"> '+choice+' </div>');
					$("#rowUpChoice"+num).append(rowUpChoice);
					IntChoice++;
					IntChoiceBox++;
					$('#countBox'+num).val(countBox);
					initTiny();
				}
				function addChoiceUpMulti(num){	
					var CheckNum;
					var countBox = $('#countBox'+num).val();
					countBox = parseInt(countBox)+1;
					var countBoxCheck = parseInt(countBox)-1;
					var countRemove = num+''+countBoxCheck;
					if(num == 0){ CheckNum = '1'; }else{ CheckNum = '2'; }
					var checkbox = '<input name="Choice[choice_answer]['+num+']['+countBoxCheck+']" id="choice_answer'+num+''+countBoxCheck+'" type="checkbox" value="1">';
					var type = '<input name="Choice[choice_type]['+num+']['+countBoxCheck+']" id="choice_type'+num+''+countBoxCheck+'" type="hidden" value="checkbox">';
					var input = '<input class="required span7" name="Choice[choice_detail]['+num+']['+countBoxCheck+']" id="Choice_choice_detail_'+num+'_'+countBoxCheck+'" type="text"  maxlength="255"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>';
					var choice = '<div class="row"> '+checkbox+' '+input+' '+type+' <a onclick="RemoveDiv('+parseInt(countRemove)+',2,'+CheckNum+');" class="btn btn-icon btn-inverse circle_ok"><i class="icon-remove"></i> Remove</a></div> <div class="row"><div class="span4"><label for="Choice_choice_detail_'+num+'_'+countBoxCheck+'" class="error errorMessage"><span class="label label-important">กรุณากรอกคำตอบช้อยส์นี้</span></label></div></div>';
					var rowUpChoice = $('<div id="choice'+num+''+countBoxCheck+'"> '+choice+' </div>');
					$("#rowUpChoice"+num).append(rowUpChoice);
					IntChoice++;
					IntChoiceBox++;
					$('#countBox'+num).val(countBox);
					initTiny();
				}
				function ReSetClick(num,id)
				{
					var countBox = $('#countBox'+num).val();
					if(countBox){
						for(z=0; z<countBox; z++){
							$("[name='Choice[choice_answer]["+num+"]["+z+"]']").attr("checked",false);
						}
					}
					$("[name='Choice[choice_answer]["+num+"]["+id+"]']").attr("checked",true);
				}
				</script>
				<style type="text/css">
				.block { display: block; }
				label.error { display: none; }
				</style>
				<!-- innerLR -->
				<div class="innerLR">
					<div class="widget widget-tabs border-bottom-none">
						<div class="widget-head">
							<ul>
								<li class="active">
									<a class="glyphicons edit" href="#account-details" data-toggle="tab">
										<i></i>เพิ่มชุดข้อสอบออนไลน์ </a>
								</li>
							</ul>
						</div>
						<div class="widget-body">
							<p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>
							<!-- FORM -->
							<div class="form">
								<form method="POST" action="{{ route('group_question.create',['id' => $id]) }}" id="Question" name="Question" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<input type="hidden" name="countQuestion" id="countQuestion" value="1">
										<input type="hidden" name="countQuestionBox" id="countQuestionBox" value="0">
									</div>
									<div class="row">
										<div class="pull-left">
											<a href="#" class="btn btn-icon btn-success" id="addScnt"><i class="icon-book"></i> เพิ่มข้อสอบคำตอบเดียว</a>
											<a href="#" class="btn btn-icon btn-success" id="addScntMulti"><i class="icon-book"></i> เพิ่มข้อสอบหลายคำตอบ</a>
											<a href="#" class="btn btn-icon btn-success" id="addScntText"><i class="icon-book"></i> เพิ่มข้อสอบบรรยาย</a>
										</div>
										<div class="pull-left" style="margin:4px 15px;">
											<h4>จำนวนข้อที่สร้าง <span id="CountNumAll">1</span> ข้อ</h4>
										</div>
									</div>
									<br>
									<div id="rowUp">
										<!-- เนื้อหาจะถูกเพิ่มโดย JavaScript ที่นี่ -->
									</div>
									<div class="row buttons">
										<button type="submit" class="btn btn-primary btn-icon glyphicons ok_2" onclick="tinyMCE.triggerSave();"><i></i>บันทึกข้อมูล</button>
									</div>
								</form>
							</div>
							<!-- END form -->
						</div>
						{{-- <div class="widget-body">
							<div class="form">
								<form enctype="multipart/form-data" id="news-form" action="{{route('group_question.create')}}" method="post">
									@csrf
									<p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>
									<div class="row">
										<label for="Grouptesting_lesson_id" class="required">ชื่อบทเรียนออนไลน์ <span class="required">*</span></label> <select class="span8" name="group_id" id="Grouptesting_lesson_id">
											@foreach ($grouptesting as $item)
											<option value="{{ $item->group_id}}">{{$item->group_title}}</option>
											@endforeach
										</select> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
										<div class="error help-block">
											<div class="label label-important" id="Grouptesting_lesson_id_em_" style="display:none"></div>
										</div>
									</div>

									<div class="row">
										<div class="pull-left">
											<a class="btn btn-icon btn-success" id="addScnt" ><i class="icon-book"></i> เพิ่มข้อสอบคำตอบเดียว</a>
											<a class="btn btn-icon btn-success" id="addScntMulti" ><i class="icon-book"></i> เพิ่มข้อสอบหลายคำตอบ</a>
											<a class="btn btn-icon btn-success" id="addScntText" ><i class="icon-book"></i> เพิ่มข้อสอบบรรยาย</a>
										
										</div>
										<div class="pull-left" style="margin:4px 15px;">
											<h4>จำนวนข้อที่สร้าง <span id="CountNumAll">1</span> ข้อ</h4>
										</div>
									</div>
									<div class="row">
										<label for="Grouptesting_group_title" class="required">หัวข้อ <span class="required">*</span></label> 
										<textarea rows="6" cols="50" class="span8 tinymce" name="ques_title" id="ques_title" aria-hidden="true" ></textarea>
										<div class="error help-block">
											<div class="label label-important" id="Grouptesting_group_title_em_" style="display:none"></div>
										</div>
									</div>
									<div class="row">
										<label for="Grouptesting_group_title" class="required">รายละเอียดย่อ <span class="required">*</span></label> 
										<textarea rows="6" cols="50" class="span8 tinymce" name="ques_explain" id="ques_explain" aria-hidden="true" ></textarea>
										<div class="error help-block">
											<div class="label label-important" id="Grouptesting_group_title_em_" style="display:none"></div>
										</div>
									</div>
									<div class="row buttons">
										<button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
									</div>
								</form>
							</div><!-- form -->
						</div> --}}
					</div>
				</div>
				<!-- END innerLR -->
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
			<!-- </div> -->
			<!-- <div class="span-5 last"> -->
			<!-- </div> -->
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->

		<div id="footer" class="hidden-print">

			<!--  Copyright Line -->
			<div class="copy">© 2023 - All Rights Reserved.</a></div>
			<!--  End Copyright Line -->

		</div>
		<!-- // Footer END -->

	</div>
	<script>
		// เพิ่ม textarea ใหม่
		function addTextarea() {
			var container = document.getElementById("textareaContainer");
			var newTextarea = document.createElement("textarea");
			newTextarea.rows = "4";
			newTextarea.cols = "50";
			newTextarea.className = "span8 tinymce"; 
			container.appendChild(newTextarea);

			// เพิ่มปุ่มลบ
			var deleteButton = document.createElement("button");
			deleteButton.textContent = "ลบ";
			deleteButton.onclick = function() {
				container.removeChild(newTextarea);
				container.removeChild(deleteButton);
			};
			
			container.appendChild(newTextarea);
			container.appendChild(deleteButton);
		}
		function addCheckbox() {
			var container = document.getElementById("inputContainer1");
			var newCheckbox = document.createElement("input");
			newCheckbox.type = "checkbox";
			newCheckbox.className = "dynamic-input";

			var textInput = document.createElement("input");
			textInput.type = "text";
			textInput.placeholder = "กรุณาใส่ข้อความ";
			
			// เพิ่มปุ่มลบ
			var deleteButton = document.createElement("button");
			deleteButton.textContent = "ลบ";
			deleteButton.onclick = function() {
				container.removeChild(newCheckbox);
				container.removeChild(textInput);
				container.removeChild(deleteButton);
			};
			
			container.appendChild(newCheckbox);
			container.appendChild(textInput);
			container.appendChild(deleteButton);
		}
		function addRadio() {
			var container = document.getElementById("inputContainer2");
			var newRadio = document.createElement("input");
			newRadio.type = "radio";
			newRadio.name = "dynamicRadio";
			newRadio.className = "dynamic-input";
			
			// เพิ่มปุ่มลบ
			var deleteButton = document.createElement("button");
			deleteButton.textContent = "ลบ";
			deleteButton.onclick = function() {
				container.removeChild(newRadio);
				container.removeChild(deleteButton);
			};
			
			container.appendChild(newRadio);
			container.appendChild(deleteButton);
		}
		</script>
</body>
@endsection
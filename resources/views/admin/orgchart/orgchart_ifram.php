<?php
use App\Models\Orgchart;
?>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/Adminkit/orgchart/css/bootstrap.min.css" />
<link rel="stylesheet" href="/Adminkit/orgchart/css/jquery.jOrgChart.css" />
<link rel="stylesheet" href="/Adminkit/orgchart/css/custom.css" />
<link href="/Adminkit/orgchart/css/prettify.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="/Adminkit/orgchart/fancybox/jquery.fancybox.css" type="text/css" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<!-- jQuery includes -->
<!--  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<!--  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->
<script type="text/javascript" src="/Adminkit/orgchart/js/prettify.js"></script>
<script type="text/javascript" src="/Adminkit/orgchart/fancybox/jquery.fancybox.js"></script>
<script src="/Adminkit/orgchart/js/jquery.jOrgChart.js"></script>
<script type="text/javascript" src="/Adminkit/orgchart/js/taffy.js"></script>
<style type="text/css">
	html, body {
    width: 100%;
    height: 100%;
    overflow: auto;
    margin: 0;
    padding: 0;
}

#chart-container {
    white-space: nowrap; /* ป้องกันตัดบรรทัด */
}
#getjson {
  width: 100px;
  height: 50px;
  border-radius: 3px;
  margin-left: 20px;
  margin-top: 20px;
}

/*
#chart{
  height: 300px;
  overflow: scroll;
  width: 500px;
  resize:both;
overflow:auto;
}
*/
.opciones span{
  cursor: pointer;
}
ul#upload-chart {
  float: right;
  list-style: none outside none;
}

ul#upload-chart li {
  background: none repeat scroll 0 0 #ECDC20;
  border: 1px solid #808080;
  border-radius: 2px;
  height: 44px;
  margin-top: 2px;
  padding-top: 5px;
  width: 200px;
}
</style>
<script>
function init_tree() {
  var opts = {
	chartElement : '#chart',
	  dragAndDrop  : false,
	  expand       : true,
	  control		 : true,
	  rowcolor     : false
  };
  $("#chart").html("");
  $("#org").jOrgChart(opts);
  cutomdata();
}

function scroll() {
  $(".node").click(function() {
	$("#chart").scrollTop(0)
	$("#chart").scrollTop($(this).offset().top - 140);
  })
}

var click_flag = true;
var node_to_edit;
// read json and convert to html formate
function loadjson() {
  var items = [];
  var data = TAFFY([

<?php
 $categories= Orgchart::where('active','y')->get();
if($categories){
  foreach($categories as $n=>$category)
  {
		if($category->parent_id==""){
		  $parent_null = '""';
		}else{
		  $parent_null = $category->parent_id;
		}

	?>
		{

		"id": <?=$category->id?>,
		"name": "<?=$category->title?>",
		"parent": <?=$parent_null?>,
		"level": <?=$category->level?>
		},

<?php
	}
  }
?>
  ]);

  data({
	"parent": ""
  }).each(function(record, recordnumber) {
	loops(record);
  });
  //start loop the json and form the html
  function loops(root) {
	  if (root.level == 1) {
		items.push("<li class='btn_add unic" + root.id + " root' id='" + root.id + "' data-parent='" + root.parent + "' data-department='"+ root.department +"'><span class='label_node'><a href='#'>" + root.name + "</a></br></span>");
	  }
	  // if (root.level == 2) {
	  //   items.push("<li class='btn_add unic" + root.id + "' id='" + root.id + "' data-parent='" + root.parent + "' data-department='"+ root.department +"'><span class='label_node'><a href='#'>" + root.name + "</a></br></span>");
	  // }
	  else {
		var id = root.id;
		var url = "/orgchart_control/" + id;
		items.push("<li class='child unic" + root.id + "' id='" + root.id + "' data-parent='" + root.parent + "' data-department='"+ root.department +"'><span class='label_node'><a href='" + url + "' class='move_down' target='_blank'>" + root.name + "</a></br></span>");
	  }
	  var c = data({
		"parent": root.id
	  }).count();
	  if (c != 0) {
		items.push("<ul>");
		data({
		  "parent": root.id
		}).each(function(record, recordnumber) {
		  loops(record);
		});
		items.push("</ul></li>");
	  } else {
		items.push("</li>");
	  }
	} // End the generate html code

  //push to html code
  $("<ul/>", {
	"id": "org",
	"style": "float:right;",
	html: items.join("")
  }).appendTo("body");
}
</script>

<body onload="prettyPrint();">
<!-- <button id="getjson" onclick="makeArrays()">Save</button> -->
<div id="in" style="display:none">
</div>

<ul id="upload-chart"></ul>

<div id="chart" class="orgChart"></div>
<!-- Add Node box -->
<div id="fancy" class="hidden">
  <form action="." method="post" id="add_node_form">
	<h1 class="title_lb">New Node</h1>
	<div class="span12" id="add_nodo">
	  <p class="notice span3">
		Enter node caption
	  </p>
	  <input type="text" name="node_name" id="new_node_name" class="span6" />
	  <div class="span12">
		<button id="add_node" class="aqua_btn span3">Add</button>
	  </div>
	</div>
  </form>
</div>
<!-- Edit node box -->
<div id="fancy_edit" class="hidden">
  <form action="." method="post" id="edit_node_form">
	<h1 class="title_lb">Edit Node</h1>
	<div class="span12" id="edit_nodo">
	  <p class="notice span3">
		Enter node caption
	  </p>
	  <input type="text" name="node_name" id="edit_node_name" class="span6" />
	  <div class="span12">
		<button id="edit_node" class="aqua_btn span3">Edit</button>
	  </div>
	</div>
  </form>
</div>


<script type="text/javascript">
function remChild(removing) {
  $("#upload-chart").append(removing);
  $("#upload-chart ul li").each(function() {
	var Orgli = $(this).removeAttr("class").addClass("node").addClass("child").clone();
	$(this).remove();
	$("#upload-chart").append(Orgli);
  });
  $("#upload-chart ul").remove();
  var sideLi = $("#upload-chart").html();
  $("#upload-chart").empty();
  $("#upload-chart").append(sideLi);
}

function makeArrays() {
    var level = [];

    $("#org li").each(function() {
        var uid = $(this).attr("id");
        var des = $(this).attr("data-department");
        var name = $(this).find(">:first-child a").text();
        var pid = $(this).attr("data-parent");
        var hidSTR = "";
        var hid = $(this).parents("li");
        if (hid.length == 0) {
            hidSTR = uid;
            var arry = hidSTR.split(",");
            var user = {
                id: uid,
                description: des,
                key: name,
                parent_id: pid,
                level: arry.length
            };
            level.push(user);
        } else {
            for (var i = hid.length - 1; i >= 0; i--) {
                if (i != hid.length) {
                    hidSTR = hidSTR + hid[i].id + ',';
                } else {
                    hidSTR = hidSTR + hid[i].id + ',';
                }
            }
            var arry = hidSTR.split(",");
            var user = {
                id: uid,
                description: des,
                key: name,
                parent_id: pid,
                level: arry.length
            };
            level.push(user);
        }
    });

    console.log(level);
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var datas = $.ajax({
        type: "POST",
        url: "/orgchart_saveorgchart",
        data: {
            "_token": csrfToken, // ต้องใส่ token CSRF เพื่อป้องกันการโจมตี CSRF
            post_value: level
        },
        success: function(data) {
            alert("SAVE");
            location.reload();
        },
    });
	
}

function cutomdata() {
  var add_to_node = "",
	del_node = "",
	classList = "";
  var regx = /\w*(row)/;

  $(".edit").off("click").on("click", function(e) {
	classList = $(this).parent().parent().attr('class').split(/\s+/);
	var tipo_n;
	$.each(classList, function(index, item) {
	  if (item != "temp" && item != "node" && item != "child" && item != "ui-draggable" && item != "ui-droppable" && !regx.test(item)) {
		del_node = item;
		var match = item.match(/^unic(\d+)$/); // ใช้ regex เพื่อหาตัวเลขหลังคำว่า "unic"
		if (match) {
			edit_node = match[1]; // เก็บตัวเลขที่ได้ลงในตัวแปร del_node
		}	
		// console.log(del_node);
	  }
	  if (item == "root" || item == "child") {
		tipo_n = item;
		// console.log(tipo_n);
	  }
	});
	node_to_edit = $("li." + del_node + ":not('.temp')");
	$("#edit_node").off("click").on("click", function(e) {
	  e.preventDefault();
	  //modify li and refresh tree
	  var edit_field = $("#edit_node_name");
	  var edit_title = $("#edit_node_title");
	  var texto = edit_field.val();
	  var texti = edit_title.val();
	  node_to_edit.find("> .label_node:eq(0) > a").text(texto);
	  node_to_edit.find("> .label_node:eq(0) > i").text(texti);
	  edit_field.val("");
	  edit_title.val("");
	  var formData = new FormData();
			formData.append("_token", $('meta[name="csrf-token"]').attr('content')); // CSRF token
			formData.append("post_edit", edit_node); // ข้อมูล post_value
			formData.append("text", texto);

	  var dsa = $.ajax({
			type: "POST",
			url: "/orgchart_edit",
			data: formData,
			contentType: false,
			processData: false,
			success: function(data) {
				alert("SAVE");
				location.reload();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.error("Error:", textStatus, errorThrown);
				alert("An error occurred while saving the data.");
			}
		});
		
	  $.fancybox.close();
	  init_tree();

	});
  }).fancybox({
	maxWidth: 800,
	maxHeight: 800,
	fitToView: false,
	width: '70%',
	height: '70%',
	autoSize: false,
	closeClick: false,
	openEffect: 'none',
	closeEffect: 'none'
  });


  //-- Listo editar :D

  $(".del").off("click").on("click", function(e) {
	if(confirm("Are you sure?")){
	var nodo = $(this);
	if (!nodo.parent().parent().hasClass("temp")) {
	  var nodeDiv = nodo.parent().parent();
	  var cu = nodeDiv.find("a").attr("rel");
	  classList = nodeDiv.attr('class').split(/\s+/);
	  $.each(classList, function(index, item) {
		if (item != "temp" && item != "node" && item != "child" && item != "ui-draggable" && item != "ui-droppable" && !regx.test(item)) {
		  del_node = item;
		  var match = item.match(/^unic(\d+)$/); // ใช้ regex เพื่อหาตัวเลขหลังคำว่า "unic"
					if (match) {
						del_node = match[1]; // เก็บตัวเลขที่ได้ลงในตัวแปร del_node
						// console.log(del_node); // แสดงผลลัพธ์ใน console

						var formData = new FormData();
							formData.append("_token", $('meta[name="csrf-token"]').attr('content')); // CSRF token
							formData.append("post_del", del_node); // ข้อมูล post_value

						var dsa = $.ajax({
									type: "POST",
									url: "/orgchart_delete",
									data: formData,
									contentType: false,
									processData: false,
									success: function(data) {
										alert("SAVE");
										location.reload();
									},
									error: function(jqXHR, textStatus, errorThrown) {
										console.error("Error:", textStatus, errorThrown);
										alert("An error occurred while saving the data.");
									}
								});
							// console.log(dsa);
					}	
		}
	  });
	  var element = $("li." + del_node + ":not('.temp, #upload-chart li')").removeAttr("class").addClass("node").addClass("child");

	  remChild(element);
	  init_tree();
	}
  }

  });

  $(".add").off("click").on("click", function() {
	click_flag = false;

	classList = $(this).parent().parent().attr('class').split(/\s+/);
	$.each(classList, function(index, item) {
	  if (item != "temp" && item != "node" && item != "child" && item != "ui-draggable" && item != "ui-droppable" && !regx.test(item)) {
		add_to_node = item;
	  }
	});
	$("#add_node").off("click").on("click", function(e) {
		e.preventDefault();

		//unidad de consumo agregada, agregar li a la lista, y refrescar arbol
		var res = add_to_node.substring(4);
		var tipo_nodo = "";
		var text_field = $("#new_node_name");
		var text_description = $("#new_node_title");
		var texto = text_field.val();
		var texti = text_description.val();
		text_field.val("");
		text_description.val("");
		var $node = $("li." + add_to_node + ":not('.temp')");
		var childs = $("#org li").size() + $("#upload-chart li").size() + 1;
		tipo_nodo += "child unic" + childs;
		var append_text = "<li class='" + tipo_nodo + "' data-parent='" + res + "' data-department='"+ texti +"'>";
		append_text += "<span class='label_node'><a href='#'>" + texto + "</a></span>";
		append_text += "</li>";
		if ($node.find("ul").size() == 0) {
			append_text = "<ul>" + append_text + "</ul>";
			$node.append(append_text);
		} else {
			$node.find("ul:eq(0)").append(append_text);
		}
		
		// ดึงค่า CSRF token จาก meta tag ให้ถูกต้อง
		var formData = new FormData();
			formData.append("_token", $('meta[name="csrf-token"]').attr('content')); // CSRF token
			formData.append("post_value", res); // ข้อมูล post_value
			formData.append("text", texto); // ข้อมูล text ที่ถูกส่ง

			// ส่งข้อมูลผ่าน AJAX
			$.ajax({
				type: "POST",
				url: "/orgchart_new",
				data: formData,
				contentType: false,
				processData: false,
				success: function(data) {
					alert("SAVE");
					location.reload();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error("Error:", textStatus, errorThrown);
					alert("An error occurred while saving the data.");
				}
			});
		
		$.fancybox.close();
		init_tree();
		scroll();
	});

  }).fancybox({
	maxWidth: 800,
	maxHeight: 800,
	fitToView: false,
	width: '70%',
	height: '70%',
	autoSize: false,
	closeClick: false,
	openEffect: 'none',
	closeEffect: 'none',
	afterClose: function() {
	  click_flag = true;
	  init_tree()
	}
  });
}


$(document).ready(function() {
  /* Custom jQuery for the example */
  $("#show-list").click(function(e) {
	e.preventDefault();

	$('#list-html').toggle('fast', function() {
	  $('#list-html').text($('#org').html());
	  $("#org").bind("DOMSubtreeModified", function() {
		$('#list-html').text('');
		$('#list-html').text($('#org').html());
		prettyPrint();
	  });
	  if ($(this).is(':visible')) {
		$('#show-list').text('Hide underlying list.');
		$(".topbar").fadeTo('fast', 0.9);
	  } else {
		$('#show-list').text('Show underlying list.');
		$(".topbar").fadeTo('fast', 1);
	  }
	});
  });



  loadjson();
  init_tree();

  //forms behavior
  $("#new_node_name, #edit_node_name").on("keyup", function(evt) {
	var id = $(this).attr("id");
	if ($(this).val() != '') {
	  if (id == "new_node_name") {
		$("#add_node").show();
	  } else {
		$("#edit_node").show();
	  }
	} else {
	  if (id == "new_node_name") {
		$("#add_node").hide();
	  } else {
		$("#edit_node").hide();
	  }
	}
  });
  scroll();


});
</script>


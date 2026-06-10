function multipleDeleteNews(url,form) 
{
    var items = $.fn.yiiGridView.getSelection(''+form+'');
    if(items.length <= 0)
    {
        alert("กรุณาเลือกข้อมูลที่จะลบ");
        return false;
    }
    bootbox.confirm('ยืนยันการลบข้อมูลหรือไม่ ?', function(result) 
    {
        if(!result) return false;
        jQuery('#'+form+'').yiiGridView('update', {
            type: 'post',
            url: url,
            data: {chk:items},
            success: function(data) {
                notyfy({dismissQueue: false,text: "ลบข้อมูลเรียบร้อย",type: 'success'});
                jQuery('#'+form+'').yiiGridView('update');
            },
            error: function(XHR) {
                alert('เกินข้อผิดพลาดกรุณาทำข้อมูลไหม');
            }
        });
        //location.reload();
    });
    return false;
}


function init_tinymce() {
    tinymce.init({
        selector: ".tinymce",
        theme: "modern",
        width: '90%',
        height: 300,
        relative_urls: false,
        remove_script_host : false,
        menubar: "view",
        autoresize_on_init: false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code","fullscreen"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code fullscreen | fontsizeselect",
        image_advtab: true ,
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",

        external_filemanager_path:"../../../../filemanager/",
        filemanager_title:"Filemanager" ,
        external_plugins: { "filemanager" : "../../../../../../filemanager/plugin.min.js"}
    });
}

function init_tinymce_text_pdf() {
    tinymce.init({
        selector: ".tinymce",
        theme: "modern",
        width: '90%',
        height: 300,
        relative_urls: false,
        remove_script_host : false,
        menubar: "view",
        autoresize_on_init: false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code","fullscreen"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| forecolor backcolor  | code fullscreen | fontsizeselect",
        image_advtab: true ,
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",

        external_filemanager_path:"../../../../filemanager/",
        filemanager_title:"Filemanager" ,
        external_plugins: { "filemanager" : "../../../../../../filemanager/plugin.min.js"}
    });
}

function initTinyChoice(question_id,id){
    tinymce.EditorManager.execCommand('mceAddEditor', true, "choice-"+question_id+"-"+id+"-tilte-input");
    tinymce.EditorManager.execCommand('mceAddEditor', true, "choice-q"+question_id+"-"+id+"-tilte-input");
    tinymce.EditorManager.execCommand('mceAddEditor', true, "choice-a"+question_id+"-"+id+"-tilte-input");
}

function initTinyQuestion(id){
    tinymce.EditorManager.execCommand('mceAddEditor', true, "question-"+id+"-title");
    tinymce.EditorManager.execCommand('mceAddEditor', true, "question-"+id+"-explain");
    tinymce.EditorManager.execCommand('mceAddEditor', true, "choice-"+id+"-0-tilte-input");
    tinymce.EditorManager.execCommand('mceAddEditor', true, "choice-"+id+"-1-tilte-input");
    tinymce.EditorManager.execCommand('mceAddEditor', true, "choice-"+id+"-2-tilte-input");
    tinymce.EditorManager.execCommand('mceAddEditor', true, "choice-"+id+"-3-tilte-input");
}

function initTinyQuestionTextarea(id){
    tinymce.EditorManager.execCommand('mceAddEditor', true, "question-"+id+"-title");
}

function tinyChoiceRemove(question_id,id){
    // alert("choice-q"+question_id+"-"+id+"-tilte-input");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "choice-"+question_id+"-"+id+"-tilte-input");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "choice-q"+question_id+"-"+id+"-tilte-input");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "choice-a"+question_id+"-"+id+"-tilte-input");
}
function tinyRemove(id){
    tinymce.EditorManager.execCommand('mceRemoveEditor',true,  "question-"+id+"-title");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "question-"+id+"-explain");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "choice-"+id+"-0-tilte-input");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "choice-"+id+"-1-tilte-input");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "choice-"+id+"-2-tilte-input");
    tinymce.EditorManager.execCommand('mceRemoveEditor', true, "choice-"+id+"-3-tilte-input");
}



function init_tinymce_question() {
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width: '100%',
        height: 300,
        relative_urls: false,
        remove_script_host : false,
        menubar: false,
        autoresize_on_init: false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code","fullscreen"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| image media | forecolor backcolor  | fontsizeselect",
        image_advtab: true ,
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",

        external_filemanager_path:"../../../../filemanager/",
        filemanager_title:"Filemanager" ,
        external_plugins: { "filemanager" : "../../../../../../filemanager/plugin.min.js"}
        
        // external_filemanager_path:"/lms_plm/filemanager/",
        // filemanager_title:"Filemanager" ,
        // external_plugins: { "filemanager" : "../../../../../../filemanager/plugin.min.js"}

    });
}


var basePath = '';

$(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto({
        social_tools: false,
        animationSpeed: 'normal', /* ลักษณะการแสดงแอนิเมชั่น fast/slow/normal */
        padding: 40, /* กำหนดระยะห่างระหว่างรูปภาพกับตัวบ้อก */
        opacity: 0.35, /* กำหนดค่าความโปร่งแสง  0 - 1 */
        showTitle: true, /* กำหนดให้แสดง title หรือไม่ true/false */
        allowresize: true, /* อนุญาติให้ยูสเซ่อร์ย่อหรือขยายหรือไม่ true/false */
        counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
        theme: 'light_rounded' /* ธีม light_rounded / dark_rounded / light_square / dark_square */
    });


    $('.time').each(function(index, el) {
        if($(this).val() == '00:00:00'){
            $('#addCurrentTime').attr('data-time-index',index);
            $('#numberAdd').text($('.numberHeader').eq(index).text());
            $('#slideImgShow').html($('.slide').eq(index).clone());
            return false;
        }
    });

    $('#addCurrentTime').click(function(event) {
        var index = $(this).attr('data-time-index');
        var timeforme = '0'+(new Date).clearTime().addSeconds(playerInstance.getPosition()).toString('H:mm:ss');
        console.log(timeforme);
        $('.time').eq(index).val(timeforme);
        $('.time').each(function(index, el) {
            if($(this).val() == '00:00:00'){
                $('#addCurrentTime').attr('data-time-index',index);
                $('#numberAdd').text($('.numberHeader').eq(index).text());
                $('#slideImgShow').html($('.slide').eq(index+1).clone());
                return false;
            }
        });
    });



    $('#question-list').on('click','.choice-remove',function(){
        if(confirm('คุณต้องการลบข้อมูล?')) {
            var em_index = $(this).index('.choice-remove');
            var question_id = $(this).data('question');
            $('.choice').eq(em_index).remove();
            tinyChoiceRemove(question_id,em_index)
        }
    });

    $('#question-list').on('click','.choice-remove1',function(){
        if(confirm('คุณต้องการลบข้อมูล?')) {
            var em_index = $(this).attr('data-new_index');
            var question_id = $(this).data('question');
            // alert('.choice1'+question_id+'-'+em_index+'');
            // var emindex = $(this).index('choice1'+question_id+'-'+em_index+'');

            $('.choice1'+question_id+'-'+em_index+'').remove();
            tinyChoiceRemove(question_id,em_index)
        }
    });

    $('#question-list').on('click','.choice-remove2',function(){
        if(confirm('คุณต้องการลบข้อมูล?')) {
            var em_index = $(this).attr('data-new_index');
            var question_id = $(this).data('question');
            $('.choice2'+question_id+'-'+em_index+'').remove();
            tinyChoiceRemove(question_id,em_index)
        }
    });

    $('#question-list').on('click','.question-remove',function(){
        if(confirm('คุณต้องการลบข้อมูล?')) {
            var em_index = $(this).index('.question-remove');
            $('.question-group').eq(em_index).remove();
            var em_question_total = $('#question-list').children('.question-group');
            var question_total = '0';
            if(em_question_total.length){
                question_total = parseInt(em_question_total.length);
            }
            var remove_index = $(this).data('index');
            $('#CountNumAll').text(question_total);
            // alert(em_question_total.length);
            tinyRemove(remove_index);

        }
    });

    $('#question-list').on('click','.add-chocie',function(){
        var em_index = $(this).index('.add-chocie');
        var question_id = $(this).attr('data-question-id');
        var value_index_choice = $('.choice-list').eq(em_index).children().last().find('.choice-'+question_id+'-input');

        var type = $('.question-group').eq(em_index).find("input[name^='Question_type']");
        if(type.length){
            type = type.val();
        }else{
            type = 'text';
        }

        var new_index = 0;
        if(value_index_choice.length){
            new_index = parseInt(value_index_choice.val())+1;
        }

        var choice = "";
        choice += '<div class="row choice" style="margin-top:20px;">';
        choice += '<div class="span1">';
        choice += '<input type="'+type+'" name="Choice['+question_id+'][]" class="choice-'+question_id+'-input pull-right" value="'+new_index+'">';
        choice += '</div>';
        choice += '<div class="span8">';
        choice += '<textarea name="ChoiceTitle['+question_id+']['+new_index+']" class="choice-tilte-input" id="choice-'+question_id+'-'+new_index+'-tilte-input" cols="30" rows="10"></textarea>';
        choice += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_id+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        choice += '</div>';
        choice += '</div>';

        $('.choice-list').eq(em_index).append(choice);
        initTinyChoice(question_id,new_index);

    });

        $('#question-list').on('click', '.add-chocie-sort', function () {
        var em_index = $(this).index('.add-chocie-sort');
        var question_id = $(this).attr('data-question-id');
        var value_index_choice = $('.choice-list-sort').eq(em_index).children().last().find('.choice-' + question_id + '-input');

        var type = $('.question-group').eq(em_index).find("input[name^='Question_type']");
        if (type.length) {
            type = type.val();
        } else {
            type = 'text';
        }

        var new_index = 0;
        if (value_index_choice.length) {
            new_index = parseInt(value_index_choice.val()) + 1;
        }

        var choice = "";
        choice += '<div class="row choice" style="margin-top:20px;">';
        choice += '<div class="span1">';
        choice += '<input type="' + type + '" name="Choice[' + question_id + '][]" class="choice-' + question_id + '-input pull-right" value="' + new_index + '">';
        choice += '</div>';
        choice += '<div class="span8">';
        choice += '<textarea name="ChoiceTitle[' + question_id + '][' + new_index + ']" class="choice-tilte-input" id="choice-' + question_id + '-' + new_index + '-tilte-input" cols="30" rows="10"></textarea>';
        choice += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="' + question_id + '"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        choice += '</div>';
        choice += '</div>';

        $('.choice-list-sort').eq(em_index).append(choice);
        initTinyChoice(question_id, new_index);

    });


    $('#question-list').on('click','.add-chocie-part1',function(){
        var em_index = $(this).index('.add-chocie-part1');
        var question_id = $(this).attr('data-question-id');
        // var value_index_choice = $('.choice-list1').eq(em_index).children().last().find('.choiceQ-'+question_id+'-input');
        var value_index_choice1 = $('.choice-list1').eq(em_index).children().last().find('.choiceA-'+question_id+'-input');

        var value_index_choice2 = $('.choice-list2').eq(em_index).children().last().find('.choiceA-'+question_id+'-input');


        var type = $('.question-group').eq(em_index).find("input[name^='Question_type']");

        if(type.length){
            type = type.val();
        }else{
            type = 'text';
        }


         var new_index1 = 0;
        if(value_index_choice1.length){
            // alert('i1 '+parseInt(value_index_choice1.val()));

            new_index1 = parseInt(value_index_choice1.val())+1;
        }

        var new_index2 = 0;
        if(value_index_choice2.length){
            // alert('i2 '+parseInt(value_index_choice2.val()));

            new_index2 = parseInt(value_index_choice2.val())+1;
        }

        if(new_index2 < new_index1){
            new_index = new_index1;
        }else if(new_index2 > new_index1){
            new_index = new_index2;
        }else if(new_index2 == new_index1){
            new_index = new_index2+1;
        }


        var choice = "";
   
        choice += '<div class="widget widget-tabs border-bottom-none choice1'+question_id+'-'+new_index+'" >';
        choice += '<script>';
        choice += '$(function(){';

        choice += 'tinyMCE.init({';
        choice += 'height: \'100px\',';
        choice += '});';
        choice += '';

        choice += '});';
        choice += '<\/script>';
        choice += '<div class="widget-body">'

        choice += '<div class="row"style="margin-top:20px;">';
        choice += '<div class="span1">';
        choice += 'คำถาม';
        choice += '<input type="hidden" name="Choice[quest]['+question_id+'][]" class="choiceQ-'+question_id+'-input pull-right" value="'+new_index+'">';
        choice += '</div>';
        choice += '<div class="span8">';
        choice += '<textarea name="ChoiceTitle[quest]['+question_id+']['+new_index+']" class="choiceQ-'+question_id+'-tilte-input" id="choice-q'+question_id+'-'+new_index+'-tilte-input" cols="30" rows="10"></textarea>';
        choice += '</div>';
        choice += '</div>';


        choice += '<div class="row" style="margin-top:20px;">';
        choice += '<div class="span1">';
        choice += 'คำตอบ';
        choice += '<input type="hidden" name="Choice[ans]['+question_id+'][]" class="choiceA-'+question_id+'-input pull-right" value="'+new_index+'">';
        choice += '</div>';
        choice += '<div class="span8">';
        choice += '<textarea name="ChoiceTitle[ans]['+question_id+']['+new_index+']" class="choiceA-'+question_id+'-tilte-input" id="choice-a'+question_id+'-'+new_index+'-tilte-input" cols="30" rows="10"></textarea>';
        choice += '<a class="btn btn-icon btn-danger circle_ok choice-remove1" data-question="'+question_id+'" data-new_index="'+new_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        choice += '</div>';
        choice += '</div>';

        choice += '</div>';
        choice += '</div>';

        $('.choice-list1').eq(em_index).append(choice);
        initTinyChoice(question_id,new_index);

    });


    $('#question-list').on('click','.add-chocie-part2',function(){
        var em_index = $(this).index('.add-chocie-part2');
        var question_id = $(this).attr('data-question-id');
        var value_index_choice1 = $('.choice-list1').eq(em_index).children().last().find('.choiceA-'+question_id+'-input');
        var value_index_choice2 = $('.choice-list2').eq(em_index).children().last().find('.choiceA-'+question_id+'-input');




        var type = $('.question-group').eq(em_index).find("input[name^='Question_type']");
        if(type.length){
            type = type.val();
        }else{
            type = 'text';
        }

        // var new_index = 0;
        // if(value_index_choice1.length){
        //     new_index = parseInt(value_index_choice1.val())+1;
        // }


        var new_index1 = 0;
        if(value_index_choice1.length){
            new_index1 = parseInt(value_index_choice1.val())+1;
        }

        var new_index2 = 0;
        if(value_index_choice2.length){
            new_index2 = parseInt(value_index_choice2.val())+1;
        }

        if(new_index2 < new_index1){
            new_index = new_index1;
        }else if(new_index2 > new_index1){
            new_index = new_index2;
        }else if(new_index2 == new_index1){
            new_index = new_index2+1;
        }

        var choice = "";
  

        choice += '<div class="row choice1'+question_id+'-'+new_index+'" style="margin-top:20px;">';
        choice += '<script>';
        choice += '$(function(){';
        choice += 'tinyMCE.init({';
        choice += 'height: \'100px\',';
        choice += '});';
        choice += '});';
        choice += '<\/script>';
        choice += '<div class="span1">';
        choice += 'คำตอบ';
        choice += '<input type="hidden" name="Choice[ans]['+question_id+'][]" class="choiceA-'+question_id+'-input pull-right" value="'+new_index+'">';
        choice += '</div>';
        choice += '<div class="span8">';
        choice += '<textarea name="ChoiceTitle[ans]['+question_id+']['+new_index+']" class="choiceA-'+question_id+'-tilte-input" id="choice-a'+question_id+'-'+new_index+'-tilte-input" cols="30" rows="10"></textarea>';
        choice += '<a class="btn btn-icon btn-danger circle_ok choice-remove1" data-question="'+question_id+'" data-new_index="'+new_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        choice += '</div>';
        choice += '</div>';


        $('.choice-list2').eq(em_index).append(choice);
        initTinyChoice(question_id,new_index);

    });

    $('.form').on('click', '#add-sort-question', function () {
        var value_index_question = $('#question-list').children('.question-group').last();
        var em_question_total = $('#question-list').children('.question-group');
        var question_index = 0;
        var question_total = 0;
        if (value_index_question.length) {
            question_index = parseInt(value_index_question.attr('data-index')) + 1;
        }
        if (em_question_total.length) {
            question_total = parseInt(em_question_total.length);
        }
        question_total += 1;
        $('#CountNumAll').text(question_total);
        var question_radio = "";

        question_radio += '<div class="question-group" data-index="' + question_index + '">';
        question_radio += '<hr class="soften" />';
        question_radio += '<div class="row question">';
        question_radio += '<label><h3>โจทย์ (จัดเรียง) <input type="hidden" name="Question_type[' + question_index + ']" value="hidden"> <!--ข้อที่ <span class="question-numbers" style="color:green; font-size: 20px;">' + question_total + '</span>--> ';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok question-remove" data-index="' + question_index + '"><i class="icon-remove"></i> ลบโจทย์</a></h3>';
        question_radio += '</label>';
        question_radio += '<div class="span12">';
        question_radio += '<textarea name="Question[' + question_index + ']" class="question-title" id="question-' + question_index + '-title" cols="30" rows="10"></textarea>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row question">';
        question_radio += '<label><h3>อธิบายคำตอบ</h3>';
        question_radio += '</label>';
        question_radio += '<div class="span12">';
        question_radio += '<textarea name="Explain[' + question_index + ']" class="question-explain" id="question-' + question_index + '-explain" cols="30" rows="10"></textarea>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice-list-sort" style="margin-top:20px;">';
        question_radio += '<label><h3>ตัวเลือก <a class="btn btn-icon btn-success add-chocie-sort" data-question-id="' + question_index + '"><i class="icon-book"></i> เพิ่มตัวเลือก</a></h3></label>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="hidden" name="Choice[' + question_index + '][]" class="choice-' + question_index + '-input pull-right" value="0">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle[' + question_index + '][0]" class="choice-tilte-input" id="choice-' + question_index + '-0-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="' + question_index + '"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="hidden" name="Choice[' + question_index + '][]" class="choice-' + question_index + '-input pull-right" value="1">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle[' + question_index + '][1]" class="choice-tilte-input" id="choice-' + question_index + '-1-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="' + question_index + '"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="hidden" name="Choice[' + question_index + '][]" class="choice-' + question_index + '-input pull-right" value="2">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle[' + question_index + '][2]" class="choice-tilte-input" id="choice-' + question_index + '-2-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="' + question_index + '"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="hidden" name="Choice[' + question_index + '][]" class="choice-' + question_index + '-input pull-right" value="3">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle[' + question_index + '][3]" class="choice-tilte-input" id="choice-' + question_index + '-3-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="' + question_index + '"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '</div>';

        $('#question-list').append(question_radio);
        initTinyQuestion(question_index);
    });

    $('.form').on('click','#add-radio-question',function(){
        var value_index_question = $('#question-list').children('.question-group').last();
        var em_question_total = $('#question-list').children('.question-group');
        var question_index = 0;
        var question_total = 0;
        if(value_index_question.length){
            question_index = parseInt(value_index_question.attr('data-index'))+1;
        }
        if(em_question_total.length){
            question_total = parseInt(em_question_total.length);
        }
        question_total += 1;
        $('#CountNumAll').text(question_total);
        var question_radio = "";

        question_radio += '<div class="question-group" data-index="'+question_index+'">';
        question_radio += '<hr class="soften" />';
        question_radio += '<div class="row question">';
        question_radio += '<label><h3>โจทย์ (คำตอบเดียว) <input type="hidden" name="Question_type['+question_index+']" value="radio"> <!--ข้อที่ <span class="question-numbers" style="color:green; font-size: 20px;">'+question_total+'</span>--> ';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok question-remove" data-index="'+question_index+'"><i class="icon-remove"></i> ลบโจทย์</a></h3>';
        question_radio += '</label>';
        question_radio += '<div class="span12">';
        question_radio += '<textarea name="Question['+question_index+']" class="question-title" id="question-'+question_index+'-title" cols="30" rows="10"></textarea>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row question">';
        question_radio += '<label><h3>อธิบายคำตอบ</h3>';
        question_radio += '</label>';
        question_radio += '<div class="span12">';
        question_radio += '<textarea name="Explain['+question_index+']" class="question-explain" id="question-'+question_index+'-explain" cols="30" rows="10"></textarea>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice-list" style="margin-top:20px;">';
        question_radio += '<label><h3>ตัวเลือก <a class="btn btn-icon btn-success add-chocie" data-question-id="'+question_index+'"><i class="icon-book"></i> เพิ่มตัวเลือก</a></h3></label>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="radio" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="0">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle['+question_index+'][0]" class="choice-tilte-input" id="choice-'+question_index+'-0-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="radio" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="1">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle['+question_index+'][1]" class="choice-tilte-input" id="choice-'+question_index+'-1-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="radio" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="2">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle['+question_index+'][2]" class="choice-tilte-input" id="choice-'+question_index+'-2-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '<div class="row choice" style="margin-top:20px;">';
        question_radio += '<div class="span1">';
        question_radio += '<input type="radio" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="3">';
        question_radio += '</div>';
        question_radio += '<div class="span8">';
        question_radio += '<textarea name="ChoiceTitle['+question_index+'][3]" class="choice-tilte-input" id="choice-'+question_index+'-3-tilte-input" cols="30" rows="10"></textarea>';
        question_radio += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '</div>';
        question_radio += '</div>';

        $('#question-list').append(question_radio);
        initTinyQuestion(question_index);

    });

    $('.form').on('click','#add-checkbox-question',function(){
        var value_index_question = $('#question-list').children('.question-group').last();
        var em_question_total = $('#question-list').children('.question-group');
        var question_index = 0;
        var question_total = 0;
        if(value_index_question.length){
            question_index = parseInt(value_index_question.attr('data-index'))+1;
        }
        if(em_question_total.length){
            question_total = parseInt(em_question_total.length);
        }
        question_total += 1;
        $('#CountNumAll').text(question_total);
        var question_checkbox = "";

        question_checkbox += '<div class="question-group" data-index="'+question_index+'">';
        question_checkbox += '<hr class="soften" />';
        question_checkbox += '<div class="row question">';
        question_checkbox += '<label><h3>โจทย์ (หลายคำตอบ) <input type="hidden" name="Question_type['+question_index+']" value="checkbox"> <!--ข้อที่ <span class="question-numbers" style="color:green; font-size: 20px;">'+question_total+'</span>--> ';
        question_checkbox += '<a class="btn btn-icon btn-danger circle_ok question-remove" data-index="'+question_index+'"><i class="icon-remove"></i> ลบโจทย์</a></h3>';
        question_checkbox += '</label>';
        question_checkbox += '<div class="span12">';
        question_checkbox += '<textarea name="Question['+question_index+']" class="question-title" id="question-'+question_index+'-title" cols="30" rows="10"></textarea>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row question">';
        question_checkbox += '<label><h3>อธิบายคำตอบ</h3>';
        question_checkbox += '</label>';
        question_checkbox += '<div class="span12">';
        question_checkbox += '<textarea name="Explain['+question_index+']" class="question-explain" id="question-'+question_index+'-explain" cols="30" rows="10"></textarea>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row choice-list" style="margin-top:20px;">';
        question_checkbox += '<label><h3>ตัวเลือก <a class="btn btn-icon btn-success add-chocie" data-question-id="'+question_index+'"><i class="icon-book"></i> เพิ่มตัวเลือก</a></h3></label>';
        question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        question_checkbox += '<div class="span1">';
        question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="0">';
        question_checkbox += '</div>';
        question_checkbox += '<div class="span8">';
        question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][0]" class="choice-tilte-input" id="choice-'+question_index+'-0-tilte-input" cols="30" rows="10"></textarea>';
        question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        question_checkbox += '<div class="span1">';
        question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="1">';
        question_checkbox += '</div>';
        question_checkbox += '<div class="span8">';
        question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][1]" class="choice-tilte-input" id="choice-'+question_index+'-1-tilte-input" cols="30" rows="10"></textarea>';
        question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        question_checkbox += '<div class="span1">';
        question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="2">';
        question_checkbox += '</div>';
        question_checkbox += '<div class="span8">';
        question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][2]" class="choice-tilte-input" id="choice-'+question_index+'-2-tilte-input" cols="30" rows="10"></textarea>';
        question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        question_checkbox += '<div class="span1">';
        question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="3">';
        question_checkbox += '</div>';
        question_checkbox += '<div class="span8">';
        question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][3]" class="choice-tilte-input" id="choice-'+question_index+'-3-tilte-input" cols="30" rows="10"></textarea>';
        question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';

        $('#question-list').append(question_checkbox);
        initTinyQuestion(question_index);

    });

    $('.form').on('click','#add-dropdown-question',function(){
        var value_index_question = $('#question-list').children('.question-group').last();
        var em_question_total = $('#question-list').children('.question-group');
        var question_index = 0;
        var question_total = 0;
        if(value_index_question.length){
            question_index = parseInt(value_index_question.attr('data-index'))+1;
        }
        if(em_question_total.length){
            question_total = parseInt(em_question_total.length);
        }
        question_total += 1;
        $('#CountNumAll').text(question_total);
        var question_checkbox = "";

        question_checkbox += '<div class="question-group" data-index="'+question_index+'">';
        question_checkbox += '<hr class="soften" />';
        question_checkbox += '<div class="row question">';
        question_checkbox += '<label><h3>โจทย์ (จับคู่) <input type="hidden" name="Question_type['+question_index+']" value="dropdown"> <!--ข้อที่ <span class="question-numbers" style="color:green; font-size: 20px;">'+question_total+'</span>--> ';
        question_checkbox += '<a class="btn btn-icon btn-danger circle_ok question-remove" data-index="'+question_index+'"><i class="icon-remove"></i> ลบโจทย์</a></h3>';
        question_checkbox += '</label>';
        question_checkbox += '<div class="span12">';
        question_checkbox += '<textarea name="Question['+question_index+']" class="question-title" id="question-'+question_index+'-title" cols="30" rows="10"></textarea>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row question">';
        question_checkbox += '<label><h3>อธิบายคำตอบ</h3>';
        question_checkbox += '</label>';
        question_checkbox += '<div class="span12">';
        question_checkbox += '<textarea name="Explain['+question_index+']" class="question-explain" id="question-'+question_index+'-explain" cols="30" rows="10"></textarea>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row choice-list1" style="margin-top:20px;">';
        question_checkbox += '<label><h3>เพิ่มส่วนที่ 1 เพิ่มคำถามและคำตอบ<a class="btn btn-icon btn-success add-chocie-part1" data-question-id="'+question_index+'"><i class="icon-book"></i> เพิ่มตัวเลือก</a></h3></label>';
        question_checkbox += '</div>';
        question_checkbox += '<div class="row choice-list2" style="margin-top:20px;">';
        question_checkbox += '<label><h3>เพิ่มส่วนที่ 2 เพิ่มคำตอบหลอก<a class="btn btn-icon btn-success add-chocie-part2" data-question-id="'+question_index+'"><i class="icon-book"></i> เพิ่มตัวเลือก</a></h3></label>';
        question_checkbox += '</div>';
        
        // question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        // question_checkbox += '<div class="span1">';
        // question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="0">';
        // question_checkbox += '</div>';
        // question_checkbox += '<div class="span8">';
        // question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][0]" class="choice-tilte-input" id="choice-'+question_index+'-0-tilte-input" cols="30" rows="10"></textarea>';
        // question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        // question_checkbox += '</div>';
        // question_checkbox += '</div>';
        // question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        // question_checkbox += '<div class="span1">';
        // question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="1">';
        // question_checkbox += '</div>';
        // question_checkbox += '<div class="span8">';
        // question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][1]" class="choice-tilte-input" id="choice-'+question_index+'-1-tilte-input" cols="30" rows="10"></textarea>';
        // question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        // question_checkbox += '</div>';
        // question_checkbox += '</div>';
        // question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        // question_checkbox += '<div class="span1">';
        // question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="2">';
        // question_checkbox += '</div>';
        // question_checkbox += '<div class="span8">';
        // question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][2]" class="choice-tilte-input" id="choice-'+question_index+'-2-tilte-input" cols="30" rows="10"></textarea>';
        // question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        // question_checkbox += '</div>';
        // question_checkbox += '</div>';
        // question_checkbox += '<div class="row choice" style="margin-top:20px;">';
        // question_checkbox += '<div class="span1">';
        // question_checkbox += '<input type="checkbox" name="Choice['+question_index+'][]" class="choice-'+question_index+'-input pull-right" value="3">';
        // question_checkbox += '</div>';
        // question_checkbox += '<div class="span8">';
        // question_checkbox += '<textarea name="ChoiceTitle['+question_index+'][3]" class="choice-tilte-input" id="choice-'+question_index+'-3-tilte-input" cols="30" rows="10"></textarea>';
        // question_checkbox += '<a class="btn btn-icon btn-danger circle_ok choice-remove" data-question="'+question_index+'"><i class="icon-remove"></i> ลบตัวเลือก</a>';
        // question_checkbox += '</div>';
        // question_checkbox += '</div>';
        question_checkbox += '</div>';
        question_checkbox += '</div>';

        $('#question-list').append(question_checkbox);
        initTinyQuestion(question_index);

    });

    $('.form').on('click','#add-textarea-question',function(){
        var value_index_question = $('#question-list').children('.question-group').last();
        var em_question_total = $('#question-list').children('.question-group');
        var question_index = 0;
        var question_total = 0;
        if(value_index_question.length){
            question_index = parseInt(value_index_question.attr('data-index'))+1;
        }
        if(em_question_total.length){
            question_total = parseInt(em_question_total.length);
        }
        question_total += 1;
        $('#CountNumAll').text(question_total);
        var question_textarea = "";

        question_textarea += '<div class="question-group" data-index="'+question_index+'">';
        question_textarea += '<hr class="soften" />';
        question_textarea += '<div class="row question">';
        question_textarea += '<label><h3>โจทย์ (คำตอบบรรยาย) <input type="hidden" name="Question_type['+question_index+']" value="textarea"> <!--ข้อที่ <span class="question-numbers" style="color:green; font-size: 20px;">'+question_total+'</span>--> ';
        question_textarea += '<a class="btn btn-icon btn-danger circle_ok question-remove" data-index="'+question_index+'"><i class="icon-remove"></i> ลบโจทย์</a></h3>';
        question_textarea += '</label>';
        question_textarea += '<div class="span11">';
        // question_textarea += '<label><h3> คะแนนเต็ม</h3>';
        // question_textarea += '<input type="number" name="Question_score['+question_index+']" min=0 pattern="[0-9]">';
        question_textarea += '</label>';
        question_textarea += '</div>';
        question_textarea += '<div class="span12">';
        question_textarea += '<textarea name="Question['+question_index+']" class="question-title" id="question-'+question_index+'-title" cols="30" rows="10"></textarea>';
        question_textarea += '</div>';
        question_textarea += '</div>';
        question_textarea += '</div>';

        $('#question-list').append(question_textarea);
        initTinyQuestionTextarea(question_index);

    });

    $('form#Question').submit(function(){
        tinyMCE.triggerSave();
        var validate = true;

        $('.question-title').each(function(index){
            if($(this).val() == ''){
//                  tinyMCE.execCommand('mceFocus', false, $(this).attr('id'));
                alert('กรุณากรอกข้อมูลโจทย์ให้ครบ');
                validate = false;
                return false;
            }
        });
        if(validate) {
            $('.choice-tilte-input').each(function (index) {
                if ($(this).val() == '') {
//                      tinyMCE.execCommand('mceFocus', false, $(this).attr('id'));
                    alert('กรุณากรอกข้อมูลตัวเลือกให้ครบ');
                    validate = false;
                    return false;
                }
            });
        }
        if(validate) {
            $('.question-group').each(function (index) {

                var type = $(this).find("input[name^='Question_type']");
                if(type.length){
                    type = type.val();
                }else{
                    type = 'error';
                }

                if((type != 'textarea') && ($type != 'dropdown')) {
                    var radiochecked = $(this).find("input:checked").length;
                    if (!radiochecked) {
                        alert('กรุณาเลือกคำตอบที่ถูกต้องให้ครบ');
                        $(this).find("input:"+type).first().focus();
                        validate = false;
                        return false;
                    }
                }

            });
        }

        return validate;
    });



});
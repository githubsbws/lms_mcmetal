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
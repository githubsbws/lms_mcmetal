import Sortable from 'sortablejs';

document.addEventListener('DOMContentLoaded', function () {
    // สร้าง instances ของ Sortable
    new Sortable(document.getElementById('sortableList'), {
        animation: 150
        // เพิ่มค่าอื่น ๆ ตามต้องการ
    });
});
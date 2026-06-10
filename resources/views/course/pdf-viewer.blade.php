<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ดูเอกสาร</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #404040; display: flex; flex-direction: column; align-items: center; }

        #toolbar {
            width: 100%; background: #333; padding: 8px 16px;
            display: flex; align-items: center; gap: 12px;
            position: sticky; top: 0; z-index: 10; color: white;
        }

        #pdf-container { padding: 20px; width: 100%; }

        canvas {
            display: block;
            margin: 0 auto 10px auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
            /* ปิด right-click */
            -webkit-user-select: none;
            user-select: none;
        }
    </style>
</head>
<body>

{{-- Toolbar --}}
<div id="toolbar">
    <span id="page-info">หน้า 1 / 1</span>
    {{-- <button onclick="prevPage()" class="btn btn-sm btn-secondary">◀ ก่อนหน้า</button>
    <button onclick="nextPage()" class="btn btn-sm btn-secondary">ถัดไป ▶</button> --}}
    <span style="margin-left: auto;">{{ $fileName ?? 'เอกสาร' }}</span>
</div>

<div id="pdf-container"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    // ปิด right-click
    document.addEventListener('contextmenu', e => e.preventDefault());

    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    var pdfDoc    = null;
    var pageNum   = 1;
    var totalPages = 0;
    var scale     = 1.5;

    // โหลด PDF จาก route (ส่งเป็น base64 หรือ stream)
    pdfjsLib.getDocument('{{ $pdfUrl }}').promise.then(function(pdf) {
        pdfDoc     = pdf;
        totalPages = pdf.numPages;

        // render ทุกหน้าเลย
        for (var i = 1; i <= totalPages; i++) {
            renderPage(i);
        }

        document.getElementById('page-info').textContent = 'ทั้งหมด ' + totalPages + ' หน้า';
    });

    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({ scale: scale });
            var canvas   = document.createElement('canvas');
            var ctx      = canvas.getContext('2d');

            canvas.height = viewport.height;
            canvas.width  = viewport.width;

            document.getElementById('pdf-container').appendChild(canvas);

            page.render({ canvasContext: ctx, viewport: viewport });
        });
    }
</script>
</body>
</html>

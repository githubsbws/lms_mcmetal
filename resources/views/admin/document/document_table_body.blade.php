@php
use App\Models\DownloadFile;
@endphp
<!-- document_table_body.blade.php -->
@foreach ($document as $item)
    @php
        $document_type = DownloadFile::join('download_categoty', 'download_categoty.download_id', '=', 'download_file.download_id')->where('file_id', $item->file_id)->get();
    @endphp
    <tr class="odd selectable" data-filedoc-id="{{ $item->filedoc_id }}">
        <td class="checkbox-column"><input class="select-on-check" value="78" id="chk_{{ $loop->index }}" type="checkbox" name="chk[]"></td>
        <td>
            @if($document_type->isEmpty())
                -
            @endif
            @foreach($document_type as $type)
                {{ $type->download_name }}
            @endforeach
        </td>
        <td>{{ $item->filedoc_name }}</td>
        <td style="width:450px; vertical-align:top;"><a href="{{ route('document.downloadfile', ['id' => $item->filedoc_id]) }}">{{ $item->filedocname }}</a></td>
        <td style="width: 90px;" class="center">
            <a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="{{ route('document.detail', ['id' => $item->filedoc_id]) }}"><i></i></a>
            <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="{{ route('document.edit', ['id' => $item->filedoc_id]) }}"><i></i></a>
            <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="{{ route('document.delete', ['id' => $item->filedoc_id]) }}" onclick="return confirm('คุณต้องการลบเอกสาร {{ $item->filedoc_name }} หรือไม่?')"><i></i></a>
        </td>
    </tr>
@endforeach



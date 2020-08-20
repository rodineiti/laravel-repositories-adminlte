@csrf
<div class="form-group">
    <label for="page_id">Página Principal</label>
    <select class="form-control" id="page_id" name="page_id">
        @foreach($pages as $item) {
        <option value="{{$item->id}}" {{isset($page) && $page->page_id === $item->id ? "selected" : ""}}>{{$item->title}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="title">Título</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$page->title ?? old('title')}}" placeholder="Título da página">
</div>
<div class="form-group">
    <label for="body">Conteúdo</label>
    <textarea class="form-control" id="body" name="body">{{$page->body ?? old('body')}}</textarea>
</div>
<button type="submit" class="btn btn-success">Salvar</button>

@section('js')
    <script src="https://cdn.tiny.cloud/1/fvixi3kmpjgenyrb4d09yzdqvtcuc47yydhu8wyiymmgsciv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(function () {
            if ($("#body").length) {
                tinymce.init({
                    selector:"#body",
                    height:500,
                    menubar:false,
                    plugins:["table code advtable lists fullscreen textcolor image media autolink checklist"],
                    toolbar:"undo redo | formatselect | bold italic backcolor | media image | " +
                        " alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | " +
                        "table tableinsertdialog tablecellprops tableprops | fullscreen",
                    images_upload_url:"{{route('pages.upload')}}",
                    images_upload_credentials:true,
                    convert_urls:false,
                });
            }
        });
    </script>
@endsection

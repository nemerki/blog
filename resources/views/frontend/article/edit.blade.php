@extends("layouts.frontend")
@section("tittle")
@section("headerTittle",'Makale Düzenle')
@section("content")

    <div class="container">
        <form id="articleForm">
        <div class="form-group  row">
            <label class="col-lg-2 col-form-label">
                Yazı Başlığı
            </label>
            <div class="col-lg-4">
                <input type="email" name="title" class="form-control m-input"
                       value="{{$article->title}}">
            </div>
            <label class="col-lg-2 col-form-label">
                Yazı Kategorisi
            </label>
            <div class="col-lg-4">
                <select class="form-control h-100 " name="category_id">
                    <option value="" selected="" disabled="" hidden="">Kategori Seçin</option>
                    @foreach($categories as $category)

                        <option
                            {{$category->id == $article->category_id ? 'selected' : ''}}
                            value="{{$category->id}}">{{$category->tittle}}</option>

                    @endforeach
                </select>


            </div>
        </div>

        <div class="form-group  row">
            <label class="col-lg-2 col-form-label">
                Kategori İçeriği
            </label>
            <div class="col-lg-10">
                <textarea name="content" id="summernote">{!! $article->content !!}</textarea>
            </div>

        </div>

        <div class="form-group  row   ">
            <label class="col-lg-2 col-form-label">
                Yazı Resmi
            </label>
            <div class="col-lg-4">

                <input type="file" name="image" id="logoImage">
                <img style="max-height: 200px;" id="logoImageShow" src=""
                     alt="">
            </div>

            <label class="col-lg-2 col-form-label">
                Yüklü Resim
            </label>
            <div class="col-lg-4">
                <img style="max-height: 200px;" class="img-fluid"
                     src="{!!asset( $article->image->name) !!}"
                     alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-10">
                <button type="button" id="articleUpdate" class="btn btn-success">
                    Kaydet
                </button>

                <a class="btn btn-danger" href="{{route("frontend.article.index")}}">İptal</a>
            </div>
        </div>
        </form>
    </div>
@endsection
@push("customJs")
    <script src="https://unpkg.com/sweetalert2@7.22.2/dist/sweetalert2.all.js"></script>
    <script>

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
        });


        $("#articleUpdate").on("click", function () {
            var form = new FormData($("#articleForm")[0]);

            $(".has-danger").removeClass("has-danger");
            $(".text-danger").remove();

            swal({
                title: 'Yükleniyor...',
                html:
                '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>' +
                ' <span class="sr-only">Loading...</span>',
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            $.ajax({
                type: "post",
                url: "{{route("frontend.article.update",["id"=>$article->id])}}",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    swal.close();
                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                        timer: 2000
                    });
                    window.location.href = "{{route("frontend.article.index")}}";

                },
                error: function (response) {
                    swal.close();

                    $.each(response.responseJSON.errors, function (k, v) {
                        $.each(v, function (kk, vv) {
                            $("[name='" + k + "']").parent().parent().addClass("has-danger");
                            $("[name='" + k + "']").parent().append(" <span class=\"text-danger\">" + vv + "</span>");
                        })
                    });

                }
            })
        })

        /* Yüklenen resmi anlık olarak görmek için */
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logoImageShow').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#logoImage").change(function () {
            readURL(this);
        });
        /* /Yüklenen resmi anlık olarak görmek için */
    </script>


    <!-- Include external JS libs. -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

    <!-- Include Editor JS files. -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/js/froala_editor.pkgd.min.js"></script>

    <!-- Initialize the editor. -->
    <script> $(function () {
            $('textarea').froalaEditor()
        }); </script>
@endpush
@push("customCss")
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.pkgd.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css" rel="stylesheet"
          type="text/css"/>



@endpush


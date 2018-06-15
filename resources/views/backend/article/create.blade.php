@extends("layouts.backend")
@section("tittle")
@section("content")

    <div class="m-content w-100">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Yazı Ekle
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form id="articleForm"
                          class="m-form m-form--fit m-form--label-align-right m-form--state m-form--group-seperator-dashed">
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Yazı Başlığı
                                </label>
                                <div class="col-lg-4">
                                    <input type="email" name="title" class="form-control m-input"
                                           placeholder="Yazı başlığını giriniz">
                                </div>
                                <label class="col-lg-2 col-form-label">
                                    Yazı Kategorisi
                                </label>
                                <div class="col-lg-4">
                                    <select class="form-control " name="category_id">
                                        <option value="" selected="" disabled="" hidden="">Kategori Seçin</option>
                                        @foreach($categories as $category)

                                            <option value="{{$category->id}}">{{$category->tittle}}</option>

                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Kategori İçeriği
                                </label>
                                <div class="col-lg-10">
                                    <textarea name="content" class="summernote"></textarea>
                                </div>

                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Yazı Resmi
                                </label>
                                <div class="col-lg-4">
                                    div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="logoImage">
                                    <label class="custom-file-label" for="customFile">
                                        Resim seç
                                    </label>
                                </div>
                            </div>


                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">

                                </label>
                                <div class="col-lg-4">
                                    <img style="max-height: 200px;" id="logoImageShow" src=""
                                         alt="">
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <button type="button" id="articleCreate" class="btn btn-success">
                                            Kaydet
                                        </button>

                                        <a class="btn btn-danger" href="{{route("backend.article.index")}}">İptal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
                <!--begin::Portlet-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>


@endsection
@push("customJs")
    <script>

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
        });


        $("#articleCreate").on("click", function () {
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
                url: "{{route("backend.article.store")}}",
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
                    {{--window.location.href = "{{route("backend.article.index")}}";--}}

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


    <!--begin::Page Resources -->
    <script src="{{asset("assets/backend/demo/default/custom/crud/forms/widgets/summernote.js")}}"
            type="text/javascript"></script>
    <!--end::Page Resources -->

@endpush
@push("customCss")



@endpush


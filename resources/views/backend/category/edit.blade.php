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
                                    Kategori Ekleme
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form id="categoryForm" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Kategori Adı
                                </label>
                                <div class="col-lg-4">
                                    <input type="email" name="tittle" class="form-control m-input"
                                           value="{{$category->tittle}}">

                                </div>


                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Kategori Resmi
                                </label>
                                <div class="col-lg-4">
                                    <div class="m-input-icon m-input-icon--right">
                                        <input id="logoImage" type="file" name="image" class="form-control m-input">

                                    </div>

                                </div>
                                <label class="col-lg-2 col-form-label">
                                    Yüklü Resim
                                </label>
                                <div class="col-lg-3">
                                    <div class="m-input-icon m-input-icon--right">
                                       {!!  $category->thumb !!}
                                    </div>

                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">

                                </label>
                                <div class="col-lg-4">
                                    <img class="img-fluid"   id="logoImageShow" src=""
                                         alt="">
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <button type="button" id="categoryCreate" class="btn btn-success">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            Cancel
                                        </button>
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


        $("#categoryCreate").on("click", function () {
            var form = new FormData($("#categoryForm")[0]);

            $(".has-error").removeClass("has-error");
            $(".label-danger").remove();

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
                url: "{{route("backend.category.update",["id"=>$category->id])}}",
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
                    window.location.href = "{{route("backend.category.index")}}";

                },
                error: function (response) {
                    swal.close();

                    $.each(response.responseJSON.errors, function (k, v) {
                        $.each(v, function (kk, vv) {
                            $("[name='" + k + "']").parent().addClass("has-error");
                            $("[name='" + k + "']").parent().append(" <span class=\"label label-danger\">" + vv + "</span>");
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

@endpush
@push("customCss")



@endpush


@extends("layouts.backend")
@section("tittle")
@section("content")
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Ayarlar

                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">

                            <i class="m-nav__link-icon la la-gear"></i>

                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">

                    <!--begin::Portlet-->
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                    <h3 class="m-portlet__head-text">
                                        Genel Ayarlar
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right" id="settingForm">
                            <div class="m-portlet__body m-form m-form--state ">
                                @foreach($settings as $setting)
                                    <div class="form-group m-form__group row ">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            {{trans("forms.".$setting->name)}}
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control m-input" name="{{$setting->name}}" type="text"
                                                   value="{{$setting->value}}"
                                                   id="example-text-input">
                                        </div>
                                    </div>



                                @endforeach

                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-10">
                                            <button type="button" id="settingUpdate" class="btn btn-success">
                                                Güncelle
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--end::Portlet-->

                </div>

            </div>
        </div>
    </div>
@endsection
@push("customJs")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>
    <script>

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
        });


        $("#settingUpdate").on("click", function () {
            var form = new FormData($("#settingForm")[0]);

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
                url: "{{route("backend.setting.update")}}",
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

@endpush
@push("customCss")



@endpush


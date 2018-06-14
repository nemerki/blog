@extends("layouts.backend")
@section("tittle")
@section("content")
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Kullanıcı Düzenle
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-user"></i>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
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
                                        {{$user->name}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed  m-form--state "
                              id="userForm">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>
                                            İsim:
                                        </label>
                                            <input type="text" class="form-control m-input" name="name"
                                                   value="{{$user->name}}">


                                    </div>
                                    <div class="col-lg-6">
                                        <label>
                                            Email:
                                        </label>

                                        <input type="email" name="email" class="form-control m-input"
                                               value="{{$user->email}}">


                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>
                                            Şifre:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="password" name="password" class="form-control m-input"
                                                   placeholder="Şifre Giriniz">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
															<span>
																<i class="la la-key"></i>
															</span>
														</span>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <label>
                                            Şifre Tekrar:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="password" name="password_confirmation"
                                                   class="form-control m-input" placeholder="Şifre Giriniz">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
															<span>
																<i class="la la-key"></i>
															</span>
														</span>
                                        </div>

                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>
                                            Yetki:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <select class="form-control m-select2" id="m_select2_11" multiple
                                                    name="role[]">
                                                @foreach($allroles as $allrole)

                                                    <option
                                                        {{collect($roles)->contains($allrole->id) ? 'selected' : ''}}
                                                        value="{{$allrole->id}}">{{$allrole->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="button" id="userUpdate" class="btn btn-primary">
                                                Güncelle
                                            </button>
                                            <a href="{{route("backend.user.index")}}">
                                                <button type="button" class="btn btn-secondary">
                                                    İptal
                                                </button>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->

                </div>
            </div>
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


        $("#userUpdate").on("click", function () {
            var form = new FormData($("#userForm")[0]);

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
                url: "{{route("backend.user.update",["id"=>$user->id])}}",
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


        $(function () {
            $("#m_select2_11").select2({
                placeholder: "Yetki Seçin",
                allowClear: true
            });
        });
    </script>
    <!--begin::Page Resources -->
    <script src="{{asset("assets/backend/demo/default/custom/crud/forms/widgets/select2.js")}}"
            type="text/javascript"></script>
    <!--end::Page Resources -->



@endpush
@push("customCss")



@endpush


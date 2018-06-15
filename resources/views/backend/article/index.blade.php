@extends("layouts.backend")
@section("tittle")
@section("content")
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Makaleler
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-users"></i>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tüm Makaleler
                            </h3>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-4">
                                        <div class="m-form__group m-form__group--inline">
                                            <div class="m-form__label">
                                                <label>
                                                    Status:
                                                </label>
                                            </div>
                                            <div class="m-form__control">
                                                <select class="form-control m-bootstrap-select" id="m_form_status">
                                                    <option value="">
                                                        All
                                                    </option>
                                                    <option value="1">
                                                        Pending
                                                    </option>
                                                    <option value="2">
                                                        Delivered
                                                    </option>
                                                    <option value="3">
                                                        Canceled
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="m-form__group m-form__group--inline">
                                            <div class="m-form__label">
                                                <label class="m-label m-label--single">
                                                    Type:
                                                </label>
                                            </div>
                                            <div class="m-form__control">
                                                <select class="form-control m-bootstrap-select" id="m_form_type">
                                                    <option value="">
                                                        All
                                                    </option>
                                                    <option value="1">
                                                        Online
                                                    </option>
                                                    <option value="2">
                                                        Retail
                                                    </option>
                                                    <option value="3">
                                                        Direct
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" class="form-control m-input" placeholder="Search..."
                                                   id="generalSearch">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                <a href="{{route("backend.article.create")}}"
                                   class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
												<span>
													<i class="la la-cart-plus"></i>
													<span>
														Yeni Makale
													</span>
												</span>
                                </a>
                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <table class="m-datatable" id="html_table" width="100%">
                        <thead>
                        <tr>
                            <th>
                                Resim
                            </th>
                            <th>
                                Başlık
                            </th>
                            <th>
                                Yazar
                            </th>
                            <th>
                                Kategori
                            </th>
                            <th>
                                Yayınlanma Tarihi
                            </th>
                            <th>
                                Durum
                            </th>
                            <th>
                                İşlem
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @php($i=0)
                        @foreach($articles as $article)
                            @php($i++)
                            <tr>

                                <td>
                                    {!! $article->thumb !!}
                                </td>
                                <td>
                                    {!! $article->title !!}
                                </td>
                                <td>
                                    {{$article->user->name}}
                                </td>
                                <td>
                                    {{$article->category->tittle}}
                                </td>
                                <td>
                                    {{$article->created_at->diffForHumans()}}
                                </td>
                                <td>
                                    <span class="m-switch m-switch--lg m-switch--icon">
                                        <label>
                                            <input class="status" type="checkbox" name="status"
                                                   data-id="{{$article->id}}" {{$article->status ? "checked" : null}}>
											<span> </span>
										</label>
									 </span>
                                </td>
                                <td>
                                    <a href="{{route("backend.article.edit",["id"=>$article->id])}}"
                                       class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                       title="Düzenle"> <i class="la la-edit"></i> </a>
                                    <button
                                        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill  "
                                        title="Sil"><i data-id="{{$article->id}}"
                                                       class="la la-trash articleDelete"></i>
                                    </button>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push("customJs")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>

    <script>


        $("#html_table").on("click", ".articleDelete", function () {
            var button = $(this);

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
                url: "{{route("backend.article.delete")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: button.data("id")
                },
                success: function (response) {
                    if (response.status == "success") {
                        button.closest("tr").remove();
                    }
                    swal.close();
                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                        timer: 2000
                    });
                },
                error: function (response) {
                    console.log(response);
                }
            })
        });


        $("#html_table").on("change", ".status", function (event, state) {
            var button = $(this);
            if ($(this).is(":checked")) {
                $.ajax({
                    type: "post",
                    url: "{{route("backend.article.status")}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: button.data("id"),
                        status: 1,
                    },
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (response) {
                        console.log(response);
                    }
                })

            } else {
                $.ajax({
                    type: "post",
                    url: "{{route("backend.article.status")}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: button.data("id"),
                        status: 0,
                    },
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (response) {
                        console.log(response);
                    }
                })
            }


        });
    </script>


    <!--begin::Page Resources -->
    <script src="{{asset("assets/backend/demo/default/custom/crud/metronic-datatable/base/html-table.js")}}"
            type="text/javascript"></script>
    <!--end::Page Resources -->
@endpush
@push("customCss")
    {{--<style>--}}
    {{--.m-datatable__cell span {--}}
    {{--width:  auto !important;--}}
    {{--}--}}

    {{--.m-datatable__cell--sort span {--}}
    {{--width:   min-content !important;--}}
    {{--}--}}
    {{--</style>--}}

@endpush


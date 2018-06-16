@extends("layouts.frontend")
@section("tittle")
@section("content")
    <div class="container">
        <div class="row">


            <table id="html_table" class="table table-striped">
                <a href="{{route("frontend.article.create")}}" class="btn btn-primary ml-auto">Ekle</a>
                <thead>
                <tr>
                    <th width="200">
                        Resim
                    </th>
                    <th>
                        Başlık
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
                @foreach($articles as $article)
                    <tr class="gradeX">
                        <td>
                            {!! $article->thumb !!}
                        </td>
                        <td>
                            {!! $article->title !!}
                        </td>

                        <td>
                            {{$article->category->tittle}}
                        </td>
                        <td>
                            {{$article->created_at->diffForHumans()}}
                        </td>
                        <td>{{$article->status==1?"Aktif":"Onay Bekliyor"}}</td>
                        <td class="center">
                            <a href="{{route("frontend.article.edit",["id"=>$article->id])}}">
                                <button data-id="{{$article->id}}" class="btn btn-primary btn-mini">
                                    Düzenle
                                </button>
                            </a>
                            <button data-id="{{$article->id}}" class="btn btn-danger btn-mini articleDelete">
                                Sil
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push("customJs")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.22.2/dist/sweetalert2.all.js"></script>
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
                url: "{{route("frontend.article.delete")}}",
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
    </script>

@endpush
@push("customCss")

@endpush


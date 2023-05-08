@extends('layouts/contentLayoutMaster')

@section('title', 'Formlar')

@section('content')

<!-- Table head options start -->
<div class="row" id="table-head">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kayıtlı Formlar</h4>
                <a href="{{route('CreateForm')}}" class="btn btn-gradient-primary float-end"> <i
                        data-feather='plus'></i> Yeni Form Ekle</a>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Oluşturulan iş ilanlarına buradaki listeden ulaşabilirsiniz
                </p>
            </div>
            <div class="table-responsive">
                @if($forms->isEmpty())
                <p>Henüz Form Yok</p>
                @else
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Form Başlığı</th>
                            <th class="text-center">Soru Sayısı</th>
                            <th class="text-center">Başvuru Sayısı</th>
                            <th class="text-center">Oluşturma Tarihi</th>
                            <th class="text-center">Detaylar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($forms as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->category_name}}<br>
                                <small class="text-muted">{{$data->city}}</small>
                            </td>
                            <td class="text-center"><span
                                    class="badge rounded-pill badge-light-primary me-1">{{$data->questions_count}}</span>
                            </td>
                            <td class="text-center"><span
                                    class="badge rounded-pill badge-light-success me-1">{{$data->applications_count}}</span>
                            </td>
                            <td class="text-center"><span
                                    class="badge rounded-pill badge-light-warning me-1">{{$data->created_at}}</span>
                            </td>
                            <td class="text-center"><a href="{{route('InspectApplicationForm', $data->id)}}"
                                    class="btn btn-outline-primary"> <i data-feather='list'></i> </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Table head options end -->


@endsection

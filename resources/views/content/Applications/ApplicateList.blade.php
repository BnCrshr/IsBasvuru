@extends('layouts/contentLayoutMaster')

@section('title', 'Başvurular')

@section('content')

<!-- Table head options start -->
<div class="row" id="table-head">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kayıtlı Başvurular</h4>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Başvurulara, buradaki listeden ulaşabilirsiniz
                </p>
            </div>
            <div class="table-responsive">
                @if($savedapplications->isEmpty())
                <p>Henüz Başvuru Yok</p>
                @else
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Başvuru Alanı</th>
                            <th>Ad-Soyad</th>
                            <th>Başvuru Tarihi</th>
                            <th>Son İşlem Tarihi</th>
                            <th>Şehir</th>
                            <th>Durum</th>
                            <th>Detaylar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($savedapplications as $data)
                        <tr>
                            <td>{{$i++}}</td>

                            <td>{{$data["applicatecategorys"]->category_name }}</td>
                            <td>{{$data->name}} {{$data->id}}</td>
                            <td>{{$data->created_at->format('d.m.Y H:i')}}</td>

                            @php
                            $status = $data["comments"]->last() != null ?
                            $data["comments"]->last()->created_at->format('d.m.Y H:i') : ''
                            @endphp
                            <td><span class="font-weight-bold">
                                    @if(empty($status))
                                    Henüz İşlem Yok
                                    @else
                                    {{($status)}}
                                    @endif
                            <td>{{$data->city}}</td>

                            @isset($data["comments"])
                            @if($data["comments"]->isNotEmpty())
                            @php
                            $status = "";
                            switch($data["comments"]->last()->status) {
                            case 1:
                            $status = "Yeni Başvuru";
                            break;
                            case 2:
                            $status = "Telefon Görüşmesi";
                            break;
                            case 3:
                            $status = "E-posta";
                            break;
                            case 4:
                            $status = "Zoom Toplantısı";
                            break;
                            case 5:
                            $status = "Mülakat";
                            break;
                            case 6:
                            $status = "Olumlu";
                            break;
                            case 7:
                            $status = "Olumsuz";
                            break;
                            }
                            @endphp
                            <td class="text-center"><span
                                    class="badge badge-pill badge-light-warning mr-1">{{ $status }}</span>
                            </td>
                            @else
                            <td class="text-center"><span class="badge badge-pill badge-light-warning mr-1">Yeni
                                    Başvuru</span></td>
                            @endif
                            @else
                            <td class="text-center"><span class="badge badge-pill badge-light-warning mr-1">Yeni
                                    Başvuru</span></td>
                            @endisset

                            <td><a href="{{route('ApplicatedUserPage', $data->id)}}" class="btn btn-outline-primary"> <i
                                        data-feather='list'></i> </a></td>
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

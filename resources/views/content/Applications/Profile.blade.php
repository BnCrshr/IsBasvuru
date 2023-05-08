@extends('layouts/contentLayoutMaster')

@section('title', $inspectapplicant->name)

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')

<div id="user-profile">
    <!-- profile header -->
    <div class="row">
        <div class="col-12">
            <div class="card profile-header mb-2">
                <!-- profile cover photo -->
                <img class="card-img-top" src="{{asset('images/profile/user-uploads/kctek.png')}}"
                    alt="User Profile Image" />
                <!--/ profile cover photo -->

                <div class="position-relative">
                    <!-- profile picture -->
                    <div class="profile-img-container d-flex align-items-center">
                        <div class="profile-img">
                            <img src="https://media.licdn.com/dms/image/C4D0BAQGewvzxcLnxgQ/company-logo_200_200/0/1605526309164?e=2147483647&v=beta&t=fjmZJdbwEZQOR3LPxAgrYk88YouKkwc4GQnJCAfQ4OA"
                                class="rounded img-fluid" alt="Card image" />
                        </div>
                        <!-- profile title -->
                        <div class="profile-title ms-3">
                            <h2 class="text-dark">{{$inspectapplicant->name}}</h2>
                            <p class="text-dark">{{$inspectapplicant->created_at}}</p>
                        </div>
                    </div>
                </div>

                <!-- tabs pill -->
                <div class="profile-header-nav">
                    <!-- navbar -->
                    <nav
                        class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                        <!-- collapse  -->
                        <div class="d-flex justify-content-end w-100 mt-1 mt-md-0">


                            <div class="m-1">
                                <a href="{{route('DestroyApplicant', $inspectapplicant->id )}}"
                                    class="btn btn-gradient-danger">
                                    <span class="fw-bold d-block"> <b><i data-feather='user-x'></i></b>
                                        Başvuruyu Sil</span>
                                </a>
                            </div>

                        </div>
                        <!--/ collapse  -->
                    </nav>
                    <!--/ navbar -->
                </div>
            </div>
        </div>
    </div>
    <!--/ profile header -->

    <!-- profile info section -->
    <section id="profile-info">

        <div class="row">

            <!-- BAŞLANGIÇ: SAYFANOIN SOL KISMI -->
            <div class="col-lg-3 col-12 order-2 order-lg-1">
                <!-- DİĞER BİLGİLER -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-75">Diğer Bilgiler</h5>
                        <div class="mt-2">
                            <h5 class="mb-75">Durum:</h5>
                            <span class="badge rounded-pill bg-primary">
                                @if($inspectapplicant["comments"]->whereNotNull('status')->count() > 0)
                                <?php $lastStatus = $inspectapplicant["comments"]->whereNotNull('status')->last(); ?>

                                @if ($lastStatus->status==1)
                                Yeni Başvuru
                                @elseif ($lastStatus->status==2)
                                Telefon Görüşmesi
                                @elseif ($lastStatus->status==3)
                                E-posta
                                @elseif ($lastStatus->status==4)
                                Zoom Toplantısı
                                @elseif ($lastStatus->status==5)
                                Mülakat
                                @elseif ($lastStatus->status==6)
                                Olumlu
                                @elseif ($lastStatus->status==7)
                                Olumsuz
                                @else
                                Yeni Başvuru
                                @endif

                                @else
                                Yeni Başvuru
                                @endif
                            </span>
                            {{-- <span class="badge rounded-pill bg-primary">Primary</span> --}}
                        </div>
                        <div class="mt-2">
                            <h5 class="mb-75">Şehir:</h5>
                            <p class="card-text">{{$inspectapplicant->city}}</p>
                        </div>
                        <div class="mt-2">
                            <h5 class="mb-50">Başvuru Alanı:</h5>
                            <a href="{{route('InspectApplicationForm', $inspectapplicant['applicatecategorys']->id)}}"
                                class="card-text mb-0"> {{$inspectapplicant['applicatecategorys']->category_name}}</a>
                        </div>
                    </div>
                </div>
                <!--/ DİĞER BİLGİLER -->

                <!-- YORUMLAR -->
                <form action="{{route('newComment', $inspectapplicant->id)}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body profile-suggestion">
                            <div class="row">
                                <h5 class="mb-2">Yorum Yaz</h5>
                                <!-- user suggestions -->
                                <label class="form-label" for="select2-basic">Yorum Kategorisi Seçiniz</label>
                                <div class="d-flex justify-content-start align-items-center mb-1">
                                    <select class="select2 form-select" id="select2-basic" name="comment_category">
                                        <option value="1">Olumlu</option>
                                        <option value="2">Olumsuz</option>
                                    </select>
                                </div>
                                <!-- user suggestions -->

                                <div class="mb-1">
                                    <fieldset class="mb-75">
                                        <label class="form-label" for="label-textarea">Yorum</label>
                                        <textarea class="form-control" id="label-textarea" rows="3"
                                            placeholder="Yorum Yaz" name="comment"></textarea>
                                        <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                                    </fieldset>
                                </div>


                                <div class="col-12 ">
                                    <button type="submit"
                                        class="btn btn-sm btn-gradient-primary float-end">Kaydet</button>
                                </div>
                            </div>


                            <div class="row mt-1">
                                <div class="col-12">
                                    <h5 class="mb-2">Mevcut Yorumlar</h5>

                                    @foreach($inspectapplicant["comments"] as $comment)
                                    @if(empty($comment->comment))
                                    @continue
                                    @endif
                                    <div
                                        class="card shadow-none bg-transparent border mb-1 @if($comment->comment_category==1) border-success @elseif($comment->comment_category==2) border-danger @endif">
                                        <div class="card-body">

                                            <div class="profile-user-info">
                                                <h6 class="mb-0">Murat Ertunç</h6>
                                                <small class="text-muted">{{$comment->created_at->format('d.m.Y H:i')}}
                                                </small>
                                                <span
                                                    class="badge rounded-pill @if($comment->comment_category==1) bg-success @elseif($comment->comment_category==2) bg-danger @endif bg-glow">@if($comment->comment_category==1)
                                                    Olumlu @elseif($comment->comment_category==2) Olumsuz @endif</span>
                                            </div>

                                            <p class="card-text">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>



                        </div>
                    </div>
                </form>
                <!-- YORUMLAR -->

            </div>
            <!-- BİTİŞ: SAYFANIN SOL KISMI -->
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                @if (!$questions->where('category', 6, 0)->isEmpty())
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h6 class="mb-0">Yetenekler</h6>
                                <small class="text-muted">{{$inspectapplicant->created_at->format('d.m.Y H:i')}}</small>
                            </div>
                        </div>
                        <p class="card-text">
                            Başvuru formunda yer alan sorulara verdiği cevaplara buradan ulaşabilirsiniz
                        </p>

                        <div class="table-responsive">
                            <table class="table text-nowrap text-center border-bottom">
                                <thead>
                                    <tr>
                                        <th class="text-start">Soru</th>
                                        <th>Hiçbir Fikrim <br> Yok</th>
                                        <th>Adını Duydum ve <br> Merak Ediyorum</th>
                                        <th>Sadece Basit Bir <br> Projede Kullandım</th>
                                        <th>Biliyorum ve <br> Kullanıyorum</th>
                                        <th>Çok İyi <br> Biliyorum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions->where('category', 6) as $defquestion)
                                    <tr>
                                        <td class="text-start"> {{$defquestion->question}}</td>
                                        @for ($i = 1; $i <= 5; $i++) <td>
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox"
                                                    id="answer-{{$defquestion->id}}-{{$i}}"
                                                    {{ $i == $defquestion->answer->answer ? 'checked' : '' }}
                                                    disabled />
                                            </div>
                                            </td>
                                            @endfor
                                    </tr>
                                    @endforeach

                                    @foreach ($questions->where('category', 0) as $defquestion)
                                    <tr>
                                        <td class="text-start"> <span style="color: green; font-size: 20px;">•</span>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Kullanıcının Eklediği Yetenek"> {{$defquestion->question}}</td>
                                        @for ($i = 1; $i <= 5; $i++) <td>
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox"
                                                    id="answer-{{$defquestion->id}}-{{$i}}"
                                                    {{ $i == $defquestion->answer->answer ? 'checked' : '' }}
                                                    disabled />
                                            </div>
                                            </td>
                                            @endfor
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @php $counter = 0 @endphp
                @foreach ($questions as $data)
                @php $counter++ @endphp

                @if ($data->category==7)
                <div class="card">
                    <div class="card-body profile-suggestion">
                        <h5 class="mb-2"> <b>{{ $counter}}- </b>{{$data->question}}</h5>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                @if ($data->answer)
                                    <input class="form-control" readonly
                                        value="{{ $data->answer->answer }}"
                                        id="html5-text-input">
                                @else
                                    <p>Bu soruya cevap verilmemiştir</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($data->category==3)
                <div class="card">
                    <div class="card-body profile-suggestion">
                        <h5 class="mb-2"> <b>{{ $counter}}- </b>{{$data->question}}</h5>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                @if ($data->answer)
                                    <input class="form-control" readonly
                                        value="{{ $data->answer->answer }}"
                                        id="html5-text-input">
                                @else
                                    <p>Bu soruya cevap verilmemiştir</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($data->category==2)
                <div class="card">
                    <div class="card-body profile-suggestion">
                        <h5 class="mb-2"> <b>{{ $counter}}- </b>{{$data->question}}</h5>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                @if ($data->answer)
                                    <input class="form-control" readonly
                                        value="{{ $data->answer->answer }}"
                                        id="html5-text-input">
                                @else
                                    <p>Bu soruya cevap verilmemiştir</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($data->category==1)
                <div class="card">
                    <div class="card-body profile-suggestion">
                        <h5 class="mb-2"> <b>{{ $counter}}- </b>{{$data->question}}</h5>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                @if ($data->answer)
                                    <input class="form-control" readonly
                                        value="{{ $data->answer->answer }}"
                                        id="html5-text-input">
                                @else
                                    <p>Bu soruya cevap verilmemiştir</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($data->category==4)
                <div class="card">
                    <div class="card-body profile-suggestion">
                        <h5 class="mb-2"> <b>{{ $counter}}- </b>{{$data->question}}</h5>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                @if ($data->answer)
                                    <input class="form-control" readonly
                                        value="{{ $data->answer->answer }}"
                                        id="html5-text-input">
                                @else
                                    <p>Bu soruya cevap verilmemiştir</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                @if ($data->category==5)
                <div class="card">
                    <div class="card-body profile-suggestion">
                        <h5 class="mb-2"> <b>{{ $counter}}- </b>{{$data->question}}</h5>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                @if ($data->answer)
                                    <input class="form-control" readonly
                                        value="{{ $data->answer->answer }}"
                                        id="html5-text-input">
                                @else
                                    <p>Bu soruya cevap verilmemiştir</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($data->category==8)
                <div class="card">
                    <div class="card-body profile-suggestion">
                        <h5 class="mb-2"> <b>{{ $counter}}- </b>{{$data->question}}</h5>
                        <div class="mb-3 row">
                            <div class="col-md-12 row">
                                <div class="input-group">
                                    @if ($data->answer)
                                        <a href="{{route('downloadCV', $data->answer->id)}}"
                                            class="btn btn-outline-primary waves-effect"
                                            type="button" id="button-addon1">İndir</a>
                                        <input type="text" class="form-control" readonly
                                            value="{{ $data->answer->answer}}">
                                    @else
                                        <a href="#" class="btn btn-outline-primary waves-effect disabled"
                                            type="button" id="button-addon1">İndir</a>
                                        <input type="text" class="form-control" readonly
                                            value="Bu soruya cevap verilmemiştir">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach


                <div class="card">
                    <form action="{{route('newStatus', $inspectapplicant->id)}}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body profile-suggestion">
                                <h5 class="mb-2">Durum Yaz</h5>
                                <!-- user suggestions -->
                                <label class="form-label" for="select2-basic">Durum Kategorisi Seçiniz</label>
                                <div class="d-flex justify-content-start align-items-center mb-1">
                                    <select class="select2 form-select" id="select2-basic" name="status">
                                        <option value="1">Yeni Başvuru</option>
                                        <option value="2">Telefon Görüşmesi</option>
                                        <option value="3">E-Posta</option>
                                        <option value="4">Zoom Toplantısı</option>
                                        <option value="5">Mülakat</option>
                                        <option value="6">Olumlu</option>
                                        <option value="7">Olumsuz</option>
                                    </select>
                                </div>
                                <!-- user suggestions -->

                                <div class="mb-1">
                                    <fieldset class="mb-75">
                                        <label class="form-label" for="label-textarea">Durum</label>
                                        <textarea class="form-control" id="label-textarea" rows="3"
                                            placeholder="Durum Açıklaması Yaz" name="status_exp"></textarea>
                                        <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                                    </fieldset>
                                </div>

                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-sm btn-gradient-primary float-end">Kaydet</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <div class="profile-user-info">
                                <h6 class="mb-0">Durum</h6>
                            </div>
                        </div>
                        <div class="row" id="table-head">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="10%">Durum</th>
                                                    <th width="15%" class="text-center">Detay</th>
                                                    <th>Açıklama</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($inspectapplicant["comments"] as $status)
                                                @if(empty($status->status_exp))
                                                @continue
                                                @endif
                                                <tr>
                                                    <td>
                                                        <span class="badge rounded-pill bg-primary bg-glow">
                                                            @if ($status->status==1)
                                                            İlk Başvuru
                                                            @elseif ($status->status==2)
                                                            Telefon Görüşmesi
                                                            @elseif ($status->status==3)
                                                            E-posta
                                                            @elseif ($status->status==4)
                                                            Zoom Toplantısı
                                                            @elseif ($status->status==5)
                                                            Mülakat
                                                            @elseif ($status->status==6)
                                                            Olumlu
                                                            @elseif ($status->status==7)
                                                            Olumsuz
                                                            @else
                                                            Hata
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class=" text-center">
                                                        <span class="badge rounded-pill bg-primary bg-glow">
                                                            Murat Ertunç <br>
                                                            {{$status->created_at->format('d.m.Y H:i')}}
                                                        </span>
                                                    </td>
                                                    <td>{{ $status->status_exp }}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ profile info section -->
</div>
@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection

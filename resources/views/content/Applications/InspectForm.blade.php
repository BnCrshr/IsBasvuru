@extends('layouts/contentLayoutMaster')

@php
$categoryName = $form->category_name;
@endphp


@section('title', $categoryName)

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"> </script>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.css">


<section id="card-navigation">
    <div class="card col-12 p-2">
        <h4 class="card-title">Form Bilgileri
        </h4>
        <div class="row match-height">
            <div class="col-md-6 col-xl-6 ">
                <div class="card shadow-none bg-transparent border border-primary text-center">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Toplam Başvuru:
                            <b>{{ $form->applications->count() }}</b></li>
                        <li class="list-group-item">Toplam Soru Sayısı:
                            <b>{{ $form->questions->count() }}</b></li>
                        <li class="list-group-item">Şube: <b>{{$form->city}}</b></li>
                        <li class="list-group-item">Oluşturma Tarihi:
                            <b>{{$form->created_at->format('d.m.Y - H:i')}}</b></li>
                        <li class="list-group-item">
                            <a href="/form/{{$form->slug}}" class="btn btn-gradient-primary"> <i
                                    data-feather='list'></i> Başvuru Formu</a>

                            <div class="modal-size-lg d-inline-block">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-gradient-warning" data-bs-toggle="modal"
                                    data-bs-target="#large">
                                    <i data-feather='edit'></i> Formu Düzenle
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-start" id="large" tabindex="-1"
                                    aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel17">Formu
                                                    Düzenle</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('UpdateForm', $form->id)}}" method="post">
                                                    @csrf

                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label">Form
                                                            Başlığı</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="colFormLabel"
                                                                placeholder="Normal Input" name="category_name"
                                                                value="{{$form->category_name}}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label">Şube
                                                            Seçiniz</label>
                                                        <div class="col-sm-9">
                                                            <select class="select2 form-select" id="select2-multiple"
                                                                multiple name="city[]">
                                                                <optgroup label="Şubeler">
                                                                    <option value="İstanbul"
                                                                        {{ str_contains($form->city, 'İstanbul') ? 'selected' : '' }}>
                                                                        İstanbul</option>
                                                                    <option value="Ankara"
                                                                        {{ str_contains($form->city, 'Ankara') ? 'selected' : '' }}>
                                                                        Ankara</option>
                                                                    <option value="Kayseri"
                                                                        {{ str_contains($form->city, 'Kayseri') ? 'selected' : '' }}>
                                                                        Kayseri</option>
                                                                    <option value="Kocaeli"
                                                                        {{ str_contains($form->city, 'Kocaeli') ? 'selected' : '' }}>
                                                                        Kocaeli</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel"
                                                            class="col-sm-3 col-form-label">Açıklama</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id="explanationedit"
                                                                rows="14" placeholder="Açıklama Giriniz"
                                                                name="explanation">{{$form->explanation}}</textarea>
                                                        </div>
                                                    </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-gradient-primary"
                                                    data-bs-dismiss="modal"> <i data-feather='save'></i> Kaydet
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{route('DestroyForm', $form->id)}}" class="btn btn-gradient-danger"> <i
                                    data-feather='trash-2'></i> Formu Sil</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 col-xl-6">
                <div class="card shadow-none bg-transparent border border-primary overflow-hidden p-1">
                    <div class="row">
                        <div class="card-title">
                            <h5 class="card-title">Açıklama</h5>
                        </div>
                    </div>

                    <div class="card-text scrollable-container" style="max-height:300px;">
                        <div id="myText">{!! $form->explanation !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card col-12 p-2">
        <div class="card-header pt-0">
            <h4 class="card-title">Form Soruları
            </h4>
            <div class="modal-size-default d-inline-block">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#defaultSize">
                    <i data-feather='plus'></i> Form'a Yeni Soru Ekle
                </button>
                <!-- Modal -->
                <div class="modal fade text-start" id="defaultSize" tabindex="-1" aria-labelledby="myModalLabel18"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel18">Soru Ekle
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{route('saveNewQuestion', $form->id)}}" method="post" id="addquestion">
                                @csrf
                                <input type="hidden" id="formQuestionData" name="category">

                                <div class="p-1">
                                    <select class="form-select" aria-label="Soru Tipi" id="soru-tipi">
                                        <option selected disabled>Soru Tipi Seçiniz</option>
                                        <option value="1">Metin Alanı Kısa Cevap</option>
                                        <option value="3">Metin Alanı Uzun Cevap</option>
                                        <option value="2">İnput (Sayı)</option>
                                        <option value="5">İnput (Tarih)</option>
                                        <option value="4">Doğru <b>-</b> Yanlış</option>
                                        <option value="6">Varsayılan Şıklı Soru</option>
                                        <option value="7">Şıklı Soru</option>
                                    </select>
                                </div>
                                <div id="soru-input"></div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-gradient-primary" data-bs-dismiss="modal"
                                        id="savebutton"> <i data-feather='save'></i> Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th width="70%">Soru Metni</th>
                        <th width="30%">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sortedQuestions = $form["questions"]->sortBy('question_order'); ?>
                    @foreach ($sortedQuestions as $questiondata)
                    <tr>
                        <td>
                        @if ($questiondata->category == 6)
                        -
                        @else
                        {{ $questiondata->question_order }}
                        @endif
                        </td>
                        <td>{{$questiondata->question}}</td>
                        <td>
                            <div class="modal-size-default d-inline-block">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit-{{$questiondata->id}}">
                                    <i data-feather="edit"></i>
                                    Soruyu Düzenle
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-start" id="edit-{{$questiondata->id}}" tabindex="-1"
                                    aria-labelledby="myModalLabel18" aria-hidden="true">
                                    <form action="{{route('UpdateQuestion', $questiondata->id)}}" method="post">
                                        @csrf
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel18">Soruyu
                                                        Düzenle</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" class="form-control" id="basicInput"
                                                        placeholder="Java" value="{{$questiondata->question}}"
                                                        name="question">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-gradient-primary"
                                                        data-bs-dismiss="modal">Kaydet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <a href="{{route('DestroyQuestion', $questiondata->id)}}" type="button"
                                class="btn btn-outline-danger"
                                onclick="return confirm('Soruyu silmek istediğinize eminmisiniz ?')"><i
                                    data-feather="trash"></i> Soruyu Sil</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card col-12 p-2">
        <div class="card-header pt-0">
            <h4 class="card-title">{{$form->category_name}} Soruları</h4>
        </div>
        <div class="table-responsive">
            <table class="table" id="applications">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th width="70%">Ad-Soyad</th>
                        <th width="10%">Başvuru Tarihi</th>
                        <th width="10%">Son İşlem</th>
                        <th width="10%">Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @if(count($form["applications"]) > 0)
                    @foreach ($form["applications"] as $applicatedata)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><a href="{{route('ApplicatedUserPage', $applicatedata->id)}}">{{$applicatedata->name}}</a>
                        </td>
                        <td> <span
                                class="badge badge-glow bg-primary">{{$applicatedata->created_at->format('H:i - d.m.Y')}}</span>
                        </td>
                        <td> <span
                                class="badge badge-glow bg-primary">{{$applicatedata->created_at->format('H:i - d.m.Y')}}</span>
                        </td>
                        @php
                        $status = $applicatedata["comments"]->last() != null ?
                        $applicatedata["comments"]->last()->status : ''
                        @endphp
                        <td> <span class="badge badge-glow bg-primary">
                                @if ($status==1)
                                İlk Başvuru
                                @elseif ($status==2)
                                Telefon Görüşmesi
                                @elseif ($status==3)
                                E-posta
                                @elseif ($status==4)
                                Zoom Toplantısı
                                @elseif ($status==5)
                                Mülakat
                                @elseif ($status==6)
                                Olumlu
                                @elseif ($status==7)
                                Olumsuz
                                @else
                                İlk Başvuru
                                @endif
                            </span> </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4" class="text-center">Henüz Başvuru Yok</td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</section>

<script>
    // Kategori seçildiğinde çalışacak fonksiyon
    let formData = [];

    function selectChanged() {
        var select = document.querySelector('#soru-tipi');
        var formSelect = document.getElementById('ilan');
        var saveButton = document.getElementById('savebutton');
        var formQuestionDataInput = document.getElementById('formQuestionData');
        var formAttribute = document.getElementById('addquestion');


        var selectedValue = select.value;
        var parentDiv = select.parentNode;
        console.log(selectedValue);

        if (selectedValue == '1') {
            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Metin Alanı Kısa Cevap';
            input1.name = 'question';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'
            orderIput.name = 'order'

            formQuestionDataInput.value = selectedValue;

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);

            select.style.display = 'none';
        }

        if (selectedValue == '2') {
            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'İnput (Sayı)';
            input1.name = 'question';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'
            orderIput.name = 'order'

            formQuestionDataInput.value = selectedValue;

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);

            select.style.display = 'none';
        }

        if (selectedValue == '3') {
            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Metin Alanı Uzun Cevap';
            input1.name = 'question';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'
            orderIput.name = 'order'

            formQuestionDataInput.value = selectedValue;

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);

            select.style.display = 'none';
        }

        if (selectedValue == '4') {
            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Doğru - Yanlış';
            input1.name = 'question';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'
            orderIput.name = 'order'

            formQuestionDataInput.value = selectedValue;


            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);

            select.style.display = 'none';
        }

        if (selectedValue == '5') {
            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Tarih Seçenekli Soru';
            input1.name = 'question';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'
            orderIput.name = 'order'

            formQuestionDataInput.value = selectedValue;

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);

            select.style.display = 'none';
        }

        if (selectedValue == '6') {
            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Varsayılan Seçenekli Soru';

            formQuestionDataInput.value = selectedValue;

            parentDiv.insertBefore(input1, select);

            select.style.display = 'none';
        }

        if (selectedValue == '7') {
            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Şıklı Soru';
            input1.name = 'question';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'
            orderIput.name = 'order'

            formQuestionDataInput.value = selectedValue;

            var choiceAddButton = document.createElement('button');
            choiceAddButton.className = 'btn btn-primary mx-1';
            choiceAddButton.textContent = 'Seçenek Ekle';

            var choiceInputs = [];

            choiceAddButton.addEventListener('click', function (event) {
                event.preventDefault();

                var newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.className = 'form-control my-1';
                newInput.name = 'choices[]';
                newInput.placeholder = (choiceInputs.length + 1) + '. Seçenek';
                newInput.id = 'choice-' + choiceInputs.length;
                parentDiv.insertBefore(newInput, choiceAddButton);

                choiceInputs.push(newInput);

                console.log(choiceInputs);
            });

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(choiceAddButton, select);

            select.style.display = 'none';
        }
    }

    // Kategori seçimi değiştiğinde selectChanged fonksiyonunu çalıştır
    var select = document.querySelector('#soru-tipi');
    select.addEventListener('change', selectChanged);

</script>

<script>
    ClassicEditor
        .create(document.querySelector('#explanationedit'))
        .catch(error => {
            console.error(error);
        });

</script>

@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCTEK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com" rel="stylesheet">


    <style>
        body {
            background-image: url('{{ asset('images/meeting.png') }}');
            font-family: 'Noto Sans', sans-serif;
        }

        .warning {
            color: red;
        }

        input::placeholder {
            opacity: 0.5;
            font-size: 14px;
        }

        .roboto {
            letter-spacing: 0.5px;
            font-family: Roboto;
        }

        textarea.no-resize {
            resize: none;
        }

        .card {
            --bs-card-bg: #ffffffbe;
        }

    </style>
</head>

<body>
    <form action="{{route('applicationsave', $deneme->first()->id)}}" method="post" enctype="multipart/form-data"
        id="ilan-form">
        @csrf
        <div class="col-12 row d-flex justify-content-center">

            <div class="col-xxl-4 col-xl-4 col-lg-8 col-md-10 col-sm-12 mt-3 mb-3">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title fs-3">{{$deneme->first()->category_name}}</h5>
                            <br>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                <div id="myText">{!! $deneme->first()->explanation !!}</div>
                                <script>
                                    // CKEditor'dan verileri al ve özel karakterleri kaçırma
                                    var editorData = "{!! $deneme->first()->explanation !!}";
                                    // editorData'da HTML etiketleri olabilir, ancak bu yöntemi kullanarak doğrudan yazdırabiliriz
                                    document.getElementById("myText").innerHTML = editorData;

                                </script>

                            </h6>
                            <hr>
                            <p class="card-text">Bu iş başvuru formu <b>{{$deneme->first()->city}}</b> şehri için
                                açılmıştır. </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-xxl-4 col-xl-4 col-lg-8 col-md-10 col-sm-12 mt-3 mb-3">

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title fs-6 roboto">1- Adınız Soyadınız <span style="color: red; font-size: 15px"
                                title="Bu Alan Zorunludur">*</span></h5>
                        <div class="mb-3 mt-4">
                            <input required type="text" maxlength="25" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="name" placeholder="Yanıtınızı girin">
                            @if ($errors->has('name'))
                            <div class="form-text warning mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                {{ $errors->first('name')}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title fs-6 roboto">2- Yaşadığınız Şehri Yazınız <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        <div class="mb-3 mt-4">
                            <input type="text" required class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="city" placeholder="Yanıtınızı girin">
                            @if ($errors->has('city'))
                            <div class="form-text warning mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                {{ $errors->first('city') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


                @php $counter = 2 @endphp

                @foreach ($questions as $question)
                @php $counter++ @endphp

                @if($question->category === 7)
                <div class="card mb-3">
                    <div class="card-body">
                        @if($question->required_status === 1)
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}} <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        @else
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}}</h5>
                        @endif
                        <div class="mb-3 mt-4">
                            @foreach ($question->questionChoices as $choice)
                            <div class="d-flex justify-content-between align-items-center my-4">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio"
                                        name="question[{{$question->question}}]" value="{{$choice->choice}}"
                                        placeholder="Yanıtınızı girin" @if($question->required_status === 1) required
                                    @endif>
                                    <span class="mx-1">{{$choice->choice}}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if($question->category === 5)
                <div class="card mb-3">
                    <div class="card-body">
                        @if($question->required_status === 1)
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}} <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        @else
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}}</h5>
                        @endif
                        <div class="mb-3 mt-4">
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="question[{{$question->question}}]" placeholder="Yanıtınızı girin"
                                @if($question->required_status === 1) required @endif>
                        </div>
                    </div>
                </div>
                @endif

                @if($question->category === 8)
                <div class="card mb-3">
                    <div class="card-body">
                        @if($question->required_status === 1)
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}} <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        @else
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}}</h5>
                        @endif
                        <div class="mb-3 mt-4">
                            <input type="file" class="form-control" id="exampleInputEmail1"
                                @if($question->required_status == 1) required @endif
                            aria-describedby="emailHelp" name="filequestion[{{$question->id}}]" placeholder="Yanıtınızı
                            girin">
                        </div>
                    </div>
                </div>
                @endif

                @if($question->category === 1)
                <div class="card mb-3">
                    <div class="card-body">
                        @if($question->required_status === 1)
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}} <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        @else
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}}</h5>
                        @endif
                        <div class="mb-3 mt-4">
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="question[{{$question->question}}]" placeholder="Yanıtınızı girin"
                                placeholder="Yanıtınızı girin" @if($question->required_status === 1) required @endif maxlength="300">
                        </div>
                    </div>
                </div>
                @endif

                @if($question->category === 2)
                <div class="card mb-3">
                    <div class="card-body">
                        @if($question->required_status === 1)
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}} <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        @else
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}}</h5>
                        @endif
                        <div class="mb-3 mt-4">
                            <input type="number" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="question[{{$question->question}}]"
                                placeholder="Yanıtınızı girin" placeholder="Yanıtınızı girin"
                                @if($question->required_status === 1) required @endif  maxlength="300">
                        </div>
                    </div>
                </div>
                @endif


                @if($question->category === 3)
                <div class="card mb-3">
                    <div class="card-body">
                        @if($question->required_status === 1)
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}} <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        @else
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}}</h5>
                        @endif
                        <div class="mb-3 mt-4">
                            <textarea class="form-control no-resize" id="explanation" rows="3"
                                placeholder="Yanıtınızı girin" name="question[{{$question->question}}]"
                                @if($question->required_status === 1) required @endif maxlength="600"></textarea>
                        </div>
                    </div>
                </div>
                @endif



                @if($question->category === 4)
                <div class="card mb-3">
                    <div class="card-body">
                        @if($question->required_status === 1)
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}} <span
                                style="color: red; font-size: 15px" title="Bu Alan Zorunludur">*</span></h5>
                        @else
                        <h5 class="card-title fs-6 roboto"> {{ $counter}}- {{$question->question}}</h5>
                        @endif
                        <div class="mb-3 mt-4 d-flex justify-content-around">
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="question[{{$question->question}}]"
                                    id="inlineRadio1" value="Doğru" placeholder="Yanıtınızı girin"
                                    @if($question->required_status === 1) required @endif>
                                <label class="form-check-label" for="inlineRadio1">Doğru</label>
                            </div>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="question[{{$question->question}}]"
                                    id="inlineRadio2" value="Yanlış" @if($question->required_status === 1) required
                                @endif>
                                <label class="form-check-label" for="inlineRadio2">Yanlış</label>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach



                @if(!$questions->where('category', 6)->isEmpty())
                @php $counter++ @endphp
                <div class="card mb-3">
                    <div class="card-body table-responsive">
                        <h6 class="card-subtitle mb-2 p-2" style="letter-spacing: 0.5px; font-family: Roboto">
                            {{ $counter}}- Aşağıdaki kodlama, betik dilleri, kütüphanelerden bilgi
                            düzeylerinizi seçiniz. <span style="color: red; font-size: 15px"
                                title="Bu Alan Zorunludur">*</span></h6>
                        <table class="table text-center col-12 ">
                            <thead>
                                <tr>
                                    <th scope="col-auto" class="align-middle"></th>
                                    <th scope="col-auto" class="align-middle roboto">Hiç bir fikrim yok</th>
                                    <th scope="col-auto" class="align-middle roboto">Adını duydum ve merak ediyorum</th>
                                    <th scope="col-auto" class="align-middle roboto">Sadece basit bir projede kullandım
                                    </th>
                                    <th scope="col-auto" class="align-middle roboto">Biliyorum ve kullanıyorum</th>
                                    <th scope="col-auto" class="align-middle roboto">Çok iyi biliyorum</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions->where('category', 6) as $choice )
                                <tr>
                                    <td scope="row" class="text-left roboto">{{$choice->question}}</td>
                                    <td> <label><input class="form-check-input" required type="radio"
                                                name="question[{{$choice->question}}]" value="1"></label> </td>
                                    <td> <label><input class="form-check-input" required type="radio"
                                                name="question[{{$choice->question}}]" value="2"></label> </td>
                                    <td> <label><input class="form-check-input" required type="radio"
                                                name="question[{{$choice->question}}]" value="3"></label> </td>
                                    <td> <label><input class="form-check-input" required type="radio"
                                                name="question[{{$choice->question}}]" value="4"></label> </td>
                                    <td> <label><input class="form-check-input" required type="radio"
                                                name="question[{{$choice->question}}]" value="5"></label> </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"> <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="questionAdd"
                                            placeholder="Eklemek istediğin yeteneğin mi var? Örn. WordPress"></td>
                                    <td> <button class="btn btn-success" id="add"> <b>+</b> </button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif


                <div class="mb-5">
                    <button class="btn btn-primary btn-lg float-end roboto" type="submit" id="confirm">Kaydet</button>
                </div>


            </div>


        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById("add").addEventListener("click", function (event) {
            event.preventDefault();
            var table = document.querySelector("table");
            var question = document.querySelector('input[name="questionAdd"]').value;
            if (question.trim() === '') { // eğer soru boş ise
                // input alanını temizle
                document.querySelector('input[name="questionAdd"]').value = '';
                return; // satır ekleme işlemini atla
            }
            var newRow = table.insertRow(table.rows.length - 1); // input satırının üstüne satır ekle
            var newCell = newRow.insertCell(0);
            newCell.innerHTML = question;
            for (var i = 0; i < 5; i++) {
                var cell = newRow.insertCell(i + 1);
                cell.innerHTML =
                    '<label><input class="form-check-input" required type="radio" name="question[' + question +
                    ']" value="' + (i + 1) + '"></label>';
            }
            // input alanını temizle
            document.querySelector('input[name="questionAdd"]').value = '';
        });

    </script>
</body>

</html>

@extends('layouts/contentLayoutMaster')

@section('title', 'Başvurular')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link
    href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap"
    rel="stylesheet">
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')


<section id="basic-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Oluştur</h4>
                </div>
                <form action="{{route('SaveForm')}}" method="post" id="ilan">
                    @csrf
                    <input type="hidden" id="formQuestionData" name="formQuestionData">

                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-6 col-md-12 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="basicInput">Form Başlığı</label>
                                    @error('category_name') <label class="form-label text-danger bold"
                                        for="basicInput">!</label> @enderror
                                    <input type="text" class="form-control" id="basicInput"
                                        placeholder="Front-End Developer" name="category_name"
                                        value="{{ old('category_name') }}" required />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12 col-12">
                                <label class="form-label" for="select2-multiple">Şubeler</label>
                                <select class="select2 form-select" id="select2-multiple" multiple name="city[]"
                                    aria-placeholder="Şube Seçiniz" required>
                                    <optgroup label="Şubeler">
                                        <option value="İstanbul"
                                            {{ in_array('İstanbul', old('city', [])) ? 'selected' : '' }}>İstanbul
                                        </option>
                                        <option value="Ankara"
                                            {{ in_array('Ankara', old('city', [])) ? 'selected' : '' }}>Ankara</option>
                                        <option value="Kayseri"
                                            {{ in_array('Kayseri', old('city', [])) ? 'selected' : '' }}>Kayseri
                                        </option>
                                        <option value="Kocaeli"
                                            {{ in_array('Kocaeli', old('city', [])) ? 'selected' : '' }}>Kocaeli
                                        </option>
                                    </optgroup>
                                </select>
                            </div>


                            <div class="col-xl-12 col-md-12 col-12 mb-1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="exampleFormControlTextarea1">Açıklama</label>
                                            @error('explanation') <label class="form-label text-danger bold"
                                                for="basicInput">!</label> @enderror
                                            <textarea class="form-control" id="explanation" rows="14"
                                                placeholder="Açıklama Giriniz"
                                                name="explanation">{{ old('explanation') }}</textarea>
                                        </div>
                                        <div class="mb-1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-md-12 col-12 row match-height">
                                <label class="form-label" for="exampleFormControlTextarea1">Form Soruları</label>
                                <div class="col-xl-4 col-md-12 col-12">
                                    <div class="card shadow-none bg-transparent border-primary">
                                        <div class="row" id="table-head">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body pb-0">
                                                        <p class="card-text" id="question-type">
                                                            Formunuza buradan soru ekleyebilirsiniz
                                                        </p>
                                                    </div>
                                                    <div class="p-1">
                                                        <select class="form-select" aria-label="Soru Tipi"
                                                            id="soru-tipi">
                                                            <option selected disabled>Soru Tipi Seçiniz</option>
                                                            <option value="1">Metin Alanı Kısa Cevap</option>
                                                            <option value="3">Metin Alanı Uzun Cevap</option>
                                                            <option value="2">İnput (Sayı)</option>
                                                            <option value="5">İnput (Tarih)</option>
                                                            <option value="8">İnput (Dosya)</option>
                                                            <option value="4">Doğru <b>-</b> Yanlış</option>
                                                            <option value="6">Varsayılan Şıklı Soru</option>
                                                            <option value="7">Şıklı Soru</option>
                                                        </select>
                                                    </div>
                                                    <div id="soru-input"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-8 col-md-12 col-12">
                                    <div class="card shadow-none bg-transparent border-primary">
                                        <div class="row" id="table-head">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body pb-0">
                                                        <p class="card-text">
                                                            Formunuza eklediğiniz sorulara buradaki listeden
                                                            ulaşabilirsiniz
                                                        </p>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table text-center">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Kategori</th>
                                                                    <th>Soru</th>
                                                                    <th>Cevap Zorunluluğu</th>
                                                                    <th>Sıra No</th>
                                                                    <th>Soruyu Sil</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="myTableBody">
                                                                <tr id="noDataRow">
                                                                    <td colspan="6">Henüz Soru Eklenmedi</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check-primary float-start mt-1">
                                    <input class="form-check-input" type="checkbox" id="customCheckPrimary" checked="">
                                    <label class="form-check-label" for="customCheckPrimary">Form Linki Otomatik
                                        Ayarlansın</label>
                                </div>
                                <script>
                                    const checkbox = document.querySelector('#customCheckPrimary');
                                    const label = checkbox.nextElementSibling;
                                    checkbox.addEventListener('change', function () {
                                        if (!this.checked) {
                                            const input = document.createElement('input');
                                            input.type = 'text';
                                            input.className = 'form-control';
                                            input.placeholder = 'Form Linki';
                                            input.name = 'slug';
                                            checkbox.parentNode.replaceChild(input, checkbox);
                                            label.parentNode.removeChild(label);
                                        }
                                    });

                                </script>
                                <button class="btn btn-gradient-primary float-end mx-2"> <i data-feather='save'></i>
                                    Kaydet </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    // Kategori seçildiğinde çalışacak fonksiyon
    let formData = [];

    function selectChanged() {
        var select = document.querySelector('#soru-tipi');
        var formSelect = document.getElementById('ilan');
        var questionTypeLabel = document.getElementById('question-type');

        var formQuestionDataInput = document.getElementById('formQuestionData');

        var selectedValue = select.value;
        var parentDiv = select.parentNode;
        console.log(selectedValue);

        if (selectedValue == '1') {

            questionTypeLabel.innerText = "Eklenen Soru Tipi: Metin Alanı Kısa Cevap";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Metin Alanı Kısa Cevap';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary float-end';
            okButton.textContent = 'Soruyu Ekle';

            var reqDiv = document.createElement("div");
            reqDiv.className = "form-check";

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input mr-3";
            checkbox.id = "reqinput";
            checkbox.checked = true;

            var reqtext = document.createElement("label");
            reqtext.className = "form-check-label";
            reqtext.for = "reqinput";
            reqtext.textContent = "Soruyu cevaplamak zorunlu olsun";

            reqDiv.appendChild(checkbox);
            reqDiv.appendChild(reqtext);


            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(reqDiv, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '' || orderIput.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = orderIput.value;
                const req_status = checkbox.checked ? 1 : 0;
                let data = {};

                data.category = category;
                data.question = question;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                orderIput.remove();
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();


                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

        if (selectedValue == '2') {
            questionTypeLabel.innerText = "Eklenen Soru Tipi: İnput (Sayı)";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'İnput (Sayı)';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary float-end';
            okButton.textContent = 'Soruyu Ekle';

            var reqDiv = document.createElement("div");

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input mr-3";
            checkbox.id = "reqinput";
            checkbox.checked = true;
            checkbox.value = "1";

            var reqtext = document.createElement("label");
            reqtext.type = "checkbox";
            reqtext.className = "form-check-label";
            reqtext.for = "reqinput";
            reqtext.textContent = "Soruyu cevaplamak zorunlu olsun";

            reqDiv.appendChild(checkbox);
            reqDiv.appendChild(reqtext);


            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(reqDiv, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '' || orderIput.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = orderIput.value;
                const req_status = checkbox.checked ? 1 : 0;
                let data = {};

                data.category = category;
                data.question = question;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                orderIput.remove();
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();

                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

        if (selectedValue == '3') {
            questionTypeLabel.innerText = "Eklenen Soru Tipi: Metin Alanı Uzun Cevap";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Metin Alanı Uzun Cevap';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary float-end';
            okButton.textContent = 'Soruyu Ekle';

            var reqDiv = document.createElement("div");

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input mr-3";
            checkbox.id = "reqinput";
            checkbox.checked = true;
            checkbox.value = "1";

            var reqtext = document.createElement("label");
            reqtext.type = "checkbox";
            reqtext.className = "form-check-label";
            reqtext.for = "reqinput";
            reqtext.textContent = "Soruyu cevaplamak zorunlu olsun";

            reqDiv.appendChild(checkbox);
            reqDiv.appendChild(reqtext);

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(reqDiv, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '' || orderIput.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = orderIput.value;
                const req_status = checkbox.checked ? 1 : 0;
                let data = {};

                data.category = category;
                data.question = question;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                orderIput.remove();
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();

                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

        if (selectedValue == '4') {
            questionTypeLabel.innerText = "Eklenen Soru Tipi: Doğru - Yanlış";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Doğru - Yanlış';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary float-end';
            okButton.textContent = 'Soruyu Ekle';

            var reqDiv = document.createElement("div");

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input mr-3";
            checkbox.id = "reqinput";
            checkbox.checked = true;
            checkbox.value = "1";

            var reqtext = document.createElement("label");
            reqtext.type = "checkbox";
            reqtext.className = "form-check-label";
            reqtext.for = "reqinput";
            reqtext.textContent = "Soruyu cevaplamak zorunlu olsun";

            reqDiv.appendChild(checkbox);
            reqDiv.appendChild(reqtext);

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(reqDiv, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '' || orderIput.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = orderIput.value;
                const req_status = checkbox.checked ? 1 : 0;
                let data = {};

                data.category = category;
                data.question = question;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                orderIput.remove();
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();

                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

        if (selectedValue == '5') {
            questionTypeLabel.innerText = "Eklenen Soru Tipi: İnput (Tarih)";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Tarih Seçenekli Soru';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary float-end';
            okButton.textContent = 'Soruyu Ekle';

            var reqDiv = document.createElement("div");

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input mr-3";
            checkbox.id = "reqinput";
            checkbox.checked = true;
            checkbox.value = "1";

            var reqtext = document.createElement("label");
            reqtext.type = "checkbox";
            reqtext.className = "form-check-label";
            reqtext.for = "reqinput";
            reqtext.textContent = "Soruyu cevaplamak zorunlu olsun";

            reqDiv.appendChild(checkbox);
            reqDiv.appendChild(reqtext);

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(reqDiv, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '' || orderIput.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = orderIput.value;
                const req_status = checkbox.checked ? 1 : 0;
                let data = {};

                data.category = category;
                data.question = question;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                orderIput.remove();
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();

                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

        if (selectedValue == '6') {
            questionTypeLabel.innerText = "Eklenen Soru Tipi: Varsayılan Şıklı Soru";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Varsayılan Seçenekli Soru';

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary  float-end';
            okButton.textContent = 'Soruyu Ekle';

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = 99;
                const req_status = 1;
                let data = {};

                data.category = category;
                data.question = question;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();

                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

        if (selectedValue == '7') {
            questionTypeLabel.innerText = "Eklenen Soru Tipi: Şıklı Soru";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'Şıklı Soru';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'

            var choiceAddButton = document.createElement('button');
            choiceAddButton.className = 'btn btn-primary float-start';
            choiceAddButton.textContent = '+ Seçenek Ekle';

            var choiceInputs = [];

            choiceAddButton.addEventListener('click', function (event) {
                event.preventDefault();

                var newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.className = 'form-control my-1';
                newInput.name = 'choices[]';
                newInput.id = 'choice-' + choiceInputs.length;
                parentDiv.insertBefore(newInput, choiceAddButton);

                choiceInputs.push(newInput);

                console.log(choiceInputs);
            });

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary float-end';
            okButton.textContent = 'Soruyu Ekle';

            var reqDiv = document.createElement("div");
            reqDiv.className = "col-12 mb-1";

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input mr-3";
            checkbox.id = "reqinput";
            checkbox.checked = true;
            checkbox.value = "1";

            var reqtext = document.createElement("label");
            reqtext.type = "checkbox";
            reqtext.className = "form-check-label";
            reqtext.for = "reqinput";
            reqtext.textContent = "Soruyu cevaplamak zorunlu olsun";

            reqDiv.appendChild(checkbox);
            reqDiv.appendChild(reqtext);

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(reqDiv, select);
            parentDiv.insertBefore(choiceAddButton, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '' || orderIput.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = orderIput.value;
                const options = [];
                const req_status = checkbox.checked ? 1 : 0;
                let data = {};



                for (let i = 0; i < choiceInputs.length; i++) {
                    options.push(choiceInputs[i].value);
                }
                data.category = category;
                data.question = question;
                data.options = options;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                orderIput.remove();
                choiceAddButton.remove();
                choiceInputs.forEach(function (input) {
                    input.remove();
                });
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();

                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

        if (selectedValue == '8') {

            questionTypeLabel.innerText = "Eklenen Soru Tipi: İnput (Dosya)";

            var maindiv = document.getElementById('soru-input');

            var input1 = document.createElement('textarea');
            input1.className = 'form-control my-1';
            input1.placeholder = 'İnput (Dosya)';

            var orderIput = document.createElement('input');
            orderIput.className = 'form-control my-1'
            orderIput.placeholder = 'Soru Sıra No'
            orderIput.type = 'number'

            var okButton = document.createElement('button');
            okButton.className = 'btn btn-primary float-end';
            okButton.textContent = 'Soruyu Ekle';

            var reqDiv = document.createElement("div");

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input mr-3";
            checkbox.id = "reqinput";
            checkbox.checked = true;
            checkbox.value = "1";

            var reqtext = document.createElement("label");
            reqtext.type = "checkbox";
            reqtext.className = "form-check-label";
            reqtext.for = "reqinput";
            reqtext.textContent = "Soruyu cevaplamak zorunlu olsun";

            reqDiv.appendChild(checkbox);
            reqDiv.appendChild(reqtext);

            parentDiv.insertBefore(input1, select);
            parentDiv.insertBefore(orderIput, select);
            parentDiv.insertBefore(reqDiv, select);
            parentDiv.insertBefore(okButton, select);

            okButton.addEventListener('click', function (event) {
                event.preventDefault();

                if (input1.value.trim() === '' || orderIput.value.trim() === '') {
                    alert('Lütfen tüm alanları doldurun.');
                    return;
                }

                const category = selectedValue;
                const question = input1.value;
                const order = orderIput.value;
                const req_status = checkbox.checked ? 1 : 0;
                let data = {};

                data.category = category;
                data.question = question;
                data.order = order;
                data.req = req_status;
                data.id = window.crypto.randomUUID();
                formData.push(data);

                addTable(formData);

                var jsonFormData = JSON.stringify(formData);
                formQuestionDataInput.value = jsonFormData;


                input1.remove();
                orderIput.remove();
                checkbox.remove();
                reqtext.remove();
                reqDiv.remove();


                select.selectedIndex = -1;
                select.style.display = 'inline-block';
                questionTypeLabel.innerText = "Formunuza buradan soru ekleyebilirsiniz";

                okButton.remove();

                console.log(formData);
            });

            select.style.display = 'none';
        }

    }

    function addTable(data) {
        // tabloyu sıfırla

        let formQuestionDataInput = document.getElementById('formQuestionData');
        $("#myTableBody").empty();

        // verileri sırala
        data.sort(function (a, b) {
            return a.order - b.order;
        });

        // verileri tabloya ekle
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                var row = $("<tr>");
                row.attr('row-id', window.crypto.randomUUID());
                row.append($("<td>").text(i + 1));

                // category değerine göre kategori sütununa "Şıklı" veya "Klasik" yaz
                var categoryText = "";
                if (data[i].category == 1) {
                    categoryText = "Metin Alanı Kısa Cevap";
                } else if (data[i].category == 2) {
                    categoryText = "İnput (Sayı)";
                } else if (data[i].category == 3) {
                    categoryText = "Metin Alanı Uzun Cevap";
                } else if (data[i].category == 4) {
                    categoryText = "Doğru - Yanlış";
                } else if (data[i].category == 5) {
                    categoryText = "İnput (Tarih)";
                } else if (data[i].category == 6) {
                    categoryText = "Varsayılan Şıklı Soru";
                } else if (data[i].category == 7) {
                    categoryText = "Şıklı Soru";
                } else if (data[i].category == 8) {
                    categoryText = "İnput (Dosya)";
                }

                row.append($("<td>").text(categoryText));

                row.append($("<td>").text(data[i].question));


                var reqText = "";
                if (data[i].req == "1") {
                    reqText = "Zorunlu";
                } else {
                    reqText = "Zorunlu Değil";
                }

                row.append($("<td>").text(reqText));


                var orderText = data[i].order;
                if (orderText == 99) {
                    orderText = "- ";
                }
                row.append($("<td>").text(orderText));
                // row.append($("<td>").text(data[i].order));

                // "Soruyu Sil" butonunu satıra ekle
                var deleteButton = $("<button>").addClass("btn btn-outline-danger btn-sm").attr('type', 'button').attr(
                    'data-id', data[i].id).text("Soruyu Sil");
                deleteButton.click(function () {
                    $(this).closest('tr').remove(); // ilgili satırı table'dan kaldır
                    var id = $(this).data('id'); // deleteButton'un data-id özelliğini al
                    formData = formData.filter(function (item) {
                        return item.id !== id
                    }); // ilgili objeyi formData array'inden kaldır
                    console.log("Durum: ", formData); // formData array'inin güncel halini konsola yazdır

                    var jsonFormData = JSON.stringify(formData);
                    formQuestionDataInput.value = jsonFormData;
                });

                row.append($("<td>").append(deleteButton));

                $("#myTableBody").append(row);
            }
        } else {
            // eğer veri yoksa, "Henüz Soru Eklenmedi" mesajını göster
            var row = $("<tr>");
            row.append($("<td>").attr("colspan", "5").text("Henüz Soru Eklenmedi"));
            $("#myTableBody").append(row);
        }
    }

    // Kategori seçimi değiştiğinde selectChanged fonksiyonunu çalıştır
    var select = document.querySelector('#soru-tipi');
    select.addEventListener('change', selectChanged);

</script>

<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#explanation'))
        .catch(error => {
            console.error(error);
        });

</script>

@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-repeater.js')) }}"></script>
@endsection

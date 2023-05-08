@extends('layouts/contentLayoutMaster')

@section('title', 'Kullanıcılar')

@section('content')

<!-- Table head options start -->
<div class="row" id="table-head">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kayıtlı Kullanıcılar</h4>
                <div class="modal-size-lg d-inline-block">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#large">
                        <i data-feather='plus'></i> Kullanıcı Ekle
                    </button>
                    <!-- Modal -->
                    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17"
                        aria-hidden="true">
                        <form action="{{route('newAdmin')}}" method="post">
                        @csrf
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17">Yönetici Ekle</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-1 row">
                                            <label for="colFormLabelLg1" class="col-sm-3 col-form-label-lg">Ad -
                                                Soyad</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-lg"
                                                    id="colFormLabelLg1" placeholder="Murat Ertunç" name="name">
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <label for="colFormLabelLg2"
                                                class="col-sm-3 col-form-label-lg">E-posta</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-lg"
                                                    id="colFormLabelLg2" placeholder="example@domain.com" name="email">
                                            </div>
                                        </div>
                                        <div class="mb-1 row">
                                            <label for="colFormLabelLg3"
                                                class="col-sm-3 col-form-label-lg">Parola</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-lg"
                                                    id="colFormLabelLg3" placeholder="• • • • • • • • • • •"
                                                    name="password">
                                            </div>
                                        </div>
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
            </div>
            <div class="card-body">
                <p class="card-text">
                    Sistemdeki mevcut yöneticilere buradaki listeden ulaşabilirsiniz
                </p>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ad - Soyad</th>
                            <th>E-Mail</th>
                            <th>Kullanıcıyı Düzenle</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($savedadmins as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>
                                <div class="modal-size-lg d-inline-block">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#edit-{{$data->id}}">
                                        <i data-feather='edit'></i> Kullanıcıyı Düzenle
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-start" id="edit-{{$data->id}}" tabindex="-1" aria-labelledby="myModalLabel17"
                                        aria-hidden="true">
                                        <form action="{{route('editAdmin', $data->id)}}" method="post">
                                        @csrf
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel17">Kullanıcıyı Düzenle</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-1 row">
                                                            <label for="colFormLabelLg1" class="col-sm-3 col-form-label-lg">Ad -
                                                                Soyad</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-lg"
                                                                    id="colFormLabelLg1" placeholder="Murat Ertunç" name="name" value="{{$data->name}}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-1 row">
                                                            <label for="colFormLabelLg2"
                                                                class="col-sm-3 col-form-label-lg">E-posta</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-lg"
                                                                    id="colFormLabelLg2" placeholder="example@domain.com" name="email" value="{{$data->email}}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-1 row">
                                                            <label for="colFormLabelLg3"
                                                                class="col-sm-3 col-form-label-lg">Parola</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-lg"
                                                                    id="colFormLabelLg3" placeholder="• • • • • • • • • • •"
                                                                    name="password">
                                                            </div>
                                                        </div>
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
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table head options end -->


@endsection

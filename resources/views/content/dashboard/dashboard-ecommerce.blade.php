
@extends('layouts/contentLayoutMaster')

@section('title', 'Ana Sayfa')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
  <div class="row match-height">
    <!-- Medal Card -->
    <div class="col-xl-4 col-md-6 col-12">
      <div class="card card-congratulation-medal">
        <div class="card-body">
          <h5>Hoş Geldiniz</h5>
          <p class="card-text font-small-3">Bu ay yapılan toplam maaş ödemesi</p>
          <h3 class="mb-75 mt-2 pt-50">
            <a href="#">153.650 <b>₺</b> </a>
          </h3>
          <button type="button" class="btn btn-primary">Ödemeleri Görüntüle</button>
          <img src="{{asset('images/illustration/badge.svg')}}" class="congratulation-medal" alt="Medal Pic" />
        </div>
      </div>
    </div>
    <!--/ Medal Card -->

    <!-- Statistics Card -->
    <div class="col-xl-8 col-md-6 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Genel Bilgiler</h4>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">39</h4>
                  <p class="card-text font-small-3 mb-0">Çalışanlar</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">6</h4>
                  <p class="card-text font-small-3 mb-0">Müşteriler</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">11</h4>
                  <p class="card-text font-small-3 mb-0">Projeler</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="users" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">5</h4>
                  <p class="card-text font-small-3 mb-0">Takımlar</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Statistics Card -->
  </div>

  <div class="row match-height">
    <!-- Company Table Card -->
    <div class="col-lg-8 col-12">
      <div class="card card-company-table">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Projeler</th>
                  <th>Takımlar</th>
                  <th>Proje Alanları</th>
                  <th>Başlangıç Tarihi</th>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar rounded">
                        <div class="avatar-content">
                          <img src="{{asset('images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                        </div>
                      </div>
                      <div>
                        <div class="fw-bolder">Qulak Proctor</div>
                        <div class="font-small-2 text-muted">Anadolu Üniversitesi</div>
                      </div>
                    </div>
                  </td>
                  <td class="text-nowrap">
                    <div class="d-flex flex-column">
                      <span class="fw-bolder mb-25">Qulak Proctor Geliştirici Takımı</span>
                      <span class="font-small-2 text-muted">6 Kişi</span>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-primary me-1">
                        <div class="avatar-content">
                          <i data-feather="monitor" class="font-medium-3"></i>
                        </div>
                      </div>
                      <span>Yazılım</span>
                    </div>
                  </td>

                  <td>19.10.2022</td>
                </tr>

                <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                            <img src="{{asset('images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                          </div>
                        </div>
                        <div>
                          <div class="fw-bolder">Qulak Safe Exam</div>
                          <div class="font-small-2 text-muted">Erciyes Üniversitesi</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-nowrap">
                      <div class="d-flex flex-column">
                        <span class="fw-bolder mb-25">Qulak Ana Takımı</span>
                        <span class="font-small-2 text-muted">13 Kişi</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar bg-light-primary me-1">
                          <div class="avatar-content">
                            <i data-feather="monitor" class="font-medium-3"></i>
                          </div>
                        </div>
                        <span>Yazılım</span>
                      </div>
                    </td>

                    <td>12.9.2023</td>
                </tr>

                <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                            <img src="{{asset('images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                          </div>
                        </div>
                        <div>
                          <div class="fw-bolder">CommunueNow</div>
                          <div class="font-small-2 text-muted">Lc Waikiki</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-nowrap">
                      <div class="d-flex flex-column">
                        <span class="fw-bolder mb-25">KCTEK Tasarımcı Takımı</span>
                        <span class="font-small-2 text-muted">6 Kişi</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar bg-light-success me-1">
                          <div class="avatar-content">
                            <i data-feather="figma" class="font-medium-3"></i>
                          </div>
                        </div>
                        <span>Tasarım</span>
                      </div>
                    </td>

                    <td>25.1.2023</td>
                </tr>

                <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                            <img src="{{asset('images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                          </div>
                        </div>
                        <div>
                          <div class="fw-bolder">Qulak Proctor</div>
                          <div class="font-small-2 text-muted">Bahçeşehir Üniversitesi</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-nowrap">
                      <div class="d-flex flex-column">
                        <span class="fw-bolder mb-25">Qulak Ana Takımı</span>
                        <span class="font-small-2 text-muted">13 Kişi</span>
                      </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                          <div class="avatar bg-light-success me-1">
                            <div class="avatar-content">
                              <i data-feather="figma" class="font-medium-3"></i>
                            </div>
                          </div>
                          <span>Tasarım</span>
                        </div>
                    </td>

                    <td>19.10.2022</td>
                </tr>

                <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded">
                          <div class="avatar-content">
                            <img src="{{asset('images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                          </div>
                        </div>
                        <div>
                          <div class="fw-bolder">Qulak Safe Exam</div>
                          <div class="font-small-2 text-muted">Anadolu Üniversitesi</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-nowrap">
                      <div class="d-flex flex-column">
                        <span class="fw-bolder mb-25">Qulak Proctor Developer Takımı</span>
                        <span class="font-small-2 text-muted">6 Kişi</span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar bg-light-primary me-1">
                          <div class="avatar-content">
                            <i data-feather="monitor" class="font-medium-3"></i>
                          </div>
                        </div>
                        <span>Yazılım</span>
                      </div>
                    </td>

                    <td>03.09.2023</td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--/ Company Table Card -->


        <!-- Goal Overview Card -->
    <div class="col-lg-4 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Projeler</h4>
        </div>
        <div class="card-body p-0">
          <div id="goal-overview-radial-bar-chart" class="my-2"></div>
          <div class="row border-top text-center mx-0">
            <div class="col-6 border-end py-1">
              <p class="card-text text-muted mb-0">Tamamlandı</p>
              <h3 class="fw-bolder mb-0">9</h3>
            </div>
            <div class="col-6 py-1">
              <p class="card-text text-muted mb-0">Üstünde Çalışılıyor</p>
              <h3 class="fw-bolder mb-0">2</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Goal Overview Card -->

    <!-- Browser States Card -->
    <div class="col-lg-6 col-md-6 col-12">
      <div class="card card-browser-states">
        <div class="card-header">
          <div>
            <h4 class="card-title">Başvurular</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="browser-states">
            <div class="d-flex">
              <img
                src="https://marketplace.canva.com/EAFEits4-uw/1/0/1600w/canva-boy-cartoon-gamer-animated-twitch-profile-photo-oEqs2yqaL8s.jpg"
                class="rounded me-1"
                height="30"
                alt="Google Chrome"
              />
              <h6 class="align-self-center mb-0">Murat Ertunç</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="fw-bold text-body-heading me-1">54.4%</div>
              <div id="browser-state-chart-primary"></div>
            </div>
          </div>

          <div class="browser-states">
            <div class="d-flex">
              <img
              src="https://marketplace.canva.com/EAFEits4-uw/1/0/1600w/canva-boy-cartoon-gamer-animated-twitch-profile-photo-oEqs2yqaL8s.jpg"
              class="rounded me-1"
                height="30"
                alt="Mozila Firefox"
              />
              <h6 class="align-self-center mb-0">Yasin İlkaya</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="fw-bold text-body-heading me-1">6.1%</div>
              <div id="browser-state-chart-warning"></div>
            </div>
          </div>

          <div class="browser-states">
            <div class="d-flex">
              <img
                src="https://marketplace.canva.com/EAFEits4-uw/1/0/1600w/canva-boy-cartoon-gamer-animated-twitch-profile-photo-oEqs2yqaL8s.jpg"
                class="rounded me-1"
                height="30"
                alt="Apple Safari"
              />
              <h6 class="align-self-center mb-0">Nizamettin Şimşek</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="fw-bold text-body-heading me-1">14.6%</div>
              <div id="browser-state-chart-secondary"></div>
            </div>
          </div>

          <div class="browser-states">
            <div class="d-flex">
              <img
              src="https://marketplace.canva.com/EAFEits4-uw/1/0/1600w/canva-boy-cartoon-gamer-animated-twitch-profile-photo-oEqs2yqaL8s.jpg"
              class="rounded me-1"
                height="30"
                alt="Internet Explorer"
              />
              <h6 class="align-self-center mb-0">Burak Korkmaz</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="fw-bold text-body-heading me-1">4.2%</div>
              <div id="browser-state-chart-info"></div>
            </div>
          </div>

          <div class="browser-states">
            <div class="d-flex">
              <img
              src="https://marketplace.canva.com/EAFEits4-uw/1/0/1600w/canva-boy-cartoon-gamer-animated-twitch-profile-photo-oEqs2yqaL8s.jpg"
              class="rounded me-1" height="30" alt="Opera Mini" />
              <h6 class="align-self-center mb-0">Abdussamed Ulutaş</h6>
            </div>
            <div class="d-flex align-items-center">
              <div class="fw-bold text-body-heading me-1">8.4%</div>
              <div id="browser-state-chart-danger"></div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!--/ Browser States Card -->

    <!-- Transaction Card -->
    <div class="col-lg-6 col-md-6 col-12">
      <div class="card card-transaction">
        <div class="card-header">
          <h4 class="card-title">Takımlar ve Alanları</h4>
        </div>
        <div class="card-body">

          <div class="transaction-item">
            <div class="d-flex">
              <div class="avatar bg-light-success rounded float-start">
                <div class="avatar-content">
                  <i data-feather="users" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">Qulak Ana Geliştirici Ekibi</h6>
              </div>
            </div>
            <div class="fw-bolder text-warning">Yazılım</div>
          </div>

          <div class="transaction-item">
            <div class="d-flex">
              <div class="avatar bg-light-success rounded float-start">
                <div class="avatar-content">
                  <i data-feather="users" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">Qulak Yan Geliştirici Ekibi</h6>
              </div>
            </div>
            <div class="fw-bolder text-warning">Yazılım</div>
          </div>

          <div class="transaction-item">
            <div class="d-flex">
              <div class="avatar bg-light-success rounded float-start">
                <div class="avatar-content">
                  <i data-feather="users" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">Qulak Ana Tasarımcı Ekibi</h6>
              </div>
            </div>
            <div class="fw-bolder text-warning">Tasarım</div>
          </div>

          <div class="transaction-item">
            <div class="d-flex">
              <div class="avatar bg-light-success rounded float-start">
                <div class="avatar-content">
                  <i data-feather="users" class="avatar-icon font-medium-3"></i>
                </div>
              </div>
              <div class="transaction-percentage">
                <h6 class="transaction-title">CommunueNow Ana Geliştirici Ekibi</h6>
              </div>
            </div>
            <div class="fw-bolder text-warning">Yazılım</div>
          </div>

        </div>
      </div>
    </div>
    <!--/ Transaction Card -->

  </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
@endsection

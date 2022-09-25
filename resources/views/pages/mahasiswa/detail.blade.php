@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Detail {{ $mahasiswa->name }}</h1>
        <div class="text-end">
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel panel-primary">
                        <div class="tab-menu-heading tab-menu-heading-boxed">
                            <div class="tabs-menu-boxed">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li><a href="#detail" class="active" data-bs-toggle="tab">Detail</a></li>
                                    <li><a href="#tab26" data-bs-toggle="tab" class="">Semester</a></li>
                                    <li><a href="#tab27" data-bs-toggle="tab" class="">International Exposure</a>
                                    </li>
                                    <li><a href="#tab28" data-bs-toggle="tab" class="">Additional Notes</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @include('partials.errors')
            <div class="tabs-menu-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="detail">
                        @include('pages.mahasiswa.tab.detailMahasiswa')
                    </div>
                    <div class="tab-pane" id="tab26">
                        <p> default model text, and a search for 'lorem ipsum' will uncover many web sites still
                            in
                            their infancy. Various versions have evolved over the years, sometimes by accident,
                            sometimes on purpose (injected
                            humour and the like</p>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                            tempor
                            invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                        </p>
                    </div>
                    <div class="tab-pane" id="tab27">
                        <p>over the years, sometimes by accident, sometimes on purpose (injected humour and the
                            like</p>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                            tempor
                            invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                        </p>
                    </div>
                    <div class="tab-pane" id="tab28">
                        <p>page editors now use Lorem Ipsum as their default model text, and a search for 'lorem
                            ipsum'
                            will uncover many web sites still in their infancy. Various versions have evolved
                            over the
                            years, sometimes
                            by accident, sometimes on purpose (injected humour and the like</p>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                            tempor
                            invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

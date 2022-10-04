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
                                <li><a href="#batchsemester" id="btnSemesterBatch" data-bs-toggle="tab"
                                        class="">Semester Batch</a></li>
                                <li><a href="#international" id="btnInternational" data-bs-toggle="tab"
                                        class="">International
                                        Exposure</a>
                                </li>
                                <li><a href="#note" id="btnNote" data-bs-toggle="tab"
                                        class="">Additional
                                        Notes</a></li>
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
                <div class="tab-pane" id="batchsemester">
                    @include('pages.mahasiswa.tab.batchSemester')
                </div>
                <div class="tab-pane" id="international">
                    @include('pages.mahasiswa.tab.internationalMahasiswa')
                </div>
                <div class="tab-pane" id="note">
                    @include('pages.mahasiswa.tab.notesMahasiswa')

                </div>
            </div>
        </div>
    </div>
</div>
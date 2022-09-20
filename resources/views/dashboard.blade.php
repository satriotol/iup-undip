@extends('layout.main')
@section('content')
    <div class="page-header">
        <h1 class="page-title">Table</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Table</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hoverable Rows Table</h3>
                </div>
                <div class="card-body">
                    <p>Use <code class="highlighter-rouge">.table-hover</code>to add zebra-striping
                        to any table row within the <code class="highlighter-rouge">.tbody</code>.
                    </p>
                    <div class="table-responsive">
                        <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Joan Powell</td>
                                    <td>Associate Developer</td>
                                    <td>$450,870</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Gavin Gibson</td>
                                    <td>Account manager</td>
                                    <td>$230,540</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Julian Kerr</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>$55,300</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Cedric Kelly</td>
                                    <td>Accountant</td>
                                    <td>$234,100</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Samantha May</td>
                                    <td>Junior Technical Author</td>
                                    <td>$43,198</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

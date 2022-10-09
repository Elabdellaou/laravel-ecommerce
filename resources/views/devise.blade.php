@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="h5 fw-bold">Divisé</span>
                        <button class="btn btn-primary" data-bs-toggle="modal" id="btn_add_city" data-bs-target="#add_devise">Ajouter</button>
                    </div>
                    <div class="card-body position-relative">
                        <div class="validation position-absolute start-50 translate-middle" style="top:5%">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                        </div>

                        <table class="table  table-dark table-hover datatable">
                            <thead>
                                <tr class="active">
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Divisé</th>
                                    <th>Active</th>
                                    <th>Local</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody id="tb_devise">
                                @foreach ($devise as $c)
                                    <tr id="{{ 'devise_'.$c->id }}">
                                        <td>
                                            {{ $c->id }}
                                        </td>
                                        <td>
                                            {{ $c->name }}
                                        </td>
                                        <td>
                                            {{ $c->divis }}
                                        </td>
                                        <td>
                                            {{ $c->active == true ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            {{ $c->local == true ? 'active' : 'not active' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" onclick="EditDevice({{ $c -> id }})"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" onclick="DeleteDevice({{ $c -> id }})"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Add -->
                    <div class="modal fade" id="add_devise" tabindex="-1" aria-labelledby="Modal_add_devise"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_add_devise">Ajoter Devise</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="validation position-absolute start-50 translate-middle" style="top:35%;z-index:1500 !important;">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name"
                                                placeholder="Nom">
                                            <label for="name">Nom</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" value="{{ old('divis') }}" class="form-control @error('divis') is-invalid @enderror" id="divis" value=""
                                                placeholder="Divisé">
                                            <label for="name">Divisé</label>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-between">
                                            <div class="form-check ">
                                                <input class="form-check-input @error('active') border-danger @enderror " value="true" type="checkbox"  id="active"
                                                    checked>
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input @error('local') border-danger @enderror " value="true" type="checkbox" id="local"
                                                    checked>
                                                <label class="form-check-label" for="local">
                                                    Local
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal edit -->
                    <div class="modal fade" id="edit_devise" tabindex="-1" aria-labelledby="Modal_edit_devise"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_edit_devise">Modifier Divisé</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="validation position-absolute start-50 translate-middle" style="top:35%;z-index:1500 !important;">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                        </div>
                                        <input type="hidden" name="" id="id">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name"
                                                placeholder="Nom">
                                            <label for="name">Nom</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" value="{{ old('divis') }}" class="form-control @error('divis') is-invalid @enderror" id="divis" value=""
                                                placeholder="Divisé">
                                            <label for="name">Divisé</label>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-between">
                                            <div class="form-check ">
                                                <input class="form-check-input @error('active') border-danger @enderror " type="checkbox" value="{{ old('active') }}" id="active"
                                                    checked>
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input @error('local') border-danger @enderror " type="checkbox" value="{{ old('local') }}" id="local"
                                                    checked>
                                                <label class="form-check-label" for="active">
                                                    Local
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

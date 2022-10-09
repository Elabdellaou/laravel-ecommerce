@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="h5 fw-bold">Pays</span>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_country">Ajouter</button>
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
                                    <th>Code</th>
                                    <th>Active</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody id="tb_country">
                                @foreach ($country as $c)
                                    <tr id="{{ 'country_'.$c->id }}">
                                        <td>
                                            {{ $c->id }}
                                        </td>
                                        <td>
                                            {{ $c->name }}
                                        </td>
                                        <td>
                                            {{ $c->code }}
                                        </td>
                                        <td>
                                            {{ $c->active == true ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" onclick="EditCountry({{ $c -> id }})"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" onclick="DeleteCountry({{ $c -> id }})"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Add -->
                    <div class="modal fade" id="add_country" tabindex="-1" aria-labelledby="Modal_add_country"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_add_country">Ajouter Pays</h5>
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
                                            <input type="text" class="form-control @error('name')
                                                is-invalid
                                            @enderror" id="name" value="{{ old('name') }}"
                                                placeholder="Nom Pays">
                                            <label for="name">Nom de Pays</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control  @error('name')
                                            is-invalid
                                        @enderror" value="{{ old('code') }}" id="code" placeholder="Code">
                                            <label for="code">Code</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input  @error('active')
                                            border-danger
                                        @enderror" type="checkbox" value="true"  id="active"
                                                checked>
                                            <label class="form-check-label" for="active">
                                                Active
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal edit -->
                    <div class="modal fade" id="edit_country" tabindex="-1" aria-labelledby="Modal_edit_country"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_edit_country">Modifier Pays</h5>
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
                                        <input type="hidden" id="id_country">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('name')
                                                is-invalid
                                            @enderror" id="name" value="{{ old('name') }}"
                                                placeholder="Nom Pays">
                                            <label for="name">Nom de Pays</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control  @error('name')
                                            is-invalid
                                        @enderror" value="{{ old('code') }}" id="code" placeholder="Code">
                                            <label for="code">Code</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input  @error('active')
                                            border-danger
                                        @enderror" type="checkbox" value="true"  id="active"
                                                checked>
                                            <label class="form-check-label" for="active">
                                                Active
                                            </label>
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

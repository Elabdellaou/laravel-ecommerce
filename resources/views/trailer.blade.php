@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="h5 fw-bold">Remoque</span>
                        <button class="btn btn-primary" data-bs-toggle="modal" id="btn_add_city" data-bs-target="#add_Trailer">Ajouter</button>
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
                                    <th>Numéro</th>
                                    <th>Taille</th>
                                    <th>Remoque id</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody id="tb_Trailer">
                                @foreach ($TT as $c)
                                    <tr id="{{ 'Trailer_'.$c->id }}">
                                        <td>
                                            {{ $c->id }}
                                        </td>
                                        <td>
                                            {{ $c->numero }}
                                        </td>
                                        <td>
                                            {{ $c->volum }}
                                        </td>
                                        <td>
                                            {{ $c->trailer }}
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" onclick="EditTrailer({{ $c -> id }})"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" onclick="DeleteTrailer({{ $c -> id }})"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Add -->
                    <div class="modal fade " id="add_Trailer" tabindex="-1" aria-labelledby="Modal_add_Trailer"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_add_Trailer">Ajouter Remoque</h5>
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
                                            <input type="text" class="form-control " id="numero" value="{{ old('numero') }}"
                                                placeholder="Numero" name="numero">
                                            <label for="name">Numero</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('volum')
                                            border-danger
                                        @enderror" id="v" name="volum" value="{{ old('volum') }}"
                                                placeholder="Volum">
                                            <label for="name">Taille</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="floatingSelect @error('trailertype_id')
                                            is-invalid
                                        @enderror" value="{{ old('trailertype_id') }}" id="trailertype_id"  aria-label="Floating label select example">
                                                @foreach ($trailer as $cou )
                                                <option>{{ $cou->id }} . {{ $cou->name }} </option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelect">Id . Remoque</label>
                                          </div>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal edit -->
                    <div class="modal fade" id="edit_Trailer" tabindex="-1" aria-labelledby="Modal_edit_Trailer"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_edit_Trailer">Modifier Remoque</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="validation position-absolute start-50 translate-middle" style="top:35% ;z-index:1500 !important;">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                        </div>
                                        <input type="hidden" name="" id="id">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('numero')
                                            is-invalid
                                        @enderror" id="numero" value="{{ old('numero') }}"
                                            placeholder="Numero" name="numero">
                                        <label for="name">Numero</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('volum')
                                        is-invalid
                                    @enderror" id="v" name="volum" value="{{ old('volum') }}"
                                            placeholder="Volum">
                                        <label for="name">Taille</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" @error('trailertype_id')
                                        is-invalid
                                    @enderror value="{{ old('trailertype_id') }}"  aria-label="Floating label select example">
                                            @foreach ($trailer as $cou )
                                            <option>{{ $cou->id }} . {{ $cou->name }} </option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect">Id . Remoque</label>
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
@push('scripts')
<script>

    //$('#edit_city #floatingSelect').select2();
</script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="h5 fw-bold">Villes</span>
                        <input class="form-control" id="search_city" type="search" placeholder="Search" aria-label="Search" style="width: 40%">
                        <button class="btn btn-primary" data-bs-toggle="modal" id="btn_add_city" data-bs-target="#add_city">Ajouter</button>
                    </div>
                    <div class="card-body position-relative">
                        <div class="validation position-absolute start-50 translate-middle" style="top:5%">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                        </div>

                        <table class="table  table-dark table-hover">
                            <thead>
                                <tr class="active">
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Position</th>
                                    <th>Active</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody id="tb_city">
                                @foreach ($city as $c)
                                    <tr id="{{ 'city_'.$c->id }}">
                                        <td>
                                            {{ $c->id }}
                                        </td>
                                        <td>
                                            {{ $c->name }}
                                        </td>
                                        <td>
                                            {{ $c->position }}
                                        </td>
                                        <td>
                                            <input type="checkbox" id='toggle-two' {{ $c->active == true ? 'checked' : '' }} onchange="changeToggle({{ $c->id }})"  data-toggle="toggle" data-size="sm" data-onstyle="outline-success" data-offstyle="outline-danger" data-on="Yes" data-off="No">
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" onclick="DeleteCity({{ $c -> id }})"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $city->links() }}
                    </div>

                    <!-- Modal Add -->
                    <div class="modal fade" id="add_city" tabindex="-1" aria-labelledby="Modal_add_city"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_add_city">Ajouter Ville</h5>
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
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control " value="{{ old('name') }}" id="name"
                                                placeholder="Nom de ville">
                                            <label for="name">Nom de ville</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control " value="{{ old('position') }}" id="position" value=""
                                                placeholder="City name">
                                            <label for="name">Position</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="floatingSelect" value="{{ old('country_id') }}" id="country_id" aria-label="Floating label select example">
                                                    @foreach ($country as $cou )
                                                    <option>{{ $cou->id }}  . {{ $cou->name }}</option>
                                                    @endforeach
                                            </select>
                                            <label for="floatingSelect">Id . Pays</label>
                                          </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input " type="checkbox"  value="true"  id="active"
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
                    <div class="modal fade" id="edit_city" tabindex="-1" aria-labelledby="Modal_edit_city"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content position-relative">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal_edit_city">Modifier Ville</h5>
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
                                            <input type="text" class="form-control" readonly id="name"
                                                placeholder="Nom de ville">
                                            <label for="name">Nom de ville</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" readonly  id="position" value=""
                                                placeholder="City name">
                                            <label for="name">Position</label>
                                        </div>
                                        <div class="form-floating mb-3" >
                                            <select class="form-select" id="floatingSelect" id="country_id" aria-label="Floating label select example" >
                                                @foreach ($country as $cou )
                                                <option>{{ $cou->id }}  . {{ $cou->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelect">Id . Pays</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="true" id="active"
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
@push('scripts')
<script>
        //$('#edd_city .form-select').selectpicker();
</script>
@endpush

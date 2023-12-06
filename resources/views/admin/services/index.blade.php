@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">



            <div class="col-12 col-sm-5 ">

                <div class="table-responsive rounded-4">
                    <table
                        class="table table-striped
                    table-hover	
                    table-borderless
                    table-primary
                    align-middle">
                        <thead class="table-light">
                            <caption>Apartament Services</caption>
                            <tr>
                                <th>Service Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @forelse ($services as $service)
                                <tr class="table-primary">
                                    <td scope="row">{{ $service->name }}</td>
                                    <td>

                                        {{-- controllare poi se l'edit nella stess view del create da problemi --}}

                                        <div class="actions d-flex">
                                            <div class="edit">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" id="btn-{{ $service->id }}">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                    id="modal-{{ $service->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('admin.services.update', $service) }}"
                                                                    method="post" id="form-{{ $service->id }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-3">
                                                                        <label for="title"
                                                                            class="form-label">title</label>
                                                                        <input type="text" class="form-control"
                                                                            name="title" id="title"
                                                                            aria-describedby="helpId" placeholder="title">
                                                                        <small id="helpId"
                                                                            class="form-text text-muted">Help text</small>
                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    id="submit-{{ $service->id }}">Save
                                                                    changes</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="delete">

                                                <form action="{{ route('admin.services.destroy', $service->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button technology="submit" class="btn btn-danger">delete</button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <h2>No services </h2>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>


            </div>
            <div class="col-12 col-sm-7">
                <h4>add new service</h4>
                @if ($errors->any())
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Alert</strong>
                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.services.store') }}" method="post" id="new-service">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="helpService" placeholder="add new service">
                        <small id="helpService" class="form-text text-muted">Add new service for the apartaments</small>
                    </div>

                    <button type="submit" class="btn btn-primary" id="new-service-btn">Add + </button>
                </form>
            </div>
        </div>
    </div>
@endsection

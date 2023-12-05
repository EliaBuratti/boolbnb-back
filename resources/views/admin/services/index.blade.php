@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">



            <div class="col-12 col-sm-5">

                <div class="table-responsive">
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
                                    <td scope="row">{{ $service }}</td>
                                    <td>

                                        {{-- controllare poi se l'edit nella stess view del create da problemi --}}

                                        <div class="actions">
                                            <div class="edit">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    {{ $service }} name
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('admin.services.edit', $service) }}"
                                                                    method="post" id="form-{{ $service->id }}">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Service
                                                                            Name</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" id="name"
                                                                            aria-describedby="helpId"
                                                                            placeholder="{{ $service->name }}">
                                                                        <small id="helpId"
                                                                            class="form-text text-muted">Edit
                                                                            {{ $service->name }}</small>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save
                                                                    changes</button>
                                                                <button type="submit">Update</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="delete">

                                                <form action="{{ route('admin.services.destroy', $service->slug) }}"
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


                <ul>
                    @foreach ($services as $service)
                        <li>{{ $service }}</li>
                    @endforeach
                </ul>
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

                <form action="{{ route('admin.services.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="helpService" placeholder="add new service">
                        <small id="helpService" class="form-text text-muted">Add new service for the apartaments</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Add + </button>
                </form>
            </div>
        </div>
    </div>
@endsection

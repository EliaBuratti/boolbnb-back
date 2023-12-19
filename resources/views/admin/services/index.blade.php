@extends('layouts.app')

@section('content')
    <div class="container">

        @include('../partials.errors')

        <div class="row mt-4">


            <div class="col-12 col-sm-5 ">

                <div class="table-responsive rounded-4">
                    <table
                        class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Service Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @forelse ($services as $service)
                                <tr>
                                    <td scope="row">{{ $service->name }}</td>
                                    <td>
                                        <div class="actions d-flex gap-3">
                                            <div class="edit">
                                                <a href="{{ route('admin.services.edit', $service->slug) }}"
                                                    class="btn btn-dark primary">Edit</a>
                                            </div>
                                            <div class="delete">
                                                <form action="{{ route('admin.services.destroy', $service->slug) }}"
                                                    method="post" id>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button technology="submit" class="btn btn-danger">Delete</button>
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
                <h4>Add new service</h4>
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
                            aria-describedby="helpService" placeholder="Add new service">
                    </div>

                    <button type="submit" class="btn btn-dark primary" id="new-service-btn">Add + </button>
                </form>
            </div>
        </div>
    </div>
@endsection

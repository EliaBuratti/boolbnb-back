@extends('layouts.app')

@section('content')
    <div class="container">

        @include('../partials.errors')

        <div class="row">

            <div class="col-12 col-sm-5">

                <div class="table-responsive">
                    <table
                        class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Sponsorship Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @forelse ($sponsorships as $sponsorship)
                                <tr>
                                    <td scope="row">{{ $sponsorship->name }}</td>
                                    <td>
                                        <div class="actions d-flex gap-3">

                                            <div class="edit">
                                                <a href=" {{ route('admin.sponsorships.edit', $sponsorship->id) }}"
                                                    class="btn primary btn-dark">Edit</a>
                                            </div>
                                            <div class="delete">

                                                <form action="{{ route('admin.sponsorships.destroy', $sponsorship->id) }}"
                                                    method="post">
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
                                    <h2>No sponsorships </h2>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-sm-7">
                <h4>Add new sponsorship</h4>
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

                <form action="{{ route('admin.sponsorships.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Sponsorship Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="nameHelper" placeholder="Add new sponsorship">
                        <small id="nameHelper" class="form-text text-muted">Add name</small>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Sponsorship price</label>
                        <input type="number" step=".01" min=1 max=999.99 class="form-control" name="price"
                            id="price" aria-describedby="nameHelper" placeholder="9.99 €">
                        <small id="priceHelper" class="form-text text-muted">Add price</small>
                    </div>

                    <div class="mb-3">
                        <label for="duration" class="form-label">Sponsorship duration</label>
                        {{-- <input type="time" class="form-control" name="duration" id="duration"
                            aria-describedby="timeHelper" placeholder="Add new sponsorship"> --}}
                        <input type="text" pattern="^([0-9]+):([0-5][0-9]):([0-5][0-9])$" class="form-control"
                            name="duration" id="duration" aria-describedby="timeHelper"
                            placeholder="Hour : Minute : Seceonds">
                        <small id="timeHelper" class="form-text text-muted">Add duration</small>
                    </div>

                    <button type="submit" class="btn primary btn-dark">Add + </button>
                </form>
            </div>
        </div>
    </div>
@endsection

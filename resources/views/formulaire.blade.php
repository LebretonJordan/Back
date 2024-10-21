@extends('template')

@section('content')

<h1>Créer votre compte</h1>
<p>Vous avez déjà un compte ? Connectez-vous !</p>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('registration.store') }}" method="post">
    @csrf

    <div>
        <label for="surname">Prénom</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Prénom">
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="name">Nom</label>
        <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Nom">
        @error('lastname')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="username">Société (facultatif)</label>
        <input type="text" name="society" id="society" value="{{ old('society') }}" placeholder="Société">
    </div>

    <div>
        <label for="email">email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="email">
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="phone_number">Téléphone</label>
        <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
            placeholder="Téléphone">
        @error('phone_number')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe">
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="adress">Adresse Principale</label>
        <input type="text" name="adress" id="adress" placeholder="Adresse Principale">
        @error('adress')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="reset">Réinitialiser</button>

        <button type="submit">Enregistrer</button>
    </div>
</form>
@endsection
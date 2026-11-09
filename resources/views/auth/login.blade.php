<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Ticketing System</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #e6e3db;
        }

        .login-card {
            background-color: #5a6853;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(90, 104, 83, 0.3);
            color: #333;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #5a6853;
            outline: none;
            box-shadow: 0 0 0 3px rgba(90, 104, 83, 0.2);
        }

        .btn-login {
            background-color: #465240;
            color: #ffffff;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #465240;
            transform: translateY(-1px);
        }
    </style>
</head>


<body class="h-screen flex flex-col justify-between relative overflow-hidden">

    <div class="grow flex items-center justify-center">
        <div class="login-card p-8 rounded-2xl w-96 relative z-10">

            <div class="flex justify-center mb-6">
                <div class=" p-2 rounded-xl shadow-sm">
                    <img src="{{ asset('login-image.jpg') }}" alt="Logo" class="img-fluid p-2 rounded"
                        style="max-height: 120px; width: 100%; object-fit: contain;">
                </div>
            </div>

            <h2 class="text-2xl font-bold text-center text-white mb-6">Connexion</h2>

            @if ($errors->any())
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg mb-4 text-sm flex items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <select name="full_name"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#465240]">
                        @foreach ($users as $user)
                            <option value="{{ $user->first_name }} {{ $user->last_name }}">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <input type="password" name="password" placeholder="Mot de passe"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#465240]">
                </div>

                <button type="submit"
                    class="btn-login w-full font-bold py-3 px-4 rounded-lg flex justify-center items-center">
                    Se connecter
                </button>
            </form>
        </div>
    </div>

    {{-- <footer class="w-full text-center py-4 relative z-10 text-sm text-white" style="background-color: #5a6853;">
        &copy; {{ date('Y') }} Ticketing System. Tous droits réservés.
    </footer> --}}

</body>

</html>

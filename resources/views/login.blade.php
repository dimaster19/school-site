@vite(['resources/js/app.js'])

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <form class="card-body p-5 text-center" action="/login" method="post" class="row g-3 needs-validation" validate>
                    @csrf
                    <h3 class="mb-5">Вход в админ-панель</h3>

                    <div class="form-outline mb-4">
                        <input type="text" id="typeEmailX-2" name="login" required class="form-control form-control-lg" />
                        <label class="form-label" for="typeEmailX-2">Логин</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="typePasswordX-2" name="password" required class="form-control form-control-lg" />
                        <label class="form-label" for="typePasswordX-2">Пароль</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-start mb-4">
                        <input class="form-check-input" name="remember" type="checkbox"  id="form1Example3" />
                        <label class="form-check-label mx-2" for="form1Example3"> Запомнить меня</label>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Вход</button>

                </form>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>

        </div>

    </div>

</div>

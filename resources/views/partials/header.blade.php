<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center p-3">
                    <ul class="list-unstyled d-flex my-0">
                        <!-- Home Button with House Icon -->
                        <li class="me-3">
                            <a class="text-decoration-none nav-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}"
                                href="{{ route('home') }}">
                                <i class="bi bi-house"></i>
                            </a>
                        </li>

                        <!-- Characters Link -->
                        <li class="me-3">
                            <a class="text-decoration-none nav-link {{ Route::currentRouteName() === 'characters.index' || Route::currentRouteName() === 'characters.show' || Route::currentRouteName() === 'characters.edit' || Route::currentRouteName() === 'characters.create' ? 'active' : '' }}"
                                href="{{ route('characters.index') }}">
                                Personaggi
                            </a>
                        </li>

                        <!-- Items Link -->
                        <li class="me-3">
                            <a class="text-decoration-none nav-link {{ Route::currentRouteName() === 'items.index' || Route::currentRouteName() === 'items.show' || Route::currentRouteName() === 'items.edit' || Route::currentRouteName() === 'items.create' ? 'active' : '' }}"
                                href="{{ route('items.index') }}">
                                Oggetti
                            </a>
                        </li>

                        <!-- Types Link -->
                        <li class="me-3">
                            <a class="text-decoration-none nav-link {{ Route::currentRouteName() === 'types.index' || Route::currentRouteName() === 'types.show' || Route::currentRouteName() === 'types.edit' || Route::currentRouteName() === 'types.create' ? 'active' : '' }}"
                                href="{{ route('types.index') }}">
                                Tipologie
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center p-3">
                    <ul class=" list-unstyled d-flex my-0">
                        <li class="me-3"><a
                                class=" text-decoration-none nav-link {{ Route::currentRouteName() === 'characters.index' || Route::currentRouteName() === 'characters.show' || Route::currentRouteName() === 'characters.edit' || Route::currentRouteName() === 'characters.create' ? 'active' : '' }}"
                                href="{{ route('characters.index') }}">
                                characters
                            </a>
                        </li>
                        <li class=""><a
                                class=" text-decoration-none  nav-link {{ Route::currentRouteName() === 'items.index' || Route::currentRouteName() === 'items.show' || Route::currentRouteName() === 'items.edit' || Route::currentRouteName() === 'items.create' ? 'active' : '' }}"
                                href="{{ route('items.index') }}">
                                Items
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

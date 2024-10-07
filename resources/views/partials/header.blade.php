<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center pt-5">
                <ul class=" list-unstyled d-flex my-0">
                    <li class="me-3"><a
                            class=" text-decoration-none nav-link {{ Route::currentRouteName() === 'characters.index' ? 'active' : '' }}"
                            href="{{ route('characters.index') }}">
                            characters
                        </a>
                    </li>
                    <li class=""><a
                            class=" text-decoration-none  nav-link {{ Route::currentRouteName() === 'items.index' || Route::currentRouteName() === 'comics.show' ? 'active' : '' }}"
                            href="{{ route('items.index') }}">
                            Items
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <ul class=" list-unstyled d-flex align-items-center my-0 mx-5">
                    <li class="px-3"><a
                            class=" text-decoration-none nav-link {{ Route::currentRouteName() === 'characters.index' ? 'active' : '' }}"
                            href="{{ route('characters.index') }}">
                            characters
                        </a>
                    </li>
                    <li class="px-3"><a
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

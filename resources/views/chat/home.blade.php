<x-layout-app pageTitle="Chat">
    <div class="w-100 p-4">

        <h3>Chat</h3>

        <hr>

        {{-- Lista de conversas --}}
        <div class="card-body d-flex container-fluid">

            <div class="row w-100">

                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                    <div class="p-3">

                    <div class="input-group rounded mb-3">
                        <input type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                        aria-describedby="search-addon" />
                        <span class="input-group-text border-0 ms-2" id="search-addon">
                        <i class="fas fa-search"></i>
                        </span>
                    </div>

                    <div data-mdb-perfect-scrollbar-init style="position: relative; height: 400px">
                        <ul class="list-unstyled mb-0">

                        @foreach ($users as $user)
                            <li class="p-2 border-bottom">
                                <x-user-chat :user="$user" />
                            </li>
                        @endforeach

                        </ul>
                    </div>

                    </div>

                </div>

                <div class="col-8 d-none" id="chat-section">
                    {{-- Espaco para o componente do chat. Só deve aparecer se uma conversa for selecionada --}}
                    <x-chat />
                </div>
            </div>

        </div>
    </div>

</x-layout-app>

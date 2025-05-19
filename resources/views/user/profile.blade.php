<x-layout-app pageTitle="Perfil">
    <div class="w-100 p-4">
        <h3>Perfil</h3>
        <hr>

        <div class="d-flex gap-5">

            <x-profile-user-data />

        </div>

        <hr>

        <div class="container-fluid m-0 p-0 mt-5">
            <div class="row">

                <x-profile-user-change-password />

                <x-profile-user-change-data :colaborator="$colaborator"/>

                <x-profile-user-details-change :colaborator="$colaborator" />

            </div>
        </div>

    </div>
</x-layout-app>

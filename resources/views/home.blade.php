<x-layout-app pageTitle="Home">

    <div class="w-100 p-4">
        <h3>Home</h3>
        <hr>

        <div class="d-flex">
            <x-info-title-value item-title="Total de Colaboradores" :item-value="$data['total_colaborators']" />
            <x-info-title-value item-title="Total de Colaboradores Deletados" :item-value="$data['total_colaborators_deleted']" />
            <x-info-title-value item-title="Gastos totais com salário" :item-value="$data['total_salary']" />
        </div>
        <hr>
        <div class="d-flex">
            <x-info-title-collection item-title="Colaboradores por Departamento" :collection="$data['total_colaborators_by_department']" />
            <x-info-title-collection item-title="Gastos por Departamento" :collection="$data['total_salary_by_department']" />
        </div>

    </div>

</x-layout-app>

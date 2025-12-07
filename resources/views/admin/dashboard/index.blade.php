<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{__('Dashboard')}}
    </h2>
  </x-slot>
  <div class="py-6 mx-2">
    <div
      class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

      <x-stat-card label="Bendras vartotojų skaičius" value="1,523" color="indigo">
        <x-lucide-users class="w-6 h-6" />
      </x-stat-card>

      <x-stat-card label="Nauji vartotojai (30 d.)" value="128" color="indigo">
        <x-lucide-user-plus class="w-6 h-6" />
      </x-stat-card>

      <x-stat-card label="Aktyvūs vartotojai (7 d.)" value="842" color="indigo">
        <x-lucide-activity class="w-6 h-6" />
      </x-stat-card>

      <x-stat-card label="Bendras kursų skaičius" value="74" color="red">
        <x-lucide-book-open class="w-6 h-6" />
      </x-stat-card>

      <x-stat-card label="Nauji kursai (30 d.)" value="6" color="red">
        <x-lucide-file-plus class="w-6 h-6" />
      </x-stat-card>

      <x-stat-card label="Registracijos į kursus (30 d.)" value="312" color="green">
        <x-lucide-graduation-cap class="w-6 h-6" />
      </x-stat-card>

      <x-stat-card label="Vidutinis kursų įvertinimas" value="4.6 ★" color="yellow">
        <x-lucide-star class="w-6 h-6" />
      </x-stat-card>

      <x-stat-card label="Įvertinimų (30 d.)" value="56" color="orange">
        <x-lucide-message-circle class="w-6 h-6" />
      </x-stat-card>

    </div>
  </div>
</x-admin-layout>
<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{__('Dashboard')}}
    </h2>
  </x-slot>
  <div class="py-6 mx-2">
    <div
      class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-users class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Bendras vartotojų skaičius</p>
          <p class="text-2xl font-bold text-gray-900">1,523</p>
        </div>
      </div>

      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-user-plus class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Nauji vartotojai (30 d.)</p>
          <p class="text-2xl font-bold text-gray-900">128</p>
        </div>
      </div>

      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-activity class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Aktyvūs vartotojai (7 d.)</p>
          <p class="text-2xl font-bold text-gray-900">842</p>
        </div>
      </div>

      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-book-open class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Bendras kursų skaičius</p>
          <p class="text-2xl font-bold text-gray-900">74</p>
        </div>
      </div>

      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-file-plus class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Nauji kursai (30 d.)</p>
          <p class="text-2xl font-bold text-gray-900">6</p>
        </div>
      </div>

      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-graduation-cap class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Registracijos į kursus (30 d.)</p>
          <p class="text-2xl font-bold text-gray-900">312</p>
        </div>
      </div>

      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-star class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Vidutinis kursų įvertinimas</p>
          <p class="text-2xl font-bold text-gray-900">4.6 ★</p>
        </div>
      </div>

      <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200 flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
          <x-lucide-message-circle class="w-6 h-6" />
        </div>
        <div>
          <p class="text-sm text-gray-500">Įvertinimų (30 d.)</p>
          <p class="text-2xl font-bold text-gray-900">56</p>
        </div>
      </div>

    </div>
  </div>
</x-admin-layout>
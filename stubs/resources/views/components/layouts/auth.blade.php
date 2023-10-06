<x-layouts.base>


    <x-slot name="pageName">{{ $pageName }}</x-slot>
  
    <main class="w-screen py-8 overflow-y-scroll  bg-gray-100">

      {{ $slot }}
    </main>
            
      
  </x-layouts.base>
  
<x-app-layout>
  <div class="flex flex-col items-center justify-center p-6">
    <div class="w-full max-w-5xl">
      @if (auth()->user()->is_admin == 1) 
        <a 
        class="inline-flex my-3 items-center justify-center text-sm shadow-lg border border-gray-300 dark:border-gray-700 bg-white hover:bg-gray-500 font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary h-10 px-4 py-2 rounded-sm transition-all duration-500 dark:text-black hover:text-white cursor-pointer"
        href={{route('incidents.edit', $incident)}}
        >
          Káresemény szerkeztése
        </a>
        <x-danger-button
        x-data=""
        class=' h-10 px-4 py-2 rounded-none mx-2 my-3'
        x-on:click.prevent="$dispatch('open-modal', 'confirm-incident-deletion')"
        >
          Káresemény törlése
        </x-danger-button>
        <x-modal name="confirm-incident-deletion" focusable>
          <form method="post" action="{{ route('incidents.destroy', $incident) }}" class="p-6">
              @csrf
              @method('delete')
  
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  {{ __('Biztos?') }}
              </h2>
  
  
              <div class="mt-6 flex justify-end">
                  <x-secondary-button x-on:click="$dispatch('close')">
                      {{ __('Mégse') }}
                  </x-secondary-button>
  
                  <x-danger-button class="ms-3">
                      {{ __('Biztos!') }}
                  </x-danger-button>
              </div>
          </form>
      </x-modal>
      @endif
      <div class="mt-4 space-y-2 text-black dark:text-white">
        <h1 class="text-2xl font-semibold">{{$incident->location}} - {{$incident->time}}</h1>
        <p class="text-base font-medium text-gray-800 dark:text-gray-200">{{$incident->desc}}</p>
      </div>
      <h2 class="text-xl font-bold dark:text-white my-3">Járművek:</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach ($vehicles as $vehicle)
        @php
          $imageSrc = (substr($vehicle->image, 0, 4) == 'http') ? $vehicle->image : asset('storage/images/' . $vehicle->image);  
        @endphp
        <a href={{route('vehicles.show', $vehicle)}}>
          <div
          class="text-card-foreground shadow-sm rounded-lg overflow-hidden bg-white dark:bg-gray-700"
          >
            <img
              src={{$imageSrc}}
              height="200"
              width="400"
              alt="Incident related image"
              class="object-cover w-full h-48"
              style="aspect-ratio: 400 / 200; object-fit: cover;"
            />
            <div class="flex flex-col space-y-1.5 p-4">
              <h3 class="text-2xl font-semibold leading-none tracking-tight text-black dark:text-white">{{$vehicle->brand}} - {{$vehicle->model}}</h3>
              <p class="text-sm text-gray-800 dark:text-gray-200">{{$vehicle->license}}</p>
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
</x-app-layout>
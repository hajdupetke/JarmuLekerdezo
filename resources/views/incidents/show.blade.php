<x-app-layout>
  <div class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-900">
    <div class="w-full max-w-5xl">
      <div class="mt-4 space-y-2 text-black dark:text-white">
        <h1 class="text-2xl font-semibold">{{$incident->location}} - {{$incident->time}}</h1>
        <p class="text-base font-medium text-gray-800 dark:text-gray-200">{{$incident->desc}}</p>
      </div>
      <h2 class="text-xl font-bold dark:text-white my-3">Járművek:</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach ($vehicles as $vehicle)
        <a href={{route('vehicles.show', $vehicle)}}>
          <div
          class="text-card-foreground shadow-sm rounded-lg overflow-hidden bg-white dark:bg-gray-700"
          >
            <img
              src={{$vehicle->image}}
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
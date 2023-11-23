<x-app-layout>
  <div class='flex flex-col gap-10 py-10 justify-center items-center'>
  <h1 class="dark:text-white text-6xl font-bold"> Keresési előzmények</h1>
  <div class="text-white">
  @php
      $sorted = $history->sortByDesc('search_time');
  @endphp
  
  @foreach($sorted as $key => $item)
  @php
    $vehicle = $item->vehicle()[0];
    $imageSrc = (substr($vehicle->image, 0, 4) == 'http') ? $vehicle->image : asset('storage/images/' . $vehicle->image);
  @endphp
  <a href={{route('vehicles.show', $vehicle)}}>
    <div
      class="border text-card-foreground my-4 bg-white dark:bg-zinc-800 rounded-lg overflow-hidden shadow-lg max-w-xl mx-auto dark:border-black"
    >
      <div class="flex">
        <div class="w-1/2">
          <img
            src={{$imageSrc}}
            height="150"
            width="200"
            alt="Placeholder image"
            class="object-cover w-full h-full"
            style="aspect-ratio: 200 / 120; object-fit: cover;"
          />
        </div>
        <div class="w-1/2 p-4">
          <h3 class="text-2xl font-semibold leading-none tracking-tight text-gray-900 dark:text-white">{{$vehicle->license}}</h3>
          <p class="py-3 text-gray-600 dark:text-gray-200 mt-2">{{$item->search_time}}</p>
        </div>
      </div>
    </div>
  </a>
  @endforeach
  {{$history->links()}}
  </div>
</div>  
</x-app-layout>
<x-app-layout>
  <div class="space-y-8 w-6/12 mx-auto mt-8">
    <div class="space-y-2">
      <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Autó információk</h2>
      <p class="text-gray-500 dark:text-gray-200">Töltse ki az alábbi űrlapot az autó adatainak rögzítéséhez.</p>
    </div>
    <form class="space-y-4" action={{route('vehicles.store')}} method="POST" enctype="multipart/form-data">
      @csrf
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="license_plate"
        >
          Rendszám
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="license_plate"
          name="license_plate"
          value="{{old('license_plate') ?? null}}"
          placeholder="Adja meg a rendszámot"
          type='text'
        />
        @error('license_plate')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Rendszám hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="brand"
        >
          Márka
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="brand"
          name='brand'
          value="{{old('brand') ?? null}}"
          placeholder="Adja meg a márka nevét"
          type='text'
        />
        @error('brand')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Márka hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="model"
        >
          Model
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="model"
          name='model'
          value="{{old('model') ?? null}}"
          placeholder="Adja meg a modelt"
          type='text'
        />
        @error('model')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Model hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="year"
        >
          Évjárat
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="year"
          name='year'
          value="{{old('year') ?? null}}"
          placeholder="Adja meg az évjáratot"
          type='number'
        />
        @error('year')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Évjárat hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="grid w-full max-w-sm items-center gap-1.5">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="image"
        >
          Kép feltöltése
        </label>
        <input
          class="flex w-full rounded-md py-2 text-sm ring-offset-background file:border-0 file:bg-gray-800 file:cursor-pointer file:hover:bg-gray-600 file:duration-150 file:text-white file:px-4 file:py-2 file:mr-2 file:rounded-lg  file:text-md file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50  text-gray-800 dark:text-gray-200"
          id="image"
          type="file"
          value="{{old('image') ?? null}}"
          name='image'
        />
        @error('license_plate')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Kép hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <button type="submit" class ="inline-flex my-3 items-center justify-center text-sm shadow-lg border border-gray-300 dark:border-gray-700 font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary h-10 px-4 py-2 rounded-full transition-all duration-500 hover:bg-gray-600  dark:bg-gray-800 dark:text-white cursor-pointer">Autó létrehozása</button>

    </form>
  </div>
</x-app-layout>
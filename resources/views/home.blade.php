<x-guest-layout>
    <x-slot name="title">Főoldal</x-slot>

    <section class="w-full h-full flex flex-col items-center justify-center bg-zinc-100 dark:bg-zinc-800">
        <h1 class="text-4xl font-bold text-center mb-4 text-zinc-900 dark:text-zinc-50">
            Jármű Lekérdező
        </h1>
        <p class="text-xl text-center mb-6 text-zinc-500 dark:text-zinc-400">
            Keressen rá különböző rendszámokra, hogy lekérdezze az adott jármű baleseteit.
        </p>
        <form action={{route('search')}} method="POST" role='search' class="max-w-lg w-full" >
            @csrf
            <div class="w-full px-4 py-2 bg-white dark:bg-zinc-900 shadow-md rounded-md flex items-center space-x-4">
                <input class="flex-grow !m-0 text-base text-zinc-900 dark:text-zinc-50 bg-transparent !outline-none border-transparent focus:border-transparent focus:ring-0" placeholder="Keresés..." aria-label="Search" type="text" name="license">
                <button class="p-2 rounded-md bg-zinc-600 dark:bg-zinc-300 text-zinc-50 dark:text-zinc-900"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" h-5 w-5"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg></button>
            </div>
            @error('license')
            <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
                <p class="font-semibold">Rendszám hiba:</p>
                <p>{{$message}}</p>
            </div>
            @enderror
        </form>
        <a href={{route('history.index')}} class="my-5 bg-white p-3 rounded-md hover:bg-gray-500 hover:text-white duration-150">Keresési előzmények</a>
    </section>

</x-guest-layout>
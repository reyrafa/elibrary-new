<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-5 py-5" style="text-align: center;">
                <label for="" class="text-primary font-semibold">Learn from yesterday, live for today, hope for tommorow. The important thing is not to stop questioning.</label>
                <br><label for="">- Albert Einstein -</label>
                <h1 style="font-size: 30px;">Welcome Librarian</h1>
            </div>
        </div>
    </div>
</x-app-layout>
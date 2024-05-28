<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  ">
                <h1 style="font-weight: bold;">Task Management System by Malaika Batool </h1><br> <br>
                <a style="border:1px solid black; padding:10px" href="{{ route('tasks') }}">Explore Tasks</a>
            
            
            </div>
        </div>
    </div>
</x-app-layout>

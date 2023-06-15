<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                {{--                {{isset($variable) ? $variable->name : old('taskname')}}--}}

                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ ucwords(str_replace('.', ' ', request()->route()->getName())) }}
                        </h2>
                    </header>

                    <form method="post"
                          action="{{ request()->route()->getName() === 'tasks.create' ? route('tasks.store') : route('tasks.update',$task->id) }}"
                          class="mt-6 space-y-6">
                        @csrf
                        @method(request()->route()->getName() === 'tasks.create'?'POST' :'PUT')
                        <div>
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                          :value="old('title', $task->title ?? '')" required autofocus
                                          placeholder="Enter task title"
                                          autocomplete="title"/>
                            <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')"/>
                            <x-textarea id="description" name="description" type="text" class="mt-1 block w-full"
                                          :value="old('description', $task->description ?? '')" required autofocus
                                          placeholder="Enter description"
                                          autocomplete="description"/>
                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                        </div>


                        <div class="flex items-center gap-4">
                            <x-secondary-button type="button"
                                                onclick="window.location.href='{{ route('tasks.index') }}'">{{ __('Back') }}</x-secondary-button>
                            <x-primary-button
                                type="submit">{{ __(request()->route()->getName() === 'tasks.create'? 'Save' : 'Update') }}</x-primary-button>

                            @if (session('status') === 'data-saved')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

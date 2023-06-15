<div class="bg-white">
    @if (session('status') === 'data-deleted')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-red-700"
        >{{ __('Record Deleted.') }}</p>
    @endif
    <div class="flex items-center gap-4 p-3 flex justify-end">
        <x-primary-button
            onclick="window.location.href='{{ route('users.create') }}'">{{ __('Create User') }}</x-primary-button>

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
    <div class="overflow-x-auto border-x border-t">
        <table class="table-auto w-full">
            <thead class="border-b">
            <tr class="bg-gray-100">
                <th class="text-left p-4 font-medium">
                    Name
                </th>
                <th class="text-left p-4 font-medium">
                    Email
                </th>
                <th class="text-left p-4 font-medium">
                    Phone
                </th>
                <th class="text-left p-4 font-medium">
                    Role
                </th>
                <th class="text-left p-4 font-medium">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($userData as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">
                        {{ $user['name'] }}
                    </td>
                    <td class="p-4">
                        {{ $user['email'] }}
                    </td>
                    <td class="p-4">
                        {{ $user['phone'] }}
                    </td>
                    <td class="p-4">
                        {{ $user['roles'][0]->name }}
                    </td>
                    <td class="p-4 flex">
                        <a href="{{ route('users.edit', $user->id) }}" class="pr-2">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" style="height: 25px; width: 25px;"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                            </svg>
                        </a>
                        <form action="{{route('users.destroy',$user->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" style="height: 25px; width: 25px;"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                </svg>
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

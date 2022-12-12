<div class="p-5 m-10 bg-white rounded-lg">
    <table class="w-full">
        <thead class="text-lg font-bold text-orange-500 ">
            <td class="pl-5 border-b border-r">#id</td>
            <td class="pl-5 border-b border-r">name</td>
            <td class="pl-5 border-b ">products count</td>
            <td class="pl-5 border-b"></td>
        </thead>

        <tbody>
            @foreach ([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1] as $thing)
                <tr class="{{ $loop->odd ? '' : 'bg-orange-50' }}">
                    <td class="py-1 pl-5 border-l">{{ $loop->index }}</td>

                    <td class="py-1 pl-5 border-l">
                        <form>
                            <input type="text" class="w-full h-full bg-transparent border-0 focus:ring-0"
                                value="somthing" placeholder="somthing">
                        </form>
                    </td>

                    <td class="py-3 pl-5 border-l">452</td>

                    <td>
                        <span class="px-3 py-1 text-white bg-red-500 rounded-lg">Delete</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

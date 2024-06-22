<div>
    <h2 class="text-2xl font-bold mb-4"> payments list by periods</h2>
    <form wire:submit.prevent="submit">
        <select wire:model="selectedItem" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value="">Choose </option>
            @foreach($items as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>

        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
            Submit
        </button>
    </form>

    @if ($generatedList)
        <div class="mt-4">
            <h2 class="text-lg font-bold">Payment List for invoice{{ $selectedItem }} </h2>
            <ul class="list-disc list-inside">
                @foreach($generatedList as $generatedItem)
                    <li>{{ $generatedItem }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

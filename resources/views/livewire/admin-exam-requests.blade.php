
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left">მომხმარებლის სახელი</th>
                    <th class="py-3 px-4 text-left">გამოცდის ტიპი</th>
                    <th class="py-3 px-4 text-left">მოთხოვნის თარიღი</th>
                    <th class="py-3 px-4 text-left">მოთხოვნის ID</th>
                    <th class="py-3 px-4 text-left">მოქმედება</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($examRequests->sortByDesc('created_at') as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $request->user->name }}</td>
                        <td class="py-3 px-4">არქიტექტურული</td>
                        <td class="py-3 px-4">{{ $request->created_at->format('Y-m-d H:i') }}</td>
                        <td class="py-3 px-4">#{{ $request->id }}</td>
                        <td class="py-3 px-4">
                            @if($request->approved)
                                <button 
                                    wire:click="cancelRequest({{ $request->id }})"
                                    class="bg-gray-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    გაუქმება
                                </button>
                            @else
                                <button 
                                    wire:click="approveRequest({{ $request->id }})"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    დამტკიცება
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


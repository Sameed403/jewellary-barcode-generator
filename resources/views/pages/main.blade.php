<x-layouts.content>
    <article class="min-h-[80vh] print:min-h-fit py-16 print:py-0 ">
        <section class="container mx-auto w-100 flex h-full items-center justify-center flex-wrap md:space-x-5 print:hidden print:py-0 print:items-start">
            <div class="flex-1">
                <form action="{{ route('homestoreData') }}" method="POST" class="bg-slate-800 px-5 py-10 ">
                    @csrf

                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-white">Product Name</label>
                        <input type="text" id="text" name="product_name" class="bg-gray-50  text-gray-900 text-sm block w-full p-2.5 outline-none" placeholder="Enter Name" >
                    </div>

                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-white">Quantity</label>
                        <input type="text" id="text" name="product_quantity" class="bg-gray-50  text-gray-900 text-sm block w-full p-2.5 outline-none" placeholder="Enter Quantity" >
                    </div>


                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-white">Net</label>
                        <input type="text" id="text" name="product_netweight" class="bg-gray-50  text-gray-900 text-sm block w-full p-2.5 outline-none" placeholder="Enter Net" >
                    </div>

                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-white">Size</label>
                        <input type="text" id="text" name="product_size" class="bg-gray-50  text-gray-900 text-sm block w-full p-2.5 outline-none" placeholder="Enter Size" >
                    </div>

                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-white">Karat</label>
                        <input type="text" id="text" name="product_carrot" class="bg-gray-50  text-gray-900 text-sm block w-full p-2.5 outline-none" placeholder="Enter Karat Amount" >
                    </div>

                    <div class="mb-6">
                        <label for="text" class="block mb-2 text-sm font-medium text-white">Extra Label</label>
                        <input type="text" id="text" name="product_extra" class="bg-gray-50  text-gray-900 text-sm block w-full p-2.5 outline-none" placeholder="Enter Extra Label" >
                    </div>

                    <button type="submit" name="makeBarcode" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>

        </section>

        <section class="container print:border-black print:border-2 mx-auto w-100 flex h-full my-5 items-center justify-center flex-wrap md:space-x-5 print:m-0 print:h-fit">
            @if (session()->has('barcode'))
                @if (count(session()->get('barcode')) > 0)
                <div class="grid grid-cols-2 w-full my-5 print:hidden">
                    <a class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center" href="{{ route('homedeleteData') }}">Clear Barcodes</a>
                    <a class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center" onclick="window.print()">Print Barcodes</a>
                </div>
                @endif
            @endif
        </section>

        {{-- Print --}}
        <section class="w-full h-fit grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 container mx-auto print:grid-cols-3">

            @if (session()->has('barcode'))
                @if (session()->get('barcode'))
                    @php
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    @endphp
                @foreach (session()->get('barcode') as $key => $item)

                        <div class="grid bg-slate-600 print:bg-white p-3 h-fit text-white print:text-black">
                            <div class="grid place-items-start">
                                @php
                                    echo '<img class="w-full bg-white" src="data:image/png;base64,' . base64_encode($generator->getBarcode($item['product_barcode_number'], $generator::TYPE_CODE_128)) . '">';
                                @endphp

                            </div>
                            <div class="grid w-full h-fit grid-cols-2">
                                <label for="Barcode Number" class="border-2 border-black">Barcode</label>
                                <div class="border-2 border-black">{{ $item['product_barcode_number'] }}</div>

                                @if(!empty($item['product_name']))
                                <label for="Product Name" class="border-2 border-black">Name</label>
                                <div class="border-2 border-black">{{ $item['product_name'] }}</div>
                                @endif
                                @if(!empty($item['product_quantity']))
                                <label for="Product Quantity" class="border-2 border-black">Quantity</label>
                                <div class="border-2 border-black">{{ $item['product_quantity'] }}</div>
                                @endif
                                @if(!empty($item['product_netweight']))
                                <label for="Product Net Weight" class="whitespace-nowrap border-2 border-black">Net Weight</label>
                                <div class="border-2 border-black">{{ $item['product_netweight'] }}</div>
                                @endif
                                @if(!empty($item['product_size']))
                                <label for="Product Size" class="border-2 border-black">Size</label>
                                <div class="border-2 border-black">{{ $item['product_size'] }}</div>
                                @endif
                                @if(!empty($item['product_carrot']))
                                <label for="Karat" class="border-2 border-black">Karat</label>
                                <div class="border-2 border-black">{{ $item['product_carrot'] }}</div>
                                @endif
                                @if(!empty($item['product_extra']))
                                <label for="Product Extra" class="border-2 border-black">Extra</label>
                                <div class="border-2 border-black">{{ $item['product_extra'] }}</div>
                                @endif

                            </div>
                            <div class="h-fit print:hidden">
                                <a class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 block font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center" href="{{ route('removeItem',$key) }}">Delete Barcode</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endif
        </section>
        {{-- Print --}}

    </article>
</x-layouts.content>

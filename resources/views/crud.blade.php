@extends('plantilla')

@section('contenido')
    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow">
                    <div class="w-full flex p-4" id="button">
                        <a {{ request()->is('/') ? '' : 'href=' . route('index') . '' }}>
                            <button
                                class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm"
                                onclick="modalHandler(true)">Añadir usuario </button>
                        </a>
                    </div>
                    <table class="divide-y divide-green-400 ">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    ID
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Name
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Email
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Direccion
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Telefono
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Edad
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Created_at
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Edit
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Delete
                                </th>
                            </tr>
                        </thead>


                        <tbody class="bg-white divide-y divide-gray-300">



                            @foreach ($user as $element)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <?php
                                        echo $element['id'];
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php
                                            echo $element['nombre'];
                                            ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500"><?php
                                        echo $element['correo'];
                                        ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <?php
                                        echo $element['direccion'];
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <?php
                                        echo $element['telefono'];
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <?php
                                        echo $element['edad'];
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <?php
                                        echo $element['created_at'];
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">


                                        <a href="{{ route('user.editar', [$element['id']]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2
                                                                                                                                                                                2 0 112.828
                                                                                                                                                                                2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('user.delete', [$element['id']]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5
                                                                                                                                                                                4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
        </div>
    </div>

    <div>
        <!-- component -->
        <!-- Code block starts -->
        <dh-component>

            <div class="py-12 bg-gray-700/50 transition duration-150 ease-in-out fixed flex  justify-center items-center h-screen z-50 top-0 right-0 bottom-0 left-0"
                style="@isset($userFind) @else opacity: -0.1; display: none  @endisset " id="modal">
                <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
                    <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                        <form <?php $url = $_SERVER['REQUEST_URI'];
                        $path = parse_url($url, PHP_URL_PATH);
                        $parts = explode('/', $path);
                        $numero = end($parts); ?>
                            @isset($userFind) action="{{ route('user.update', [$numero]) }} @else action="{{ route('user.registrar') }} @endisset"
                            method="POST">
                            @csrf
                            <div class="w-full flex justify-start text-gray-600 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet"
                                    width="52" height="52" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d=" M0 0h24v24H0z" />
                                    <path
                                        d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                                    <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                                </svg>
                            </div>
                            <button type="button"
                                class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                                onclick="modalHandler()" aria-label="close modal" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Enter Billing
                                Details</h1>
                            <label for="name"
                                class="block text-gray-800 text-sm font-bold leading-tight tracking-normal">Nombre</label>
                            <input id="nombre"
                                class=" mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                placeholder="James" name="nombre"
                                value="@isset($userFind)<?php echo $userFind['nombre']; ?>@endisset" />
                            <div class="mb-5">
                                @error('nombre')
                                    {{ $message }}
                                @enderror
                            </div>
                            <label for="identificacion"
                                class="block text-gray-800 text-sm font-bold leading-tight tracking-normal">identificacion</label>
                            <input id="identificacion"
                                class=" mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                placeholder="James" name="identificacion"
                                value="@isset($userFind)<?php echo $userFind['identificacion']; ?>@endisset" />
                            <div class="mb-5">
                                @error('identificacion')
                                    {{ $message }}
                                @enderror
                            </div>
                            <label for="direccion"
                                class="text-gray-800 text-sm font-bold leading-tight tracking-normal block">Direccion</label>
                            <input id="direccion"
                                class=" mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                placeholder="Calle 20" name="direccion"
                                value="@isset($userFind)<?php echo $userFind['direccion']; ?>@endisset" />
                            <div class="mb-5">
                                @error('direccion')
                                    {{ $message }}
                                @enderror
                            </div>
                            <label for="telefono"
                                class="text-gray-800 text-sm font-bold leading-tight tracking-normal block">Telefono</label>
                            <input id="telefono"
                                class=" mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                placeholder="3214123123" name="telefono"
                                value="@isset($userFind)<?php echo $userFind['telefono']; ?>@endisset" />
                            <div class="mb-5">
                                @error('telefono')
                                    {{ $message }}
                                @enderror
                            </div>
                            <label for="email"
                                class="text-gray-800 text-sm font-bold leading-tight tracking-normal block">Email</label>
                            <input
                                class="mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                placeholder="example@gamil.com" name="correo"
                                value="@isset($userFind)<?php echo $userFind['correo']; ?>@endisset" />
                            <div class="mb-5">
                                @error('correo')
                                    {{ $message }}
                                @enderror
                            </div>
                            <label for="edad"
                                class="text-gray-800 text-sm font-bold leading-tight tracking-normal block">Edad</label>
                            <input
                                class=" mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                                placeholder="example@gamil.com" name="edad"
                                value="@isset($userFind)<?php echo $userFind['edad']; ?>@endisset" />
                            <div class="mb-5">
                                @error('edad')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="w-full flex justify-start" id="button">
                                <button type="submit"
                                    class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700  transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">
                                    @isset($userFind)
                                        Actualizar
                                    @else
                                        Añadir
                                    @endisset
                                </button>
                                @isset($userFind)
                                    <a href="{{ route('user.pdf', [$userFind['id']]) }}">
                                        <button type="button"
                                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700  transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">
                                            PDF</button>
                                    </a>
                                @endisset

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                let modal = document.getElementById("modal");

                function modalHandler(val) {
                    if (val) {
                        fadeIn(modal);
                    } else {
                        fadeOut(modal);
                    }
                }

                function fadeOut(el) {
                    el.style.opacity = 1;
                    (function fade() {
                        if ((el.style.opacity -= 0.1) < 0) {
                            el.style.display = "none";
                        } else {
                            requestAnimationFrame(fade);
                        }
                    })();
                }

                function fadeIn(el, display) {
                    el.style.opacity = 0;
                    el.style.display = display || "flex";
                    (function fade() {
                        let val = parseFloat(el.style.opacity);
                        if (!((val += 0.2) > 1)) {
                            el.style.opacity = val;
                            requestAnimationFrame(fade);
                        }
                    })();
                }
            </script>

        </dh-component>
        <!-- Code block ends -->
    </div>
@endsection

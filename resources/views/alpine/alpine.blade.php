<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alpine') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SOLO ALPINE SIN NADA DE PHP --}}
            {{-- los div se combierten en componentes de alpine sin interferir con la demas pagina --}}
            <div x-data></div>
            <div name="ejemplo 1">
                <h1>ejemplo 1</h1>
                {{-- x-data="{ open: true }" => de esta manera se declaran las variables de alpine --}}
                <div x-data="{ open: false }">

                    {{-- x-on:click => detecta clic,  !open => pone la variable al contrario de lo que es actualmente --}}
                    <button class="btn btn-primary" x-on:click="open = !open">
                        Menu
                        <i x-show="!open" class="bi bi-chevron-compact-right"></i>
                        <i x-show="open" class="bi bi-chevron-down"></i>
                    </button>

                    {{-- x-on:click.away => Funcionalidad de click lejos del espacio del nav --}}
                    <nav x-show="open" x-on:click.away="open = false">
                        <ul>
                            <li><i class="bi bi-dash-lg"></i>Item 1</li>
                            <li><i class="bi bi-dash-lg"></i>Item 2</li>
                            <li><i class="bi bi-dash-lg"></i>Item 3</li>
                            <li><i class="bi bi-dash-lg"></i>Item 4</li>
                            <li><i class="bi bi-dash-lg"></i>Item 5</li>
                        </ul>
                    </nav>
                </div>
            </div>

            {{-- si bien programar asi lo facilita es feo el codigo asi que deberemos hacer lo siguitente --}}
            <div name="ejemplo 2">
                <h1>ejemplo 2</h1>
                <div x-data="data()" x-init="start()">

                    {{-- x-bind:disabled="true"  / :disabled="false" => va a mostrar un atributo dependiendo del valor --}}
                    <button x-bind:disabled="open" class="btn btn-primary" @click="isOpen()">
                        Menu
                        {{-- ⏫ :class{'clase': true} => Sirve para oculatar o mostrar una clase dependiendo el valor del atributo --}}
                        <i class="bi bi-chevron-down bi-chevron-compact-right" :class="{ 'bi-chevron-down': open, 'bi-chevron-compact-right': !open }"></i>
                    </button>
                    {{-- x-on:click / @click => 2 formas de usarlo --}}
                    <nav x-show="open" @click.away="close()">
                        <ul>
                            <li><i class="bi bi-dash-lg"></i>Item 1</li>
                            <li><i class="bi bi-dash-lg"></i>Item 2</li>
                            <li><i class="bi bi-dash-lg"></i>Item 3</li>
                            <li><i class="bi bi-dash-lg"></i>Item 4</li>
                            <li><i class="bi bi-dash-lg"></i>Item 5</li>
                        </ul>
                    </nav>
                </div>

                <script>
                    function data() {
                        return {
                            open: null,
                            start() {
                                this.open = false;
                            },
                            isOpen() {
                                this.open = !this.open
                            },
                            close() {
                                this.open = false
                            },
                        }
                    }
                </script>
            </div>

            <div>
                <h1>ejemplo 3</h1>
                <div x-data="{ mensaje: 'Hola, me actualizo :3' }">
                    <input type="text" x-model="mensaje">

                    <button @click="$refs.msj.innerText=mensaje" class="btn btn-success">Enviar</button>

                    <p x-text="mensaje"> soy mensaje</p>
                    <p x-ref="msj">Yo espero un trigger</p>
                </div>
            </div>

            <div>
                <h1>ejemplo 4</h1>
                <div x-data="ejemplo4()">
                    <ul>
                        <span>Object</span>
                        <template x-for="product_obj in Object.values(products_object)">
                            <li>
                                <span x-text="product_obj.stock"></span>
                                -
                                <span x-text="product_obj.name"></span>

                                <span x-show="product_obj.stock === 0">(Sin Stock)</span>

                                {{-- <template x-if="product_obj.stock === 0"> Tiene pedos de programación y no jala esta madre sepa la verga por que :v
                                    (Sin Stock)
                                </template> --}}

                            </li>
                        </template>
                    </ul>

                    <ul class="pt-3">
                        <span>Array</span>
                        <template x-for="product_array in products_array">
                            <li>
                                <span x-text="product_array.stock"></span>
                                -
                                <span x-text="product_array.name"></span>
                            </li>
                        </template>
                    </ul>
                </div>

                <script>
                    function ejemplo4() {
                        return {
                            products_object: {
                                1: {
                                    id: 1,
                                    name: 'voler al futuro 3logy',
                                    stock: 5
                                },
                                2: {
                                    id: 2,
                                    name: 'Harry Potter 1',
                                    stock: 12
                                },
                                3: {
                                    id: 3,
                                    name: 'Harry Potter 2',
                                    stock: 1
                                },
                                4: {
                                    id: 4,
                                    name: 'Harry Potter 3',
                                    stock: 0
                                }
                            },

                            products_array: [{
                                    id: 1,
                                    name: 'Pantalon',
                                    stock: 5
                                },
                                {
                                    id: 2,
                                    name: 'Camisa',
                                    stock: 3
                                },
                                {
                                    id: 3,
                                    name: 'Chamarra',
                                    stock: 8
                                },
                                {
                                    id: 4,
                                    name: 'Tenis',
                                    stock: 0
                                }
                            ],
                        }
                    }
                </script>
            </div>

            <div>
                <h1>Ejemplo 5</h1>
                <div x-data="{ mensaje: null, msj: null }">
                    <button class="btn btn-primary" @click="console.log('hola mundo')">Hazme click</button>

                    {{-- @submit/@submit.prevent  --}}
                    <form action="" @submit.prevent="console.log(mensaje)">
                        <input type="text" x-model="mensaje">
                        <button class="btn btn-primary" @click.away="console.log('Has hecho click fuera del boton')">Enviar</button>
                    </form>

                    {{-- @keydown/.enter/.escape/.arraw-down/.arraw-up/.ctrl.a/.a --}}
                    <input type="text" class="pt-5" x-model="msj" @keydown.enter="console.log(msj)">
                </div>
            </div>

            <div>
                <h1>Ejemplo 6</h1>
                <div x-data="{ open: true }" @resize.window="open = window.outerWidth > 768 ? true : false">
                    <p x-show="open">
                        Este mensaje solo se muestra desde una pantalla grande
                    </p>
                </div>
            </div>

            <div>
                <h1>Ejemplo 7</h1>
                <div x-data>
                    {{-- $el/$refs.nombre. => hace referencia de si mismo --}}
                    <button class="btn btn-primary" @click="$refs.nombre.innerHTML='texto cambiado'">
                        {{-- <button class="btn btn-primary" @click="$el.innerHTML='texto cambiado'"> --}}
                        Hazme click
                    </button>

                    <p x-ref="nombre">Un texto</p>
                </div>

                {{-- capturar eventos --}}
                <div x-data>
                    <input type="text" @input="console.log($event.target.value)">
                </div>
                {{-- SON COMPONENTES DIFERENTES, NO AFECTA EL NOMBRE --}}
                <div x-data="{ mensaje: null }">
                    <input type="text" x-model="mensaje">
                </div>
                <div x-data="{ mensaje: null }">
                    <input type="text" x-model="mensaje">
                </div>

                {{-- CONECTIVIDAD CON COMPONENTES DE ALPINE --}}
                <div x-data="{ mensaje: null }">
                    {{-- $dispatch => emit de livewire --}}
                    <input type="text" x-model="mensaje" @input="$dispatch('custom-event', mensaje)">
                </div>
                <div x-data="{ mensaje: null }" @custom-event.window="mensaje = $event.detail">
                    <input type="text" x-model="mensaje">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

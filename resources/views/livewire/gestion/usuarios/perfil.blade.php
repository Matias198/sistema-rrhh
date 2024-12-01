<div>
    <div class="col">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a wire:ignore.self class="nav-link active" id="perfil" data-toggle="pill" href="#perfil_tab"
                            role="tab" aria-controls="perfil_tab" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a wire:ignore.self class="nav-link" id="settings" data-toggle="pill" href="#settings_tab"
                            role="tab" aria-controls="settings_tab" aria-selected="false">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div wire:ignore.self class="tab-pane fade active show" id="perfil_tab" role="tabpanel"
                        aria-labelledby="perfil">
                        @livewire('Gestion.Empleados.Ver', ['id_persona' => $id_persona])
                    </div>
                    <div wire:ignore.self class="tab-pane fade" id="settings_tab" role="tabpanel"
                        aria-labelledby="settings">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Correo Electronico</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="font-bold mb-4">Actualizar Correo Electronico</h5>
                                        <p class="pr-4 font-italic text-md text-secondary">
                                            Actualiza tu correo electronico para recibir notificaciones y mantener tu
                                            cuenta segura.
                                        </p>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <div class="mt-4 d-flex justify-content-center">
                                                    <i class="fas fa-envelope-open-text text-info fa-3x"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Correo Actual -->
                                        <div class="form-group">
                                            <label for="email_user">Correo Actual</label>
                                            <input type="email" class="form-control" id="email_user"
                                                value="{{ $email_user }}" disabled>
                                        </div>
                                        <!-- Correo Electronico -->
                                        <div class="form-group">
                                            <label for="email_nuevo">Correo Electronico</label>
                                            <input type="email_nuevo"
                                                class="form-control @if (!$errors->get('') && $this->email_nuevo != null) border-success is-valid @endif  @error('email_nuevo') border-danger is-invalid @enderror"
                                                id="email_nuevo" name="email_nuevo" wire:model="email_nuevo"
                                                autocomplete="off"
                                                x-on:input="$wire.set('email_nuevo', $('#email_nuevo').val())">
                                            @error('email_nuevo')
                                                <span
                                                    class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            @if (!$errors->get('email_nuevo') && $this->email_nuevo != null)
                                                <span class="d-block text-success valid-feedback">Campo correcto</span>
                                            @endif
                                        </div>
                                        <!-- Repetir Correo Electronico -->
                                        <div class="form-group">
                                            <label for="email_confirmation">Repetir Correo Electronico</label>
                                            <input type="email"
                                                class="form-control @if (!$errors->get('') && $this->email_confirmation != null) border-success is-valid @endif  @error('email_confirmation') border-danger is-invalid @enderror"
                                                id="email_confirmation" name="email_confirmation"
                                                wire:model="email_confirmation" autocomplete="off"
                                                x-on:input="$wire.set('email_confirmation', $('#email_confirmation').val())">
                                            @error('email_confirmation')
                                                <span
                                                    class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            @if (!$errors->get('email_confirmation') && $this->email_confirmation != null)
                                                <span class="d-block text-success valid-feedback">Campo correcto</span>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button wire:click="updateEmail"
                                                class="btn btn-secondary">Actualizar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Correo Electronico</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="font-bold mb-4">Actualizar Contraseña</h5>
                                        <p class="pr-4 font-italic text-md text-secondary">
                                            Actualiza tu contraseña para mantener tu cuenta segura.
                                        </p>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <div class="mt-4 d-flex justify-content-center">
                                                    <i class="fa fa-lock text-info fa-3x"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <input type="password"
                                                class="form-control @if (!$errors->get('') && $this->password != null) border-success is-valid @endif  @error('password') border-danger is-invalid @enderror"
                                                id="password" name="password" wire:model="password" autocomplete="off"
                                                x-on:input="$wire.set('password', $('#password').val())">
                                            @error('password')
                                                <span
                                                    class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            @if (!$errors->get('password') && $this->password != null)
                                                <span class="d-block text-success valid-feedback">Campo correcto</span>
                                            @endif
                                        </div>
                                        <!-- Repetir Password -->
                                        <div class="form-group">
                                            <label for="password_confirmation">Repetir Contraseña</label>
                                            <input type="password"
                                                class="form-control @if (!$errors->get('') && $this->password_confirmation != null) border-success is-valid @endif  @error('password_confirmation') border-danger is-invalid @enderror"
                                                id="password_confirmation" name="password_confirmation"
                                                wire:model="password_confirmation" autocomplete="off"
                                                x-on:input="$wire.set('password_confirmation', $('#password_confirmation').val())">
                                            @error('password_confirmation')
                                                <span
                                                    class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            @if (!$errors->get('password_confirmation') && $this->password_confirmation != null)
                                                <span class="d-block text-success valid-feedback">Campo correcto</span>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button wire:click="updatePassword"
                                                class="btn btn-secondary">Actualizar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>


</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('success', function(message) {
            Sweetalert2.fire({
                title: 'Correcto',
                text: message[0],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            })
        });


        Livewire.on('error', function(message) {
            Sweetalert2.fire({
                title: 'Error',
                text: message[0],
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            })
        });
        
        $(function() {
            new bootstrap.Tooltip($('[data-toggle="tooltip"]'))
        })

        if ($('body').hasClass('dark-mode')) {
            $('.select2-selection__rendered').css('color', '#ffff')
            $('.select2-selection').addClass('form-control')
            var links = $("link");
            for (var i = 0; i < links.length; i++) {
                if (links[i].href.indexOf("dark.css") !== -1) {
                    links[i].href = links[i].href.replace(
                        "dark",
                        "flatpickr"
                    );
                }
            }
        }
    });
</script>

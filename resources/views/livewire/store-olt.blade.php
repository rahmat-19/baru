<div class="card-body">
    <div class="">
        <form wire:submit.prevent="save">

            <div class="mb-3" wire:ignore>
                <label for="sto" class="form-label">STO</label>

                <select wire:ignore class="js-example-basic-single form-select" id="id_sto" name="id_sto" style="width: 100%;">
                    @foreach($stos as $sto)
                    <option value={{$sto->id}}>{{$sto->kota}}</option>
                    @endforeach
                </select>
                @error('id_sto')
                <div id="id_sto" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="hostname" class="form-label">Hostname</label>
                <input type="text" value="{{old('hostname')}}" wire:model="hostname" class="form-control @error('hostname') is-invalid @enderror" name="hostname" id="hostname" placeholder="Hostname Olt">
                @error('hostname')
                <div id="hostname" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="ip" class="form-label">Ip Address</label>
                <input type="text" value="{{old('ip')}}" wire:model="ip" class="form-control @error('ip') is-invalid @enderror" name="ip" id="ip" placeholder="0.0.0.0/24">
                @error('ip')
                <div id="ip" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="merk" class="form-label">Merk OLT</label>

                <select class="form-select" wire:model="merk" id="merk" name="merk" style="width: 100%;">
                    <option value='ZTE'>ZTE</option>
                    <option value='HUAWEI'>HUAWEI</option>
                    <option value='FIBERHIOME'>FIBERHOME</option>
                </select>
                @error('merk')
                <div id="merk" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="type" class="form-label">Type {{$merk}}</label>

                <select class="form-select @error('type') is-invalid @enderror" wire:model="type" id="type" name="type" style="width: 100%;">
                    <option>Select Type {{$merk}}</option>
                    @foreach($types as $type)
                    <option value='{{$type}}'>{{$type}}</option>
                    @endforeach

                </select>
                @error('type')
                <div id="type" class="invalid-feedback mb-3">
                    {{$message}}
                </div>
                @enderror
            </div>
            <hr>
            <div class="mb-3">

                <button type="submit" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">Add OLT</span>
                </button>
            </div>
        </form>
    </div>


    <script>
        document.addEventListener('livewire:load', function() {
            $('#id_sto').on('change', function() {
                @this.set('id_sto', this.value)
            })
        })
    </script>

</div>
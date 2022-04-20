<form action="/admin/inspection/add" method="post" wire:submit.prevent="newInspection" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class = "inspection">
            <label>Car Brand:</label>
            <select id = "carBrand" class = "form-control @error('car_brand') is-invalid @enderror">
                <option value="0" disabled selected>-- Please Select Car Brand --</option>
                @foreach ($CarBrands as $CarBrand)
                    <option value="{{$CarBrand->id}}">{{$CarBrand->brand}}</option>
                @endforeach
            </select>
                @error('car_brand')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <br>
            <label>Car:</label>
            <select id = "Car" name = "car" class = "form-control @error('car') is-invalid @enderror" disabled>
            </select>
                @error('car')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <br>
            <label>Registration Number:</label>
            <input type="text" wire:model="reg_num" class="form-control @error('reg_num') is-invalid @enderror">
            @error('reg_num')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <label>Data File:</label>
            <input type = "file" wire:model = "data_file" class = "form-control @error('data_file') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                @error('data_file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            <br>
            <label>Ownership File:</label>
            <input type = "file" wire:model = "ownership_file" class = "form-control @error('ownership_file') is-invalid @enderror" accept = "application/JSON,application/xml,text/plain,text/xml,image/png,image/jpeg">
                @error('ownership_file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-outline-primary" value = "Add" wire:loading.attr="disabled"></button>
    </div>
</form>

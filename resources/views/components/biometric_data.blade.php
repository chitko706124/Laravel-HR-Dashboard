@foreach ($biometrics as $biometric)
    <button style="position: relative;width:101.36px" class=" biometric-old-data btn py-2 btn-sm border"><i
            style="font-size: 32px;color:#4CD195" class=" fas fa-fingerprint m-1"></i>
        <p class=" mb-0" style="font-size: 10px">Biometric {{ $loop->iteration }}</p>
        <i style="position: absolute;top:0;right:0;padding:8px;font-size:15px;color:red"
            class=" fas fa-trash-alt biometric-delete-btn" data-id="{{ $biometric->id }}"></i>
    </button>
@endforeach

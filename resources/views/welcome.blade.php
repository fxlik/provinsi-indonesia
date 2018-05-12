<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



    </head>
    <body>
        <div class="container">
            <!-- <div class="row"> -->
            <div class="col-md-4">
                <form>
                    <div class="form-group">
                        <label for="provinsi">Provinsi:</label>
                        <select class="form-control" id="provinces" name="provinces">
                            <option value="0" disable="true" selected="true">=== Pilih Provinsi ===</option>
                            @foreach($provinces as $key => $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for=kabupaten>Kabupaten:</label>
                        <select class="form-control" name="regencies" id="regencies">
                            <option value="0" disable="true" selected="true">=== Pilih Kabupaten/Kota ===</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan:</label>
                        <select class="form-control" name="districts" id="districts">
                            <option value="0" disable="true" selected="true">=== Pilih Kecamatan ===</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desa">Desa:</label>
                        <select class="form-control" name="villages" id="villages">
                            <option value="0" disable="true" selected="true">=== Pilih Desa ===</option>
                        </select>
                    </div>
                </form>
            </div>
            <!-- </div> -->
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            $('#provinces').on('change', function(e){
                console.log(e);
                var province_id = e.target.value;
                $.get('/json-regencies?province_id=' + province_id,function(data) {
                    console.log(data);
                    $('#regencies').empty();
                    $('#regencies').append('<option value="0" disable="true" selected="true">=== Pilih Kabupaten/Kota ===</option>');

                    $('#districts').empty();
                    $('#districts').append('<option value="0" disable="true" selected="true">=== Pilih Kecamatan ===</option>');

                    $('#villages').empty();
                    $('#villages').append('<option value="0" disable="true" selected="true">=== Pilih Desa ===</option>');

                    $.each(data, function(index, regenciesObj){
                        $('#regencies').append('<option value="'+ regenciesObj.id +'">'+ regenciesObj.name +'</option>');
                    })
                });
            });

            $('#regencies').on('change', function(e){
                console.log(e);
                var regencies_id = e.target.value;
                $.get('/json-districts?regencies_id=' + regencies_id,function(data) {
                    console.log(data);
                    $('#districts').empty();
                    $('#districts').append('<option value="0" disable="true" selected="true">=== Pilih Kecamatan ===</option>');
                    $.each(data, function(index, districtsObj){
                        $('#districts').append('<option value="'+ districtsObj.id +'">'+ districtsObj.name +'</option>');
                    })
                });
            });

            $('#districts').on('change', function(e){
                console.log(e);
                var districts_id = e.target.value;
                $.get('/json-village?districts_id=' + districts_id,function(data) {
                    console.log(data);
                    $('#villages').empty();
                    $('#villages').append('<option value="0" disable="true" selected="true">=== Pilih Desa ===</option>');

                    $.each(data, function(index, villagesObj){
                        $('#villages').append('<option value="'+ villagesObj.id +'">'+ villagesObj.name +'</option>');
                    })
                });
            });
        </script>
    </body>
</html>

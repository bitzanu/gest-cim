  $(document).ready(function(){
  $('#cimitir').change(function()
    {
        $.get( '/cimitire/' + this.value + '/parcele' , function(parcele)
        {
            console.log(parcele);
            if ( ! jQuery.isEmptyObject(parcele)) {
            var $parcela = $('#parcela');

            $parcela.find('option').remove().end();
            $parcela.append('<option value="0">' + 'toate' + '</option>');
            $.each(parcele, function(index, parcela) {
                $parcela.append('<option value="' + parcela.id + '">' + parcela.numar + '</option>');
            });
        } else {
            alert('Selecteaza!');
        }
        });

    });
   $('#parcela').change(function()
    {
        $.get( '/parcele/' + this.value + '/locuri' , function(locuri)
        {
            console.log(parcela);
            if ( ! jQuery.isEmptyObject(locuri)) {
            var $loc = $('#loc');

            $loc.find('option').remove().end();
            $loc.append('<option value="0">' + 'toate' + '</option>');

            $.each(locuri, function(index, loc) {
                $loc.append('<option value="' + loc.id + '">' + loc.numar + '</option>');
            });
        } else {
            alert('Parcela nu are niciun loc!');
        }
        });

    });
});
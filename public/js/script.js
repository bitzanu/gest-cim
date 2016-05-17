jQuery.noConflict();
jQuery(document).ready(function($){
    if ($("#persoane").length) {
        var selections=[];
        $("#persoane option:selected").each(function() {
            var optionText=$(this).text();
            console.log(optionText);
            selections.push(optionText);
        });
        $("#numepersoane").append(selections.join(" , "));

    };

    $('#cimitir').change(function()
    {
        $.get( '/cimitire/' + this.value + '/parcele' , function(parcele)
        {
            if ( ! jQuery.isEmptyObject(parcele)) {
            var $parcela = $('#parcela');

            $parcela.find('option').remove().end();
            $parcela.append('<option value="0">' + 'toate' + '</option>');
            $.each(parcele, function(index, parcela) {
                $parcela.append('<option value="' + parcela.id + '">' + parcela.numar + '</option>');
            });
            }
        });

    });
    $('#parcela').change(function()
    {
        $.get( '/parcele/' + this.value + '/locuri' , function(locuri)
        {
            if ( ! jQuery.isEmptyObject(locuri)) {
            var $loc = $('#loc');

            $loc.find('option').remove().end();
            $loc.append('<option value="0">' + 'toate' + '</option>');

            $.each(locuri, function(index, loc) {
                $loc.append('<option value="' + loc.id + '">' + loc.numar + '</option>');
            });
        }
        });

    });

      $('#persoane').change(function() 
      {
        var selections=[];
        $("#numepersoane").empty();
        $("#persoane option:selected").each(function() {
            var optionText=$(this).text();
            selections.push(optionText);
        });
        $("#numepersoane").append(selections.join(" , "))
      });

});